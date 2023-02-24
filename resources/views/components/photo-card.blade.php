@props(['photo'])

<div class="photo-container">
    <img src="{{asset('/storage/' . $photo->preview_url)}}" alt="">
</div>