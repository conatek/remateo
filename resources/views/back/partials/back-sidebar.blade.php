<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="app-sidebar__heading">Menu</li>
            <li class="mm-active">
                <a href="{{ route('home') }}">
                    <i class="metismenu-icon pe-7s-box2"></i>
                    Panel de Control
                    {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                </a>
            </li>
            <li class="app-sidebar__heading">Usuarios</li>
            <li class="{{ request()->is('users/*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-users"></i>
                    Gestión
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ request()->is('users/index') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Listado
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('users.create') }}" class="{{ request()->is('users/create') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Agregar
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>