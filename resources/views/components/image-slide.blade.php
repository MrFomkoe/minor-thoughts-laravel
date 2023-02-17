@props(['unit'])

<div class="slide">
    @if ($unit instanceof \App\Models\Song)
    <img src="{{$unit->photo ? asset('/storage/' . $unit->photo->url) : asset('/storage/' . $unit->album()->first()->photo->url)}}"
        alt="">
    @else
    <img src="{{asset('/storage/' . $unit->photo->url)}}" alt="">
    @endif

    <div class="slide-data">
        <h3 class="slide-heading">{{$unit->name}}</h3>
        <div class="slide-links">
            <a href="{{$unit->spotify}}" target="_blank" rel="noopener noreferrer">&#xf1bc;</a>
            <a href="{{$unit->apple}}" target="_blank" rel="noopener noreferrer">&#xf179;</a>

            @if ($unit instanceof \App\Models\Song && $unit->album_id)
            <a href="{{route('albums.show', $unit->album()->first())}}">&#xf50d;</a>
            @elseif ($unit instanceof \App\Models\Album)
            <a href="{{route('albums.show', $unit)}}">&#xf50d;</a>
            @endif

        </div>
    </div>
</div>