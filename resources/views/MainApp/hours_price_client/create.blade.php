@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')

@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fa fa-euro-sign icon-gradient bg-primary"></i>
                </div>
                <div>Crear nuevo precio hora cliente
                    <div class="page-title-subheading">
                        Crear precio hora cliente
                    </div>
                </div>
            </div>
            <div class="page-title-actions text-white">
                <a href="{{ route('hour_price_client.index') }}" class="m-2 btn btn-light"><i
                        class="fa fa-angle-left mr-2"></i>Cancelar</a>

            </div>
        </div>
    </div>

@endsection


@section('main_content')

    <div class="p-2">
        {!! Form::open(['route' => ['hour_price_client.store'], 'method' => 'POST', 'id' => 'hour_price_client_form']) !!}
        @csrf
        <div class="card">
            <div class="card-body">
                <p class="float-right"><small class="text-danger">*</small> <small>Campos obligatorios</small></p>


                @include('MainApp.hours_price_client.form')
            </div>

        </div>
        </form>
    </div>

@endsection

@section('custom_footer')

@endsection
