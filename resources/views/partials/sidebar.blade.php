<nav class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            <i class="fas fa-layer-group text-warning me-2"></i>
            Style<span>Box</span>
        </a>
    </div>

    <ul class="nav-links list-unstyled">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
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

        <li class="nav-item-header">OPERACIONES</li>

        <li class="nav-item">
            <a href="{{ route('clients.index') }}"
                class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Clientes</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Ventas / POS</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-boxes"></i>
                <span>Inventario</span>
            </a>
        </li>

        <li class="nav-item-header">SISTEMA</li>

        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-chart-bar"></i>
                <span>Reportes</span>
            </a>
        </li>
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
                <div class="fw-bold text-truncate">Admin User</div>
                <small class="text-muted">admin@stylebox.com</small>
            </div>
            <a href="#" class="logout-btn" title="Cerrar Sesión">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </div>
</nav>