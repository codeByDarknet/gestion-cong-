@extends('grh.sidebar')

@section('title', 'Tableau de bord GRH')

@section('content')




    <div class="container-fluid py-4">
        <div class="row">

            <div class="col-lg-6 col-12">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-primary opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i class="fa-solid fa-users text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $employes->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Employés</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">+5%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i
                                                class="fa-solid fa-clipboard-list text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $demandes->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Demandes</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">+10%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i class="fa-solid fa-building text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $services->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Services</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">+8%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-dark opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i class="fa-solid fa-file-alt text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $types->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Types de demandes</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">+12%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- statistiques --}}

            <div class="col-lg-6 col-12 mt-4 mt-lg-0">
                <div class="card shadow h-100">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Stats des demandes</h6>
                    </div>
                    <div class="card-body pb-0 p-3">
                        @php
                            $totalDemandes = count($demandes);
                            $statuts = [
                                'Demandée' => 'Demande en attente',
                                'Acceptée' => 'Demande acceptée',
                                'Rejetée' => 'Demande refusée',
                                'Plannifiée' => 'Demande planifiée',
                            ];
                        @endphp

                        <ul class="list-group">
                            @foreach ($statuts as $statut => $label)
                                @php
                                    $count = count($demandes->where('statut', $statut));
                                    $pourcentage = $totalDemandes == 0 ? 0 : ($count * 100) / $totalDemandes;
                                @endphp
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                                    <div class="w-100">
                                        <div class="d-flex mb-2">
                                            <span class="me-2 text-sm font-weight-bold text-dark">{{ $label }}</span>
                                            <span class="ms-auto text-sm font-weight-bold">
                                                {{ number_format($pourcentage, 1) }} %
                                            </span>
                                        </div>
                                        <div>
                                            <div class="progress progress-md">
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: {{ $pourcentage }}%;" aria-valuenow="{{ $count }}"
                                                    aria-valuemin="0" aria-valuemax="100">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                    <div class="card-footer pt-0 p-3 d-flex align-items-center">
                        <div class="w-60">
                            <p class="text-sm">
                                Plus de
                                <b>{{ count($demandes->where('statut', 'Acceptée')) + count($demandes->where('statut', 'Rejetée')) }}</b>
                                demandes ont été traitées avec succès, et
                                <b>{{ count($demandes->where('statut', 'Acceptée')) }}</b> ont été acceptées.
                            </p>

                        </div>
                        <div class="w-40 text-center">
                            <a class="btn btn-dark mb-0 text-center" href="{{ route('demandes.toutes') }}">Voir toutes les
                                demandes <i class="fas fa-arrow-right text-sm ms-1"></i></a>
                        </div>
                    </div>

                </div>
            </div>


        </div>


        <div class="row my-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Demandes en cours</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-clock text-warning" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $demandes->where('statut', 'en cours')->count() }} en attente</span>
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="#">Voir toutes les demandes</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employé</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Type</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($demandes->where('statut', 'en cours') as $demande)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $demande->employe->nom }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">{{ $demande->type->nom }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold">{{ $demande->date }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-warning">En cours</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-md-0 mb-4"> <!-- Réduit la largeur pour mieux cadrer -->
                <div class="card z-index-2 shadow-sm" >
                    <div class="card-header pb-2 pt-2">
                        <h6 class="m-0">Statistiques des demandes</h6>
                        <p class="text-sm m-0">
                            <i class="fa fa-chart-bar text-primary"></i>
                            <span class="font-weight-bold">Répartition des demandes</span> selon leur statut
                        </p>
                    </div>
                    <div class="card-body p-2">
                        <div class="chart">
                            <canvas id="demandes-chart" class="chart-canvas" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>





        <div class="row mt-4 p-3">

        </div>


        @php
            $totalDemandes = count($demandes);
            $demandesData = [
                'Demandée' => count($demandes->where('statut', 'Demandée')),
                'Acceptée' => count($demandes->where('statut', 'Acceptée')),
                'Rejetée' => count($demandes->where('statut', 'Rejetée')),
                'Planifiée' => count($demandes->where('statut', 'Plannifiée')),
            ];
        @endphp

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById('demandes-chart').getContext('2d');

                var demandesChart = new Chart(ctx, {
                    type: 'bar', // Type de graphique (bar, pie, doughnut, line)
                    data: {
                        labels: @json(array_keys($demandesData)), // Les noms des statuts
                        datasets: [{
                            label: 'Nombre de demandes',
                            data: @json(array_values($demandesData)), // Le nombre de demandes par statut
                            backgroundColor: ['#f39c12', '#28a745', '#dc3545', '#007bff'], // Couleurs par statut
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: { beginAtZero: true }
                        }
                    }
                });
            });
        </script>


    </div>


@endsection
