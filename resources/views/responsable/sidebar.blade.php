@extends('layouts.app')

@section('role', 'Responsable')
@section('dashboard')


    {{-- la bar lateral gauche de navigation ( sidebar ) --}}

    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 "
        id="sidenav-main">
        <div class="sidenav-header"> <i
                class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <div class="navbar-brand flex items-center space-x-3 p-2"> <!-- Logo SVG -->
                <span class="text-primary text-2xl font-bold uppercase">Opti</span> <span
                    class="text-lg font-semibold text-gray-700">Congé</span>
                <!-- Logo Image -->
                <img src="{{ asset('img/logo_ibam.png') }}" alt="logo" class="navbar-brand-img h-auto max-h-14"
                    style="max-height: 55px;">
            </div>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav"> {{-- Dashboard --}}
                <li class="nav-item"> <a
                        class="nav-link {{ Str::contains(request()->path(), 'dashboard') ? 'active' : '' }}"
                        href="{{ route('responsable.dashboard') }}">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-home {{ Str::contains(request()->path(), 'dashboard') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>

                {{-- Demandes concernant le service du responsable en question  --}}
                <li class="nav-item">
                    <a class="nav-link {{ Str::contains(request()->path(), 'responsable-demandes-Employes') ? 'active' : '' }}"
                        href={{route('resposanble.demandes.employes')}}>
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-clock {{ Str::contains(request()->path(), 'responsable-demandes-Employes') ? 'text-white' : 'text-dark' }}"></i>
                        </div> <span class="nav-link-text ms-1">Mon Service</span>
                    </a>
                </li>

                {{-- demmande de mes employes  --}}
                <li class="nav-item">
                    <a class="nav-link {{ Str::contains(request()->path(), 'demandes-personnel') ? 'active' : '' }}"
                        href={{route('resposanble.demandes.personnel')}}>
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-clock {{ Str::contains(request()->path(), 'demandes-personnel') ? 'text-white' : 'text-dark' }}"></i>
                        </div> <span class="nav-link-text ms-1">Mes demandes</span>
                    </a>
                </li>
                {{-- Historique des demandes --}}
                <li class="nav-item"> <a
                        class="nav-link {{ Str::contains(request()->path(), 'responsable-historique-demandes') ? 'active' : '' }}"
                        href={{route('responsable.demandes.historique')}}>
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-history {{ Str::contains(request()->path(), 'responsable-historique-demandes') ? 'text-white' : 'text-dark' }}"></i>
                        </div>
                        <span class="nav-link-text ms-1">Historique de mes demandes</span>
                    </a>
                </li>
                {{-- Liste des employés --}} <li class="nav-item">
                    <a class="nav-link {{ Str::contains(request()->path(), '/responsable/liste-des-employes') ? 'active' : '' }}" href={{route('responsable.employes.liste')}}>
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-users {{ Str::contains(request()->path(), '/responsable/liste-des-employes') ? 'text-white' : 'text-dark' }}"></i>
                        </div> <span class="nav-link-text ms-1">Mes employés</span>
                    </a>
                </li>
                {{-- Mon compte section --}}
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Mon compte</h6>
                </li>
                {{-- Profile <li class="nav-item">
                    <a class="nav-link {{ Str::contains(request()->path(), 'profile') ? 'active' : '' }}" href="">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i
                                class="fas fa-user {{ Str::contains(request()->path(), 'profile') ? 'text-white' : 'text-dark' }}"></i>
                        </div> <span class="nav-link-text ms-1">Mon Profil</span>
                    </a>
                </li> --}}
                {{-- Déconnexion --}}
                <li class="nav-item"> <a class="nav-link" href={{ route('deconnexion') }}
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fas fa-sign-out-alt text-dark"></i>
                        </div>
                        <span class="nav-link-text ms-1">Se déconnecter</span>
                    </a>
                    <form id="logout-form" action="" method="POST" class="d-none"> @csrf
                    </form>
                </li>
            </ul>
        </div>
    </aside>


@endsection

@section('content')
    @yield('content')
@endsection
