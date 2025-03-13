@extends('employe.sidebar')

@section('title', 'Tableau de bord Employé')

@section('content')
    <div class="container-fluid py-4">


        {{-- quant il ya pas de demandes  --}}
        @if ($mes_demandes->count() == 0)
            <div class="row min-vh-60 d-flex justify-content-center align-items-center">
                <div class="col-md-6 col-lg-4">
                    <div class="d-flex flex-column align-items-center p-5 rounded bg-light border border-2 border-primary"
                        style="border-style: dashed !important;">

                        <!-- Icône avec animation hover -->
                        <div class="mb-4 icon-wrapper">
                            <style>
                                .icon-wrapper {
                                    transition: transform 0.3s ease;
                                }

                                .icon-wrapper:hover {
                                    transform: scale(1.1);
                                }

                                .icon-orange {
                                    fill: #f97316;
                                    stroke: #f97316;
                                }
                            </style>

                            <svg class="icon-orange" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="80"
                                height="80">
                                <g>
                                    <path
                                        d="M77.4,78.1H40.5c-1.2,0-2.3-1-2.3-2.2v-4.6c0-1.2,1-2.3,2.2-2.3h36.9c1.2,0,2.3,1,2.3,2.2v4.6C79.8,77,78.8,78.1,77.4,78.1z">
                                    </path>
                                    <path
                                        d="M26.6,78.1H22c-1.2,0-2.3-1-2.3-2.2v-4.6c0-1.2,1-2.3,2.2-2.3h4.6c1.2,0,2.3,1,2.3,2.2v4.6C29,77,28,78,26.8,78.1z">
                                    </path>
                                    <path
                                        d="M53.8,57.6c-1.2,0-2.3-1-2.3-2.2v-4.6c0-1.2,1-2.3,2.2-2.3h23.6c1.2,0,2.3,1,2.3,2.2v4.6c0,1.2-1,2.3-2.2,2.3H53.8z">
                                    </path>
                                    <path
                                        d="M62.6,37.1c-1.2,0-2.3-1-2.3-2.2v-4.6c0-1.2,1-2.3,2.2-2.3h14.8c1.2,0,2.3,1,2.3,2.2v4.6c0,1.2-1,2.3-2.2,2.3H62.6z">
                                    </path>
                                    <path
                                        d="M20.8,58.2C19.6,47.5,28,36.4,38,34.5l2.7-0.6c0.5-0.1,0.9-0.6,0.8-1.2l-6.7-4.5c-0.7-0.5-0.8-1.4-0.3-2l1.7-2.5c0.4-0.7,1.4-0.9,2-0.4L54,33.5c0.7,0.4,0.9,1.4,0.4,2l-11,16.2c-0.4,0.7-1.4,0.9-2,0.4l-2.5-1.7c-0.7-0.4-0.9-1.4-0.4-2l4.4-6.7c0.3-0.4,0.3-1.1-0.2-1.4l-1.6,0.3c-7.8,1.5-14.4,10.3-13.7,17.9c0,0.7-1.1,1.7-1.9,1.9h-1.9C21.8,60.3,20.8,59.1,20.8,58.2z">
                                    </path>
                                </g>
                            </svg>
                        </div>

                        <!-- Texte -->
                        <p class="text-secondary mb-4 fs-5">
                            Aucune demande en cours
                        </p>

                        <!-- Bouton pour planifier une demande -->
                        <style>
                            .btn-no-scale {
                                transform: none !important;
                                transition: background-color 0.3s ease !important;
                            }

                            .btn-no-scale:hover,
                            .btn-no-scale:focus,
                            .btn-no-scale:active {
                                transform: none !important;
                                box-shadow: none !important;
                            }
                        </style>

                        <!-- Modifiez le bouton comme ceci -->
                        <!-- Bouton d'ouverture du modal -->
                        <button type="button"
                            class="btn btn-outline-primary d-flex align-items-center gap-2 px-4 py-2 btn-no-scale"
                            data-bs-toggle="modal" data-bs-target="#plannifierDemandeModal">
                            <i class="fas fa-calendar"></i> Planifier une demande
                        </button>

                        <!-- Modal -->
                    </div>
                </div>
            </div>
        @else
            {{-- quant il ya des demandes plannifiées --}}

            <h4 class="mt-4">📅 Mes planifications ({{ $mes_demandes->where('statut', 'Plannifiée')->count() }})</h4>


            <div class="row">

                @foreach ($mes_demandes->where('statut', 'Plannifiée')->reverse() as $demande)
                    <div class="col-md-4">
                        <div class="card shadow-lg border-0">
                            <div class="d-flex justify-content-between align-middle rounded-sm card-header bg-white p-3 pb-2"
                                style="border-bottom: 2px dashed #ccc;">
                                <h6 class="mb-0 text-sm">
                                    <span class="text-muted text-small ">Planifiée le </span>
                                    {{ \Carbon\Carbon::parse($demande->created_at)->translatedFormat('d F Y') }}
                                    <div class="mb-0 text-gradient text-primary text-lg text-muted bg-white fw-bold "
                                        style="text-transform: capitalize !important;">
                                        {{ $demande->typeDemande->libelle }}
                                    </div>

                                </h6>

                                {{-- les button --}}


                                <div class="d-flex justify-content-end gap-2">

                                    {{-- button de voir plus --}}

                                    <div>
                                        <button data-bs-toggle="modal" data-bs-target="#voirDemande{{ $demande->id }}"
                                            title="Voir les détails">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>
                                    </div>

                                    {{-- Modal de voir plus --}}
                                    <div class="modal fade" id="voirDemande{{ $demande->id }}" tabindex="-1"
                                        aria-labelledby="voirDemande{{ $demande->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-sm rounded">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fa-solid fa-circle-info me-2"></i>
                                                        Détails : <strong>{{ $demande->typeDemande->libelle }}</strong>
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">


                                                    <!-- Période -->
                                                    <p class="fw-semibold text-muted mb-1"><i
                                                            class="fa-solid fa-calendar-day me-2 text-primary"></i> Période
                                                        :</p>
                                                    <p class="mb-3">
                                                        <strong>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</strong>
                                                        →
                                                        <strong>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</strong>
                                                    </p>

                                                    <!-- Motif -->
                                                    <p class="fw-semibold text-muted mb-1"><i
                                                            class="fa-solid fa-pencil-alt me-2 text-primary"></i> Motif :
                                                    </p>
                                                    <div class="p-3 bg-light rounded mb-3">{{ $demande->motif }}</div>

                                                    <!-- Pièce jointe (si présente) -->
                                                    @if ($demande->piece_jointe)
                                                        <p class="fw-semibold text-muted mb-1"><i
                                                                class="fa-solid fa-file me-2 text-primary"></i> Pièce jointe
                                                            :</p>
                                                        <div class="d-flex align-items-center p-2 bg-light rounded">
                                                            <i class="fa-solid fa-file  fs-4 me-3"></i>
                                                            <span
                                                                class="text-truncate">{{ basename($demande->piece_jointe) }}</span>
                                                            <a href="{{ asset('storage/' . $demande->piece_jointe) }}"
                                                                target="_blank" class="btn btn-primary btn-sm ms-auto">
                                                                <i class="fa-solid fa-download"></i>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <!-- Date de création -->
                                                    <p class="mt-4 text-muted">
                                                        <i class="fa-solid fa-clock me-2 text-primary"></i>
                                                        Créée le
                                                        <strong>{{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y à H:i') }}</strong>
                                                    </p>
                                                </div>

                                                <div class="modal-footer bg-light">

                                                    <div>
                                                        <button type="button" class="btn btn-secondary me-2"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa-solid fa-times me-2"></i>Fermer
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    {{-- Bouton de modification --}}
                                    <div>
                                        <button class="" data-bs-toggle="modal"
                                            data-bs-target="#modifDemande{{ $demande->id }}" title="Modifier">
                                            <i class="fas fa-pencil text-info"></i>
                                        </button>
                                    </div>

                                    {{-- Modal de modification --}}
                                    <div class="modal fade" id="modifDemande{{ $demande->id }}" tabindex="-1"
                                        aria-labelledby="modifDemande{{ $demande->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modifDemande{{ $demande->id }}ModalLabel">
                                                        <i class="fa-solid fa-pen-to-square"></i> Modifier la demande :
                                                        <strong>{{ $demande->typeDemande->libelle }}</strong>
                                                    </h5>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                                        aria-label="Close"> <i class="fa fa-close"></i></button>
                                                </div>

                                                {{-- Formulaire de modification --}}
                                                <div class="modal-body">
                                                    <form action="{{ route('demande.modifier', $demande->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')

                                                        {{-- Sélection du type de demande --}}
                                                        <div class="mb-3">
                                                            <label for="type_demande_id" class="form-label"><i
                                                                    class="fa-solid fa-list"></i> Type de demande</label>
                                                            <select
                                                                class="form-select @error('type_demande_id') is-invalid @enderror"
                                                                id="type_demande_id" name="type_demande_id" required>
                                                                @foreach ($types as $type)
                                                                    <option value="{{ $type->id }}"
                                                                        {{ $demande->type_demande_id == $type->id ? 'selected' : '' }}>
                                                                        {{ $type->libelle }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            @error('type_demande_id')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Dates de début et de fin --}}
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label for="date_debut" class="form-label"><i
                                                                        class="fa-solid fa-calendar-day"></i> Date de
                                                                    début</label>
                                                                <input type="date"
                                                                    class="form-control @error('date_debut') is-invalid @enderror"
                                                                    id="date_debut" name="date_debut"
                                                                    value="{{ old('date_debut', $demande->date_debut) }}"
                                                                    required>
                                                                @error('date_debut')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>

                                                            <div class="col-md-6">
                                                                <label for="date_fin" class="form-label"><i
                                                                        class="fa-solid fa-calendar-day"></i> Date de
                                                                    fin</label>
                                                                <input type="date"
                                                                    class="form-control @error('date_fin') is-invalid @enderror"
                                                                    id="date_fin" name="date_fin"
                                                                    value="{{ old('date_fin', $demande->date_fin) }}"
                                                                    required>
                                                                @error('date_fin')
                                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        {{-- Motif --}}
                                                        <div class="mb-3">
                                                            <label for="motif" class="form-label"><i
                                                                    class="fa-solid fa-pencil-alt"></i> Motif</label>
                                                            <textarea class="form-control @error('motif') is-invalid @enderror" id="motif" name="motif" rows="2"
                                                                required>{{ old('motif', $demande->motif) }}</textarea>
                                                            @error('motif')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Pièce jointe --}}
                                                        <div class="mb-3">
                                                            <label for="piece_jointe" class="form-label"><i
                                                                    class="fa-solid fa-file"></i> Pièce jointe
                                                                (optionnelle)
                                                            </label>
                                                            <input type="file"
                                                                class="form-control @error('piece_jointe') is-invalid @enderror"
                                                                id="piece_jointe" name="piece_jointe">
                                                            @error('piece_jointe')
                                                                <div class="invalid-feedback">{{ $message }}</div>
                                                            @enderror
                                                            @if ($demande->piece_jointe)
                                                                <small class="text-muted">Fichier actuel : <a
                                                                        href="{{ asset('storage/' . $demande->piece_jointe) }}"
                                                                        target="_blank">Voir</a></small>
                                                            @endif
                                                        </div>

                                                        {{-- Bouton de soumission --}}
                                                        <div class="d-grid mt-4">
                                                            <button type="submit" class="btn btn-primary btn-lg">
                                                                <i class="fa-solid fa-floppy-disk"></i> Modifier
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>








                                    <!-- Bouton qui ouvre le modal de supression -->
                                    <div>
                                        <button class="" data-bs-toggle="modal"
                                            data-bs-target="#confirmDeleteModal" title="Supprimer">
                                            <i class="fas fa-trash text-danger"></i>
                                        </button>
                                    </div>

                                    <!-- Modal de la confirmation de suppression -->
                                    <div class="modal fade" id="confirmDeleteModal" tabindex="-1"
                                        aria-labelledby="modalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel">Confirmation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Fermer"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Voulez-vous vraiment supprimer cette planification de demande ?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <form id="deleteForm"
                                                        action="{{ route('demande.supprimer', $demande->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-trash "> </i> Supprimer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Contenu de la demande --}}
                            <div class="card-body mb-0">

                                <p class="wrap-word mb-2 overflow-auto modal-body"
                                    style="max-height: 100px !important; min-height: 100px !important; ">


                                    <i class="fas fa-sticky-note text-muted"></i>
                                    <strong>Motif :</strong> <span class="font-weight-light">{{ $demande->motif }}</span>

                                </p>
                                <p class=" mb-0">
                                    <i class="fas fa-calendar-alt text-muted"></i>
                                    <strong>Date de début :</strong>
                                    {{ \Carbon\Carbon::parse($demande->date_debut)->translatedFormat('d F Y') }}
                                </p>
                                <p class=" mb-0">
                                    <i class="fas fa-calendar-check text-muted"></i>
                                    <strong>Date de fin :</strong>
                                    {{ \Carbon\Carbon::parse($demande->date_fin)->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            {{-- Bouton pour soumettre la demande --}}

                            <div class="card-footer mt-0 py-0">
                                <!-- Bouton qui ouvre le modal -->
                                <button type="button" class="btn btn-lg btn-outline-primary w-100"
                                    data-bs-toggle="modal" data-bs-target="#confirmSubmitModal">
                                    Soumettre
                                </button>
                            </div>

                            <!-- Modal de confirmation  de la soummission de la demande -->
                            <div class="modal fade" id="confirmSubmitModal" tabindex="-1"
                                aria-labelledby="submitModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="submitModalLabel">Confirmation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Fermer"></button>
                                        </div>
                                        <div class="modal-body">
                                            Voulez-vous vraiment soumettre cette demande ?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Annuler</button>
                                            <form id="submitForm" action="{{ route('demande.soumettre', $demande->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary">Confirmer</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>





            {{-- les demandes en attente de validation  --}}

            <h4 class="mt-4">⏳ En attente de validation ({{ $mes_demandes->where('statut', 'Demandée')->count() }})</h4>

            <div class="row g-4 ">
                @foreach ($mes_demandes->where('statut', 'Demandée')->reverse() as $demande)
                    <div class="col-md-4 ">

                        <div class="card shadow-lg border-0">

                            <div class="d-flex justify-content-between align-middle rounded-sm card-header bg-white p-3 pb-2"
                                style="border-bottom: 2px dashed #ccc;">

                                <h6 class="mb-0 text-sm">
                                    <span class="text-muted text-small  " style="font-size: 0.85rem;">Soumis le </span>
                                    {{ \Carbon\Carbon::parse($demande->updated_at)->translatedFormat('d F Y') }}
                                    <div class="mb-0 text-gradient text-primary text-lg text-muted bg-white fw-bold "
                                        style="text-transform: capitalize !important;">
                                        {{ $demande->typeDemande->libelle }}
                                    </div>

                                    @if ($demande->commentaire_modification != null)
                                        <span class="badge bg-warning  text-lowercase" style="font-size: 0.5rem;">en
                                            attente
                                            modification</span>
                                    @endif


                                    @if ($demande->relancer == true)
                                        <span class="badge bg-info text-lowercase" style="font-size: 0.5rem;">relancé au
                                            grh</span>
                                    @endif





                                </h6>

                                {{-- --}}
                                <div class="d-flex justify-content-end gap-2">
                                    {{-- button pour voir plus  --}}
                                    <div>
                                        <button data-bs-toggle="modal" data-bs-target="#voirDemande{{ $demande->id }}"
                                            title="Voir les détails">
                                            <i class="fas fa-eye text-info"></i>
                                        </button>
                                    </div>

                                    {{-- Modal de voir plus --}}
                                    <div class="modal fade" id="voirDemande{{ $demande->id }}" tabindex="-1"
                                        aria-labelledby="voirDemande{{ $demande->id }}Label" aria-hidden="true">
                                        <div class="modal-dialog modal-md modal-dialog-centered">
                                            <div class="modal-content border-0 shadow-sm rounded">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title text-white">
                                                        <i class="fa-solid fa-circle-info me-2"></i>
                                                        Détails : <strong>{{ $demande->typeDemande->libelle }}</strong>
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">


                                                    <!-- Période -->
                                                    <p class="fw-semibold text-muted mb-1"><i
                                                            class="fa-solid fa-calendar-day me-2 text-primary"></i> Période
                                                        :</p>
                                                    <p class="mb-3">
                                                        <strong>{{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}</strong>
                                                        →
                                                        <strong>{{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}</strong>
                                                    </p>

                                                    <!-- Motif -->
                                                    <p class="fw-semibold text-muted mb-1"><i
                                                            class="fa-solid fa-pencil-alt me-2 text-primary"></i> Motif :
                                                    </p>
                                                    <div class="p-3 bg-light rounded mb-3">{{ $demande->motif }}</div>

                                                    <!-- Pièce jointe (si présente) -->
                                                    @if ($demande->piece_jointe)
                                                        <p class="fw-semibold text-muted mb-1"><i
                                                                class="fa-solid fa-file me-2 text-primary"></i> Pièce
                                                            jointe :</p>
                                                        <div class="d-flex align-items-center p-2 bg-light rounded">
                                                            <i class="fa-solid fa-file  fs-4 me-3"></i>
                                                            <span
                                                                class="text-truncate">{{ basename($demande->piece_jointe) }}</span>
                                                            <a href="{{ asset('storage/' . $demande->piece_jointe) }}"
                                                                target="_blank" class="btn btn-primary btn-sm ms-auto">
                                                                <i class="fa-solid fa-download"></i>
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <!-- Date de création -->
                                                    <p class="mt-4 text-muted">
                                                        <i class="fa-solid fa-clock me-2 text-primary"></i>
                                                        Créée le
                                                        <strong>{{ \Carbon\Carbon::parse($demande->created_at)->format('d/m/Y à H:i') }}</strong>
                                                    </p>


                                                    <div>
                                                        @if ($demande->commentaire_modification != null)
                                                            <p class="fw-semibold text-muted mb-1"><i
                                                                    class="fa-solid fa-comment-dots me-2 text-primary"></i>
                                                                Commentaires de ma demande de modification :
                                                            </p>
                                                            <div class="p-3 bg-light rounded mb-3">
                                                                {{ $demande->commentaire_modification }}
                                                            </div>
                                                        @endif




                                                    </div>
                                                </div>

                                                <div class="modal-footer bg-light">

                                                    <div>
                                                        <button type="button" class="btn btn-secondary me-2"
                                                            data-bs-dismiss="modal">
                                                            <i class="fa-solid fa-times me-2"></i>Fermer
                                                        </button>



                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Contenu de la demande --}}
                            <div class="card-body mb-0">

                                <div class="wrap-word mb-2 overflow-auto modal-body "
                                    style="max-height: 100px !important; min-height: 100px !important; ">
                                    <i class="fas fa-sticky-note text-muted"></i>
                                    <strong>Motif :</strong> <span class="font-weight-light">{{ $demande->motif }}</span>
                                </div>
                                <p class=" mb-0">
                                    <i class="fas fa-calendar-alt text-muted"></i>
                                    <strong>Date de début :</strong>
                                    {{ \Carbon\Carbon::parse($demande->date_debut)->translatedFormat('d F Y') }}
                                </p>
                                <p class=" mb-0">
                                    <i class="fas fa-calendar-check text-muted"></i>
                                    <strong>Date de fin :</strong>
                                    {{ \Carbon\Carbon::parse($demande->date_fin)->translatedFormat('d F Y') }}
                                </p>
                            </div>

                            <div class="card-footer bg-white py-2 d-flex justify-content-end gap-2">

                                <!-- Bouton pour relancer la demande -->
                                @if ($demande->relancer == false)
                                    <button class="btn btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#demandeRelancement{{ $demande->id }}">
                                        <i class="fas fa-redo"></i> Relancer
                                    </button>
                                @endif

                                <!-- Bouton pour modifier la demande -->

                                @if ($demande->commentaire_modification == null)
                                    <button class="btn  btn-outline-warning" data-bs-toggle="modal"
                                        data-bs-target="#demandeModification{{ $demande->id }}">
                                        <i class="fas fa-edit"></i> demander modification
                                    </button>
                                @endif

                                {{-- modal de demande de modification --}}
                                <!-- Modal de demande de modification -->
                                <div class="modal fade" id="demandeModification{{ $demande->id }}" tabindex="-1"
                                    aria-labelledby="demandeModification{{ $demande->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-3">
                                            <form
                                            action="{{ route('demande.demander.modification', $demande->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')

                                                <div class="modal-header bg-warning text-dark">
                                                    <h5 class="modal-title"
                                                        id="demandeModification{{ $demande->id }}Label">
                                                        <i class="fa-solid fa-pen-to-square me-2"></i>Demande de
                                                        modification
                                                    </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <div class="alert alert-info">
                                                        <i class="fa-solid fa-info-circle me-2"></i>
                                                        Veuillez préciser les raisons de votre demande de modification.
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="commentaire_modification"
                                                            class="form-label fw-medium">Commentaire de
                                                            modification</label>
                                                        <textarea class="form-control" id="commentaire_modification" name="commentaire_modification" rows="5"
                                                            required></textarea>
                                                        <div class="form-text">Expliquez clairement les modifications
                                                            souhaitées.</div>
                                                    </div>


                                                </div>

                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="fa-solid fa-times me-2"></i>Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="fa-solid fa-paper-plane me-2"></i>Envoyer la demande
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal de demande de relancement -->

                                <!-- Modal de demande de relancement -->
                                <div class="modal fade" id="demandeRelancement{{ $demande->id }}" tabindex="-1"
                                    aria-labelledby="demandeRelancement{{ $demande->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow-lg rounded-3">
                                            <form action="{{ route('demande.relancement', $demande->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')

                                                <div class="modal-header bg-info text-white">
                                                    <h5 class="modal-title  text-white"
                                                        id="demandeRelancement{{ $demande->id }}Label">
                                                        <i class="fa-solid fa-bell me-2"></i>Relancer la demande
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body p-4">
                                                    <div class="alert alert-warning">
                                                        <i class="fa-solid fa-exclamation-triangle me-2"></i>
                                                        Vous êtes sur le point de relancer votre demande. Cela enverra une
                                                        notification aux GRH .
                                                    </div>

                                                    <div class="card border-0 bg-light mb-3">
                                                        <div class="card-body">
                                                            <div class="mb-3">
                                                                <span class="text-muted">Type de demande:</span>
                                                                <p class="fw-bold mb-1">
                                                                    {{ $demande->typeDemande->libelle }}</p>
                                                            </div>
                                                            <div class="mb-3">
                                                                <span class="text-muted">Période:</span>
                                                                <p class="fw-bold mb-1">
                                                                    Du
                                                                    {{ \Carbon\Carbon::parse($demande->date_debut)->format('d/m/Y') }}
                                                                    au
                                                                    {{ \Carbon\Carbon::parse($demande->date_fin)->format('d/m/Y') }}
                                                                </p>
                                                            </div>
                                                            <div>
                                                                <span class="text-muted">Statut actuel:</span>
                                                                <p class="fw-bold mb-0">{{ $demande->statut }}</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <p class="mb-0">Voulez-vous vraiment relancer cette demande ?</p>
                                                </div>

                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        <i class="fa-solid fa-times me-2"></i>Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-info text-white">
                                                        <i class="fa-solid fa-bell me-2"></i>Relancer
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                @endforeach
            </div>






        @endif


        <button type="button" class="btn btn-primary hover-button" data-bs-toggle="modal"
            data-bs-target="#plannifierDemandeModal">

            <i class="fas fa-calendar icon-animate"></i>
            <span class="btn-text">Planifier une demande</span>
        </button>


    </div>




    <style>
        .hover-button {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            position: fixed;
            bottom: 80px;
            right: 80px;
            z-index: 9999;
            width: 70px;
            height: 70px;
            border-radius: 50%;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
            padding: 26px;
            transition: all 0.5s ease-in-out;
            white-space: nowrap;
            overflow: hidden;
            /* background-color: #007bff; */
            color: white;
            border: none;
        }

        .btn-text {
            opacity: 0;
            max-width: 0;
            transition: max-width 0.5s ease, opacity 0.3s ease;
        }

        .icon-animate {
            font-size: 32px;
            /* Icône grande au départ */
            transition: font-size 0.5s ease, transform 0.3s ease;
            display: inline-block;
            animation: iconMove 1.5s infinite ease-in-out;
        }

        /* Effet au hover */
        .hover-button:hover {
            width: auto;
            height: 50px;
            padding: 10px 16px;
            border-radius: 8px;
        }

        .hover-button:hover .btn-text {
            max-width: 200px;
            opacity: 1;
        }

        .hover-button:hover .icon-animate {
            font-size: 20px;
            /* L’icône rétrécit */
        }

        @keyframes iconMove {

            0%,
            100% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(5px);
            }
        }
    </style>

    <style>
        .modal-body::-webkit-scrollbar {
            width: 3px;
            max-height: 400px;
            overflow-y: auto;
        }

        .modal-body::-webkit-scrollbar-track {
            background: #86979e;
            border-radius: 3px;
        }

        .modal-body::-webkit-scrollbar-thumb {
            background: #f97316;
            border-radius: 3px;
        }





        .modal-body {
            scrollbar-width: thin;
            scrollbar-color: #f97316 #f1f1f1;
        }
    </style>







    {{-- modal de planification de demande --}}
    <div class="modal fade" id="plannifierDemandeModal" tabindex="-1" aria-labelledby="plannifierDemandeLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="plannifierDemandeLabel">
                        <i class="fa-solid fa-plus-circle"></i> Planifier une demande
                    </h5>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-close"></i>
                    </button>
                </div>

                <!-- Formulaire Multi-Step -->
                <div class="modal-body">
                    <form action="{{ route('demande.planifier') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Étapes -->
                        <div id="step-1" class="step">
                            <h6 class="text-primary">Étape 1 / 3 : Type de demande</h6>
                            <div>
                                <label for="type_demande" class="form-label">Type<span
                                        class="text-danger">*</span></label>
                                <select name="type_demande_id" id="type_demande" class="form-control" required
                                    onchange="updateTypeInfo()">
                                    <option value="">Sélectionnez un type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}" data-description="{{ $type->description }}"
                                            data-duree_min="{{ $type->duree_min }}"
                                            data-duree_max="{{ $type->duree_max }}">
                                            {{ $type->libelle }}
                                        </option>
                                    @endforeach
                                </select>

                                <!-- Zone d'affichage des infos du type sélectionné -->
                                <div id="type_info" class="mt-3 d-none">
                                    <div>
                                        <strong>Description :</strong> <span id="description"></span>
                                    </div>
                                    <div class="d-flex gap-2 mt-2">
                                        <div><i class="fa-solid fa-clock"></i> <span
                                                id="duree_min">{{ $type->duree_min }}</span></div>
                                        <div><i class="fa-solid fa-calendar-day"></i> <span
                                                id="duree_max">{{ $type->duree_max }}</span></div>
                                    </div>
                                </div>

                            </div>
                            <button type="button" class="btn btn-primary mt-3" onclick="nextStep(2)">Suivant</button>
                        </div>

                        {{-- sept 2 --}}

                        <div id="step-2" class="step d-none">
                            <h6 class="text-primary">Étape 2 / 3 : Informations</h6>

                            <div class="mb-3">
                                <label for="motif" class="form-label">Motif<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa-solid fa-file-lines"></i></span>
                                    <textarea class="form-control" id="motif" name="motif" rows="2" placeholder="Motif" required></textarea>
                                </div>
                                <small class="text-muted mt-1">
                                    <i class="fa-solid fa-circle-info text-primary"></i>
                                    Motif claire et concise de votre demande.
                                </small>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="date_debut" class="form-label">Date de début <span
                                            class="text-danger">*</span><span class="text-muted">(départ)</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                                        <input type="date" id="date_debut" name="date_debut" class="form-control"
                                            required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="date_fin" class="form-label">Date de fin<span
                                            class="text-danger">*</span> <span class="text-muted">(retour)</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>
                                        <input type="date" id="date_fin" name="date_fin" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="piece_jointe" class="form-label">Pièce jointe</label>
                                <input type="file" id="piece_jointe" name="piece_jointe" class="form-control"
                                    accept=".pdf,.jpg,.png,.doc,.docx">
                            </div>

                            <button type="button" class="btn btn-secondary mt-3"
                                onclick="prevStep(1)">Précédent</button>
                            <button type="button" class="btn btn-primary mt-3" onclick="nextStep(3)">Suivant</button>
                        </div>

                        {{-- sept 3 --}}

                        <div id="step-3" class="step d-none">
                            <h6 class="text-primary">Étape 3 : Vérification</h6>
                            <p>Veuillez vérifier vos informations avant de soumettre.</p>

                            <!-- Récapitulatif des informations -->
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Récapitulatif</h6>
                                    <ul class="list-group">
                                        <li class="list-group-item"><strong>Type de demande :</strong>
                                            <span id="recap_type_demande"></span>
                                        </li>
                                        <li class="list-group-item"><strong>Motif :</strong> <span
                                                id="recap_motif"></span></li>
                                        <li class="list-group-item"><strong>Date de début :</strong>
                                            <span id="recap_date_debut"></span>
                                        </li>
                                        <li class="list-group-item"><strong>Date de fin :</strong>
                                            <span id="recap_date_fin"></span>
                                        </li>
                                        <li class="list-group-item"><strong>Pièce jointe :</strong>
                                            <span id="recap_piece_jointe"></span>
                                            {{-- disposition de la pièce jointe --}}

                                            {{-- <img src="{{ asset('storage/' . $demande->piece_jointe) }}" alt="Pièce jointe"> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <button type="button" class="btn btn-secondary mt-3"
                                onclick="prevStep(2)">Précédent</button>
                            <button type="submit" class="btn btn-success mt-3">Sauvegarder</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>




    {{-- tooltip --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>


    <script>
        function updateTypeInfo() {
            const select = document.getElementById("type_demande");
            const selectedOption = select.options[select.selectedIndex];

            if (selectedOption.value) {
                document.getElementById("description").innerText = selectedOption.dataset.description;
                document.getElementById("duree_min").innerText = selectedOption.dataset.duree_min + " jours";
                document.getElementById("duree_max").innerText = selectedOption.dataset.duree_max + " jours";
                document.getElementById("type_info").classList.remove("d-none");
            } else {
                document.getElementById("type_info").classList.add("d-none");
            }
        }

        function updateRecap() {
            document.getElementById("recap_type_demande").innerText = document.getElementById("type_demande").options[
                document.getElementById("type_demande").selectedIndex].text;
            document.getElementById("recap_motif").innerText = document.getElementById("motif").value;
            document.getElementById("recap_date_debut").innerText = document.getElementById("date_debut").value;
            document.getElementById("recap_date_fin").innerText = document.getElementById("date_fin").value;

            let fileInput = document.getElementById("piece_jointe");
            document.getElementById("recap_piece_jointe").innerText = fileInput.files.length ? fileInput.files[0].name :
                "Aucun fichier joint";
        }

        // Appel de la fonction lors du passage à l'étape 3
        function nextStep(step) {
            document.querySelectorAll('.step').forEach(stepDiv => stepDiv.classList.add('d-none'));
            document.getElementById(`step-${step}`).classList.remove('d-none');

            if (step === 3) {
                updateRecap();
            }
        }

        function prevStep(step) {
            document.querySelectorAll('.step').forEach(stepDiv => stepDiv.classList.add('d-none'));
            document.getElementById(`step-${step}`).classList.remove('d-none');
        }
    </script>



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dateDebutFields = document.querySelectorAll("input[name='date_debut']");
            const dateFinFields = document.querySelectorAll("input[name='date_fin']");

            // Empêcher la sélection de dates passées
            const today = new Date().toISOString().split("T")[0];
            dateDebutFields.forEach(dateDebut => {
                dateDebut.setAttribute("min", today);

                dateDebut.addEventListener("change", function() {
                    const selectedDate = this.value;

                    // Appliquer la contrainte aux dates de fin correspondantes
                    dateFinFields.forEach(dateFin => {
                        dateFin.setAttribute("min", selectedDate);
                    });
                });
            });
        });
    </script>


@endsection
