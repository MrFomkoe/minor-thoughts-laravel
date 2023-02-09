@props(['list'])
@vite(["resources/js/imageSlider.js"])



<div class="slider">
    @unless (count($list) == 0)
        @if (count($list) > 3)
        <div class="slider-btns">
            <button class="slider-btn prev-btn"><i class="fa-solid fa-chevron-left"></i></button>
            <button class="slider-btn next-btn"><i class="fa-solid fa-chevron-right"></i></button>
        </div>
        @endif

        <div class="slides">
            @foreach ($list as $unit)
            <x-image-slide :unit='$unit' />
            @endforeach
        </div>
    @endunless
</div>