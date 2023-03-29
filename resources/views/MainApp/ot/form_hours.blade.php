<div class="mb-4">
    <div class="row ">
        <div class="col-sm-12 col-md-2 col-lg-2 col-xl-1">
            <h3><strong>Horas</strong></h3>
        </div>
        @if (isset($type) && $type == 'edit')
            <div class="col-sm-12 col-md-4">
                <button type="button" class="btn mr-2 mb-2 btn-secondary" data-toggle="modal"
                    data-target=".ot-hours-bulk-modal">Entrada horas massiva</button>
            </div>
        @endif
    </div>
</div>

<div class="position-relative form-group">
    <div id="main_row">
        <div class="row" id="first_row">

            <div class=" col-md-3">
                <label for="sub_company_id" class="">SubEmpresa <small class="text-danger">*</small></label>
                {{ Form::select('sub_company_id', $array_subompany, null, [
                    'class' => 'form-control' . ($errors->has('sub_company_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione una subempresa.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('sub_company_id'))
                        <div class="invalid-feedback">
                            La subempresa es obligatoria.
                        </div>
                    @endif
                @endif
            </div>
            <div class=" col-md-3">
                <label for="person_id" class="">Persona <small class="text-danger">*</small></label>
                {{ Form::select('person_id', $array_person, null, [
                    'class' => 'form-control' . ($errors->has('person_id') ? ' is-invalid' : ''),
                    'id' => 'selectPerson',
                    'data-validacion-text' => 'Por favor seleccione una persona.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('person_id'))
                        <div class="invalid-feedback">
                            La persona es obligatoria.
                        </div>
                    @endif
                @endif
            </div>
            <div class=" col-md-3">
                <label for="category_id" class="">Tipo trabajo <small class="text-danger">*</small></label>
                {{ Form::select('category_id', $array_category, null, [
                    'class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione una tipo trabajo.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('category_id'))
                        <div class="invalid-feedback">
                            El tipo de trabajo es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-3">
                <label for="destiny_type_id" class="">Tipo destino <small class="text-danger">*</small></label>
                {{ Form::select('destiny_type_id', $array_destiny_type, null, [
                    'class' => 'form-control' . ($errors->has('destiny_type_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione una tipo de destino.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('destiny_type_id'))
                        <div class="invalid-feedback">
                            El tipo de destino es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>
<div class="position-relative form-group">
    <div id="main_row">
        <div class="row" id="first_row">
            <div class=" col-md-2">
                <label for="hour_type_id" class="">Tipo hora <small class="text-danger">*</small></label>
                {{ Form::select('hour_type_id', $array_hour_type, null, [
                    'class' => 'form-control' . ($errors->has('hour_type_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione una tipo de hora.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                    'id' => 'selectTypeHour',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('hour_type_id'))
                        <div class="invalid-feedback">
                            El tipo de hora es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-2">
                <label for="benefit" class="">Horas <small class="text-danger">*</small></label>
                <div class="input-group">
                    {{ Form::text('hours', null, [
                        'data-validacion' => 'obligatorio',
                        'class' => 'form-control' . ($errors->has('hours') ? ' is-invalid' : ''),
                        'autocomplete' => 'off',
                    ]) }}
                    <div class="input-group-append">
                        <span class="input-group-text" id=""><i class="fas fa-hourglass-end"></i></span>
                    </div>
                    @if ($errors->any())
                        @if ($errors->has('hours'))
                            <div class="invalid-feedback">
                                Las horas son obligatorias.
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class=" col-md-2">
                <label for="benefit" class="">Precio hora <small class="text-danger">*</small></label>
                <div class="input-group">
                    {{ Form::text('price', null, [
                        'data-validacion' => 'obligatorio',
                        'class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                        'autocomplete' => 'off',
                    ]) }}
                    <div class="input-group-append">
                        <span class="input-group-text" id="">€</span>
                    </div>
                    @if ($errors->any())
                        @if ($errors->has('price'))
                            <div class="invalid-feedback">
                                El precio es obligatorio.
                            </div>
                        @endif
                    @endif
                </div>
            </div>

            <div class=" col-md-3">
                <label for="date" class="">Fecha <small class="text-danger">*</small></label>
                {{ Form::date('date', null, [
                    'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca una fecha.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            La fecha es obligatoria.
                        </div>
                    @endif
                @endif
            </div>
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="col-md-3 mt-4 text-right">
                <button id="saveHours" type="button" class="mt-1 btn btn-success">
                    <i class="fa fa-save mr-2"></i>
                    Añadir horas
                </button>
            </div>
        </div>
    </div>
</div>
<div class="position-relative form-group">
    <div id="main_row">
        <div class="row" id="second_row">

            <input type="hidden" name="type" value="{{ $type }}">

        </div>
    </div>
</div>
<div class="app-page-title bg-filter p-1">
    <div class="row justify-content-center text-center">
        <div class="col-10 ">
            <div class="row bg-secondary pl-2 pr-2 m-4 text-white">

                <span class="m-2"><strong>Total horas:</strong> <span
                        id="hours_count">{{ number_format($array_resume['hours_count'], 2, '.', '') }}</span></span>
                <span class="m-2"><strong>Total coste:</strong> <span
                        id="hours_total_amount">{{ number_format($array_resume['hours_total_amount'], 2, '.', '') }}</span></span>

                <br>
            </div>
        </div>
    </div>
</div>
<div class="position-relative form-group">
    <div class="row justify-content-center text-center">
        <div class="col-10 ">

            <div class='mt-4 mb-4'></div>
            <table id="hoursTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>

                        <th class="text-center">Persona</th>
                        <th class="text-center">Horas</th>
                        <th class="text-center">Tipo hora</th>
                        <th class="text-center">Tipo trabajo</th>
                        <th class="text-center">Precio</th>
                        <th class="text-center">Destino</th>
                        <th class="text-center">Entidad</th>
                        <th class="text-center">Fecha</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_hour as $hour)
                        <tr id="row_hours_{{ $hour->hour_ot_id }}">

                            <td class="text-center">{{ $hour->person_name }}</td>
                            <td class="text-center">{{ $hour->hours }}</td>
                            <td class="text-center">{{ $hour->hour_type_name }}</td>
                            <td class="text-center">{{ $hour->category_description }}</td>
                            <td class="text-center">{{ $hour->price }}</td>
                            <td class="text-center">{{ $hour->destiny_type_name }}</td>
                            <td class="text-center">{{ $hour->sub_company_name }}</td>
                            <td class="text-center">{{ $hour->date->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <button class="btn btn-danger delete_hour_ot" type="button"
                                    data-attr="{{ $hour->hour_ot_id }}" id="" title="Eliminar hora"><i
                                        class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="row">

    </div>
</div>

<div class="position-relative form-group">


    <div class="mt-5 mb-3">


        @if ($type == 'create')
            <a href="{{ route('ot.create_documents', $obj_ot->ot_id) }}"class="mt-1 btn btn-dark">
                <i class="fa fa-save mr-2"></i>
                Siguiente
            </a>
        @endif
    </div>
</div>

@php
    $error_from_modal = false;
    if (session()->has('error_from_modal')) {
        $error_from_modal = session()->get('error_from_modal');
    }
@endphp

@section('custom_footer')
    <script type="text/javascript">
        var error_from_modal = "{{ $error_from_modal }}";
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var get_person_hour_price = "{{ route('ot.get_person_hour_price') }}";
        var delete_hour = "{{ route('ot.delete_hour') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery.inputmask.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_hours_view.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_hours_modal.js') }}?v={{ config('app.version') }}"></script>
@endsection
