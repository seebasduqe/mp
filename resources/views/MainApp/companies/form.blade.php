<div class="mb-4">
    <h3><strong>Empresa</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-3">
            <label for="name" class="">Nombre <small class="text-danger">*</small></label>
            {{ Form::text('name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
        </div>

        <div class="col-md-3">
            <label for="sex" class="">Cif <small class="text-danger"></small></label>

            {{ Form::text('cif', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca un Cif.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}

        </div>
        <div class="col-md-3">
            <label for="sex" class="">Dirección <small class="text-danger"></small></label>

            {{ Form::text('address', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca una dirección.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}

        </div>

        <div class="col-md-3">
            <label for="sex" class="">C.P. <small class="text-danger"></small></label>

            {{ Form::text('postal_code', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca un código postal.',
                'data-validacion' => '',
                'autocomplete' => 'off',
                'maxlength' => '6',
            ]) }}

        </div>


    </div>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class="col-md-3">
            <label for="sex" class="">Población <small class="text-danger"></small></label>

            {{ Form::text('population', null, [
                'class' => 'form-control ',
                'data-validacion-text' => 'Por favor introduzca un código postal.',
                'data-validacion' => '',
                'autocomplete' => 'off',
            ]) }}

        </div>
        <div class="col-md-3">
            @php
                $start_date = isset($obj_company) && $obj_company->start_date != null ? $obj_company->start_date->format('Y-m-d') : \Carbon\Carbon::now()->format('Y-m-d');
            @endphp
            <label for="empresa" class="">Fecha de alta <small class="text-danger">*</small></label>
            <input type='date' name='start_date' class="form-control"
                data-validacion-text="Por favor introduzca una fecha." data-validacion="obligatorio" autocomplete="off"
                value="{{ $start_date }}">


        </div>
    </div>
</div>
<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnUserSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/companies/company_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
