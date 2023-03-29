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
                <div>Editar Sub-empresa
                    <div class="page-title-subheading">
                        Editar Sub-empresa
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('sub_companies.index') }}" class="m-2 btn btn-light"><i
                        class="fa fa-angle-left mr-2"></i>Cancelar</a>

            </div>
        </div>
    </div>

@endsection


@section('main_content')

    <div class="p-2">
        {!! Form::model($obj_sub_company, ['route' => ['sub_companies.update', $obj_sub_company->sub_company_id], 'method' => 'PUT', 'id' => 'sub_company_form']) !!}

        @csrf
        <div class="card">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>


                @include('MainApp.sub_companies.form')
            </div>

        </div>
        </form>
    </div>

@endsection

@section('custom_footer')

@endsection
