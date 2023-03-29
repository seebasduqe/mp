<div class="mb-4">
    <h3><strong>Información común</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-2">
            <label for="name" class="">Número Ot <small class="text-danger">*</small></label>

            {{ Form::text('ot_number_info', null, [
                'class' => 'form-control' . ($errors->has('ot_number_info') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un número.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('ot_number_info'))
                    <div class="invalid-feedback">
                        El número es obligatorio.
                    </div>
                @endif
            @endif
        </div>
        <div class=" col-md-2">
            <label for="ot_number_info" class=""> &nbsp;<small class="text-danger"></small></label>
            {{ Form::text('ot_number', null, [
                'class' => 'form-control' . ($errors->has('ot_number') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un número.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => '',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('ot_number'))
                    <div class="invalid-feedback">
                        El número es obligatorio.
                    </div>
                @endif
            @endif
        </div>
        <div class=" col-md-2">
            <label for="person_id" class="">Técnico <small class="text-danger">*</small></label>
            {{ Form::select('person_id', $array_person, null, [
                'class' => 'form-control' . ($errors->has('person_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un técnico.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('person_id'))
                    <div class="invalid-feedback">
                        El técnico es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-3">
            <label for="type" class="">Tipo de ot <small class="text-danger">*</small></label>
            {{ Form::select('type', $array_type_ot, null, [
                'class' => 'form-control' . ($errors->has('type') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un tipo de ot.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('type'))
                    <div class="invalid-feedback">
                        El tipo de ot es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-3">
            <label for="sub_company_id" class="">SubEmpresa <small class="text-danger">*</small></label>
            {{ Form::select('sub_company_id', $array_sub_company, null, [
                'class' => 'form-control' . ($errors->has('sub_company_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione una sub-empresa.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('sub_company_id'))
                    <div class="invalid-feedback">
                        La sub-empresa es obligatoria.
                    </div>
                @endif
            @endif
        </div>


    </div>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-2">
            <label for="client_id" class="">Cliente <small class="text-danger">*</small></label>
            {{ Form::select('client_id', $array_client, null, [
                'class' => 'form-control' . ($errors->has('client_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione cliente.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('client_id'))
                    <div class="invalid-feedback">
                        El cliente es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-2">
            <label for="destiny_type_id" class="">Tipo destino <small class="text-danger">*</small></label>
            {{ Form::select('destiny_type_id', $array_destiny_type, null, [
                'class' => 'form-control' . ($errors->has('destiny_type_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un tipo de destino.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('destiny_type_id'))
                    <div class="invalid-feedback">
                        El tipo destino es obligatorio.
                    </div>
                @endif
            @endif
        </div>
        <div class=" col-md-2">
            <label for="ot_related_id" class="">Ot relacionada</label>
            {{ Form::select('ot_related_id', $array_ot, null, [
                'class' => 'form-control',
                'autocomplete' => 'off',
            ]) }}

        </div>
    </div>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class="col-md-12">
            <label for="observations" class="">Descipción </label>
            {{ Form::textarea('description', null, [
                'class' => 'form-control',
                'rows' => 3,
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>
<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>
            @if (isset($obj_ot))
                Guardar
            @else
                Siguiente
            @endif
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_common_data_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
