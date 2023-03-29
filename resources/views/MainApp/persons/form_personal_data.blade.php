<div class="mb-4">
    <h3><strong>Información personal</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-2">
            <label for="name" class="">Nombre <small class="text-danger">*</small></label>
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        El nombre es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-2">
            <label for="surnames" class="">Apellidos<small class="text-danger">*</small></label>
            {{ Form::text('surnames', null, [
                'class' => 'form-control' . ($errors->has('surnames') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un apellido.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('surnames'))
                    <div class="invalid-feedback">
                        Los apellidos son obligatorios.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-1">
            <label for="initial" class="">Inicial<small class="text-danger"></small></label>
            {{ Form::text('initial', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una inicial.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}

        </div>

        <div class="col-md-2">
            <label for="nif" class="">Nif<small class="text-danger">*</small></label>
            {{ Form::text('nif', null, [
                'class' => 'form-control' . ($errors->has('nif') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un nif.',
                'data-validacion' => 'obligatorio dni',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('nif'))
                    <div class="invalid-feedback">
                        El nif ya existe.
                    </div>
                @endif
            @endif
        </div>

        <div class="col-md-2">
            <label for="sub-empresa" class="">Sub Empresa <small class="text-danger">*</small></label>
            {{ Form::select('sub_company_id', $array_sub_company, null, [
                'class' => 'form-control' . ($errors->has('sub_company_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una sub-empresa.',
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
        <div class="col-md-2">
            <label for="sub-empresa" class="">Categoria <small class="text-danger">*</small></label>
            {{ Form::select('category_id', $array_category, null, [
                'class' => 'form-control' . ($errors->has('category_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una categoria.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('category_id'))
                    <div class="invalid-feedback">
                        La categoria es obligatoria.
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-1 ">
            <div class=" radio_options">
                <div class="">
                    <label>
                        <p class="mb-2">Baja</p>
                        <input name="leave" type="checkbox" value="1"
                            @if (isset($obj_person)) {{ $obj_person->leave === 1 ? 'checked' : '' }} @endif>
                        <span></span>
                    </label>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="row">

        <div class="col-md-2">
            <label for="telephone_1" class="">Teléfono 1: <small class="text-danger">*</small></label>
            {{ Form::text('telephone_1', null, [
                'class' => 'form-control' . ($errors->has('telephone_1') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una teléfono.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('telephone_1'))
                    <div class="invalid-feedback">
                        El telefono es obligatorio.
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-2">
            <label for="telephone_2" class="">Teléfono 2: <small class="text-danger"></small></label>
            {{ Form::text('telephone_2', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una teléfono.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-3">
            <label for="email" class="">Email: <small class="text-danger"></small></label>
            {{ Form::text('email', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una email.',
                'data-validacion' => 'email',
                'autocomplete' => 'off',
            ]) }}
        </div>

        <div class="col-md-2">
            <label for="fehca-nacimiento" class="">Fecha de Nacimiento: <small
                    class="text-danger">*</small></label>
            {{ Form::date('birth_date', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una fecha de nacimiento.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('birth_date'))
                    <div class="invalid-feedback">
                        La fecha de nacimiento es obligatoria.
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-1">
            <label for="numero-matricula" class="">N Matrícula: <small class="text-danger"></small></label>
            {{ Form::text('registration_number', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una matrícula.',
                'data-validacion' => 'numerico',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="liquido-nomina" class="">Líquido Nómina: <small class="text-danger"></small></label>
            {{ Form::text('liquid_payroll', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una líquido de nómina.',
                'data-validacion' => 'numerico',
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="row">

        <div class="col-md-3">
            <label for="sub-empresa" class="">Dirección: <small class="text-danger">*</small></label>
            {{ Form::text('address', null, [
                'class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una dirección.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('address'))
                    <div class="invalid-feedback">
                        La dirección es obligatoria.
                    </div>
                @endif
            @endif
        </div>

        <div class="col-md-2">
            <label for="town" class="">Población: <small class="text-danger">*</small></label>
            {{ Form::text('town', null, [
                'class' => 'form-control' . ($errors->has('town') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una población.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('town'))
                    <div class="invalid-feedback">
                        La población es obligatoria.
                    </div>
                @endif
            @endif
        </div>

        <div class="col-md-2">
            <label for="postal_code" class="">Código postal: <small class="text-danger">*</small></label>
            {{ Form::text('postal_code', null, [
                'class' => 'form-control' . ($errors->has('postal_code') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un código postal.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('postal_code'))
                    <div class="invalid-feedback">
                        El código postal es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class="col-md-2">
         
            <label for="sub-empresa" class="">Provincia <small class="text-danger">*</small></label>
            {{ Form::select('province_id', $array_province, null, [
                'class' => 'form-control' . ($errors->has('province_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una provincia.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('province_id'))
                    <div class="invalid-feedback">
                        La privincia es obligatoria.
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnClientSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>
            @if (isset($obj_person))
                Guardar
            @else
                Siguiente
            @endif
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/persons/person_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
