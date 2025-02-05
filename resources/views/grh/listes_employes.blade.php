@extends('grh.dashboard')

@section('title', 'Liste des demandes')

@section('content')
<div class="container-fluid py-4">
    <h2>Employé</h2>
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    {{-- ici je veux un card header avec la possibile de pouvoir faire une recherche  --}}
                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
                                <i class="fas fa-plus me-2"></i>Ajouter
                            </button>
                        </div>
                        <div>
                            {{-- ici je veux que la recherche se face avec du javascript  --}}
                            <form>
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control form-control-outline" placeholder="Rechercher...">

                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matricule</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom & Prénom(s)</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fonction et Services</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prise de Service</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Statut</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employes as $employe)
                                <tr>
                                    <td class="align-middle text-center text-sm font-weight-bold">{{ $employe->matricule }}</td>
                                    <td class="align-middle text-center">
                                        <div class="d-flex px-2 py-1">
                                            <div class="avatar avatar-sm me-2  d-flex align-items-center justify-content-center rounded-circle" style="background-image: linear-gradient(310deg, #f97316, #f97316);;">
                                                <span class="text-white text-uppercase">{{ substr($employe->nom, 0, 2) }}</span>
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $employe->nom }} {{ $employe->prenom }}</h6>
                                                <span class="text-xs text-secondary">{{ $employe->email }}</span>
                                            </div>
                                        </div>

                                    </td>
                                    <td class="align-middle text-sm font-weight-bold">
                                        <p class="mb-0">{{ $employe->fonction }}</p>
                                        <span class="text-xs text-muted">{{ $employe->service->nom }}</span>
                                    </td>
                                    <td class="align-middle text-center text-sm font-weight-bold">{{ $employe->date_de_prise_de_service }}</td>
                                    <td class="align-middle text-center">
                                        @php
                                            $statusClass = match($employe->statut) {
                                                'Actif' => 'badge bg-success',
                                                'En congé' => 'badge bg-warning',
                                                'Suspendu' => 'badge bg-danger',
                                                default => 'badge bg-info'
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ $employe->statut }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <div class="dropdown">
                                            <button class="btn btn-link text-secondary mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="#">
                                                        <i class="fas fa-eye text-info me-2"></i> Voir
                                                    </a>
                                                </li>
                                                <li>
                                                    <form action="#" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            <i class="fas fa-edit text-success me-2"></i> Modifier
                                                        </button>
                                                    </form>
                                                </li>
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





<!-- Modal -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Ajouter un employé</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('employes.ajouter') }}" method="POST" id="addEmployeeForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Matricule</label>
                            <input type="text" name="matricule" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nom</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Prénom</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Téléphone</label>
                            <input type="tel" name="telephone" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fonction</label>
                            <input type="text" name="fonction" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date de prise de service</label>
                            <input type="date" name="date_de_prise_de_service" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rôle</label>
                            <select name="role_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Service</label>
                            <select name="service_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#addEmployeeForm").submit(function (event) {
            event.preventDefault(); // Empêche la soumission par défaut

            let form = $(this);
            let formData = form.serialize(); // Sérialise les données du formulaire

            $.ajax({
                url: form.attr("action"),
                type: "POST",
                data: formData,
                dataType: "json",
                success: function (response) {
                    alert("Employé ajouté avec succès !");
                    $("#addEmployeeModal").modal("hide"); // Ferme le modal
                    form[0].reset(); // Réinitialise le formulaire
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = "Erreur lors de l'enregistrement :\n";

                    $.each(errors, function (key, value) {
                        errorMessage += "- " + value[0] + "\n";
                    });

                    alert(errorMessage);
                }
            });
        });
    });
</script>



@endsection

