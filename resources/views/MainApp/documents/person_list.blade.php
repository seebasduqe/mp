@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-address-book icon-gradient bg-primary"></i>
                </div>
                <div>Documento de Personas
                    <div class="page-title-subheading">
                        Listado de documentos de personas
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">

            </div>
        </div>
    </div>

@endsection


@section('main_content')
    <div class="row">

        <div class="col-12 bg-white">
            <div class='mt-4 mb-4'></div>
            <table id="clientTbl"
                class="table table-hover table-striped table-bordered dataTable dtr-inline border-secondary no-footer"
                style="width:100%">
                <thead>
                    <tr>
                        <th class="text-center">Orden</th>
                        <th class="text-center">Fecha Creación</th>
                        <th class="text-center">Tipo documento</th>
                        <th class="text-center">Observaciones</th>
                        <th class="text-center">Persona</th>
                        <th class="text-center">Fecha expiración</th>
                        <th class="text-center">Documento</th>

                    </tr>


                </thead>

                <tbody>


                    @foreach ($array_document as $document)
                        <tr @if (isset($document->expiration_date)) @if ($document->expiration_date->lt($current_time)) class="table-danger" @endif
                            @endif
                            id="row_client_{{ $document->document_id }}">
                            <td class="text-center">{{ $document->document_id }}</td>
                            <td class="text-center">
                                @if (isset($document->created_at))
                                    {{ $document->created_at->format('d-m-Y') ?? '' }}
                                @endif
                            </td>
                            <td class="text-center">{{ $document->document_type }}</td>
                            <td class="text-center">{{ $document->observations }}</td>
                            <td class="text-center">
                                @if (isset($document->person_id))
                                    <a class="link-dark"
                                        href="{{ route('persons.edit_personal_data', $document->person_id) }}">{{ $document->person_name }}
                                        {{ $document->person_surnames }}</a>
                                @endif
                            </td>

                            <td class="text-center">
                                @if (isset($document->expiration_date))
                                    {{ $document->expiration_date->format('d-m-Y') ?? '' }}
                                @endif
                            </td>
                            <td class="text-center"><a
                                    href="{{ asset('storage/person_documents/' . $document->document_url) }}" download
                                    class="btn btn-success" href="" title="Descargar archivo">
                                    <i class="fas fa-file-download"></i></td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('custom_footer')

    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/documents/document_person_list.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
