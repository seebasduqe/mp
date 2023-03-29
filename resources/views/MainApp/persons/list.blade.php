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
                <div>Personas
                    <div class="page-title-subheading">
                        Listado de personas
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <input type="hidden" value="0" name="tab_orders" id="tab_orders">
                <a class="m-2 btn btn-primary" href="{{ route('persons.create_personal_data') }}"><i
                        class="fa fa-user-plus mr-2"></i>Nueva persona</a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="personTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">ID</th>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Apellidos</th>
                        <th class="text-center">NIF</th>
                        <th class="text-center">Teléfono</th>
                        <th class="text-center">Email</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_person as $person)
                        <tr id="row_person_{{ $person->person_id }}">
                            <td class="text-center">{{ $person->person_id }}</td>
                            <td class="text-center">{{ $person->name }}</td>
                            <td class="text-center">{{ $person->surnames }}</td>
                            <td class="text-center">{{ $person->nif }}</td>
                            <td class="text-center">
                                {{ !is_null($person->telephone_1) ? $person->telephone_1 : $person->telephone_2 }}</td>
                            <td class="text-center">{{ $person->email }}</td>

                            <td class="text-center">

                                <a class="btn btn-primary"
                                    href="{{ route('persons.edit_personal_data', $person->person_id) }}"
                                    title="Editar persona">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <button class="btn btn-danger delete_person" data-attr="{{ $person->person_id }}"
                                    id="dlt_btn_person_{{ $person->person_id }}" title="Eliminar persona">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
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
        var delete_person_url = "{{ route('persons.delete') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/persons/person_list.js') }}?v={{ config('app.version') }}"></script>
@endsection
