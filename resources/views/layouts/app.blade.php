<!doctype html>
<html lang="es">

<head>
    <title>@yield('app_name', config('app.name'))</title>
    <meta name="description" content="Area Privada la Sirena">
    @include('includes.head_common')
    @yield('custom_head')
</head>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-header fixed-sidebar fixed-footer closed-sidebar">

        @include('includes.header')
        <div class="app-main">
            @include('includes.menu')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    <!-- PAGE TITLE -->

                    @yield('title_content')

                    <!-- CONTENT BODY -->

                    @yield('main_content')

                    <!-- END CONTENT BODY -->

                    @include('includes.footer')
                    @yield('custom_footer')
                </div>
            </div>
        </div>
    </div>

</body>

</html>
