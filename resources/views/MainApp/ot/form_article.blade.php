<div class="mb-4">
    <h3><strong>Artículos</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-3">
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

        <div class="col-md-2">
            <label for="quantity" class="">Cantidad <small class="text-danger">*</small></label>
            {{ Form::number('quantity', null, [
                'class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor introduzca una cantidad.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('quantity'))
                    <div class="invalid-feedback">
                        La cantidad es obligatoria.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-2">
            <label for="unit_price" class="">Precio unidad <small class="text-danger">*</small></label>
            <div class="input-group">
                {{ Form::text('unit_price', null, [
                    'data-validacion' => 'obligatorio',
                    'class' => 'form-control' . ($errors->has('unit_price') ? ' is-invalid' : ''),
                    'autocomplete' => 'off',
                ]) }}
                <div class="input-group-append">
                    <span class="input-group-text" id="">€</span>
                </div>
                @if ($errors->any())
                    @if ($errors->has('unit_price'))
                        <div class="invalid-feedback">
                            El precio unidad es obligatorio.
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class=" col-md-2">
            <label for="attrition" class="">Desgaste <small class="text-danger">*</small></label>
            <div class="input-group">
                {{ Form::text('attrition', null, [
                    'data-validacion' => 'obligatorio',
                    'class' => 'form-control' . ($errors->has('attrition') ? ' is-invalid' : ''),
                    'autocomplete' => 'off',
                ]) }}
                <div class="input-group-append">
                    <span class="input-group-text" id="">%</span>
                </div>
                @if ($errors->any())
                    @if ($errors->has('attrition'))
                        <div class="invalid-feedback">
                            El desgaste es obligatorio.
                        </div>
                    @endif
                @endif
            </div>
        </div>

        <div class=" col-md-2">
            <label for="benefit" class="">Beneficio <small class="text-danger">*</small></label>
            <div class="input-group">
                {{ Form::text('benefit', null, [
                    'data-validacion' => 'obligatorio',
                    'class' => 'form-control' . ($errors->has('benefit') ? ' is-invalid' : ''),
                    'autocomplete' => 'off',
                ]) }}
                <div class="input-group-append">
                    <span class="input-group-text" id="">%</span>
                </div>
                @if ($errors->any())
                    @if ($errors->has('benefit'))
                        <div class="invalid-feedback">
                            El beneficio es obligatorio.
                        </div>
                    @endif
                @endif
            </div>
        </div>

    </div>
</div>

<div class="position-relative form-group">
    <div class="row">
        <div class="col-md-6">
            <label for="observations" class="">Comentarios </label>
            {{ Form::textarea('comments', null, [
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
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_articles_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
