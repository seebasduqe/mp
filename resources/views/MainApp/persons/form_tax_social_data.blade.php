<div class="mb-4">
    <h3><strong>Datos bancarios</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-lg-4  col-md-6">
            <label for="bank_account" class="">Número de cuenta <small class="text-danger">*</small></label>
            {{ Form::text('bank_account', null, [
                'class' => 'form-control' . ($errors->has('bank_account') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un número de cuenta válido.',
                'data-validacion' => 'obligatorio bank_account',
                'autocomplete' => 'off',
                'id' => 'bank_account',
                'autofocus' => 'true',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('bank_account'))
                    <div class="invalid-feedback">
                        El número de cuenta es obligatorio.
                    </div>
                @endif
            @endif
            <small>Patrón: ES11 1234 5678 12 3456789012</small>
        </div>



    </div>
</div>

<div class="mb-4">
    <h3><strong>Información Seguridad Social</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class="col-lg-4 col-md-4 ">
            <label for="nss" class="">Número de la seguridad social <small
                    class="text-danger">*</small></label>
            {{ Form::text('nss', null, [
                'class' => 'form-control' . ($errors->has('nss') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un número de la seguridad social.',
                'data-validacion' => 'obligatorio',
                'maxlength' => 15,
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('nss'))
                    <div class="invalid-feedback">
                        El número de la seguridad social es obligatorio.
                    </div>
                @endif
            @endif
        </div>
        <div class="col-lg-3 col-md-4 ">
            <label for="start_date" class="">Fecha de alta <small class="text-danger">*</small></label>
            {{ Form::date('start_date', null, [
                'class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una Fecha de alta.',
                'data-validacion' => 'obligatorio ',
                'autocomplete' => 'off',
            ]) }}
        </div>

    </div>
</div>
<div class="position-relative form-group">

    <div class="row">
        <div class="col-lg-7 col-md-8 ">
            <label for="observations" class="">Observaciones <small class="text-danger">*</small></label>
            {{ Form::textarea('observations', null, [
                'class' => 'form-control',
                'rows' => 2,
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>

    <div class="mt-5 mb-3">
        <button id="btnSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>
            @switch($type)
                @case('create')
                    Siguiente
                @break

                @default
                    Guardar
                @break
            @endswitch
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery.inputmask.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/iban_validation.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/persons/person_tax_social_data_view.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
