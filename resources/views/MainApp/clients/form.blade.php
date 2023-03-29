<div class="mb-4">
    <h3><strong>Clientes</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-3">
            <label for="client_name" class="">Nombre <small class="text-danger">*</small></label>
            {{ Form::text('client_name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
        </div>

        <div class=" col-md-3">
            <label for="short_name" class="">Nombre Abrev<small class="text-danger"></small></label>
            {{ Form::text('short_name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}
        </div>

        <div class=" col-md-2">
            <label for="nif" class="">Nif<small class="text-danger">*</small></label>
            {{ Form::text('nif', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nif.',
                'data-validacion' => 'obligatorio dni',
                'autocomplete' => 'off',
            ]) }}
        </div>
        <div class=" col-md-2">
            <label for="nif_ue" class="">Nif Ue<small class="text-danger"></small></label>
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
            <label for="postal_code" class="">C.P. <small class="text-danger"></small></label>

            {{ Form::text('postal_code', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca un código postal.',
                'data-validacion' => '',
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
        <div class="col-md-4">
            <label for="address" class="">Dirección <small class="text-danger"></small>*</label>

            {{ Form::text('address', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca una dirección.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}

        </div>


    </div>
</div>
<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnClientSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/clients/client_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
