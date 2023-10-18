  <!-- Navbar -->
  <nav class="navbar">
      <div class="container">
          <div class="navbar-bars">
              <a href="#" class="navbar-title sidebar-toggle" style="padding: 0;"><i
                      class="ion-navicon-round"></i></a>
              <a href="{{ url('/') }}" class="navbar-title" style="color: white;">Anasai</a>
          </div>
          <div class="navbar-item">
              <a href="{{ url('/') }}" class="navbar-title" style="color: white;">Anasai</a>
              <ul>
                  <li><a href="{{ url('/tour') }}"
                          style="@if (request()->is('tour')) color: yellow; @endif">Wisata</a></li>
                  <li><a href="{{ url('/merchandise') }}"
                          style="@if (request()->is('merchandise')) color: yellow; @endif">Merchandise</a></li>
                  <li><a href="{{ url('/village') }}"
                          style="@if (request()->is('village')) color: yellow; @endif">Desa</a></li>
                  <li><a href="{{ url('/event') }}"
                          style="@if (request()->is('event')) color: yellow; @endif">Event</a></li>
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
                          <li><a href="{{ route('home') }}">Dashboard</a></li>
                      @endif
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
