@extends('dashboard.dashboard-layout')
@section('dashboard')
        <x-section>
            <h1>Add new gig</h1>
            <a class="page-link" href="{{route('dashboard')}}"> BACK </a>

            <div>
                
                <div class="dashboard-item">
                    <form class="dashboard-form" action="{{route('gigs.store')}}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <div class="dashboard-input">
                            <label for=""> Venue </label>
                            <input type="text" name="venue" value="{{old('venue')}}">
                        </div>

                        <div class="dashboard-input">
                            <label for=""> Place </label>
                            <input type="text" name="place" value="{{old('place')}}">
                        </div>

                        <div class="dashboard-input">
                            <label for=""> Date </label>
                            <input type="date" name="date" value="{{old('date')}}">
                        </div>

                        <div class="dashboard-input">
                            <label for=""> Socials link </label>
                            <input type="text" name="link" value="{{old('link')}}">
                        </div>

                        <button class="dashboard-form-btn" type="submit">&#xe808;</button>
                    </form>
                </div>

            </div>

        </x-section>
@endsection