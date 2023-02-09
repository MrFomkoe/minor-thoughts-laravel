@vite(["resources/js/collapseSection.js"])

<header>
    <nav class="navigation">
        <ul>
            <li><a href="{{route('home')}}">Home</a></li>
            <li id="navigation-collapse-section">
                Discography
                <ul id="navigation-collapse-links">
                    <li><a href="{{route('albums.index')}}">Albums</a></li>
                    <li><a href="{{route('songs.index')}}">Songs</a></li>
                </ul>
            </li>

            @unless (request()->routeIs('gigs.*'))
            <li><a href="{{route('gigs.index')}}">Gigs</a></li>
            @endunless
            @unless (request()->routeIs('photos.*'))
            <li><a href="{{route('photos.index')}}">Gallery</a></li>
            @endunless
            
            <li><a href="{{route('home')}}#contacts">Contacts</a></li>
        </ul>
    </nav>
</header>