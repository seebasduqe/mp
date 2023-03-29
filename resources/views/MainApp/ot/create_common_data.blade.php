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
                <div>Crear nueva orden de trabajo
                    <div class="page-title-subheading">
                        Introduce los datos de la nueva orden de trabajo
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

    <div class="p-2">
        {!! Form::open(['route' => ['ot.store_common_data'], 'method' => 'POST', 'id' => 'ot_form']) !!}
        @csrf
        <div class="card">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>
                @include('MainApp.ot.form_common_data')
            </div>

        </div>
        </form>
    </div>

@endsection

@section('custom_footer')

@endsection
