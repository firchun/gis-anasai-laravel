  <!-- Navbar -->
  <nav class="navbar">
      <div class="container">
          <div class="navbar-bars">
              <a href="#" class="navbar-title sidebar-toggle" style="padding: 0;"><i
                      class="ion-navicon-round"></i></a>
              <a href="{{ url('/') }}" class="navbar-title">Anasai</a>
          </div>
          <div class="navbar-item">
              <a href="{{ url('/') }}" class="navbar-title">Anasai</a>
              <ul>
                  <li><a href="{{ url('/merchandise') }}">Merchandise</a></li>
                  <li><a href="{{ url('/village') }}">Desa</a></li>
                  <li><a href="{{ url('/event') }}">Event</a></li>
                  @guest
                      <li><button class="btn-login" id="openLogin">LOGIN</button></li>
                  @else
                      <li><a href="{{ route('home') }}" class="text-danger">Dashboard</a></li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
