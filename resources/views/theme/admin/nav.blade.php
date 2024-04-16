<button class="btn-nav">
    <i class="fa-solid fa-bars"></i>
</button>
<div class="nav-content">
    <div class ="user-info">
        @if ( Session::get('usuario')->user_foto != '' && File::exists(public_path()."/images/".Session::get('usuario')->user_foto) )
            <div class="imagen" style="background-image: url({{ public_path()."/images/".Session::get('usuario')->user_foto }}) "></div>
        @else
            <div class="imagen" style="background-image: url({{ asset('assets/admin/images/profile.png') }}) "></div>
        @endif
        <h2>{{ Session::get('usuario')->user_names." ".Session::get('usuario')->user_lastnames }}</h2>
    </div>
    <nav>
        <ul>
            <li><a href="{{ route('home-admin') }}"><i class="fa-solid fa-house"></i> Inicio</a></li>
            <li><a href="{{ route('banner.index') }}"><i class="fas fa-tags"></i> Banners</a></li>
            <li><a href="{{ route('category.index') }}"><i class="fas fa-tags"></i> Categorias</a></li>
            <li><a href="{{ route('campus.index') }}"><i class="fas fa-store"></i> Sedes</a></li>
            <li><a href="{{ route('product.index') }}"><i class="fas fa-shopping-basket"></i> Productos</a></li>
            <li><a href="{{ route('product.edicionmasiva') }}"><i class="fas fa-shopping-basket"></i>Edición masiva</a></li>
            <li><a href="{{ route('sales.index') }}"><i class="fas fa-tags"></i> Ventas</a></li>
            <li><a href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i> Usuarios</a></li>
        </ul>
    </nav>
    <a href="{{ route('logout') }}" class="logout">
        Cerrar sesión  <i class="fa-solid fa-power-off"></i>
    </a>
</div>