<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">

      <!-- Collapsed Hamburger -->
      <button type="button" class="navbar-toggle collapsed"
              data-toggle="collapse" data-target="#app-navbar-collapse">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <!-- Branding Image -->
      <a class="navbar-brand" href="{{ url('/') }}">
        Jornadas mini-app {{ env('APP_VER', null) }}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="app-navbar-collapse">
      <!-- Left Side Of Navbar -->
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/home') }}">Inicio</a></li>
      </ul>

      <!-- Mant -->
      @if(Auth::user() && Auth::user()->admin)
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle"
               data-toggle="dropdown" role="button"
               aria-expanded="false">
              <i class="fa fa-btn fa-wrench"></i> Mantenimiento <span
                class="caret"></span>
            </a>

            <!-- Listado -->
            <ul class="dropdown-menu" role="menu">
              <!-- Usuarios -->
              <li>
                <a href="{{ route('users.index') }}">
                  <i class="fa fa-btn fa-users"></i>Usuarios
                </a>
              </li>

              <!-- Profesores -->
              <li>
                <a href="{{ route('professors.index') }}">
                  <i class="fa fa-btn fa-user-md"></i>Profesores
                </a>
              </li>
            </ul>
          </li>
        </ul>
      @endif

      <!-- Right Side Of Navbar -->
      <ul class="nav navbar-nav navbar-right">
        <!-- Authentication Links -->
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">Entrar</a></li>
          <li><a href="{{ url('/register') }}">Registrarse</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle"
               data-toggle="dropdown" role="button"
               aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ route('users.show', Auth::user()->name) }}">
                  <i class="fa fa-btn fa-eye"></i>
                  Ver perfil
                </a>
              <li>
                <a href="{{ url('/logout') }}">
                  <i class="fa fa-btn fa-sign-out"></i>
                  Salir
                </a>
              </li>
            </ul>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>