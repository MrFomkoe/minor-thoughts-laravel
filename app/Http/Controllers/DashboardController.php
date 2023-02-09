<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Song;
use App\Models\Album;
use App\Models\Photo;
use App\Models\Description;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting a single record of description from database 
        // and exploding it into several array records, 
        // so further it could be displayed in paragraphs
        $desciption = Description::first();
        $albums = Album::all();
        $songs = Song::all();
        $gigs = Gig::orderBy('date', 'asc')->get();
        $user = auth()->user();

        return view('dashboard.index', [
            'description' => $desciption,
            'albums' => $albums,
            'songs' => $songs,
            'gigs' => $gigs,
            'user' => $user,
        ]);
    }
}
