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
                <div>Editar Usuario
                    <div class="page-title-subheading">
                        Editar Usuario
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('users.index') }}" class="m-2 btn btn-light"><i
                        class="fa fa-angle-left mr-2"></i>Cancelar</a>

            </div>
        </div>
    </div>

@endsection


@section('main_content')

    <div class="p-2">
        {!! Form::model($obj_user, ['route' => ['users.update', $obj_user->id], 'method' => 'PUT', 'id' => 'user_form']) !!}

        @csrf
        <div class="card">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>


                @include('MainApp.users.form')
            </div>

        </div>
        </form>
    </div>

@endsection

@section('custom_footer')

@endsection
