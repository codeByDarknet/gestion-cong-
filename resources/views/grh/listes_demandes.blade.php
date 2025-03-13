@extends('grh.sidebar')

@section('title', 'Liste des demandes')


@section('content')


    <div class="container-fluid py-4">


        {{-- Système de filtres avec JavaScript --}}
        <div class="d-flex gap-2 my-3">
            <button id="filter-tous" class="btn btn-sm btn-primary active-filter btn-filter px-2 py-1"
                onclick="filterTable('', this)">
                <i class="fa fa-list me-1 fs-6"></i> Tous <span id="filter-tous-count"></span>
            </button>
            <button id="filter-demandee" class="btn btn-sm btn-warning btn-filter px-2 "
                onclick="filterTable('Demandée', this)">
                <i class="fa fa-hourglass-half me-1 fs-6"></i> Demandées <span id="filter-demandee-count"></span>
            </button>
            <button id="filter-a-modifier" class="btn btn-sm btn-info btn-filter px-2"
            onclick="filterTable('À modifier', this)">
            <i class="fa fa-edit me-1 fs-6"></i> À modifier <span id="filter-a-modifier-count"></span>
        </button>
        <button class="btn btn-sm btn-success btn-filter px-2" onclick="filterTable('Acceptée', this)">
            <i class="fa fa-check-circle me-1 fs-6"></i> Acceptées <span id="filter-acceptee-count"></span>
        </button>
        <button id="filter-rejetee" class="btn btn-sm btn-danger btn-filter px-2"
            onclick="filterTable('Rejetée', this)">
            <i class="fa fa-times-circle me-1 fs-6"></i> Rejetées <span id="filter-rejetee-count"></span>
        </button>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Toutes les demandes</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center justify-content-center mb-0 table-responsive">
                                <thead>
                                    <tr>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Date de Soumission</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employé</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Type
                                        </th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Durée</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Statut</th>
                                        <th class="text-secondary opacity-7">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demandes->reverse() as $demande)
                                        @if ($demande->statut != 'Plannifiée')
                                        <tr>
                                            <td class="align-middle text-center">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="d-flex align-items-center mb-1">
                                                            <i class="fa fa-calendar text-info me-2"></i>
                                                            <span
                                                                class="text-sm font-weight-bold">{{ $demande->created_at->format('d/m/Y') }}</span>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <i class="fa fa-clock text-secondary me-2"></i>
                                                            <span
                                                                class="text-xs text-muted">{{ $demande->created_at->format('H:i') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="avatar avatar-sm me-2  d-flex align-items-center justify-content-center rounded-circle"
                                                        style="background-image: linear-gradient(310deg, #f97316, #f97316);;">
                                                        <span
                                                            class="text-white text-uppercase">{{ substr($demande->user->nom, 0, 2) }}</span>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $demande->user->nom }}
                                                            {{ $demande->user->prenom }}</h6>
                                                        <span
                                                            class="text-xs text-secondary">{{ $demande->user->email }}</span>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <span
                                                    class="badge bg-secondary me-4 text-xxs">{{ $demande->typeDemande->libelle }}</span>
                                            </td>

                                            <td class="align-middle">
                                                <div class="d-flex">
                                                    <i class="fa fa-clock text-secondary me-2"></i>
                                                    @php
                                                        // Convertir les dates en objets DateTime
                                                        $dateDebut = new DateTime($demande->date_debut);
                                                        $dateFin = new DateTime($demande->date_fin);

                                                        // Calculer la différence entre les deux dates
                                                        $interval = $dateDebut->diff($dateFin);

                                                        // Formater la différence
                                                        $difference = '';
                                                        if ($interval->y > 0) {
                                                            $difference .=
                                                                $interval->y .
                                                                ' an' .
                                                                ($interval->y > 1 ? 's' : '') .
                                                                ', ';
                                                        }
                                                        if ($interval->m > 0) {
                                                            $difference .= $interval->m . ' mois, ';
                                                        }
                                                        if ($interval->d > 0) {
                                                            $difference .=
                                                                $interval->d .
                                                                ' jour' .
                                                                ($interval->d > 1 ? 's' : '') .
                                                                ', ';
                                                        }
                                                        if ($interval->h > 0) {
                                                            $difference .=
                                                                $interval->h .
                                                                ' heure' .
                                                                ($interval->h > 1 ? 's' : '') .
                                                                ', ';
                                                        }
                                                        if ($interval->i > 0) {
                                                            $difference .=
                                                                $interval->i .
                                                                ' minute' .
                                                                ($interval->i > 1 ? 's' : '') .
                                                                ', ';
                                                        }

                                                        // Supprimer la virgule finale
                                                        $difference = rtrim($difference, ', ');

                                                        // Si la différence est vide (dates identiques), afficher un message
                                                        if (empty($difference)) {
                                                            $difference = '0 jour';
                                                        }
                                                    @endphp
                                                    <span class="text-sm">{{ $difference }}</span>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center">
                                                @php
                                                    $statusClasses = [
                                                        'Demandée' => 'bg-gradient-warning',
                                                        'Acceptée' => 'bg-gradient-success',
                                                        'Rejetée' => 'bg-gradient-danger',
                                                        'À modifier' => 'bg-gradient-info',
                                                    ];

                                                    $statusClass =
                                                        $statusClasses[$demande->statut] ?? 'bg-gradient-secondary';
                                                @endphp
                                                <span
                                                    class="badge {{ $statusClass }} text-xxs">{{ $demande->statut }}</span>
                                            </td>

                                            <td class="align-middle">
                                                <div class="dropdown">

                                                    <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                        data-bs-target="#detailDemande{{ $demande->id }}">
                                                        <i class="fa fa-ellipsis-v text-xs"></i>
                                                    </button>

                                                    <div class="modal fade " id="detailDemande{{ $demande->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="detailDemande{{ $demande->id }}Label"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg py-3 ">

                                                            <div class="modal-content">
                                                                <div class="modal-header m-0">
                                                                    <h5 class="modal-title"
                                                                        id="detailDemande{{ $demande->id }}Label">Détails
                                                                    </h5>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal" aria-label="Close"> <i
                                                                            class="fa fa-close"></i></button>
                                                                </div>

                                                                <div class="modal-body p-4 py-0">
                                                                    <div class="row g-4">
                                                                        <!-- Informations Employé -->
                                                                        <div class="col-12">
                                                                            <div class="d-flex align-items-center justify-content-between p-4 border-2 border border-secondary bg-white"
                                                                                style="border-style: dashed !important; border-bottom: 1px !important ">
                                                                                <div
                                                                                    class="d-flex align-items-center gap-3">
                                                                                    <!-- Cercle avec initiales -->
                                                                                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle fw-bold fs-4"
                                                                                        style="width: 48px; height: 48px;">
                                                                                        {{ substr($demande->user->nom, 0, 1) }}{{ substr($demande->user->prenom, 0, 1) }}
                                                                                    </div>
                                                                                    <div>

                                                                                        <div
                                                                                            class="h5 mb-0 fw-bold text-muted">
                                                                                            {{ $demande->user->nom }}
                                                                                            {{ $demande->user->prenom }}
                                                                                        </div>
                                                                                        <div class="small text-muted ">
                                                                                            Matricule : <span
                                                                                                class="fw-bold">{{ $demande->user->matricule }}</span>
                                                                                        </div>
                                                                                        <div class="small text-muted ">
                                                                                            Email : <span
                                                                                                class="fw-bold">{{ $demande->user->email }}</span>
                                                                                        </div>
                                                                                        <div class="small text-muted ">
                                                                                            Service :
                                                                                            {{ $demande->user->service->nom }}
                                                                                            / <span
                                                                                                class="fw-bold">{{ $demande->user->fonction }}
                                                                                                @if ($demande->user->role->nom == 'responsable')
                                                                                                    <span
                                                                                                        class="badge bg-secondary px-1 py-1">Responsable</span>
                                                                                                @endif
                                                                                            </span></div>
                                                                                        <div class="small text-muted">
                                                                                            Date de prise de service :
                                                                                            <span class="fw-bold"> le
                                                                                                {{ \Carbon\Carbon::parse($demande->user->date_de_prise_de_service)->translatedFormat(' d F Y') }}</span>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <!-- Détails de la Demande -->
                                                                            <div class="col-12">
                                                                                <div class="d-flex  justify-content-between p-4 border-2 border border-secondary gap-4 bg-white "
                                                                                    style="border-style: dashed !important; ">

                                                                                    <!-- Bloc des détails de la demande et des dates -->

                                                                                    <!-- Détails de la Demande avec largeur minimale fixe -->
                                                                                    <div class="bg-white"
                                                                                        style="min-width: 250px;">
                                                                                        <div
                                                                                            class="d-flex justify-content-between small">
                                                                                            <span class="text-muted">Type
                                                                                                :</span>
                                                                                            <span
                                                                                                class="fw-bold badge bg-secondary px-1 py-1">{{ $demande->typeDemande->libelle }}</span>
                                                                                        </div>
                                                                                        <div class="small text-muted ">
                                                                                            {{ $demande->typeDemande->description }}
                                                                                        </div>
                                                                                        <div
                                                                                            class="d-flex justify-content-between small ">
                                                                                            <span class="text-muted">Durée
                                                                                                du type:</span>
                                                                                            <span
                                                                                                class="fw-bold">{{ $demande->typeDemande->duree_min }}
                                                                                                -
                                                                                                {{ $demande->typeDemande->duree_max }}
                                                                                                jours</span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="d-flex justify-content-between small mt-2">
                                                                                            <span class="text-muted">Jours
                                                                                                demandés :</span>
                                                                                            <span
                                                                                                class="fw-bold">{{ $difference }}</span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="d-flex justify-content-between small">
                                                                                            <span class="text-muted">Début
                                                                                                :</span>
                                                                                            <span
                                                                                                class="fw-bold">{{ \Carbon\Carbon::parse($demande->date_debut)->translatedFormat(' d F Y') }}</span>
                                                                                        </div>
                                                                                        <div
                                                                                            class="d-flex justify-content-between small">
                                                                                            <span class="text-muted">Fin
                                                                                                :</span>
                                                                                            <span
                                                                                                class="fw-bold">{{ \Carbon\Carbon::parse($demande->date_fin)->translatedFormat(' d F Y') }}</span>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div
                                                                                        class="p-2  rounded  border shadow-sm inset-2 bg-light flex-grow-1 w-100 h-full ">
                                                                                        <h6
                                                                                            class="fw-bold text-muted mt-0 text-decoration-underline">
                                                                                            Motif</h6>
                                                                                        <div
                                                                                            class="text-wrap w-100 text-break ">
                                                                                            <span class="fw-semibold">
                                                                                                {{ $demande->motif }}</span>
                                                                                        </div>
                                                                                    </div>




                                                                                </div>
                                                                            </div>


                                                                            {{-- piece jointe --}}
                                                                            @if ($demande->piece_jointe)
                                                                            <div class="col-12 mt-3">
                                                                                <div class="p-2 rounded border shadow-sm bg-light">
                                                                                    <h6 class="fw-bold text-muted mt-0 text-decoration-underline">Pièce jointe</h6>
                                                                                    <div class="text-wrap w-100 text-break">
                                                                                        <a href="{{ asset('storage/' . $demande->piece_jointe) }}"
                                                                                            class="text-primary fw-bold"
                                                                                            target="_blank">
                                                                                            <i
                                                                                                class="fa-solid fa-download"></i>
                                                                                            Voir la pièce jointe</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif

                                                                            <div class="col-12">
                                                                                <div class="d-flex justify-content-between px-4 py-1 align-items-center border border-2   border-secondary  bg-gradient-secondary bg-opacity-6 "
                                                                                    style="border-style: dashed !important;border-top: 1px !important ;  ">
                                                                                    <h6 class="fw-semibold mb-0">Statut
                                                                                    </h6>
                                                                                    <span
                                                                                        class=" text-white fw-bold  rounded small">
                                                                                        {{ $demande->statut }}
                                                                                    </span>
                                                                                </div>
                                                                            </div>


                                                                            @if ($demande->commentaire_modification)
                                                                            <div class="col-12 mt-3">
                                                                                <div class="p-2 rounded border shadow-sm bg-light">
                                                                                    <h6 class="fw-bold text-muted mt-0 text-decoration-underline">
                                                                                        Commentaire de modification</h6>
                                                                                    <div class="text-wrap w-100 text-break">
                                                                                        <span class="fw-semibold">{{ $demande->commentaire_modification }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                            <!-- Statut -->




                                                                        </div>
                                                                    </div>





                                                                    @if ($demande->statut === 'Demandée')
                                                                        <div class="modal-footer justify-content-start">
                                                                            <form
                                                                                action="{{ route('demande.accepter', $demande->id) }}"
                                                                                method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-success">Accepter</button>
                                                                            </form>
                                                                            <form
                                                                                action="{{ route('demande.rejeter', $demande->id) }}"
                                                                                method="POST" class="d-inline">
                                                                                @csrf
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Rejeter</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif

                                                                    @if ($demande->statut === 'À modifier')
                                                                        <div class="modal-footer justify-content-start">
                                                                            <form
                                                                                 action="{{ route('demande.traiter-modification', $demande->id) }}"

                                                                                method="POST" class="d-inline w-100">
                                                                                @csrf

                                                                                {{-- type de demande --}}

                                                                                 <div class="form-group mb-3">
                                                                                    <label for="type_demande">Type de demande</label>
                                                                                    <select class="form-control" id="type_demande" name="type_demande">
                                                                                        @foreach ($types as $typeDemande)
                                                                                            <option value="{{ $demande->typeDemande->id }}">{{ $demande->typeDemande->libelle }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>

                                                                                {{-- date debut --}}
                                                                                <div class="form-group mb-3">
                                                                                    <label for="date_debut">Date de début</label>
                                                                                    <input type="date" class="form-control" id="date_debut" name="date_debut" value="{{ $demande->date_debut }}">
                                                                                </div>

                                                                                {{-- date fin --}}
                                                                                <div class="form-group mb-3">
                                                                                    <label for="date_fin">Date de fin</label>
                                                                                    <input type="date" class="form-control" id="date_fin" name="date_fin" value="{{ $demande->date_fin }}">
                                                                                </div>

                                                                                <button type="submit" name="action" value="accepter" class="btn btn-success">Modifier la demande</button>
                                                                                <button type="submit" name="action" value="rejeter" class="btn btn-danger">Rejeter la modification</button>
                                                                            </form>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>


                                                    </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>






    <script>
        // Fonction pour mettre à jour les compteurs de demandes
        function updateFilterCounts() {
            let counts = {
                "Demandée": 0,
                "Acceptée": 0,
                "Rejetée": 0,
                "À modifier": 0,
                "Total": 0
            };



            document.querySelectorAll("tbody tr").forEach(row => {
                let statusCell = row.querySelector("td:nth-child(5) span");
                if (statusCell) {
                    let status = statusCell.textContent.trim();
                    if (counts[status] !== undefined) {
                        counts[status]++;
                    }
                    counts["Total"]++;
                }
            });

            // Mise à jour des boutons avec les nombres
            document.getElementById("filter-tous-count").innerHTML = ` (${counts["Total"]})`;
            document.getElementById("filter-demandee-count").innerHTML = ` (${counts["Demandée"]})`;
            document.getElementById("filter-acceptee-count").innerHTML = ` (${counts["Acceptée"]})`;
            document.getElementById("filter-rejetee-count").innerHTML = ` (${counts["Rejetée"]})`;
            document.getElementById("filter-a-modifier-count").innerHTML = ` (${counts["À modifier"]})`;
        }

        // Fonction pour filtrer les demandes
        function filterTable(status, button) {
            let rows = document.querySelectorAll("tbody tr");
            let title = document.querySelector(".card-header h6");

            rows.forEach(row => {
                let statusCell = row.querySelector("td:nth-child(5) span");
                row.style.display = (!status || statusCell.textContent.trim() === status) ? "" : "none";
            });

            // Mise à jour du titre
            title.textContent = status ? `Demandes - ${status}` : "Toutes les demandes";

            // Réinitialiser les styles des autres boutons
            document.querySelectorAll(".btn-filter").forEach(btn => {
                btn.classList.remove("btn-active");
                btn.style.boxShadow = "none";
                btn.style.borderWidth = "2px";
                btn.style.borderColor = "transparent";
                btn.style.outline = "none";
                btn.style.transition = "all 0.3s ease-in-out";
            });

            // Appliquer le style au bouton actif
            button.classList.add("btn-active");
            button.style.boxShadow = "0 0 12px rgba(255, 255, 255, 0.7)";
            button.style.border = "2px solid rgba(255, 255, 255, 0.6)";
            button.style.outline = "2px solid rgba(0, 0, 0, 0.8)";
            button.style.transition = "all 0.3s ease-in-out";
        }

        // Mettre à jour les compteurs dès le chargement
        document.addEventListener("DOMContentLoaded", updateFilterCounts);
    </script>

    <style>
        .table-responsive::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        .table-responsive::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        .table-responsive::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>

@endsection
