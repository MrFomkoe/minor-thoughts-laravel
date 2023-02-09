@extends('layout')
@section('content')

<x-home-navigation />

<div class="hero">
    <h1>The Minor Thoughts</h1>
</div>

<main>
    {{-- Description section --}}
    <x-section>
        <span id="bio" class='anchor-span'></span>
        <h2>Who Are We?</h2>
        @if ($description)
        @foreach ($description as $paragraph)
        <p>{{$paragraph}}</p>
        @endforeach

        @else
        <p> Under Construction </p>
        @endif
    </x-section>

    {{-- Discography section --}}
    <x-section>
        <span id="discography" class='anchor-span'></span>
        <h2>Discography</h2>

        <div class="discography-lists">
            @if (count($songs) > 0)
            <div class="list">
                <h3>Featured Songs</h3>
                <x-image-slider :list='$songs' />
                <a class="page-link" href="{{route('songs.index')}}"> See all songs</a>
            </div>
            @endif

            @if (count($albums) > 0)
            <div class="list">
                <h3>Albums</h3>
                <x-image-slider :list='$albums' />
                <a class="page-link" href="{{route('albums.index')}}"> See all albums</a>
            </div>
            @endif
        </div>
    </x-section>

    {{-- Gigs section --}}
    <x-section>
        <span id="gigs" class='anchor-span'></span>
        <div class="gigs">
            <h2>Upcoming Gigs</h2>

            @if (count($gigs) > 0)

            <div class="gig-list">
                <table>
                    <thead>
                        <th> Venue </th>
                        <th> Where </th>
                        <th> When </th>
                        <th> Link </th>
                    </thead>
                    <tbody>
                        @foreach ($gigs as $gig)
                        <x-gig-card :gig='$gig' />
                        @endforeach
                    </tbody>
                </table>
            </div>

            @else

            <div>
                <h3>No upcoming gigs so far. Stay tuned and check our media</h3>
                <div class="socials">
                    <a href="http://" target="_blank" rel="noopener noreferrer">&#xe800;</a>
                    <a href="http://" target="_blank" rel="noopener noreferrer">&#xe802;</a>
                    <a href="http://" target="_blank" rel="noopener noreferrer">&#xf32d;</a>
                </div>
            </div>
            @endif
                <a class="page-link" href="{{route('gigs.index')}}">See All Gigs</a>
        </div>
    </x-section>

    {{-- Gallery section --}}
    <x-section>
        <span id="gallery" class='anchor-span'></span>
        <div>
            <h2>Gallery</h2>
            <div class="photo-list">
                @foreach ($photos as $photo)
                <x-photo-card :photo='$photo' />
                @endforeach
            </div>
            <a class="page-link" href="{{route('photos.index')}}">See All Photos</a>
    </x-section>

</main>

<footer>
    {{-- Contacts section --}}
    <x-section>
        <span id="contacts" class='anchor-span'></span>
        <div class="contacts">
            <h2>Contacts</h2>
            <div class="socials">
                <a href="http://" target="_blank" rel="noopener noreferrer">&#xe800;</a>
                <a href="mailto:romanponomarjov@gmail.com">&#xe801;</a>
                <a href="http://" target="_blank" rel="noopener noreferrer">&#xf32d;</a>
            </div>
    </x-section>
    <x-section>The Minor Thoughs &copy {{ now()->year }}</x-section>
</footer>

@endsection