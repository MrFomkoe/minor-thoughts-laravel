<div class="dashboard-item">
@php
    // dd($gig->date);
@endphp

    {{-- Form for song's contents so those could be updated --}}
    <form class="dashboard-form" action="{{route('gigs.update', $gig)}}" method="POST">
        @csrf
        @method('PATCH')

        <div class="dashboard-input">
            <label for="">Gig </label>
            <input type="text" name="venue" value="{{$gig->venue}}">
        </div>

        <div class="dashboard-input">
            <label for="">Place </label>
            <input type="text" name="place" value="{{$gig->place}}">
        </div>

        <div class="dashboard-input">
            <label for=""> Socials link </label>
            <input type="text" name="link" value="{{$gig->socials}}">
        </div>

        <div class="dashboard-input">
            <label for="">Date </label>
            <input type="date" name="date" value="{{$gig->date}}">
        </div>
        <div class="dashboard-input">
            <label for=""> Upcoming </label>
            <input @checked($gig->upcoming) type="checkbox" name="upcoming" >
        </div>

        <button class="dashboard-form-btn" type="submit">&#xe805;</button>
    </form>
    <form class="dashboard-form"" action=" {{route('gigs.destroy', $gig)}}" method="POST">
        @csrf
        @method('DELETE')

        <button class="dashboard-form-btn" type="submit">&#xe804;</button>
    </form>
</div>