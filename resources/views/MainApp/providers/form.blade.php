<div class="mb-4">
    <h3><strong>Proveedor</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-3">
            <label for="provider_name" class="">Nombre <small class="text-danger">*</small></label>
            {{ Form::text('provider_name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
        </div>

        <div class=" col-md-3">
            <label for="short_name" class="">Nombre Abrev</label>
            {{ Form::text('short_name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}
        </div>

        <div class=" col-md-2">
            <label for="nif" class="">Nif <small class="text-danger">*</small></label>
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
        <div class=" col-md-2">
            <label for="nif_ue" class="">Nif Ue</label>
            {{ Form::text('nif_ue', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nif ue.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="sub_company_id" class="">Sub Empresa <small class="text-danger">*</small></label>
            {{ Form::select('sub_company_id', $array_sub_company, null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una sub-empresa.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class="col-md-4">
            <label for="address" class="">Dirección <small class="text-danger">*</small></label>
            {{ Form::text('address', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca una dirección.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="town" class="">Población <small class="text-danger">*</small></label>
            {{ Form::text('town', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca una población.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="postal_code" class="">C.P. <small class="text-danger">*</small></label>
            {{ Form::text('postal_code', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca un código postal.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'maxlength' => '6',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="province_id" class="">Provincia <small class="text-danger">*</small></label>
            {{ Form::select('province_id', $array_province, null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor seleccione una provincia.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="country_id" class="">País <small class="text-danger">*</small></label>
            {{ Form::select('country_id', $array_country, null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor seleccione un país.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="row">

        <div class="col-md-3">
            <label for="email" class="">Email: <small class="text-danger">*</small></label>
            {{ Form::text('email', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una email.',
                'data-validacion' => 'email obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class="col-md-2">
            <label for="telephone" class="">Teléfono : <small class="text-danger">*</small></label>
            {{ Form::text('telephone', null, [
                'class' => 'form-control' . ($errors->has('telephone') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una número de teléfono.',
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
            <label for="fax" class="">Fax: </label>
            {{ Form::text('fax', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una fax.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="mt-5 mb-3">
        <button id="btnProviderSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>
    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/providers/provider_view.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
