<div class="mb-4">
    <h3><strong> Precio hora cliente</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class=" col-md-2">
            <label for="name" class="">Tipo hora <small class="text-danger">*</small></label>
            {{ Form::select('hour_type_id', $array_hour_type, null, [
                'class' => 'form-control' . ($errors->has('hour_type_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un tipo de hora.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('hour_type_id'))
                    <div class="invalid-feedback">
                        El tipo de hora es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-2">
            <label for="name" class="">Tipo trabajo <small class="text-danger">*</small></label>
            {{ Form::select('job_id', $array_job, null, [
                'class' => 'form-control' . ($errors->has('job_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un trabajo.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('job_id'))
                    <div class="invalid-feedback">
                        El tipo de trabajo es obligatorio.
                    </div>
                @endif
            @endif
        </div>

        <div class=" col-md-2">
            <label for="name" class="">Cliente <small class="text-danger">*</small></label>
            {{ Form::select('client_id', $array_client, null, [
                'class' => 'form-control' . ($errors->has('client_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione un cliente.',
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
            <label for="name" class="">SubEmpresa <small class="text-danger">*</small></label>
            {{ Form::select('sub_company_id', $array_sub_company, null, [
                'class' => 'form-control' . ($errors->has('sub_company_id') ? ' is-invalid' : ''),
                'data-validacion-text' => 'Por favor seleccione una sub empresa.',
                'data-validacion' => 'obligatorio',
                'autocomplete' => 'off',
            ]) }}
            @if ($errors->any())
                @if ($errors->has('sub_company_id'))
                    <div class="invalid-feedback">
                        La SubEmpresa es obligatoria.
                    </div>
                @endif
            @endif
        </div>
        <div class=" col-md-2">
            <label for="name" class="">Pvp <small class="text-danger">*</small></label>
            <div class="input-group">
                {{ Form::text('pvp', null, [
                    'data-validacion' => 'obligatorio',
                    'class' => 'form-control' . ($errors->has('pvp') ? ' is-invalid' : ''),
                    'autocomplete' => 'off',
                ]) }}
                <div class="input-group-append">
                    <span class="input-group-text" id="">€</span>
                </div>
                @if ($errors->any())
                    @if ($errors->has('pvp'))
                        <div class="invalid-feedback">
                            El pvp es obligatorio.
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class=" col-md-2">
            <label for="name" class="">Coste <small class="text-danger"></small></label>
            <div class="input-group">
                {{ Form::text('cost', null, [
                    'class' => 'form-control',
                
                    'autocomplete' => 'off',
                ]) }}
                <div class="input-group-append">
                    <span class="input-group-text" id="">€</span>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="position-relative form-group">


    <div class="mt-5 mb-3">

        <button id="btnHourPriceSubmit" type="submit" class="mt-1 btn btn-dark">
            <i class="fa fa-save mr-2"></i>Guardar
        </button>

    </div>
</div>
@section('custom_footer')
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery.inputmask.min.js') }}?v={{ config('app.version') }}"></script>

    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/hour_price_client/hour_price_client_view.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
