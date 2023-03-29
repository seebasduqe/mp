@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')


@endsection


@section('main_content')
    <div class="row">

        @include('includes.dashboard_card_inc', [
            'main_title' => 'Órdenes de trabajo',
            'secondary_title' => 'Listado de órdenes de trabajo de la plataforma',
            'create_name' => 'Nuevo',
            'url_list' => route('ot.index'),
            'url_create' => '',
            'main_icon' => 'fas fa-tools',
            'create_icon' => 'fas fa-plus',
        ])

        @can('clients')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Clientes',
                'secondary_title' => 'Listado de clientes',
                'create_name' => 'Nuevo',
                'url_list' => route('clients.index'),
                'url_create' => route('clients.create'),
                'main_icon' => 'fas fa-address-book',
                'create_icon' => 'fas fa-plus',
            ])
        @endcan
        @include('includes.dashboard_card_inc', [
            'main_title' => 'Proveedores',
            'secondary_title' => 'Listado de Proveedores',
            'create_name' => 'Nuevo',
            'url_list' => route('provider.index'),
            'url_create' => route('provider.create'),
            'main_icon' => 'fas fa-address-card',
            'create_icon' => 'fas fa-plus',
        ])
        @can('companies')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Empresas',
                'secondary_title' => 'Listado de empresas',
                'create_name' => 'Nuevo',
                'url_list' => route('companies.index'),
                'url_create' => route('companies.create'),
                'main_icon' => 'fas fa-building',
                'create_icon' => 'fas fa-plus',
            ])
        @endcan
        @can('sub_companies')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'SubEmpresas',
                'secondary_title' => 'Listado de subempresas',
                'create_name' => 'Nuevo',
                'url_list' => route('sub_companies.index'),
                'url_create' => route('sub_companies.create'),
                'main_icon' => 'fas fa-archive',
                'create_icon' => 'fas fa-plus',
            ])
        @endcan
        @can('holiday_days')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Días festivos',
                'secondary_title' => 'Gestión de días festivos',
                'create_name' => 'Nuevo',
                'url_list' => route('holiday_days.index'),
                'url_create' => '',
                'main_icon' => 'fas fa-calendar-alt',
                'create_icon' => 'fas fa-calendar-plus',
            ])
        @endcan

        @can('hour_price_client')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Precios Hora Cliente',
                'secondary_title' => 'Precios Hora Cliente',
                'create_name' => 'Nuevo',
                'url_list' => route('hour_price_client.index'),
                'url_create' => route('hour_price_client.create'),
                'main_icon' => 'fas fa-euro-sign',
                'create_icon' => 'fas fa-plus ',
                'class_css' => '',
            ])
        @endcan
        @can('provinces')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Provincias',
                'secondary_title' => 'Listado de provincias',
                'create_name' => 'Nueva',
                'url_list' => route('provinces.index'),
                'url_create' => route('provinces.create'),
                'main_icon' => 'fas fa-map-marked-alt',
                'create_icon' => 'fas fa-plus ',
            ])
        @endcan
        @can('persons')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Personas',
                'secondary_title' => 'Listado de personas',
                'create_name' => 'Nueva',
                'url_list' => route('persons.index'),
                'url_create' => route('persons.create_personal_data'),
                'main_icon' => 'fas fa-male',
                'create_icon' => 'fas fa-plus ',
            ])
        @endcan
        @can('role')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Roles',
                'secondary_title' => 'Listado de roles de la plataforma',
                'create_name' => 'Nuevo',
                'url_list' => route('role.index'),
                'url_create' => route('role.create'),
                'main_icon' => 'fa fa-users',
                'create_icon' => 'fas fa-plus ',
            ])
        @endcan
        @can('users')
            @include('includes.dashboard_card_inc', [
                'main_title' => 'Usuarios',
                'secondary_title' => 'Listado de usarios de la plataforma',
                'create_name' => 'Nuevo',
                'url_list' => route('users.index'),
                'url_create' => route('users.create'),
                'main_icon' => 'fa fa-user',
                'create_icon' => 'fa fa-user-plus',
            ])
        @endcan

    </div>
@endsection

@section('custom_footer')

@endsection
