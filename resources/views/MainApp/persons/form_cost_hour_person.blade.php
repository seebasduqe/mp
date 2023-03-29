<div class="mb-4">
    <h3><strong>Información entidades</strong></h3>
</div>
<div class="position-relative form-group">
    <div class="row">
        <div class="col-lg-4 col-md-5 ">
            <label for="subcompany_name" class="">Enditad asociada:</label>
            {{ Form::text('subcompany_name', null, [
                'class' => 'form-control',
                'disabled' => 'true',
                'autocomplete' => 'off',
                'autofocus' => 'true',
            ]) }}
        </div>
        <div class="col-lg-3 col-md-4 ">
            <label for="start_date" class="">Fecha de alta</label>
            {{ Form::date('start_date', null, [
                'class' => 'form-control',
                'disabled' => 'true',
                'autocomplete' => 'off',
            ]) }}
        </div>

    </div>
</div>
<div class="mb-4">
    <h3><strong>Costes/hora </strong></h3>
</div>
<input type="hidden" name="person_id" value="{{ $obj_person->person_id }}">
<div class="position-relative form-group">
    <div class="row">

        @foreach ($array_type_cost as $type_cost)
            <div class="col-lg-2 col-md-2 ">
                <label for="type_cost_{{ $type_cost->hour_type_id }}" class="">Hora
                    {{ $type_cost->name }}:</label>
                <div class="input-group">
                    {{ Form::text('type_' . $type_cost->hour_type_id . '_cost', null, [
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                        'data-name' => 'type_cost',
                    ]) }}
                    <div class="input-group-append">
                        <span class="input-group-text" id="">€</span>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

<div class="mt-5 mb-3">
    <button id="btnSubmit" type="submit" class="mt-1 btn btn-dark">
        <i class="fa fa-save mr-2"></i>
        @switch($type)
            @case('create')
                Siguiente
            @break

            @default
                Guardar
            @break
        @endswitch
    </button>
</div>
</div>
@section('custom_footer')
    <script type="text/javascript">
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
    </script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/libs/jquery.inputmask.min.js') }}?v={{ config('app.version') }}"></script>
    <script type="text/javascript"
        src="{{ URL::asset('' . DIR_JS . '/main_app/persons/person_cost_view.js') }}?v={{ config('app.version') }}">
    </script>
@endsection
