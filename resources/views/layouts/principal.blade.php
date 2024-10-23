<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta name="csrf-token" content="{{ Session::token() }}">
    <title>
        Abogatos
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />

    <style>
        .dropdown-menu {
            top: 1.25rem !important;
        }

        label {
            margin-left: 20px;
        }

        .kid-mode {
            font-family: "Comic Sans MS", "Comic Sans", cursive;
        }

        .young-mode {
            font-family: "Open Sans", sans-serif;
        }

        .old-mode {
            font-family: "Lucida Console", "Courier New", monospace;
            font-size: 1.6em !important;
        }
    </style>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    @if (Session::has('contador'))
        <?php
        $contador = Session::get('contador') + 1;
        Session::put('contador', $contador);
        ?>
    @else
        <?php
        $contador = 1;
        Session::put('contador', $contador);
        ?>
    @endif
</head>

<?php

$time = \Carbon\Carbon::now()->format('H');
$sidebar = session()->get('sidebar', 'primary');
$background = session()->get('background', 'primary');
$modo = session()->get('modo', 'light');
$sid = '';

$usuario = \Illuminate\Support\Facades\Auth::user();
?>

<body class="g-sidenav-show  bg-gray-100  <?= session()->get('fuente', '') ?>">

    <div class="min-height-500 position-absolute w-100" id="background" data-color="<?= $background ?>"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main" data-color="<?= $sidebar ?>">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
                target="_blank">
                <img src="{{ asset('assets/img/logo-ct-dark.png') }}" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Abogatos</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Principal</span>
                    </a>
                </li>
                @auth()
                    @if ($usuario->rol == "Administrador")
                    
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Panel de Administrador</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('casos') ? 'active' : '' }}"
                            href="{{ route('casos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Casos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('seguimientos') ? 'active' : '' }}"
                            href="{{ route('seguimientos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Seguimientos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('usuarios') ? 'active' : '' }}"
                            href="{{ route('usuarios.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('eventos') ? 'active' : '' }}"
                            href="{{ route('eventos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Eventos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tareas*') ? 'active' : '' }}"
                            href="{{ route('tareas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Tareas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('formulas') ? 'active' : '' }}"
                            href="{{ route('formulas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Formulas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categorias') ? 'active' : '' }}"
                            href="{{ route('categorias.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Categorias</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('inventarios') ? 'active' : '' }}"
                            href="{{ route('inventarios.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Inventario</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('reportes') ? 'active' : '' }}"
                            href="{{ route('reportes') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Estadisticas</span>
                        </a>
                    </li>
                    
                    {{-- <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pagina de Usuario</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('profile.edit') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Perfil</span>
                        </a>
                    </li> --}}

                    @elseif ($usuario->rol == "Socio")
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Panel de Socio</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('casos') ? 'active' : '' }}"
                            href="{{ route('casos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Casos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('seguimientos') ? 'active' : '' }}"
                            href="{{ route('seguimientos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Seguimientos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('eventos') ? 'active' : '' }}"
                            href="{{ route('eventos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Eventos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tareas*') ? 'active' : '' }}"
                            href="{{ route('tareas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Gestión de Tareas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('inventarios') ? 'active' : '' }}"
                            href="{{ route('inventarios.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Inventario</span>
                        </a>
                    </li>

                    @else
                    <li class="nav-item mt-3">
                        <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Panel de Cliente</h6>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('eventos*') ? 'active' : '' }}"
                            href="{{ route('eventos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Lista de Eventos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('tareas*') ? 'active' : '' }}"
                            href="{{ route('tareas.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Lista de Tareas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('categorias*') ? 'active' : '' }}"
                            href="{{ route('categorias.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-app text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Lista de Categorias</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('casos*') ? 'active' : '' }}"
                            href="{{ route('casos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Lista de Casos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('seguimientos*') ? 'active' : '' }}"
                            href="{{ route('seguimientos.index') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Lista de Seguimientos</span>
                        </a>
                    </li>
                    @endif

                @else
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('login') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Inicia Sesión</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="{{ route('register') }}">
                            <div
                                class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                                <i class="ni ni-collection text-info text-sm opacity-10"></i>
                            </div>
                            <span class="nav-link-text ms-1">Registrarse</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </div>

    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                href="javascript:;">Pagina</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">@yield('titulo')
                        </li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">@yield('titulo')</h6>
                </nav>

                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    

                    <ul class="navbar-nav  justify-content-end">

                        @auth()
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0">
                                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-user cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <li class="mb-2">
                                        <a class="dropdown-item border-radius-md" href="{{ route('profile.edit') }}">
                                            <div class="d-flex py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        <i class="fa fa-bars"></i>
                                                        Perfil
                                                    </h6>

                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="mb-2">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item border-radius-md" href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                        this.closest('form').submit();">
                                                <div class="d-flex py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="text-sm font-weight-normal mb-1">
                                                            <i class="fa fa-id-badge"></i>
                                                            Cerrar Sesión
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </form>

                                    </li>
                                @else
                                    <li class="nav-item d-flex align-items-center px-4">
                                        <a class="nav-link text-white font-weight-bold px-0" href="{{ route('register') }}">
                                            <span class="d-sm-inline d-none">Registrarse</span>
                                        </a>
                                    </li>
                                    <li class="nav-item d-flex align-items-center">
                                        <a class="nav-link text-white font-weight-bold px-0" href="{{ route('login') }}">
                                            <i class="fa fa-user me-sm-1"></i>
                                            <span class="d-sm-inline d-none">Iniciar Sesión</span>
                                        </a>
                                    </li>
                                @endauth

                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">

            @include('partials.alert')
            @yield('content')

            <footer class="footer pt-4  ">
                <div class="card">
                    <div class="col-12 m-2">
                        <div class="container-fluid">
                            <div class="row align-items-center justify-content-lg-between">
                                <div class="col-lg-6 mb-lg-0 mb-4">
                                    <div class="text-center text-sm text-lg-start">
                                        Grupo # 08 SA
                                        <h6>Contador: <span class="badge bg-dark">
                                            {{-- {{ $contador }} --}}
                                            
                                                {{-- {{ 
                                                request()->is('casos') || 
                                                request()->is('seguimientos') ||
                                                request()->is('usuarios') ||
                                                request()->is('eventos') ||
                                                request()->is('tareas') ||
                                                request()->is('formulas') ||
                                                request()->is('categorias') ||
                                                request()->is('inventarios')
                                                ? $cont->cant : '' }} --}}
                                        </span></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </main>

    {{-- <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2" style="right: 90px !important; border-radius: 50% !important; font-size: 1.05rem"> 
            {{ $contador }}
        </a>
    </div>
     --}}
    <div class="fixed-plugin">
        <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
            <i class="fa fa-cog py-2"> </i>
        </a>
        <div class="card shadow-lg">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Configuración</h5>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                        <i class="fa fa-close"></i>
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Colores</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor2(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor2(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor2(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor2(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor2(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor2(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Tipo de Fuentes</h6>
                    <p class="text-sm">Elije entre 3 diferentes tipos de fuentes.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="kid-mode"
                        onclick="sidebarType2(this)">Niño</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 me-2" data-class="young-mode"
                        onclick="sidebarType2(this)">Joven</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="old-mode"
                        onclick="sidebarType2(this)">Adulto</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->


                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Claro / Oscuro</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode2(this)">
                    </div>
                </div>


            </div>
        </div>
    </div>



    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>


    


    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/argon-dashboard.js?v=2.0.4') }}"></script>

    <script>
        window.addEventListener('load', function() {
            var modo = <?= json_encode($modo, JSON_HEX_TAG) ?>;
            var time = <?= json_encode($time, JSON_HEX_TAG) ?>;
            if (modo == "dark" || time >= 18) {
                document.getElementById("dark-version").click();
            }
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>


    <script type="text/javascript">
        function updateFuente(fuente) {
            $.post("{{ url('/updatefuente') }}", {
                '_token': $('meta[name=csrf-token]').attr('content'),
                fuente: fuente
            }).done(function(data) {
                console.log(data)
            });
        }

        function sidebarType2(a) {
            var parent = a.parentElement.children;
            var fuente = a.getAttribute("data-class");

            for (var i = 0; i < parent.length; i++) {
                parent[i].classList.remove('active');
            }

            if (!a.classList.contains('active')) {
                a.classList.add('active');
            } else {
                a.classList.remove('active');
            }

            if (fuente == "kid-mode") {
                document.body.classList.remove("young-mode");
                document.body.classList.remove("old-mode");
            } else if (fuente == "young-mode") {
                document.body.classList.remove("kid-mode");
                document.body.classList.remove("old-mode");
            } else {
                document.body.classList.remove("kid-mode");
                document.body.classList.remove("young-mode");
            }
            document.body.classList.add(fuente);
            updateFuente(fuente);
        }

        function updateDark(modo) {
            $.post("{{ url('/updatemodo') }}", {
                '_token': $('meta[name=csrf-token]').attr('content'),
                modo: modo
            }).done(function(data) {
                console.log(data)
            });
        }

        function darkMode2(el) {
            darkMode(el);
            if (!el.getAttribute("checked")) {
                updateDark("light");
            } else {
                updateDark("dark");
            }

        }

        function updateEstilo(estilo) {
            $.post("{{ url('/updateestilo') }}", {
                '_token': $('meta[name=csrf-token]').attr('content'),
                estilo: estilo
            }).done(function(data) {
                console.log(data)
            });
        }

        function sidebarColor2(a) {
            var parent = a.parentElement.children;
            var color = a.getAttribute("data-color");

            for (var i = 0; i < parent.length; i++) {
                parent[i].classList.remove('active');
            }

            if (!a.classList.contains('active')) {
                a.classList.add('active');
            } else {
                a.classList.remove('active');
            }

            var sidebar = document.querySelector('.sidenav');
            sidebar.setAttribute("data-color", color);

            var back = document.querySelector('#background');
            back.setAttribute("data-color", color);

            if (document.querySelector('#sidenavCard')) {
                var sidenavCard = document.querySelector('#sidenavCard+.btn+.btn');
                let sidenavCardClasses = ['btn', 'btn-sm', 'w-100', 'mb-0', 'bg-gradient-' + color];
                sidenavCard.removeAttribute('class');
                sidenavCard.classList.add(...sidenavCardClasses);
            }

            updateEstilo(color);
        }
    </script>

    @yield('js')
</body>

</html>
