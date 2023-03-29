@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-map-marked-alt icon-gradient bg-primary"></i>
                </div>
                <div>Provincias
                    <div class="page-title-subheading">
                        Listado de provincias
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('provinces.create') }}"><i
                        class="fa fa-user-plus mr-2"></i>Nueva provincia</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="provinceTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Prefijo telefónico</th>
                        <th class="text-center">Prefijo postal</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_province as $province)
                        <tr id="row_province_{{ $province->province_id }}">
                            <td class="text-center">{{ $province->province_id }}</td>
                            <td class="text-center">{{ $province->province_name }}</td>
                            <td class="text-center">{{ $province->phone_prefix }}</td>
                            <td class="text-center">{{ $province->code_prefix }}</td>
                            <td class="text-center">

                                <a class="btn btn-primary" href="{{ route('provinces.edit', $province->province_id) }}"
                                    title="Editar provincia"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger delete_province" data-attr="{{ $province->province_id }}"
                                    id="dlt_btn_province_{{ $province->province_id }}" title="Eliminar provincia"><i
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
        var delete_province_url = "{{ route('provinces.delete') }}";
        var check_priovince_has_clients_url = "{{ route('provinces.check_priovince_has_clients_url', 'province_id') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/provinces/province_list.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
