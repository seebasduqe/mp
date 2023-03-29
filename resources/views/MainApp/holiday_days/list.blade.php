@extends('layouts.app')

@section('app_name', config('app.name'))


@section('custom_head')
    <script type="text/javascript">
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        var get_dates_url = "{{ route('holiday_days.get_holidays') }}";
        var toogle_dates = "{{ route('holiday_days.toogle_holidays') }}";
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery-ui.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery-ui.multidatespicker.js') }}?v={{ config('app.version') }}">
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/holiday_days/holiday_days_list.js') }}?v={{ config('app.version') }}">
    </script>
    <link href="{{ URL::asset('' . DIR_CSS . '/mdp.css') }}?v={{ config('app.version') }}" rel="stylesheet">
    <link href="{{ URL::asset('' . DIR_CSS . '/pepper-ginder-custom.css') }}?v={{ config('app.version') }}"
        rel="stylesheet">
@endsection


@section('title_content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-calendar-alt icon-gradient bg-primary"></i>
                </div>
                <div>Días Festivos
                    <div class="page-title-subheading">
                        Para poder marcar los días festivos se deberá marcar el día en el calendario
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('main_content')
    <div class="row">

        <div id="page">

            <div id="full-year" class="box"></div>

        </div>

    </div>
@endsection

@section('custom_footer')


@endsection
