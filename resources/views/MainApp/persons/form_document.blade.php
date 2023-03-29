<div class="mb-4">
    <div class="row">

        <h3><strong>Documentos</strong></h3>

    </div>
</div>
<div class="position-relative form-group">
    <div id="main_row">
        <div class="row group_documents" id="first_row">
            <div class="col-md-3">
                <div class="input-group pt-4 mt-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">
                            <i class="fas fa-file-excel"></i>
                        </span>
                    </div>
                    <div class="custom-file ">
                        <input type="file" class="custom-file-input" id="document_file" name="document_file"
                            data-validacion="obligatorio" autocomplete="off">
                        <label class="custom-file-label " for="document_file" data-browse="Examinar">
                            Elija un archivo </label>
                    </div>


                </div>



            </div>
            <div class=" col-md-3">
                <label for="description" class="">Observaciones<small class="text-danger">*</small></label>
                {{ Form::text('description', null, [
                    'class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca una descripción.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}

            </div>

            <div class="col-md-2">
                <label for="document-type" class="">Tipo documento <small class="text-danger">*</small></label>
                {{ Form::select('document_type_id', $array_document_type, null, [
                    'class' => 'form-control' . ($errors->has('document_type_id') ? ' is-invalid' : ''),
                    'data-validacion-text' => 'Por favor introduzca un tipo de documento.',
                    'data-validacion' => 'obligatorio',
                    'autocomplete' => 'off',
                ]) }}

            </div>
            <div class="col-md-2">
                <label for="expiration_date" class="">Fecha de caducidad <small
                        class="text-danger"></small></label>
                {{ Form::date('expiration_date', null, [
                    'class' => 'form-control',
                    'data-validacion-text' => 'Por favor introduzca una fecha de caducidad.',

                    'autocomplete' => 'off',
                ]) }}

            </div>
            <div class="col-md-2 mt-4">
                <button id="save_document" type="button" class="mt-1 btn btn-success">
                    <i class="fa fa-save mr-2"></i>
                    Guardar Documento
                </button>

            </div>
            {{-- <div class="col-md-2 mt-4">
                <a class="btn" href="javascript:void(0);" onclick="delete_row(this)"><i
                        class="fas fa-trash-alt text-danger"></i></a>
            </div> --}}
        </div>

    </div>



    <div class="position-relative form-group mt-4">
        <div class="row justify-content-center text-center">
            <div class="col-8 ">

                <div class='mt-4 mb-4'></div>
                <table id="provinceTbl"
                    class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                    style="width:100%">
                    <thead>
                        <tr>

                            <th class="text-center">Observaciones</th>
                            <th class="text-center">Tipo</th>
                            <th class="text-center">Documento</th>
                            <th class="text-center">Fecha de creación</th>
                            <th class="text-center">Fecha de caducidad</th>
                            <th></th>
                        </tr>


                    </thead>

                    <tbody>
                        @foreach ($array_document as $document)
                            <tr id="row_document_{{ $document->document_id }}">

                                <td class="text-center">{{ $document->observations }}</td>
                                <td class="text-center">{{ $document->type_name }}</td>
                                <td class="text-center"><a
                                        href="{{ asset('storage/person_documents/' . $document->document_url) }}"
                                        download class="btn btn-success" href="" title="Descargar archivo">
                                        <i class="fas fa-file-download"></i></td>
                                <td class="text-center">
                                    {{ $document->created_at->format('d-m-Y') }}</td>
                                <td class="text-center">
                                    @if (isset($document->expiration_date))
                                        {{ $document->expiration_date->format('d-m-Y') }}
                                    @else
                                        ---
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-primary" href=" {{route('document.edit', ['person_id' => $obj_person->person_id, 'document_id' => $document->document_id])}} " title="Editar ot"> <i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger delete_document" type="button"
                                        data-attr="{{ $document->document_id }}"
                                        id="dlt_btn_province_{{ $document->document_id }}"
                                        title="Eliminar documento"><i class="fas fa-trash-alt"></i></button>
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
                    <a
                        href="{{ route('persons.create_cost_hour', $obj_person->person_id) }}"class="mt-1 btn btn-dark">
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
            var delete_document = "{{ route('persons.delete_document') }}";
        </script>
        <script type="text/javascript"
            src="{{ URL::asset('' . DIR_JS . '/main_app/persons/person_document_view.js') }}?v={{ config('app.version') }}">
        </script>
    @endsection
