<header class="top-header">
    <div class="d-flex align-items-center justify-content-between w-100">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-dark d-md-none me-3" id="sidebarToggle">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <h5 class="mb-0 fw-bold text-dark d-none d-md-block">@yield('page_title')</h5>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="dropdown">
                <button class="btn btn-light position-relative rounded-circle" type="button">
                    <i class="far fa-bell"></i>
                    <span
                        class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle">
                        <span class="visually-hidden">New alerts</span>
                    </span>
                </button>
            </div>

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark"
                    id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name=Admin+User&background=0D8ABC&color=fff" alt="mdo"
                        width="32" height="32" class="rounded-circle me-2">
                    <span class="d-none d-md-inline small fw-bold">Admin</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="dropdownUser1">
                    <li><a class="dropdown-item small" href="#"><i class="fas fa-user-circle me-2"></i>Perfil</a></li>
                    <li><a class="dropdown-item small" href="#"><i class="fas fa-cog me-2"></i>Configuración</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item small text-danger" href="#"><i
                                class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>