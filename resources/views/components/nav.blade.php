<nav class="navbar navbar-expand-lg navbar-custom sticky-top px-4">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="/assets/img/logo_450x125.png" alt="GeriGest Logo" height="50" class="nav-img">
        </a>

        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Links -->
            <ul class="navbar-nav ms-4 me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Actividades</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="{{ route('activity-types.index') }}">Tipo de actividades</a></li>
                    <li><a class="dropdown-item" href="{{ route('locations.index') }}">Ubicaciones</a></li>
                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#">Separated link</a></li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('calendar') }}">Calendario</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('notes.index') }}">Anotaciones</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('users.index') }}">Usuarios</a>
                </li>
              </ul>

            <!-- Íconos -->
            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <div class="divider d-none d-lg-block"></div>
                <div class="nav-icons d-flex align-items-center gap-3">
                    <a href="/profile" class="nav-icon">
                        <i class="fas fa-user fa-lg"></i>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="/" class="nav-icon"
                    onclick="event.preventDefault(); if(confirm('¿Seguro que deseas cerrar sesión?')) document.getElementById('logout-form').submit();"
                    title="Cerrar sesión">
                        <i class="fas fa-sign-out-alt fa-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>
