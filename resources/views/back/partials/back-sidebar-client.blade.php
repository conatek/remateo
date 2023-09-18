<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="{{ request()->is('home') ? 'mm-active' : '' }}">
                <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-box2"></i>
                    Panel de Control - Cliente
                </a>
            </li>

            {{-- @can('user_company_index') --}}
            <li class="{{ request()->is('collaborators*') ? 'mm-active' : '' }}">
                <a href="{{ route('collaborators.index') }}" class="{{ request()->is('collaborators*') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-science"></i>
                    Maestro
                </a>
            </li>
            {{-- @endcan --}}

            <hr>

            @can('user_company_index')
            <li class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">
                <a href="{{ route('users_company.index') }}" class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-users"></i>
                    Usuarios
                </a>
            </li>
            @endcan

            @can(['area_index'])
            <li class="{{ request()->is('areas*') ? 'mm-active' : '' }}">
                <a href="#">
                    <i class="metismenu-icon pe-7s-culture"></i>
                    Organización
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    @can('area_index')
                    <li class="{{ request()->is('areas*') ? 'mm-active' : '' }}">
                        <a href="{{ route('areas.index') }}" class="{{ request()->is('areas*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon"></i>
                            Áreas
                        </a>
                    </li>
                    @endcan

                    {{--            <li class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">--}}
                    <li class="{{ request()->is('positions*') ? 'mm-active' : '' }}">
                        <a href="{{ route('positions.index') }}" class="{{ request()->is('positions*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-more"></i>
                            Cargos
                        </a>
                    </li>

                    {{--            <li class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">--}}
                    <li class="{{ request()->is('campuses*') ? 'mm-active' : '' }}">
                        <a href="{{ route('campuses.index') }}" class="{{ request()->is('campuses*') ? 'mm-active' : '' }}">
                            <i class="metismenu-icon pe-7s-more"></i>
                            Sedes
                        </a>
                    </li>
                </ul>
            </li>
            @endcan

            <li>
                <a href="#">
                    <i class="metismenu-icon pe-7s-tools"></i>
                    Herramientas
                    <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                </a>
                <ul>
                    <li>
                        <a href="#">
                            <i class="metismenu-icon"></i>
                            Control Horas Extras
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="metismenu-icon"></i>
                            Inventario
                        </a>
                    </li>

                    <li>
                        <a href="#">
                            <i class="metismenu-icon"></i>
                            Tarjetas
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
