<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('home') }}">Peliculas</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Route::currentRouteName() == 'home') active @endif" aria-current="page" href="{{ route('home') }}">Inicio</a>
                </li>
                @if (Cookie::get('Bearer') !== null)
                    @if (Cookie::get('is_admin') !== null && Cookie::get('is_admin') == 1)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catalogo</a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item @if(Route::currentRouteName() == 'catalogo') active @endif" href="{{ route('catalogo') }}">Ver catalogo</a>
                                </li>
                                <li><a class="dropdown-item @if(Route::currentRouteName() == 'inventario') active @endif" href="{{ route('inventario') }}">Administrar catalogo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('administradores') }}">Administradores</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('compras') }}">Compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('alquileres') }}">Alquileres</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'catalogo') active @endif" href="{{ route('catalogo') }}">Catalogo</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('compras') }}">Mis Compras</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('alquileres') }}">Mis Alquileres</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link @if(Route::currentRouteName() == 'catalogo') active @endif" href="{{ route('catalogo') }}">Catalogo</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contacto</a>
                </li>
            </ul>
            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @if (Cookie::get('Bearer') !== null)
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'perfil') active @endif" href="{{ route('perfil') }}">Mi perfil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'logout') active @endif" href="{{ route('logout') }}">Cerrar Sesión</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'login') active @endif" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if(Route::currentRouteName() == 'registro') active @endif" href="{{ route('registro') }}">Registro</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
  </nav>
