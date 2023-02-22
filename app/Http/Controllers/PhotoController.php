<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Photo;
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
        $filter = request(['gig']);
        return view('gallery.index', [
            // Filtering photos by selected gig
            'photos' => Photo::filter($filter)->latest()->simplePaginate(10),
            'gigs' => Gig::all(),
            'filter' => $filter,
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
            'gig_id' => ['nullable'],
            'image' => ['required'],
            'image.*' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:5012']
        ]);



        $gig = Gig::find($request['gig_id']);

        // dd($gig);
        // dd($request->file('image'));

        foreach ($request->file('image') as $image) {
            $path = $image->store('photos', 'public');

            if ($gig) {
                $gig->photos()->create([
                    'url' => $path,
                ]);
            } else {
                Photo::create([
                    'url' => $path,
                ]);
            }
        }

        return redirect(route('photos.manage'))->with('message', 'Photos uploaded');
    }

    /**
     * Mass update specified resources in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     * 
     * This is not the most graceful way to mass update data but couldn't come up with a better idea
     */
    public function update(Request $request)
    {

        // Validating input
        $data = $request->validate([
            'featured' => 'nullable',
        ]);

        // Defining entries
        $entries = $data['featured'];
        // Defining arrays that will store indexes
        $selectedIds = [];
        $notSelectedIds = [];

        // Sorting incoming data based on value from HTML. 1 -> checked, 0 -> not checked
        foreach ($entries as $id => $value) {
            if ($value == 1) {
                array_push($selectedIds, $id);
            } else {
                array_push($notSelectedIds, $id);
            }
        }

        // Getting models that shall be updated
        $photos = Photo::whereIn('id', $selectedIds)->get();
        $removeFeaturedPhotos = Photo::whereIn('id', $notSelectedIds)->get();

        // Updating models
        foreach ($photos as $photo) {
            $photo->update([
                'featured' => true,
            ]);
        }

        foreach ($removeFeaturedPhotos as $photo) {
            $photo->update([
                'featured' => false,
            ]);
        }

        // Redirecting back
        return back()->with('message', 'Photo Updated');
    }

    /**
     * Mass remove resources from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        dd($request);


        // if (Storage::disk('public')->exists($photo->url)) {
        //     Storage::disk('public')->delete($photo->url);
        // }
        // // Delete and redirect
        // $photo->delete();
        return back()->with('message', 'Photo deleted');
    }

    /**
     * Show page for managing photos
     *
     * @return \Illuminate\Http\Response
     */
    public function manage()
    {
        $filter = request(['gig']);

        return view('dashboard.photos', [
            // Filtering photos by selected gig
            'photos' => Photo::filter($filter)->latest()->simplePaginate(10),
            'gigs' => Gig::all(),
            'filter' => $filter,
        ]);
    }
}
