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
                <div>Empresas
                    <div class="page-title-subheading">
                        Listado de empresas
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('companies.create') }}"><i
                        class="fa fa-user-plus mr-2"></i>Nueva Empresa</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="companiesTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Cif</th>
                        <th class="text-center">Dirección</th>
                        <th class="text-center">C.P.</th>
                        <th class="text-center">Población</th>
                        <th class="text-center">Fecha de alta</th>
                        <th class="text-center">Activa</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_company as $company)
                        <tr id="row_company_{{ $company->company_id }}">
                            <td class="text-center">{{ $company->company_id }}</td>
                            <td class="text-center">{{ $company->name }}</td>
                            <td class="text-center">{{ $company->cif }}</td>
                            <td class="text-center">{{ $company->address }}</td>
                            <td class="text-center">{{ $company->postal_code }}</td>
                            <td class="text-center">{{ $company->population }}</td>
                            <td class="text-center">
                                @if (isset($company->start_date))
                                    {{ $company->start_date->format('d-m-Y') ?? '' }}
                                @endif
                            </td>
                            <td class="text-center">

                                <span @if ($company->active != 1) style="display: none;" @endif
                                    class="toggleCompanyData" data-action="active_off"
                                    id="active_on_{{ $company->company_id }}" data-id="{{ $company->company_id }} "
                                    title="Empresa activa">
                                    <i class="green_sm_bo fa fa-toggle-on"></i>
                                </span>

                                <span @if ($company->active != 0) style="display: none;" @endif
                                    class="toggleCompanyData" data-action="active_on"
                                    id="active_off_{{ $company->company_id }}" data-id="{{ $company->company_id }} "
                                    title="Empresa no activa">
                                    <i class="red_sm_bo fa fa-toggle-off"></i>
                                </span>

                            </td>
                            <td class="text-center">

                                <a class="btn btn-primary" href="{{ route('companies.edit', $company->company_id) }}"
                                    title="Editar usuario"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-danger delete_company" data-attr="{{ $company->company_id }}"
                                    id="dlt_btn_company_{{ $company->company_id }}" title="Eliminar empresa"><i
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
        var delete_company_url = "{{ route('companies.delete') }}";
        var toggle_status_company_url = "{{ route('companies.toggle_status') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/companies/company_list.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
