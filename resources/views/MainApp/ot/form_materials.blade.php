<div class="mb-4">
    <div class="row">

        <h3><strong>Materiales</strong></h3>

    </div>
</div>
<div class="position-relative form-group">
    <div id="main_row">
        <div class="row" id="first_row">
            <div class=" col-md-3">
                <label for="description" class="">Descripción<small class="text-danger">*</small></label>
                {{ Form::text('description', null, [
                    'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca una descripción.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('description'))
                        <div class="invalid-feedback">
                            La descripción es obligatoria.
                        </div>
                    @endif
                @endif
            </div>
            <div class=" col-md-2">
                <label for="destiny_type_id" class="">Tipo destino <small class="text-danger">*</small></label>
                {{ Form::select('destiny_type_id', $array_destiny_type, null, [
                    'class' => 'form-control' . ($errors->has('destiny_type_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione un tipo de destino.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('destiny_type_id'))
                        <div class="invalid-feedback">
                            El tipo destino es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-2">
                <label for="provider_id" class="">Proveedor <small class="text-danger">*</small></label>
                {{ Form::select('provider_id', $array_provider, null, [
                    'class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione un proveedor.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('provider_id'))
                        <div class="invalid-feedback">
                            El proveedor es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-2">
                <label for="unit_type_id" class="">SubEmpresa <small class="text-danger">*</small></label>
                {{ Form::select('sub_company_id', $array_subompany, null, [
                    'class' => 'form-control' . ($errors->has('sub_company_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione una subempresa.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('sub_company_id'))
                        <div class="invalid-feedback">
                            La subempresa es obligatoria.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-2">
                <label for="date" class="">Fecha<small class="text-danger">*</small></label>
                {{ Form::date('date', null, [
                    'class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca una fecha.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('date'))
                        <div class="invalid-feedback">
                            La fecha es obligatoria.
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div id="main_row">
        <div class="row" id="second_row">

            <div class=" col-md-3">
                <label for="albaran_prod_ref" class="">Albarán prod ref<small class="text-danger"></small></label>
                {{ Form::text('albaran_prod_ref', null, [
                    'class' => 'form-control',
                    'data-validacion-text' => 'Por favor introduzca una descripción.',
                    'data-validacion' => '',
                    'autocomplete' => 'off',
                ]) }}

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
                <label for="units" class="">Unidades<small class="text-danger">*</small></label>
                {{ Form::number('units', null, [
                    'class' => 'form-control' . ($errors->has('units') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca las unidades.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('units'))
                        <div class="invalid-feedback">
                            Las unidades son obligatorias.
                        </div>
                    @endif
                @endif

            </div>
            <div class=" col-md-2">
                <label for="unit_type_id" class="">Tipo <small class="text-danger">*</small></label>
                {{ Form::select('unit_type_id', $array_unity_type, null, [
                    'class' => 'form-control' . ($errors->has('provider_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor seleccione un tipo.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}
                @if ($errors->any())
                    @if ($errors->has('provider_id'))
                        <div class="invalid-feedback">
                            El tipo es obligatorio.
                        </div>
                    @endif
                @endif
            </div>

            <div class=" col-md-1">
                <div class="radio_options">
                    <div class="">
                        <label>
                            <p class="mb-2" title="Consumible">Consumible</p>
                            <input name="consumable" type="checkbox" value="1">
                            <span></span>
                        </label>
                    </div>
                </div>

            </div>
            <input type="hidden" name="type" value="{{ $type }}">
            <div class="col-md-2 mt-4 text-right">
                <button id="save_material" type="button" class="mt-1 btn btn-success">
                    <i class="fa fa-save mr-2"></i>
                    Añadir material
                </button>

            </div>
        </div>
    </div>
</div>
<div class="position-relative form-group mt-4">
    <div class="row justify-content-center text-center">
        <div class="col-10 ">

            <div class='mt-4 mb-4'></div>
            <table id="materialsTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>

                        <th class="text-center">Destino</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Unidades</th>
                        <th class="text-center">Tipo</th>
                        <th class="text-center">Precio unidad</th>
                        <th class="text-center">Total</th>
                        <th class="text-center">Consumible</th>
                        <th class="text-center">SubEmpresa</th>
                        <th class="text-center">Albarán prod ref</th>
                        <th class="text-center">Fecha</th>
                        <th></th>
                    </tr>


                </thead>

                <tbody>
                    @foreach ($array_materials as $material)
                        <tr id="row_material_{{ $material->material_id }}">

                            <td class="text-center">{{ $material->destiny_type_name }}</td>
                            <td class="text-center">{{ $material->provider_name }}</td>
                            <td class="text-center">{{ $material->description }}</td>
                            <td class="text-center">{{ $material->units }}</td>
                            <td class="text-center">{{ $material->unit_type_name }}</td>
                            <td class="text-center">{{ $material->unit_price }}</td>
                            @php
                                $total = $material->units * $material->unit_price;
                                $total = number_format($total, 2, '.', ' ');
                            @endphp
                            <td class="text-center">{{ $total }}</td>
                            <td class="text-center">
                                <span data-toggle="tooltip" data-html="true" data-placement="top" title=""
                                    data-original-title="">
                                    @if ($material->consumable)
                                        <i class="text-success fas fa-check"></i>
                                    @else
                                        <i class="text-danger fas fa-times"></i>
                                    @endif
                                    <span></span>
                                </span>

                            </td>
                            <td class="text-center">{{ $material->sub_company_name }}</td>
                            <td class="text-center">{{ $material->albaran_prod_ref }}</td>
                            <td class="text-center">{{ $material->date->format('d-m-Y') }}</td>
                            <td class="text-center">
                                <button class="btn btn-danger delete_material" type="button"
                                    data-attr="{{ $material->material_id }}" id=""
                                    title="Eliminar material"><i class="fas fa-trash-alt"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="position-relative form-group">
    <div class="row">

    </div>
</div>

<div class="position-relative form-group">


    <div class="mt-5 mb-3">
        @if (isset($type))
            @if ($type == 'create')
                <a href="{{ route('ot.create_hours', $obj_ot->ot_id) }}" class="mt-1 btn btn-dark">
                    <i class="fa fa-save mr-2"></i>

                    Siguiente

                </a>
            @endif
        @endif
    </div>
</div>
@section('custom_footer')
    <script type="text/javascript">
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var delete_material = "{{ route('ot.delete_material') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery.inputmask.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/ot/ot_materials_view.js') }}?v={{ config('app.version') }}"></script>
@endsection
