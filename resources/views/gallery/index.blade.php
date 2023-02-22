@vite(["resources/js/filterPhotos.js"])

@extends('layout')
@section('content')

<x-navigation />

<main>
    <x-section class="top-margin-section">
        <h2>Gallery so far</h2>
        <form action="" >
            <select name="gig" id="gallery-select" >
                <option value=""> Show all </option>
                @foreach ($gigs as $gig)
                @if (count($gig->photos) > 0) 
                <option value="{{$gig->id}}" @selected(request('gig') == $gig->id)> 
                    {{$gig->venue}} - {{Carbon\Carbon::parse($gig->date)->format('d.m.Y')}}
                </option>
                @endif
                @endforeach
            </select>
        </form>

        @if (count($photos) > 0)
        <div class="photo-list">
            @foreach ($photos as $photo)
            <x-photo-card :photo='$photo' />
            @endforeach
        </div>
        @else
        <h3>No photos for this gig are available</h3>
        @endif
    </x-section>
    <x-section>
        {{$photos->links()}}
    </x-section>
</main>

