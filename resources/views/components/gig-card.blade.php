@props(['gig'])

<tr class="gig-card @if (!$gig->upcoming) past @endif">
    <td> {{$gig->venue}}</td>
    <td> {{$gig->place}} </td>
    <td> {{Carbon\Carbon::parse($gig->date)->format('d.m.Y')}}</td>

    @if ($gig->upcoming)
        <td><a href="{{$gig->link}}">Event page</a></td>
    @else
        <td><a href="{{route('photos.index')}}?gig_id={{$gig->id}}">Gallery</a></td>
    @endif
</tr>