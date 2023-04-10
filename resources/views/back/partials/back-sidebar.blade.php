<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
{{--            <li class="app-sidebar__heading">Menu</li>--}}
            <li class="{{ request()->is('home') ? 'mm-active' : '' }}">
                <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-box2"></i>
                    Panel de Control
                    {{-- <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i> --}}
                </a>
            </li>

            @can('user_index')
{{--            <li class="app-sidebar__heading">Usuarios</li>--}}
            <li class="{{ request()->is('users*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-users"></i>
                    Usuarios
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('users.index') }}" class="{{ request()->is('users*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Listado
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('company_index')
{{--            <li class="app-sidebar__heading">Empresas</li>--}}
            <li class="{{ request()->is('companies*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-culture"></i>
                    Empresas
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('companies.index') }}" class="{{ request()->is('companies') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Listado
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('role_index')
{{--            <li class="app-sidebar__heading">Roles Y Permisos</li>--}}
            <li class="{{ request()->is('permissions*') || request()->is('roles*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-unlock"></i>
                    Roles y Permisos
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="{{ route('roles.index') }}" class="{{ request()->is('roles*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Roles
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permissions.index') }}" class="{{ request()->is('permissions*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Permisos
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            @can('cms_index')
{{--            <li class="app-sidebar__heading">Roles Y Permisos</li>--}}
            <li class="{{ request()->is('cms*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-news-paper"></i>
                    CMS
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
{{--                        <a href="{{ route('cms.index') }}" class="{{ request()->is('companies') ? 'mm-active' : '' }}">--}}
                        <a href="#">
                            <i class="metismenu-icon"></i>
                            Listado
                        </a>
                    </li>
                    <li>
{{--                        <a href="{{ route('cms.create') }}" class="{{ request()->is('companies/create') ? 'mm-active' : '' }}">--}}
                        <a href="#">
                            <i class="metismenu-icon"></i>
                            Agregar
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>
