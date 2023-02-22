@extends('dashboard.dashboard-layout')
@section('dashboard')

<x-section>
    <h1>Manage photos</h1>
    <a class="page-link" href="{{route('dashboard')}}"> BACK </a>
    <a class="page-link" href="{{route('photos.create')}}"> Add more photos </a>

    <form action="">
        <label for=""> Choose gig </label>
        <select name="gig" id="">
            <option value="" @selected(request('gig')=='' )> Show all </option>
            <option value="no-gig" @selected(request('gig')=='no-gig' )> Without gigs </option>
            @foreach ($gigs as $gig)
            @if ($gig->upcoming == false)
            <option value="{{$gig->id}}" @selected(request('gig')==$gig->id)
                > {{ $gig->venue }} / {{$gig->date}}</option>
            @endif
            @endforeach
        </select>
        <button type="submit"> Filter by gig</button>
    </form>

    <form class="photo-form" method="POST">
        @csrf
        @method('POST')
        <div class="photo-form-controls">
            <button type="submit" class="dashboard-form-btn" formaction={{route('photos.update')}}>&#xe807;</button>
            <button type="submit" class="dashboard-form-btn" formaction={{route('photos.destroy')}}>&#xe804;</button>
            
        </div>
        
        <div class="photo-container">
            @foreach ($photos as $photo)
            <div class="dashboard-photo">
                <img src="{{asset('/storage/' . $photo->url)}}" alt="">
                
                <div class="photo-controls">
                    <label> Featured photo</label>
                    <input type="hidden" name="featured[{{$photo->id}}]" value="0">
                    <input type="checkbox" name="featured[{{$photo->id}}]" value="1" @checked($photo->featured)>

                    <label> Delete photo </label>
                    <input type="checkbox" name="delete[{{$photo->id}}]">
                </div>
            </div>
            @endforeach
        </div>
    </form>

    <div class="pagination-links">
        {{$photos->appends($filter)->links()}}
    </div>
</x-section>

@endsection

{{-- <div class="photo-controls">
    <form action="{{route('photos.update', $photo)}}" method="POST">
        @csrf
        @method('PATCH')

        <label for=""> Featured photo</label>
        <input type="checkbox" name="featured" @checked($photo->featured) >

        <button>&#xe807;</button>
    </form>
    <form action="{{route('photos.destroy', $photo)}}" method="POST">
        @csrf
        @method('DELETE')

        <button>&#xe804;</button>
    </form>
</div> --}}