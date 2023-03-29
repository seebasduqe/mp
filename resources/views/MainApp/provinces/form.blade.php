<div class="mb-4">
    <h3><strong>Provincias</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row mb-2 ">
        <div class=" col-12 col-md-6 col-xl-4">
            <label for="name" class="">Nombre de la provincia<small class="text-danger">*</small></label>
            {{ Form::text('province_name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
        </div>
    </div>
    <div class="row mb-2">
        <div class=" col-12 col-md-3 col-xl-2">
            <label for="name" class="">Prefijo telefónico<small class="text-danger">*</small></label>
            {{ Form::text('phone_prefix', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un prefijo telefónico.',
                'data-validacion' => 'obligatorio numerico',
                'autocomplete' => 'off',
            ]) }}
        </div>

        <div class=" col-12 col-md-3 col-xl-2">
            <label for="name" class="">Prefijo postal</label>
            {{ Form::text('code_prefix', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un prefijo postal.',
                'data-validacion' => 'numerico',
                'autocomplete' => 'off',
                'maxlength' => '2',
            ]) }}
        </div>
    </div>
</div>

<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnProvinceSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/provinces/province_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
