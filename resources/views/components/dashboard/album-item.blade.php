<div class="dashboard-item">

    {{-- Form for song's contents so those could be updated --}}
    <form class="dashboard-form" action="{{route('albums.update', $album)}}" method="POST">
        @csrf
        @method('PATCH')

        <div class="dashboard-input">
            <label for="">Album name</label>
            <input type="text" name="name" value="{{$album->name}}">
        </div>

        <div class="dashboard-input">
            <label for="">Spotify link</label>
            <input type="text" name="spotify" value="{{$album->spotify}}">
        </div>

        <div class="dashboard-input">
            <label for="">Apple link</label>
            <input type="text" name="apple" value="{{$album->apple}}">
        </div>

        <button class="dashboard-form-btn" type="submit">&#xe805;</button>
    </form>
    {{-- Form to delete entry --}}
    <form class="dashboard-form"" action=" {{route('albums.destroy', $album)}}" method="POST">
        @csrf
        @method('DELETE')

        <button class="dashboard-form-btn" type="submit">&#xe804;</button>
    </form>
</div>