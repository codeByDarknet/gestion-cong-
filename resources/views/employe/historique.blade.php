@extends('employe.sidebar')

@section('title', 'Historique')

@section('content')

<div class="container-fluid py-4">
    <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
            @if($demandes->count() > 0)
                <table id="typesTable" class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de soummission</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date de reponse</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Motif</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date Début</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date Fin</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandes->reverse() as $demande)
                        <tr class="hover-effect py-0">

                            <!-- Date de soumission -->
                            <td class="py-1">
                                <span class=" text-xs">
                                    <i class="fas fa-calendar-day me-1"></i> {{ \Carbon\Carbon::parse($demande->created_at)->translatedFormat('d F Y') }}
                                </span>
                            </td>

                            <!-- Date de reponse -->
                            <td class="py-1">
                                <span class="text-xs  px-3">
                                    <i class="fas fa-calendar-day me-1"></i> {{ \Carbon\Carbon::parse($demande->date_reponse)->translatedFormat('d F Y') }}
                                </span>
                            </td>
                            <!-- Type de demande -->
                            <td class="py-1">
                                <span class="badge text-muted px-3">
                                    <i class="fas fa-file-signature me-1"></i> {{ $demande->typeDemande->libelle }}
                                </span>
                            </td>

                            <!-- Motif tronqué avec tooltip -->
                            <td class="py-1">
                                <p class="text-xs mb-0" data-bs-toggle="tooltip" title="{{ $demande->motif }}">
                                    {{ strlen($demande->motif) > 30 ? substr($demande->motif, 0, 30) . '...' : $demande->motif }}
                                </p>
                            </td>

                            <!-- Date de début -->
                            <td class="py-1">
                                <span class="badge bg-gradient-info opacity-80 text-white px-3">
                                    <i class="fas fa-calendar-day me-1"></i> {{ date('d/m/Y', strtotime($demande->date_debut)) }}
                                </span>
                            </td>

                            <!-- Date de fin -->
                            <td class="py-1">
                                <span class="badge bg-gradient-warning bg-opacity-5 text-white px-3">
                                    <i class="fas fa-calendar-day me-1"></i> {{ date('d/m/Y', strtotime($demande->date_fin)) }}
                                </span>
                            </td>

                            <!-- Statut -->
                            <td class="py-1">
                                <span class="badge
                                    {{ $demande->statut == 'Acceptée' ? 'bg-success' : 'bg-danger' }}
                                    text-white px-3">
                                    <i class="fas fa-check-circle me-1"></i> {{ $demande->statut }}

                                </span>
                            </td>

                            <!-- Action Modifier -->
                            <td class="text-center">

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-secondary mb-3"></i>
                    <h5 class="text-secondary">Votre historique est vide pour le moment</h5>
                    <p class="text-xs text-muted">Vous n'aviez aucune demande traitée</p>
                    <a class="btn btn-primary" href="{{ route('employe.accueil') }}"><i class="fas fa-plus"></i> Planifier une demande</a>
                </div>
            @endif
        </div>
    </div>
</div>








    @endsection
