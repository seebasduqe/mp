@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-tools icon-gradient bg-primary"></i>
                </div>
                <div>Crear materiales
                    <div class="page-title-subheading">
                        Crear los materiales de la orden de trabajo
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('ot.index') }}" class="m-2 btn btn-light"><i class="fa fa-angle-left mr-2"></i>Cancelar</a>

            </div>
        </div>
    </div>

@endsection


@section('main_content')
    @if (session('success_msg'))
        <div id="success-container" class="row">
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
    <div class="row justify-content-center text-center mt-2">
        <div class="col-6">
            <div class="alert alert-primary" role="alert">
                Si no deseas añadir ningún material puedes ir al <strong><a
                        href="{{ route('ot.create_hours', $obj_ot->ot_id) }}"> siguiente paso.</a></strong>

            </div>
        </div>
    </div>
    <div class="">

        {!! Form::open([
            'route' => ['ot.store_materials', $obj_ot->ot_id],
            'method' => 'POST',
            'id' => 'materials_form',
        ]) !!}
        @csrf
        <div class="card">

            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>
                @include('MainApp.ot.form_materials')
            </div>

        </div>
        </form>

    </div>

@endsection

@section('custom_footer')

@endsection
