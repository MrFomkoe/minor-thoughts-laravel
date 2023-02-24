<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
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
        // Defining filter
        $filter = request(['gig']);
        return view('gallery.index', [
            // Filtering photos by selected gig
            'photos' => Photo::filter($filter)->latest()->simplePaginate(10),
            'gigs' => Gig::all(),
            // Returning filter so it could be used in pagination
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

        // Checking if gig exists
        $gig = Gig::find($request['gig_id']);

        // Loop for all requests
        foreach ($request->file('image') as $image) {
            // Hashing original name
            $photoName = $image->hashName();

            // Modifying name for cropped photo
            $previewName = 'preview_' . $photoName;

            // Creating cropped photo using Intervention package
            $preview = Image::make($image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            // Saving original photo to server and creating paths
            $photoPath = $image->storeAs('photos', $photoName, 'public');
            $previewPath = 'photos/previews/' . $previewName;

            // Saving cropped photo
            Storage::put('public/' . $previewPath, $preview->encode());

            // Creating database records
            if ($gig) {
                $gig->photos()->create([
                    'url' => $photoPath,
                    'preview_url' => $previewPath,
                ]);
            } else {
                Photo::create([
                    'url' => $photoPath,
                    'preview_url' => $previewPath,
                ]);
            }
        }

        // Redirect
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

        // Defining entries - key = id of photo selected on page, value = 1 or 0
        $entries = $data['featured'];

        // Extracting ids and defining models
        $ids = array_keys($data['featured']);
        $photos =  Photo::whereIn('id', $ids)->get();


        foreach ($photos as $photo) {
            // If photo was selected as featured - it updates to true
            if ($entries[$photo->id] == 1) {
                $photo->update([
                    'featured' => true,
                ]);
                // Else, to false
            } else {
                $photo->update([
                    'featured' => false,
                ]);
            }
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
        // Validating input
        $data = $request->validate([
            'delete' => 'nullable',
        ]);

        // Getting ids of checked photos
        $ids = array_keys($data['delete']);

        // Getting photos models
        $photos = Photo::whereIn('id', $ids)->get();

        foreach ($photos as $photo) {
            // Deletion of files
            if (Storage::disk('public')->exists($photo->url)) {
                Storage::disk('public')->delete($photo->url);
                Storage::disk('public')->delete($photo->preview_url);
            }
            // Deletion of database record
            $photo->delete();
        }
        // Redirect
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
            // Returning filter so it could be used in pagination
            'filter' => $filter,
        ]);
    }
}
