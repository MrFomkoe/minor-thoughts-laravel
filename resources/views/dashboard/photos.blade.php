@extends('dashboard.dashboard-layout')
@section('dashboard')
<x-section>
    <h1>Manage photos</h1>
    <a class="page-link" href="{{route('dashboard')}}"> BACK </a>
    <a class="page-link" href="{{route('photos.create')}}"> Add more photos </a>

    <form action="">
        <label for=""> Choose gig </label>
        <select name="gig" id="">
            <option value="" @selected(request('gig') == '')> Show all </option>
            <option value="no-gig" @selected(request('gig') == 'no-gig')> Without gigs </option>
            @foreach ($gigs as $gig)
            @if ($gig->upcoming == false)
            <option value="{{$gig->id}}" @selected(request('gig')==$gig->id)
                > {{ $gig->venue }} / {{$gig->date}}</option>
            @endif
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
        {{$photos->appends($filter)->links()}}
    </div>
</x-section>

@endsection