@vite(["resources/js/collapleMobileNav.js"])

<header>
    <div class='mobile-nav-controls'>
        <button id="mobile-nav-btn">
            <div class="mobile-nav-btn-stripe"></div>
        </button>
    </div>
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

            <li class="mobile-nav-link"><a href="{{route('albums.index')}}">Albums</a></li>
            <li class="mobile-nav-link"><a href="{{route('songs.index')}}">Songs</a></li>

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