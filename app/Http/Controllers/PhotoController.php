<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Photo;
use Spatie\Backtrace\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gallery.index', [
            'photos' => Photo::filter(request(['gig_id']))->latest()->simplePaginate(20),
            'gigs' => Gig::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.forms.photo-form', [
            'gigs' => Gig::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gig_id' => 'nullable',
            'image' => 'required',
            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg'
        ]);

        $gig_id = $request['gig_id'];

        // dd($request->file('image'));

        foreach ($request->file('image') as $image) {
            $path = $image->store('photos', 'public');

            Photo::create([
                'gig_id' => $gig_id,
                'url' => $path,
            ]);
        }

        return redirect(route('photos.manage'))->with('message', 'Photos uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        // Salidating input
        $data = $request->validate([
            'featured' => 'nullable',
        ]);

        // Setting "featured" field
        if (!isset($data['featured'])) {
            $data['featured'] = false;
        } else {
            $data['featured'] = true;
        }

        // Update and redirect
        $photo->update($data);
        return back()->with('message', 'Photo Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {

        if (Storage::disk('public')->exists($photo->url)) {
            Storage::disk('public')->delete($photo->url);
        }
        // Delete and redirect
        $photo->delete();
        return back()->with('message', 'Photo deleted');
    }

    /**
     * Show page for managing photos
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {

        return view('dashboard.photos', [
            // Filtering photos by selected gig
            'photos' => Photo::filter(request(['gig_id']))->latest()->simplePaginate(10),
            'gigs' => Gig::all(),
        ]);
    }
}
