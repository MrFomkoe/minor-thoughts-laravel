<?php

namespace App\Http\Controllers;

use App\Models\Description;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

        /**
     * Upate a listing of the resource.
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Description $description
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Description $description)
    {
        $formFields = $request->validate([
            'text' => 'required'
        ]);

        $description->update($formFields);
        return back()->with('message', 'Description updated');
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
            'text' => 'required'
        ]);

        Description::create($formFields);
        return back()->with('message', 'Description created');
    }
}
