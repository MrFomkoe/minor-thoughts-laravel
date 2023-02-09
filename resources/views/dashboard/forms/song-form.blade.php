@vite(["resources/js/addSongForm.js"])

@extends('dashboard.dashboard-layout')
@section('dashboard')
        <x-section>
            <h1>Add new songs</h1>
            <a class="page-link" href="{{route('dashboard')}}"> BACK </a>

            <div>
                <button id="addSongBtn"> Add more songs</button>
                <button id="saveSongBtn">Save songs</button>

                <div class="dashboard-item">
                    <form class="dashboard-form " id="songs-form" action="{{route('songs.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="dashboard-form-unit">
                            <div class="dashboard-input">
                                <label for="">Song name</label>
                                <input type="text" name="name[]">
                            </div>
    
                            <div class="dashboard-input">
                                <label for="">Album</label>
                                <select name="album_id[]">
                                    <option value=""> No album for song</option>
                                    @foreach ($albums as $album)
                                    <option value="{{$album->id}}">{{$album->name}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                            <div class="dashboard-input">
                                <label for="">Spotify link</label>
                                <input type="text" name="spotify[]">
                            </div>
    
                            <div class="dashboard-input">
                                <label for="">Apple link</label>
                                <input type="text" name="apple[]">
                            </div>
    
                            <div class="dashboard-input">
                                <label for=""> Featured </label>
                                <input type="checkbox" name="featured[]">
                            </div>
    
                            <div class="dashboard-input">
                                <label for="">Photo</label>
                                <input type="file" name="photo[]" />
                            </div>
                        </div>

                        
                    </form>
                </div>

            </div>

        </x-section>

@endsection