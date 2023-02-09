@extends('layout')
@section('content')


<x-navigation />

<main>
    <x-section class="top-margin-section">
        <h2>{{$album->name}}</h1>
    </x-section>
    <x-section class="album">
        <img class="album-photo" src="{{asset('storage/' . $album->photo)}}" alt="">

        <h3>Song list</h2>
            <table>
                <thead>
                    <tr>
                        <th> Song Nr. </th>
                        <th> Name </th>
                        <th> Spotify </th>
                        <th> Apple </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($songs as $key => $song)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$song->name}}</td>
                        <td class="albums-link"><a href="{{$song->spotify}}" target="_blank"
                                rel="noopener noreferrer">&#xf1bc;</a></td>
                        <td class="albums-link"><a href="{{$song->apple}}" target="_blank"
                                rel="noopener noreferrer">&#xf179;</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </x-section>

</main>

@endsection