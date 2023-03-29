@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-address-card icon-gradient bg-primary"></i>
                </div>
                <div>proveedores
                    <div class="page-title-subheading">
                        Listado de proveedores
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('provider.create') }}"><i
                        class="fa fa-user-plus mr-2"></i>Nuevo Proveedor</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="providerTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">NIF</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Población</th>
                        <th class="text-center">Sub Empresa</th>
                        <th></th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($array_providers as $provider)
                        <tr id="row_provider_{{ $provider->provider_id }}">
                            <td class="text-center">{{ $provider->provider_id }}</td>
                            <td class="text-center">{{ $provider->provider_name }}</td>
                            <td class="text-center">{{ $provider->nif }}</td>
                            <td class="text-center">{{ $provider->email }}</td>
                            <td class="text-center">{{ $provider->telephone }}</td>
                            <td class="text-center">{{ $provider->town }}</td>
                            <td class="text-center">{{ $provider->scompany_name }}</td>


                            <td class="text-center">

                                <a class="btn btn-primary" href="{{ route('provider.edit', $provider->provider_id) }}"
                                    title="Editar proveedor"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger delete_provider   " data-attr="{{ $provider->provider_id }}"
                                    id="dlt_btn_provider_{{ $provider->provider_id }}" title="Eliminar proveedor"><i
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
        var delete_provider_url = "{{ route('provider.delete') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/providers/provider_list.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
