@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/xlsx.full.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/php-date-formatter.js') }}?v={{ config('app.version') }}"></script>
@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-tools icon-gradient bg-primary"></i>
                </div>
                <div>Órdenes de trabajo
                    <div class="page-title-subheading">
                        En este listado podrás visualizar y gestionar las órdenes de trabajo.
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('ot.create') }}"><i class="fa fa-user-plus mr-2"></i>Nueva
                    órden</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <!-- WARNING CONTAINER -->
    <div id="warning-container" class="row" style="display:none;">
        <!-- .col-md-12 -->
        <div class="col-12 position-relative">
            <div class="w-100 position-absolute" style="z-index:1000;">
                <div id="warning-container-text" class="mx-auto w-75  alert alert-warning alert-dismissible fade  show"
                    style="display:block" role="alert">

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        <!-- /.col-md-12 -->
    </div>
    <!-- ERORR CONTAINER -->
    @if (session('error_msg'))
        <div id="error-container" class="row">
            <!-- .col-md-12 -->
            <div class="col-12 position-relative">
                <div class="w-100 position-absolute" style="z-index:1000;">
                    <div id="error-container-text" class="mx-auto w-75  alert alert-danger alert-dismissible fade  show"
                        style="display:block" role="alert">
                        {{ session('error_msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
    @endif
    <div class="app-page-title bg-filter p-1">
        <form id="form_orders" method="POST" autocomplete="off">
            <div class="row m-1">
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterSearch" class="">Filtro</label>
                    <input value="{{ Session::get('filterSearch') ? Session::get('filterSearch') : '' }}"
                        name="filterSearch" id="filterSearch" placeholder="Filtrar pedidos" type="text"
                        class="form-control">
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterDaterange" class="">Selecciona las fechas</label>

                    <input value="{{ Session::get('filterDaterange') }}" name="filterDaterange" id="filterDaterange"
                        type="text" class="form-control" data-toggle="daterange">
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterClient" class="">Cliente</label>
                    <select name="filterClient" id="filterClient" class="form-control">
                        <option {{ Session::get('filterClient') == '' ? 'selected' : '' }} value="">Cualquier cliente
                        </option>
                        @foreach ($array_client as $client)
                            <option {{ Session::get('filterClient') == $client->client_id ? 'selected' : '' }}
                                value="{{ $client->client_id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterPerson" class="">Técnico</label>
                    <select name="filterPerson" id="filterPerson" class="form-control">
                        <option {{ Session::get('filterPerson') == '' ? 'selected' : '' }} value="">Cualquier técnico
                        </option>
                        @foreach ($array_person as $person)
                            <option {{ Session::get('filterPerson') == $person->person_id ? 'selected' : '' }}
                                value="{{ $person->person_id }}">{{ $person->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterYear" class="">Ejercicio</label>
                    <select name="filterYear" id="filterYear" class="form-control">
                        <option {{ Session::get('filterYear') == '' ? 'selected' : '' }} value="">Cualquier Año
                        </option>
                        @php
                            $year = date('Y');
                        @endphp
                        @for ($year; $year >= 2020; $year--)
                            <option value="{{ $year }}"
                                {{ Session::get('filterYear') == $year ? 'selected' : '' }}> {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterQuarter" class="">Trimestre</label>
                    <select name="filterQuarter" id="filterQuarter" class="form-control">
                        <option {{ Session::get('filterQuarter') == '' ? 'selected' : '' }} value="">Todos</option>
                        <option value="5" {{ Session::get('filterQuarter') == 5 ? 'selected' : '' }}>Últ.90Días del
                            año actual
                        </option>
                        <option value="1" {{ Session::get('filterQuarter') == 1 ? 'selected' : '' }}>Primero</option>
                        <option value="2" {{ Session::get('filterQuarter') == 2 ? 'selected' : '' }}>Segundo</option>
                        <option value="3" {{ Session::get('filterQuarter') == 3 ? 'selected' : '' }}>Tercero</option>
                        <option value="4" {{ Session::get('filterQuarter') == 4 ? 'selected' : '' }}>Cuarto</option>
                    </select>
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterStatus" class="">Estado</label>
                    <select name="filterStatus" id="filterStatus" class="form-control">
                        <option {{ Session::get('filterStatus') == '' ? 'selected' : '' }} value="">Cualquier estado
                        </option>
                        @foreach ($array_ot_status as $ot_status)
                            <option {{ Session::get('filterStatus') == $ot_status->ot_status_id ? 'selected' : '' }}
                                value="{{ $ot_status->ot_status_id }}">{{ $ot_status->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="position-relative form-group text-left col-sm-6 col-md-3">
                    <label for="filterDestinyType" class="">Tipo destino</label>
                    <select name="filterDestinyType" id="filterDestinyType" class="form-control">
                        <option {{ Session::get('filterDestinyType') == '' ? 'selected' : '' }} value="">Cualquier
                            destino</option>
                        @foreach ($array_destiny_type as $destiny_type)
                            <option
                                {{ Session::get('filterDestinyType') == $destiny_type->destiny_type_id ? 'selected' : '' }}
                                value="{{ $destiny_type->destiny_type_id }}">{{ $destiny_type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="position-relative form-group col-12 text-white mb-0">
                    <button id="filterBtn" class="m-2 btn btn-primary " type="button"><i
                            class="fa fa-filter mr-2"></i>Filtrar</button>
                    <button id="resetBtn" class="m-2 btn btn-danger" type="button">
                        <i class="fa fa-ban"></i> Quitar Filtro
                    </button>
                    <button class="m-2 btn  btn-secondary export_excel" type="button"><i
                            class="fa fa-file-download mr-2"></i>Exportar
                        Órdenes de trabajo</button>

                </div>
            </div>

            @can('gray_bar')
            <div class="row bg-secondary pl-2 pr-2 m-4 text-white">

                <span class="m-2"><strong>Órdenes de trabajo:</strong> <span id="ot_count"></span></span>
                <span class="m-2"><strong>Importe total de venta:</strong> <span id="total_sales_amount"></span></span>
                <span class="m-2"><strong>Importe total de compra teórico:</strong> <span
                        id="total_theoretical_purchase_amount"></span></span>
                <span class="m-2"><strong>Importe total coste real:</strong> <span
                        id="total_amount_real_cost"></span></span>
                <span class="m-2"><strong>Margen teórico:</strong> <span id="theoretical_margin"></span></span>
                <span class="m-2"><strong>Margen real:</strong> <span id="real_margin"></span></span>
                <br>

            </div>
            @endcan

        </form>
    </div>
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="otTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Número</th>
                        <th class="text-center"></th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Cliente</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Técnico</th>
                        <th class="text-center">Destino</th>
                        <th class="text-center">OtRel</th>
                        <th class="text-center">Número Albarán</th>
                        <th class="text-center">Fecha Creación</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


@endsection

@section('custom_footer')
    <script type="text/javascript">
        var array_ot_status = <?php echo json_encode($array_ot_status, JSON_PRETTY_PRINT); ?>;
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var get_ot_list_url = "{{ route('ot.get_ot_list') }}";
        var ot_edit_url = "{{ route('ot.edit_common_data', 'ot_id') }}";
        var delete_ot_url = "{{ route('ot.delete') }}";
        var change_ot_status = "{{ route('ot.change_status') }}";
    </script>

    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_list.js') }}?v={{ config('app.version') }}"></script>
@endsection
