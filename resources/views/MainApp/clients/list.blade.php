@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-address-book icon-gradient bg-primary"></i>
                </div>
                <div>Clientes
                    <div class="page-title-subheading">
                        Listado de clientes
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('clients.create') }}"><i
                        class="fa fa-user-plus mr-2"></i>Nuevo Cliente</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="clientTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Nombre abrev</th>
                        <th class="text-center">Sub Empresa</th>
                        <th class="text-center">Población</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">Provincia</th>
                        <th class="text-center">País</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_client as $client)
                        <tr id="row_client_{{ $client->client_id }}">
                            <td class="text-center">{{ $client->client_id }}</td>
                            <td class="text-center">{{ $client->client_name }}</td>
                            <td class="text-center">{{ $client->short_name }}</td>
                            <td class="text-center">{{ $client->scompany_name }}</td>
                            <td class="text-center">{{ $client->town }}</td>
                            <td class="text-center">{{ $client->address }}</td>
                            <td class="text-center">{{ $client->province_name }}</td>
                            <td class="text-center">{{ $client->country_name }}</td>


                            <td class="text-center">

                                <a class="btn btn-primary" href="{{ route('clients.edit', $client->client_id) }}"
                                    title="Editar cliente"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger delete_client" data-attr="{{ $client->client_id }}"
                                    id="dlt_btn_client_{{ $client->client_id }}" title="Eliminar cliente"><i
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
        var delete_client_url = "{{ route('clients.delete') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/clients/client_list.js') }}?v={{ config('app.version') }}"></script>
@endsection
