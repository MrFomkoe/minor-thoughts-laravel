@props(['photo'])

<div class="photo-container">
    <img src="{{asset('/storage/' . $photo->url)}}" alt="">
</div>