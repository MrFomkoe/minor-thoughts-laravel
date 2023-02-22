@extends('dashboard.dashboard-layout')
@section('dashboard')

        <h1>Sup {{$user->name}}</h1>
        <div>
            <form action="{{route('logout')}}" method="POST">
            @csrf
            <button type="submit">Logout</button>
            </form>
        </div>

        {{-- Section for managing songs --}}
        <x-section class="dashboard-section">
            <button class="collaplse-btn"> Show songs </button>
            <div class="dashboard-list">
                {{-- Iterating through the list of songs --}}
                @foreach ($songs as $song)
                <x-dashboard.song-item :song="$song" :albums="$albums" />
                @endforeach
            </div>

            {{-- Section for adding new songs --}}
            <a class="page-link" href="{{route('songs.create')}}"> Add new songs</a>
        </x-section>
        <hr>

        {{-- Section for managing albums --}}
        <x-section class="dashboard-section">
            <button class="collaplse-btn"> Show albums </button>

            <div class="dashboard-list">
                @foreach ($albums as $album)
                <x-dashboard.album-item :album="$album" />
                @endforeach
            </div>

            {{-- Section for adding new albums --}}
            <a class="page-link" href="{{route('albums.create')}}"> Add new album</a>
        </x-section>
        <hr>

        {{-- Section for managing gigs --}}
        <x-section class="dashboard-section">
            <button class="collaplse-btn"> Show gigs </button>
            <div class="dashboard-list">
                @foreach ($gigs as $gig)
                <x-dashboard.gig-item :gig="$gig" />
                @endforeach
            </div>

            {{-- Section for adding new gigs --}}
            <a class="page-link" href="{{route('gigs.create')}}"> Add new gig</a>
        </x-section>
        <hr>

        {{-- Section for adding and managin photo galleries --}}
        <x-section class="dashboard-section">
            <a class="page-link" href="{{route('photos.manage')}}"> Manage photos </a>
            <a class="page-link" href="{{route('photos.create')}}"> Add photos </a>
        </x-section>
        <hr>

        {{-- Section for setting and updating description --}}
        @if ($description == null)
        <x-section class="dashboard-section">
            <button class="collaplse-btn"> Show description </button>
            <div class="dashboard-list">
                <form method="POST" class="description-form" action="{{route('description.store', $description)}}">
                    @csrf

                    <textarea name="text" id="" cols="30" rows="10"></textarea>
                    <button type="submit">Submit text</button>
                </form>
            </div>
        </x-section>
        @else

        <x-section class="dashboard-section">
            <button class="collaplse-btn"> Show description </button>

            <div class="dashboard-list">
                <form method="POST" class="description-form" action="{{route('description.update', $description)}}">
                    @csrf
                    @method('PATCH')

                    <textarea name="text" id="" cols="30" rows="10">{{$description->text}}</textarea>
                    <button type="submit">Update text</button>
                </form>
            </div>
        </x-section>
        @endif

@endsection