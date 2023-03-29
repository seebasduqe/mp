<div class="mb-4">
    <h3><strong>Usuario</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-4">
            <label for="name" class="">Nombre <small class="text-danger">*</small></label>
            {{ Form::text('name', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca un nombre.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}


        </div>

        <div class="col-md-4">
            <label for="sex" class="">Email <small class="text-danger"></small></label>

            {{ Form::text('email', null, [
                'class' => 'form-control ' . ($errors->has('email') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un mail.',
                'data-validacion' => 'email',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        La dirección de correo ya existe.
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-2">
            <label for="sub_company" class="">Sub Empresa <small class="text-danger">*</small></label>
            {{ Form::select('sub_company_id', $array_subcompany, null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una subempresa.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>

        <div class="col-md-2">
            <label for="sub_company" class="">Tipo usuario<small class="text-danger">*</small></label>
            {{ Form::select('role_id', $array_role, null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor seleccione un rol.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
        </div>
    </div>
</div>

<div class="mb-4">
    <h3><strong>Accesos</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">

        <div class="col-md-4">
            <label for="surnames" class="">Username <small class="text-danger">*</small></label>
            {{ Form::text('username', null, [
                'class' => 'form-control' . ($errors->has('username') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un username.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('username'))
                    <div class="invalid-feedback">
                        El username ya existe.
                    </div>
                @endif
            @endif
        </div>
        @if (!isset($obj_user) || Auth::user()->can('update_user_password'))
            <div class="col-md-4">
                <label for="password" class="">Nueva clave de acceso<small class="text-danger">*</small></label>

                <input data-validacion-text="Por favor introduzca una clave."
                    @if (!isset($obj_user)) data-validacion="obligatorio" @endif type="password"
                    name="password" id="password" class="form-control " autocomplete="new-password" value="">
                <div class="invalid-feedback">
                    'Las claves no coinciden.'
                </div>
            </div>

            <div class="col-md-4">
                <label for="password2" class="">Repetir nueva clave de acceso</label>
                <input type="password" name="password2" id="password2" class="form-control   " autocomplete="off"
                    value="">
            </div>
        @endif
    </div>

    <div class="mt-5 mb-3">

        <button id="btnUserSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/users/user_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
