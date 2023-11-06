  <!-- Navbar -->
  <nav class="navbar">
      <div class="container">
          <div class="navbar-bars">
              <a href="#" class="navbar-title sidebar-toggle" style="padding: 0;"><i
                      class="ion-navicon-round"></i></a>
              <a href="{{ url('/') }}" class="navbar-title text-decoration-none"
                  style="color: white;">{{ env('APP_NAME') }}</a>
          </div>
          <div class="navbar-item ">
              <a href="{{ url('/') }}" class="navbar-title text-decoration-none "
                  style="color: white;">{{ env('APP_NAME') }}</a>
              <ul class="mr-auto">
                  <li><a href="{{ url('/tour') }}" style="@if (request()->is('tour')) color: yellow; @endif"
                          class="text-decoration-none">Wisata</a></li>
                  <li><a href="{{ url('/shop') }}" style="@if (request()->is('shop')) color: yellow; @endif"
                          class="text-decoration-none">Lapak</a></li>
                  <li><a href="{{ url('/village') }}" style="@if (request()->is('village')) color: yellow; @endif"
                          class="text-decoration-none">Desa</a></li>
                  <li><a href="{{ url('/event') }}" style="@if (request()->is('event')) color: yellow; @endif"
                          class="text-decoration-none">Event</a></li>
                  @guest
                      <li><button class="btn-login" id="openLogin">LOGIN</button></li>
                  @else
                      @if (Auth::user()->role == 'member')
                          <li><a href="{{ route('logout') }}" style="color:orangered;"
                                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                          </li>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      @else
                          <li><a href="{{ route('home') }}" class="text-decoration-none"
                                  style="color:orangered;">Dashboard</a></li>
                      @endif
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
