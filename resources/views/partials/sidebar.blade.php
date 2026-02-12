<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <i class="fas fa-layer-group text-warning me-2"></i>
            Style<span>Box</span>
        </a>
    </div>

    <ul class="nav-links list-unstyled">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item-header">OPERACIONES</li>

        <li class="nav-item">
            <a href="{{ route('pos.index') }}" class="nav-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
                <i class="fas fa-cash-register text-success"></i>
                <span>POS / Vender</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('clients.index') }}"
                class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Clientes</span>
            </a>
        </li>

        <li class="nav-item-header">CATÁLOGO</li>

        <li class="nav-item">
            <a href="{{ route('products.index') }}"
                class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                <i class="fas fa-tshirt"></i>
                <span>Productos</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('measurement_units.index') }}"
                class="nav-link {{ request()->routeIs('measurement_units.*') ? 'active' : '' }}">
                <i class="fas fa-ruler-combined"></i>
                <span>Unidades</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-boxes"></i>
                <span>Inventario</span>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('shop.index') }}" class="nav-link {{ request()->routeIs('shop.*') ? 'active' : '' }}">
                <i class="fas fa-store"></i>
                <span>Catálogo / Tienda</span>
            </a>
        </li>

        <li class="nav-item-header">SISTEMA</li>

        <li class="nav-item">
        <li class="nav-item">
            <a href="{{ route('reports.index') }}"
                class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i>
                <span>Reportes</span>
            </a>
        </li>
        </li>
        @can('users_list')
            <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="fas fa-user-cog"></i>
                    <span>Usuarios</span>
                </a>
            </li>
        @endcan
        @can('roles_list')
            <li class="nav-item">
                <a href="{{ route('roles.index') }}" class="nav-link {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                    <i class="fas fa-shield-alt"></i>
                    <span>Roles y Permisos</span>
                </a>
            </li>
        @endcan
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-cog"></i>
                <span>Configuración</span>
            </a>
        </li>
    </ul>

    <div class="sidebar-footer">
        <div class="user-profile">
            <div class="user-avatar">AD</div>
            <div class="user-info">
                <div class="fw-bold text-truncate">{{ auth()->user()->name }}</div>
                <small class="text-muted">{{ auth()->user()->email }}</small>
            </div>
            <a href="#" class="logout-btn" title="Cerrar Sesión"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>