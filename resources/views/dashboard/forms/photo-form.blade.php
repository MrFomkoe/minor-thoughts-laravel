@extends('dashboard.dashboard-layout')
@section('dashboard')
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
        @endif

        <x-section>
            <h1>Add photos</h1>
            <a class="page-link" href="{{route('dashboard')}}"> BACK </a>

            <form class="dashboard-form photo-form" action="{{route('photos.store')}}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <div class="dashboard-input">
                    <label for=""> Gig </label>
                    <select name="gig_id">
                        <option value=""> No gig related </option>
                        @foreach ($gigs as $gig)
                        <option value="{{$gig->id}}">{{$gig->venue}} / {{$gig->date}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="dashboard-input">
                    <label>Choose Images</label>
                    <input type="file" name="image[]" multiple>
                </div>
                </div>

                <button class="dashboard-form-btn" type="submit">&#xe808;</button>

            </form>
        </x-section>
@endsection