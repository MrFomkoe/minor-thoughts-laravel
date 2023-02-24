@props(['photo'])

<div class="dashboard-photo">
    <img src="{{asset('/storage/' . $photo->preview_url)}}" alt="">

    <div class="photo-controls">
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
    </div>
</div>