<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="">
                    <a href="{{ route('dashboard.index') }}" title="Dashboards"
                        class="{{ \Request::is('dashboard') == 1 ? 'active' : '' }}">
                        <i class="metismenu-icon fa fa-home"></i>
                        Dashboards
                    </a>
                </li>

                <li class="">
                    <a href="{{ route('ot.index') }}" title="Órdenes de trabajo"
                        class="{{ \Request::is('ordenes-trabajo') == 1 ? 'active' : '' }}">
                        <i class="metismenu-icon fas fa-tools"></i>
                        Órdendes de trabajo
                    </a>
                </li>
                @can('clients')
                    <li>
                        <a href="{{ route('clients.index') }}" title="Clientes"
                            class="{{ \Request::is('clientes') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-address-book"></i>
                            Clientes
                        </a>
                    </li>
                @endcan

                @can('providers')
                <li>
                    <a href="{{ route('provider.index') }}" title="Proveedores"
                        class="{{ \Request::is('Proveedores') == 1 ? 'active' : '' }}">
                        <i class="metismenu-icon fas fa-address-card"></i>
                        Proveedores
                    </a>
                </li>
                @endcan

                @can('companies')
                    <li>
                        <a href="{{ route('companies.index') }}" title="Empresas"
                            class="{{ \Request::is('empresas') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-building"></i>
                            Empresas
                        </a>
                    </li>
                @endcan
                @can('sub_companies')
                    <li>
                        <a href="{{ route('sub_companies.index') }}" title="SubEmpresas"
                            class="{{ \Request::is('sub-empresas') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-archive"></i>
                            SubEmpresas
                        </a>
                    </li>
                @endcan
                @can('holiday_days')
                    <li>
                        <a href="{{ route('holiday_days.index') }}" title="Días festivos"
                            class="{{ \Request::is('dias-festivos') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-calendar-alt"></i>
                            Días festivos
                        </a>
                    </li>
                @endcan
                @can('hour_price_client')
                    <li>
                        <a href="{{ route('hour_price_client.index') }}" title="Precios Hora Cliente"
                            class="{{ \Request::is('precios-hora-cliente') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-euro-sign"></i>
                            Precios Hora Cliente
                        </a>
                    </li>
                @endcan
                @can('provinces')
                    <li>
                        <a href="{{ route('provinces.index') }}" title="Provincias"
                            class="{{ \Request::is('provincias') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-map-marked-alt"></i>
                            Provincias
                        </a>
                    </li>
                @endcan
                @can('persons')
                    <li>
                        <a href="{{ route('persons.index') }}" title="Personas"
                            class="{{ \Request::is('personas') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-male"></i>
                            Personas
                        </a>
                    </li>
                @endcan
                @can('person_documents')
                    <li>
                        <a href="{{ route('documents_person.index') }}" title="Documentos de Personas"
                            class="{{ \Request::is('documentos/personas') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fas fa-folder-open"></i>
                            Documentos de Personas
                        </a>
                    </li>
                @endcan
                @can('role')
                    <li>
                        <a href="{{ route('role.index') }}" title="Roles de la plataforma"
                            class="{{ \Request::is('roles') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fa fa-users"></i>
                            Roles
                        </a>
                    </li>
                @endcan
                @can('users')
                    <li>
                        <a href="{{ route('users.index') }}" title="Usuarios"
                            class="{{ \Request::is('usuarios') == 1 ? 'active' : '' }}">
                            <i class="metismenu-icon fa fa-user"></i>
                            Usuarios
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</div>
