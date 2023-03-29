@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-users icon-gradient bg-primary"></i>
                </div>
                <div>Editar rol
                    <div class="page-title-subheading">
                        Editar rol
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('role.index') }}" class="m-2 btn btn-light"><i class="fa fa-angle-left mr-2"></i>Cancelar</a>

            </div>
        </div>
    </div>

@endsection


@section('main_content')

    <div class="pt-2">
        {!! Form::model($obj_role, [
            'route' => ['role.update', $obj_role->id],
            'method' => 'PUT',
            'id' => 'role_form',
        ]) !!}

        @csrf
        <div class="card mt-4">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>


                @include('MainApp.rols.form')
            </div>

        </div>
        </form>
    </div>

@endsection

@section('custom_footer')

@endsection
