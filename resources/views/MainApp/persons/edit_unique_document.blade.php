@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-user icon-gradient bg-primary"></i>
                </div>
                <div>Editar el documento {{$document->observations}}
                    <div class="page-title-subheading">
                        Actualizar el documento de tipo {{$document->type_name}} de la persona {{$obj_person->name}}
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('persons.index') }}" class="m-2 btn btn-light">
                    <i class="fa fa-angle-left mr-2"></i>Cancelar
                </a>
            </div>
        </div>
    </div>

@endsection


@section('main_content')
    @if (session('success_msg'))
        <div class="row">
            <!-- .col-md-12 -->
            <div class="col-12 position-relative">
                <div class="w-100 position-absolute" style="z-index:1000;">
                    <div class="mx-auto w-75  alert alert-success alert-dismissible fade  show" style="display:block"
                         role="alert">
                        {{ session('success_msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- /.col-md-12 -->
        </div>
    @endif
    <div class="p-2">
        {!! Form::model($obj_person, [
            'route' => ['persons.update_document', $obj_person->person_id, $document->document_id],
            'files' => true,
            'method' => 'PUT',
            'id' => 'person_document_form',
        ]) !!}
        @csrf
        <div class="card">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>
                @include('MainApp.persons.form_document_edit')
            </div>

        </div>
        {!! Form::close() !!}
    </div>

@endsection

@section('custom_footer')

@endsection
