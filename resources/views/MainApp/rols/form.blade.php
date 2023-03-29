<div class="mb-4">
    <h3><strong>Roles</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-3">
            <label for="name" class="">Rol <small class="text-danger">*</small></label>
            {{ Form::text('name', null, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca un nombre de rol.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        Error el nombre de rol ya existe.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-4">
            <label for="name" class="">Descripción<small class="text-danger"></small></label>
            {{ Form::textarea('description', null, [
                'class' => 'form-control',
                'data-validacion-text' => 'Por favor introduzca una descripción.',
                'data-validacion' => '',
                'autocomplete' => 'off',
                'rows' => 2,
            ]) }}
        </div>
    </div>
</div>
<div class="mb-4 mt-4">
    <h3><strong>Permisos</strong></h3>
</div>
<div class="position-relative form-group permissions-group ">
    <div class="row">
        @foreach ($array_permission as $permission)
            <div class="col-md-2">
                <div class="radio_options">
                    <div class="">
                        <label>
                            <p class="mb-2" title="{{ $permission->description }}">{{ $permission->visible_name }}</p>
                            <input name="permission[]" type="checkbox" value="{{ $permission->id }}"
                                @if (isset($array_permission_id)) @if (in_array($permission->id, $array_permission_id)) checked @else @endif
                                @endif>
                            <span></span>
                        </label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/rols/role_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
