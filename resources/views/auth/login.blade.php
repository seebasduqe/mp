<!doctype html>


<head>
    <title>{{ config('app.name') }}</title>
    <meta name="description" content="">
    @include('includes.head_common')
</head>

<body>

    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header closed-sidebar h-100">
        <div class="app-header bg-white text-dark">
            <img src="{{ URL::asset('' . DIR_IMG . '/logo_mp.png') }}" class="logo">
        </div>
        <main>
            <div class="app-main">
                <div class="row w-100 ml-0 pt-5">
                    <div class="col-sm-12 col-lg-4">
                    </div>
                    <div class="col-sm-12 col-lg-4 pt-3">
                        @if ($errors->any())
                            @if ($errors->has('login_error'))
                                <div id="error-login-alert" class="alert alert-danger" role="alert">
                                    Datos de acceso incorrectos
                                </div>
                            @endif
                        @endif
                        <div class="pt-4 card bg-white mt-3">

                            <form class="main_content pb-3 w-100" id="loginForm" method="POST" autocomplete="off"
                                action="{{ route('login') }}">

                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                                <div class="card-header-title font-size-lg font-weight-normal float-left d-block w-100">
                                    <p class="card-title w-100 text-center font-size-lg text-primary">Acceso al
                                        backoffice de Mp</p>
                                    <p class="description w-100 text-center">Por favor facilite las credenciales para
                                        poder acceder.</p>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <label class="card-title">Nombre de usuario</label>
                                        <input class="form-control" type="text" name="username"
                                            data-validacion="obligatorio " autocomplete="off">
                                    </div>
                                    <div class="mt-4 mb-2">
                                        <label class="card-title">Contraseña</label>
                                        <input class="form-control" type="password" name="password"
                                            data-validacion="obligatorio" autocomplete="off">
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12 offset-md-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                <label class="form-check-label" for="remember">
                                                    Mantenerme conectado
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 text-left">
                                            {{-- @if (Route::has('password.request'))
                                                <a class="ml-2 mt-4 btn btn-link"
                                                    href="{{ route('password.request') }}">
                                                    Has olvidado la contraseña?
                                                </a>
                                            @endif --}}
                                        </div>
                                        <div class="col-6 text-right">

                                            <a class="ml-1 mt-4 btn btn-primary" title="Acceder" id="send_form"
                                                href="javascript:void(0);">ACCEDER</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-4">
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include('includes.footer')
    <script type="text/javascript" src="{{ URL::asset('' . DIR_JS . '/main_app/login.js') }}?v={{ config('app.version') }}">
    </script>

</body>

</html>
