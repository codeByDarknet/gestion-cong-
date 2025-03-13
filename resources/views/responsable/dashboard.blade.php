@extends('responsable.sidebar')

@section('title', 'Tableau de bord Responsable')

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
                                        <span class="text-white text-sm">Employés du service</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="text-white text-sm font-weight-bolder">{{ $service->nom }}</span>
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
                                            <i class="fa-solid fa-clipboard-list text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $demandes->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Demandes à traiter</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        <span class="text-white text-sm font-weight-bolder">
                                            {{ $demandes->where('statut', 'Demandée')->count() }} en attente
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-success opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i class="fa-solid fa-check-circle text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $demandes->where('statut', 'Acceptée')->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Demandes acceptées</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        @php
                                            $pourcentageAccepte = $demandes->count() > 0 ?
                                                round(($demandes->where('statut', 'Acceptée')->count() / $demandes->count()) * 100, 1) : 0;
                                        @endphp
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">{{ $pourcentageAccepte }}%</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="card">
                            <span class="mask bg-danger opacity-10 border-radius-lg"></span>
                            <div class="card-body p-3 position-relative">
                                <div class="row">
                                    <div class="col-8 text-start">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-2xl">
                                            <i class="fa-solid fa-times-circle text-dark text-gradient text-lg opacity-10"></i>
                                        </div>
                                        <h5 class="text-white font-weight-bolder mb-0 mt-3">
                                            {{ $demandes->where('statut', 'Rejetée')->count() }}
                                        </h5>
                                        <span class="text-white text-sm">Demandes rejetées</span>
                                    </div>
                                    <div class="col-4 text-end">
                                        @php
                                            $pourcentageRejete = $demandes->count() > 0 ?
                                                round(($demandes->where('statut', 'Rejetée')->count() / $demandes->count()) * 100, 1) : 0;
                                        @endphp
                                        <p class="text-white text-sm font-weight-bolder mt-auto mb-0">{{ $pourcentageRejete }}%</p>
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
                        <h6 class="mb-0">Statistiques des demandes par type</h6>
                    </div>
                    <div class="card-body pb-0 p-3">
                        @php
                            $totalDemandes = count($demandes);
                            $demandesParType = [];
                            foreach ($types as $type) {
                                $count = $demandes->where('type_demande_id', $type->id)->count();
                                $demandesParType[$type->nom] = [
                                    'count' => $count,
                                    'percentage' => $totalDemandes > 0 ? ($count * 100) / $totalDemandes : 0
                                ];
                            }
                            // Trier par nombre de demandes décroissant
                            arsort($demandesParType);
                        @endphp

                        <ul class="list-group">
                            @foreach ($demandesParType as $nom => $data)
                                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-0">
                                    <div class="w-100">
                                        <div class="d-flex mb-2">
                                            <span class="me-2 text-sm font-weight-bold text-dark">{{ $nom }}</span>
                                            <span class="ms-auto text-sm font-weight-bold">
                                                {{ number_format($data['percentage'], 1) }} %
                                            </span>
                                        </div>
                                        <div>
                                            <div class="progress progress-md">
                                                <div class="progress-bar
                                                    @if($data['percentage'] > 50) bg-primary
                                                    @elseif($data['percentage'] > 25) bg-info
                                                    @else bg-success @endif"
                                                    role="progressbar"
                                                    style="width: {{ $data['percentage'] }}%;"
                                                    aria-valuenow="{{ $data['count'] }}"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100">
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
                                <b>{{ $demandes->whereIn('statut', ['Acceptée', 'Rejetée'])->count() }}</b> demandes ont été traitées,
                                dont <b>{{ $demandes->where('statut', 'Acceptée')->count() }}</b> acceptées.
                            </p>
                        </div>
                        <div class="w-40 text-center">
                            <a class="btn btn-dark mb-0 text-center" href="{{ route('resposanble.demandes.employes') }}">Voir toutes les
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
                                <h6>Demandes en attente</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-clock text-warning" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $demandes->where('statut', 'Demandée')->count() }} demandes</span> nécessitent votre attention
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md" href="{{ route('resposanble.demandes.employes') }}">Voir toutes les demandes</a></li>
                                       
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

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($demandes->where('statut', 'Demandée')->take(5) as $demande)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $demande->user->nom }} {{ $demande->user->prenom }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $demande->user->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-xs font-weight-bold">{{ $demande->typeDemande->nom }}</span>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold">{{ $demande->created_at->format('d/m/Y') }}</span>
                                        </td>

                                        </td>
                                    </tr>
                                    @endforeach

                                    @if($demandes->where('statut', 'Demandée')->count() == 0)
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <p class="text-sm mb-0">Aucune demande en attente</p>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
                <div class="card z-index-2 shadow-sm">
                    <div class="card-header pb-2 pt-2">
                        <h6 class="m-0">Répartition des demandes</h6>
                        <p class="text-sm m-0">
                            <i class="fa fa-chart-pie text-primary"></i>
                            <span class="font-weight-bold">Statut des demandes</span> dans votre service
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

        <div class="row mt-4">
            <div class="col-lg-6 col-md-6 mb-md-0 mb-4">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Dernières demandes traitées</h6>
                        <p class="text-sm">
                            <i class="fa fa-check text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $demandes->whereIn('statut', ['Acceptée', 'Rejetée'])->count() }}</span> demandes traitées
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            @foreach($demandes->whereIn('statut', ['Acceptée', 'Rejetée'])->sortByDesc('updated_at')->take(5) as $demande)
                                <div class="timeline-block mb-3">
                                    <span class="timeline-step">
                                        @if($demande->statut == 'Acceptée')
                                            <i class="fas fa-check text-success"></i>
                                        @else
                                            <i class="fas fa-times text-danger"></i>
                                        @endif
                                    </span>
                                    <div class="timeline-content">
                                        <h6 class="text-dark text-sm font-weight-bold mb-0">{{ $demande->user->nom }} {{ $demande->user->prenom }}</h6>
                                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $demande->typeDemande->nom }}</p>
                                        <p class="text-secondary text-sm mt-1 mb-0">
                                            <span class="badge bg-{{ $demande->statut == 'Acceptée' ? 'success' : 'danger' }}">
                                                {{ $demande->statut }}
                                            </span>
                                            le {{ $demande->updated_at->format('d/m/Y à H:i') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            @if($demandes->whereIn('statut', ['Acceptée', 'Rejetée'])->count() == 0)
                                <div class="text-center py-4">
                                    <p class="text-sm mb-0">Aucune demande traitée récemment</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Activité des employés</h6>
                        <p class="text-sm">
                            <i class="fa fa-users text-info" aria-hidden="true"></i>
                            <span class="font-weight-bold ms-1">{{ $employes->count() }}</span> employés dans votre service
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employé</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Demandes</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Acceptées</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rejetées</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employes->take(5) as $employe)
                                    @php
                                        $demandesEmploye = $demandes->where('user_id', $employe->id);
                                        $demandesAcceptees = $demandesEmploye->where('statut', 'Acceptée')->count();
                                        $demandesRejetees = $demandesEmploye->where('statut', 'Rejetée')->count();
                                        $totalDemandes = $demandesEmploye->count();
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $employe->nom }} {{ $employe->prenom }}</h6>
                                                    <p class="text-xs text-secondary mb-0">{{ $employe->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold">{{ $totalDemandes }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold text-success">{{ $demandesAcceptees }}</span>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-xs font-weight-bold text-danger">{{ $demandesRejetees }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $statutsData = [
                'Demandée' => $demandes->where('statut', 'Demandée')->count(),
                'Acceptée' => $demandes->where('statut', 'Acceptée')->count(),
                'Rejetée' => $demandes->where('statut', 'Rejetée')->count(),
            ];
        @endphp

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var ctx = document.getElementById('demandes-chart').getContext('2d');

                var demandesChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: @json(array_keys($statutsData)),
                        datasets: [{
                            data: @json(array_values($statutsData)),
                            backgroundColor: ['#f39c12', '#28a745', '#dc3545'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            }
                        }
                    }
                });
            });
        </script>
    </div>
@endsection
