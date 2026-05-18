<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Veterinaria — Sistema de gestión">
    <meta name="author" content="">

    <title>@yield('titulo_pagina', 'Veterinaria')</title>

    {{-- FontAwesome --}}
    <link href="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    {{-- SB Admin 2 CSS --}}
    <link href="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}" rel="stylesheet">

    @stack('styles')
</head>

<body id="page-top">

    {{-- ==================== PAGE WRAPPER ==================== --}}
    <div id="wrapper">

        {{-- ==================== SIDEBAR ==================== --}}
        @sectionMissing('hide_sidebar')
            @if(Auth::check() && Auth::user()->rol !== 'veterinario')
                @include('layouts.partials.sidebar')
            @endif
        @endif
        {{-- ==================== END SIDEBAR ==================== --}}

        {{-- ==================== CONTENT WRAPPER ==================== --}}
        <div id="content-wrapper" class="d-flex flex-column">

            {{-- ==================== MAIN CONTENT ==================== --}}
            <div id="content">

                {{-- ==================== TOPBAR / NAVBAR ==================== --}}
                @include('layouts.partials.topbar')
                {{-- ==================== END TOPBAR ==================== --}}

                {{-- ==================== PAGE CONTENT ==================== --}}
                <div class="container-fluid">

                    {{-- Page Heading --}}
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">@yield('page_title', 'Dashboard')</h1>
                        @yield('page_actions')
                    </div>

                    {{-- Page Content --}}
                    @yield('contenido')

                </div>
                {{-- /.container-fluid --}}

            </div>
            {{-- ==================== END MAIN CONTENT ==================== --}}

            {{-- ==================== FOOTER ==================== --}}
            @include('layouts.partials.footer')
            {{-- ==================== END FOOTER ==================== --}}

        </div>
        {{-- ==================== END CONTENT WRAPPER ==================== --}}

    </div>
    {{-- ==================== END PAGE WRAPPER ==================== --}}

    {{-- Scroll to Top Button --}}
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    {{-- ==================== LOGOUT MODAL ==================== --}}
    @include('layouts.partials.logout-modal')
    {{-- ==================== END LOGOUT MODAL ==================== --}}

    {{-- jQuery --}}
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js') }}"></script>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- jQuery Easing --}}
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    {{-- SB Admin 2 JS --}}
    <script src="{{ asset('plantilla/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js') }}"></script>

    @stack('scripts')

</body>

</html>
