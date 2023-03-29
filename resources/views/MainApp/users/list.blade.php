@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user icon-gradient bg-primary"></i>
                </div>
                <div>Usuarios
                    <div class="page-title-subheading">
                        Listado de usarios de la plataforma
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('users.create') }}"><i class="fa fa-user-plus mr-2"></i>Nuevo
                    usuario</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">
        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="usersTbl"
                class="mt-4 table table-hover table-striped table-bordered dataTable dtr-inline border-secondary"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Nombre de usuario</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Fecha de alta</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_user as $user)
                        <tr id="row_user_{{ $user->id }}">
                            <td class="text-center">{{ $user->id }}</td>
                            <td class="text-center">{{ $user->name }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">{{ $user->username }}</td>
                            <td class="text-center">{{ $user->getRoleNames()[0] ?? '' }}</td>
                            <td class="text-center">{{ $user->created_at->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"
                                    title="Editar usuario"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger delete_user" data-attr="{{ $user->id }}"
                                    id="dlt_btn_user_{{ $user->id }}" title="Eliminar usuario"><i
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
        var delete_user_url = "{{ route('users.delete') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/users/user_list.js') }}?v={{ config('app.version') }}"></script>
@endsection
