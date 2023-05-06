<div class="scrollbar-sidebar">
    <div class="app-sidebar__inner">
        <ul class="vertical-nav-menu">
            <li class="{{ request()->is('home') ? 'mm-active' : '' }}">
                <a href="{{ route('home') }}" class="{{ request()->is('home') ? 'mm-active' : '' }}">
                    <i class="metismenu-icon pe-7s-box2"></i>
                    Panel de Control - Cliente
                </a>
            </li>

            @can('user_company_index')
                <li class="{{ request()->is('collaborators*') ? 'mm-active' : '' }}">
                    <a href="{{ route('users.index') }}" class="{{ request()->is('collaborators*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-science"></i>
                        Maestro
                    </a>
                </li>
            @endcan

            <hr>

            @can('user_company_index')
                <li class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">
                    <a href="{{ route('users_company.index') }}" class="{{ request()->is('users-company*') ? 'mm-active' : '' }}">
                        <i class="metismenu-icon pe-7s-users"></i>
                        Usuarios
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</div>
