<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;

class GigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gigs.index', [
            'gigs' => Gig::orderBy('date', 'asc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.forms.gig-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'venue' => ['required'],
            'date' => ['required'],
            'place' => ['required'],
            'link' => ['nullable'],
        ]);

        Gig::create($formFields);
        return redirect('dashboard')->with('message', 'Gig created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function show(Gig $gig)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gig $gig)
    {

        // dd($request);
        // Validating inputs
        $formFields = $request->validate([
            'venue' => ['required'],
            'date' => ['required'],
            'place' => ['required'],
            'link' => ['nullable'],
            'upcoming' => ['nullable'],
        ]);

        // Checking if gig's "upcoming" parameter is set
        if (!$request['upcoming']) {
            $formFields['upcoming'] = false;
        } else {
            $formFields['upcoming'] = true;
        }

        // Updating and redirecting back
        $gig->update($formFields);
        return back()->with('message', 'Gig updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gig  $gig
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gig $gig)
    {
        $gig->photos()->delete();

        $gig->delete();
        return back()->with('message', 'Gig deleted');
    }
}
