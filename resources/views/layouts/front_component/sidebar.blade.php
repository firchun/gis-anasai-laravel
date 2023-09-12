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
                <button class="btn-login btn btn-orange btn-round" id="openLogin">LOGIN</button>
            </li>
        @else
            <li class="sidebar-list-hover"><a href="{{ route('home') }}">Dashboard</a></li>
        @endguest
    </ul>
</div>
