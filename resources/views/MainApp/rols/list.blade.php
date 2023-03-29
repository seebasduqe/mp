@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-users icon-gradient bg-primary"></i>
                </div>
                <div>Roles
                    <div class="page-title-subheading">
                        Listado de roles
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('role.create') }}"><i class="fa fa-user-plus mr-2"></i>Nuevo
                    rol</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="roleTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Fecha creación</th>

                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_role as $role)
                        <tr id="row_role_{{ $role->id }}">
                            <td class="text-center">{{ $role->id }}</td>
                            <td class="text-center">{{ $role->name }}</td>
                            <td class="text-center">{{ $role->description }}</td>
                            <td class="text-center">{{ $role->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="{{ route('role.edit', $role->id) }}" title="Editar rol">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger delete_role" data-attr="{{ $role->id }}"
                                    id="dlt_btn_role_{{ $role->id }}" title="Eliminar rol"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_footer')
    <script type="text/javascript">
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var delete_role_url = "{{ route('role.delete') }}";
        var check_role_has_users_url = "{{ route('role.check_role_has_users', 'role_id') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/rols/role_list.js') }}?v={{ config('app.version') }}"></script>
@endsection
