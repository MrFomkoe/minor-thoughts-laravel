@extends('dashboard.dashboard-layout')
@section('dashboard')
        <x-section>
            <h1>Add new album</h1>
            <a class="page-link" href="{{route('dashboard')}}"> BACK </a>

            <div>
                {{-- <button id="addSongBtn"> Add more songs</button> --}}
                
                <div class="dashboard-item">
                    <form class="dashboard-form" action="{{route('albums.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="dashboard-input">
                            <label for="">Album name</label>
                            <input type="text" name="name">
                        </div>

                        <div class="dashboard-input">
                            <label for="">Spotify link</label>
                            <input type="text" name="spotify">
                        </div>

                        <div class="dashboard-input">
                            <label for="">Apple link</label>
                            <input type="text" name="apple">
                        </div>

                        <div class="dashboard-input">
                            <label for="">Photo</label>
                            <input type="file" name="photo" />
                        </div>

                        <button class="dashboard-form-btn" type="submit">&#xe808;</button>
                    </form>
                </div>

            </div>

        </x-section>
@endsection