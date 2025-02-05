@extends('grh.dashboard')

@section('title', 'Liste des demandes')


@section('content')


    <div class="container-fluid py-4">

        <h2>Liste des demandes</h2>

        <div class="row">
            <div class="col-12">
              <div class="card mb-4">
                <div class="card-header pb-0">
                  <h6>Toutes les demandes</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center justify-content-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de Soumission</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employé</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Durée</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                <th class="text-secondary opacity-7">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($demandes as $demande)
                            <tr>
                                <td class="align-middle text-center">
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <div class="d-flex align-items-center mb-1">
                                                <i class="fa fa-calendar text-info me-2"></i>
                                                <span class="text-sm font-weight-bold">{{ $demande->created_at->format('d/m/Y') }}</span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-clock text-secondary me-2"></i>
                                                <span class="text-xs text-muted">{{ $demande->created_at->format('H:i') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div class="avatar avatar-sm me-2  d-flex align-items-center justify-content-center rounded-circle" style="background-image: linear-gradient(310deg, #f97316, #f97316);;">
                                            <span class="text-white text-uppercase">{{ substr($demande->user->nom, 0, 2) }}</span>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">{{ $demande->user->nom }}</h6>
                                            <span class="text-xs text-secondary">{{ $demande->user->email }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-gradient-info text-xxs">{{ $demande->typeDemande->libelle }}</span>
                                </td>

                                <td class="align-middle">
                                    <div class="d-flex">
                                        <i class="fa fa-clock text-secondary me-2"></i>
                                        <span class="text-sm">{{ $demande->created_at->diffForHumans($demande->date_fin) }}</span>
                                    </div>
                                </td>

                                <td class="align-middle text-center">
                                    @php
                                        $statusClasses = [
                                            'Démandée' => 'bg-gradient-warning',
                                            'Acceptée' => 'bg-gradient-success',
                                            'Rejetée' => 'bg-gradient-danger',
                                            'Planifiée' => 'bg-gradient-info'
                                        ];
                                        $statusClass = $statusClasses[$demande->statut] ?? 'bg-gradient-secondary';
                                    @endphp
                                    <span class="badge {{ $statusClass }} text-xxs">{{ $demande->statut }}</span>
                                </td>

                                <td class="align-middle">
                                    <div class="dropdown">
                                        <button class="btn btn-link text-secondary mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="{{}}">
                                                    <i class="fas fa-eye text-info me-2"></i> Voir
                                                </a>
                                            </li>
                                            @if($demande->statut === 'Démandée')
                                            <li>
                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-check text-success me-2"></i> Accepter
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action="" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fas fa-times text-danger me-2"></i> Rejeter
                                                    </button>
                                                </form>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
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
    </div>



 @endsection
