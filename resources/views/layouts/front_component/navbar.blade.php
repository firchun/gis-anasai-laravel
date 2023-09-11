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
                  <li><a href="{{ url('/') }}">Lapak</a></li>
                  @guest
                      <li><button class="btn-login" id="openLogin">LOGIN</button></li>
                  @else
                      <li><a href="{{ route('home') }}" class="text-danger">Dashboard</a></li>
                  @endguest
              </ul>
          </div>
      </div>
  </nav>
