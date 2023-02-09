@extends('dashboard.dashboard-layout')
@section('dashboard')
        <x-section>
            <h1>Manage photos</h1>
            <a class="page-link" href="{{route('dashboard')}}"> BACK </a>
            <a class="page-link" href="{{route('photos.create')}}"> Add more photos </a>

            <form action="">
                @csrf

                <label for=""> Choose gig </label>
                <select name="gig_id" id="">
                    <option value=""> Show all </option>
                    <option value="no_gig"> Without gigs </option>
                    @foreach ($gigs as $gig)
                    <option value="{{$gig->id}}"
                        @selected(request('gig_id') == $gig->id)
                        > {{ $gig->venue }} / {{$gig->date}}</option>
                    @endforeach
                </select>
                <button type="submit"> Filter by gig</button>
            </form>

            <div class="photo-container">
                @foreach ($photos as $photo)
                <x-dashboard.photo-item :photo='$photo'>
                    </x-photo>
                    @endforeach
            </div>

            <div class="pagination-links">
                {{$photos->links()}}
            </div>
        </x-section>

@endsection