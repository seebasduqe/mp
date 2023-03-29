<div id="modalHours" class="modal fade ot-hours-bulk-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="font-weight-bold">Carga masiva de horas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open([
                    'route' => ['ot.store_bulk_load_hours', $obj_ot->ot_id],
                    'method' => 'POST',
                    'id' => 'bulk_load_hours_form',
                ]) !!}
                @csrf
                <div class="row p-4">

                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="filterDaterange_modal" class="">Fechas <small
                                class="text-danger">*</small></label>

                        <input data-validacion="obligatorio" name="otDaterange_modal" id="otDaterange_modal"
                            type="text"
                            class="form-control {{ $errors->has('otDaterange_modal') ? ' is-invalid' : '' }}"
                            data-toggle="daterange">
                        @if ($errors->any())
                            @if ($errors->has('otDaterange_modal'))
                                <div class="invalid-feedback">
                                    Las fechas son obligatorias.
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="filterDaterange" class="">Persona <small class="text-danger">*</small></label>
                        {{ Form::select('person_id_modal', $array_person, null, [
                            'class' => 'form-control' . ($errors->has('person_id_modal') ? ' is-invalid' : ''),
                            'id' => 'selectPersonModal',
                            'data-validacion-text' => 'Por favor seleccione una persona.',
                            'data-validacion' => 'obligatorio',
                            'autocomplete' => 'off',
                        ]) }}
                        @if ($errors->any())
                            @if ($errors->has('person_id_modal'))
                                <div class="invalid-feedback">
                                    La persona es obligatoria.
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="hour_type_id_modal" class="">Tipo hora <small
                                class="text-danger">*</small></label>
                        {{ Form::select('hour_type_id_modal', $array_hour_type, null, [
                            'class' => 'form-control' . ($errors->has('hour_type_id_modal') ? ' is-invalid' : ''),
                            'data-validacion-text' => 'Por favor seleccione una tipo de hora.',
                            'data-validacion' => 'obligatorio',
                            'autocomplete' => 'off',
                            'id' => 'selectTypeHourModal',
                        ]) }}
                        @if ($errors->any())
                            @if ($errors->has('hour_type_id_modal'))
                                <div class="invalid-feedback">
                                    El tipo de hora es obligatorio.
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="category_id" class="">Tipo trabajo <small
                                class="text-danger">*</small></label>
                        {{ Form::select('category_id_modal', $array_category, null, [
                            'class' => 'form-control' . ($errors->has('category_id_modal') ? ' is-invalid' : ''),
                            'data-validacion-text' => 'Por favor seleccione una tipo trabajo.',
                            'data-validacion' => 'obligatorio',
                            'autocomplete' => 'off',
                        ]) }}
                        @if ($errors->any())
                            @if ($errors->has('category_id_modal'))
                                <div class="invalid-feedback">
                                    El tipo de trabajo es obligatorio.
                                </div>
                            @endif
                        @endif
                    </div>

                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="destiny_type_id" class="">Tipo destino <small
                                class="text-danger">*</small></label>
                        {{ Form::select('destiny_type_id_modal', $array_destiny_type, null, [
                            'class' => 'form-control' . ($errors->has('destiny_type_id_modal') ? ' is-invalid' : ''),
                            'data-validacion-text' => 'Por favor seleccione una tipo de destino.',
                            'data-validacion' => 'obligatorio',
                            'autocomplete' => 'off',
                        ]) }}
                        @if ($errors->any())
                            @if ($errors->has('destiny_type_id_modal'))
                                <div class="invalid-feedback">
                                    El tipo de destino es obligatorio.
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="sub_company_id" class="">SubEmpresa <small
                                class="text-danger">*</small></label>
                        {{ Form::select('sub_company_id_modal', $array_subompany, null, [
                            'class' => 'form-control' . ($errors->has('sub_company_id_modal') ? ' is-invalid' : ''),
                            'data-validacion-text' => 'Por favor seleccione una subempresa.',
                            'data-validacion' => 'obligatorio',
                            'autocomplete' => 'off',
                        ]) }}
                        @if ($errors->any())
                            @if ($errors->has('sub_company_id_modal'))
                                <div class="invalid-feedback">
                                    La subempresa es obligatoria.
                                </div>
                            @endif
                        @endif
                    </div>
                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="benefit" class="">Horas <small class="text-danger">*</small></label>
                        <div class="input-group">
                            {{ Form::text('hours_modal', null, [
                                'data-validacion' => 'obligatorio',
                                'class' => 'form-control' . ($errors->has('hours_modal') ? ' is-invalid' : ''),
                                'autocomplete' => 'off',
                            ]) }}
                            <div class="input-group-append">
                                <span class="input-group-text" id=""><i
                                        class="fas fa-hourglass-end"></i></span>
                            </div>
                            @if ($errors->any())
                                @if ($errors->has('hours_modal'))
                                    <div class="invalid-feedback">
                                        Las horas son obligatorias.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                    <div class="position-relative form-group text-left col-sm-12 col-md-6">
                        <label for="benefit" class="">Precio hora <small class="text-danger">*</small></label>
                        <div class="input-group">
                            {{ Form::text('price_modal', null, [
                                'data-validacion' => 'obligatorio',
                                'class' => 'form-control' . ($errors->has('price_modal') ? ' is-invalid' : ''),
                                'autocomplete' => 'off',
                            ]) }}
                            <div class="input-group-append">
                                <span class="input-group-text" id="">€</span>
                            </div>
                            @if ($errors->any())
                                @if ($errors->has('price_modal'))
                                    <div class="invalid-feedback">
                                        El precio es obligatorio.
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" id="saveBulkLoadHours" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </div>
</div>
