
@if (session()->has('message'))

<div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show"
    class="flash-message">
    <p>
        {{session('message')}}
    </p>
</div>

@elseif ($errors->any())
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show"
        class="flash-message errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>

@endif