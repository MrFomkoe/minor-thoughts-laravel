@extends('layout')
@section('content')

<x-navigation />

<main>
    <x-section class="top-margin-section">
        <h2> Songs so far</h2>
    </x-section>

    <x-section>
        <div class="songs-albums-page">
            @foreach ($songs as $song)
                <x-image-slide :unit='$song'/>
            @endforeach
        </div>
    </x-section>

</main>

@endsection