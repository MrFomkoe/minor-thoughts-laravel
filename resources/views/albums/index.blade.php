@extends('layout')
@section('content')

<x-navigation />

<main>
    <x-section class="top-margin-section">
        <h2> Albums so far</h2>
    </x-section>

    <x-section>
        <div class="songs-albums-page">
            @foreach ($albums as $album)
                <x-image-slide :unit='$album'/>
            @endforeach
        </div>
    </x-section>

</main>

@endsection