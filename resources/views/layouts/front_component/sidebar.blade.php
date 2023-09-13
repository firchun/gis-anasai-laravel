<!-- Sidebar -->
<div class="sidebar">
    <ul class="sidebar-list">
        <li><a href="" class="close"><span class="ion-android-close"></span></a></li>
        <li class="sidebar-list-hover"><a href="{{ url('/') }}">Home</a></li>
        <li class="sidebar-list-hover"><a href="{{ url('/merchandise') }}">Merchandise</a></li>
        <li class="sidebar-list-hover"><a href="{{ url('/village') }}">Desa</a></li>
        <li class="sidebar-list-hover"><a href="{{ url('/event') }}">Event</a></li>
        @guest
            <li>
                <a class="btn-login btn btn-orange btn-round" href="{{ route('login') }}">LOGIN</a>
            </li>
        @else
            @if (Auth::user()->role == 'member')
                <li><a href="{{ route('logout') }}" style="color:orangered;"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                </li>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <li class="sidebar-list-hover"><a href="{{ route('home') }}" style="color:orangered;">Dashboard</a></li>
            @endif
        @endguest
    </ul>
</div>
