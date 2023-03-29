@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-euro-sign icon-gradient bg-primary"></i>
                </div>
                <div>Precio Hora Cliente
                    <div class="page-title-subheading">
                        Listado de Precio Hora por cliente
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('hour_price_client.create') }}"><i
                        class="fas fa-plus mr-2"></i>Nuevo Precio Hora</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="hourPriceTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Tipo Hora</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Tipo Trabajo</th>
                        <th class="text-center">Pvp</th>
                        <th class="text-center">Coste</th>
                        <th class="text-center">SubEmpresa</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>

                    @foreach ($array_hour_price as $hour_price)
                        <tr id="row_hour_price_{{ $hour_price->hour_price_id }}">
                            <td class="text-center">{{ $hour_price->hour_price_id }}</td>
                            <td class="text-center">{{ $hour_price->hour_type_name }}</td>
                            <td class="text-center">{{ $hour_price->client_name }}</td>
                            <td class="text-center">{{ $hour_price->job_description }}</td>
                            <td class="text-center">{{ $hour_price->pvp }}</td>
                            <td class="text-center">{{ $hour_price->cost }}</td>
                            <td class="text-center">{{ $hour_price->sub_company_name }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary"
                                    href="{{ route('hour_price_client.edit', $hour_price->hour_price_id) }}"
                                    title="Editar preico hora">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button class="btn btn-danger delete_hour_price"
                                    data-attr="{{ $hour_price->hour_price_id }}"
                                    id="dlt_btn_client_{{ $hour_price->hour_price_id }}" title="Eliminar Precio Hora"><i
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
        var delete_hour_price_url = "{{ route('hour_price_client.delete') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/hour_price_client/hour_price_client_list.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
