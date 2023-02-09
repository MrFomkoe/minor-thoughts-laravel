<div class="dashboard-item">

    {{-- Form for song's contents so those could be updated --}}
    <form class="dashboard-form" action="{{route('songs.update', $song)}}" method="POST">
        @csrf
        @method('PATCH')

        <div class="dashboard-input">
            <label for="">Song name</label>
            <input type="text" name="name" value="{{$song->name}}">
        </div>

        <div class="dashboard-input">
            <label for="">Album</label>
            <select name="album_id">
                <option value=""> No album for song</option>
                @foreach ($albums as $album)
                <option value="{{$album->id}}" @selected($song->album_id == $album->id)
                    >{{$album->name}}</option>
                @endforeach
            </select>
        </div>

        <div class="dashboard-input">
            <label for="">Spotify link</label>
            <input type="text" name="spotify" value="{{$song->spotify}}">
        </div>

        <div class="dashboard-input">
            <label for="">Apple link</label>
            <input type="text" name="apple" value="{{$song->apple}}">
        </div>

        <div class="dashboard-input">
            <label for=""> Featured </label>
            <input @checked($song->featured) type="checkbox" name="featured" >
        </div>

        <button class="dashboard-form-btn" type="submit">&#xe805;</button>
    </form>
    {{-- Form to delete entry --}}
    <form class="dashboard-form"" action=" {{route('songs.destroy', $song)}}" method="POST">
        @csrf
        @method('DELETE')

        <button class="dashboard-form-btn" type="submit">&#xe804;</button>
    </form>
</div>