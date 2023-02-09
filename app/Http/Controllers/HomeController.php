<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Description;
use App\Models\Gig;
use App\Models\Photo;
use App\Models\Song;
use Illuminate\Http\Request;
use Symfony\Component\Console\Descriptor\Descriptor;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Getting a single record of description from database and exploding it into several array records, so further it could be displayed in paragraphs
        $desciption = Description::first();
        if ($desciption) {
            $desciption = preg_split('/\R/', Description::first()->text);
        }
        $albums = Album::all();
        $songs = Song::where('featured', true)->get();
        $gigs = Gig::where('upcoming', true)->orderBy('date', 'asc')->get();
        $photos = Photo::where('featured', true)->get();;

        return view('home.index', [
            'description' => $desciption,
            'albums' => $albums,
            'songs' => $songs,
            'gigs' => $gigs,
            'photos' => $photos,
        ]);
    }
}
