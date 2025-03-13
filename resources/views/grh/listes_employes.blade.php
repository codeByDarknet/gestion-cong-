@extends('grh.sidebar')

@section('title', 'Liste des employés')

@section('content')
<div class="container-fluid py-4">

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
                                    <input type="text" id="searchInput" class="form-control form-control-outline" placeholder="Rechercher...">
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table id="employesTable" class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Matricule</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom & Prénom(s)</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Fonction et Services</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Prise de Service</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Telephone</th>
                                    <th class="text-secondary opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employes->reverse() as $employe)
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

                                    <td class="align-middle text-center ">{{ $employe->telephone }}</td>

                                    <td class="align-middle">
                                        <div class="dropdown">

                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                data-bs-target="#modifEmploye{{ $employe->id }}">
                                                <i class="fa fa-ellipsis-v text-xs"></i>
                                            </button>

                                            <div class="modal fade" id="modifEmploye{{ $employe->id }}"
                                                tabindex="-1"
                                                aria-labelledby="modifEmploye{{ $employe->id }}Label"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg">

                                                    <div class="modal-content">
                                                        <div class="modal-header m-0">
                                                            <h5 class="modal-title" id="modifEmploye{{ $employe->id }}Label">
                                                                Modifier l'employé {{ $employe->matricule }}
                                                            </h5>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="fa fa-close"></i>
                                                            </button>
                                                        </div>

                                                        <div class="modal-body p-4 py-0">
                                                            {{-- Le formulaire de modification --}}
                                                            <form action="{{ route('employes.modifier', $employe->id) }}" method="POST" id="editEmployeeForm">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="modal-body">
                                                                    <div class="row g-3 row-cols-md-2">
                                                                        <!-- Matricule (non modifiable) -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-id-badge"></i> Matricule</label>
                                                                            <input type="text" name="matricule" class="form-control" value="{{ $employe->matricule }}" readonly>
                                                                        </div>

                                                                        <!-- Nom -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-user"></i> Nom</label>
                                                                            <input type="text" name="nom" class="form-control" value="{{ $employe->nom }}" required>
                                                                        </div>

                                                                        <!-- Prénom -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-user"></i> Prénom</label>
                                                                            <input type="text" name="prenom" class="form-control" value="{{ $employe->prenom }}" required>
                                                                        </div>

                                                                        <!-- Email (non modifiable) -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                                                                            <input type="email" name="email" class="form-control" value="{{ $employe->email }}" readonly>
                                                                        </div>

                                                                        <!-- Téléphone -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                                                                            <input type="tel" name="telephone" class="form-control" value="{{ $employe->telephone }}" required>
                                                                        </div>

                                                                        <!-- Date de prise de service -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-calendar"></i> Date de prise de service</label>
                                                                            <input type="date" name="date_de_prise_de_service" class="form-control" value="{{ $employe->date_de_prise_de_service }}">
                                                                        </div>

                                                                        <!-- Service -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-building"></i> Service</label>
                                                                            <select name="service_id" class="form-select" required>
                                                                                <option value="">Sélectionner...</option>
                                                                                @foreach($services as $service)
                                                                                    <option value="{{ $service->id }}" @if ($employe->service_id == $service->id) selected @endif>{{ $service->nom }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <!-- Fonction -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-briefcase"></i> Fonction</label>
                                                                            <input type="text" name="fonction" class="form-control" value="{{ $employe->fonction }}" required>
                                                                        </div>

                                                                        <!-- Rôle -->
                                                                        <div class="col">
                                                                            <label class="form-label"><i class="fas fa-user-tag"></i> Rôle</label>
                                                                            <select name="role_id" class="form-select" required>
                                                                                <option value="">Sélectionner...</option>
                                                                                @foreach($roles as $role)
                                                                                    <option value="{{ $role->id }}" @if ($employe->role_id == $role->id) selected @endif>{{ $role->nom }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer d-flex justify-content-between">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Annuler</button>
                                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                                                                </div>
                                                            </form>



                                                        </div>
                                                    </div>


                                                </div>


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
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
            </div>
            <form action="{{ route('employes.ajouter') }}" method="POST" id="addEmployeeForm">
                @csrf
                <div class="modal-body">
                    <div class="row g-3 row-cols-md-2">
                        <div class="col">
                            <label class="form-label"><i class="fas fa-id-badge"></i> Matricule</label>
                            <input type="text" name="matricule" class="form-control" placeholder="Ex: EMP12345" required>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-user"></i> Nom</label>
                            <input type="text" name="nom" class="form-control" placeholder="Ex: Dupont" required>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-user"></i> Prénom</label>
                            <input type="text" name="prenom" class="form-control" placeholder="Ex: Jean" required>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-envelope"></i> Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Ex: exemple@email.com" required>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-phone"></i> Téléphone</label>
                            <input type="tel" name="telephone" class="form-control" placeholder="Ex: +226 70 00 00 00" required>
                        </div>

                        <div class="col">
                            <label class="form-label"><i class="fas fa-calendar"></i> Date de prise de service</label>
                            <input type="date" name="date_de_prise_de_service" class="form-control">
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-building"></i> Service</label>
                            <select name="service_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-briefcase"></i> Fonction</label>
                            <input type="text" name="fonction" class="form-control" placeholder="Ex: Développeur" required>
                        </div>
                        <div class="col">
                            <label class="form-label"><i class="fas fa-user-tag"></i> Rôle</label>
                            <select name="role_id" class="form-select" required>
                                <option value="">Sélectionner...</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->nom }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times"></i> Annuler</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Enregistrer</button>
                </div>
            </form>

        </div>
    </div>
</div>


<script>
    // Fonction de filtrage
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#employesTable tbody tr');

        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            const matricule = columns[0].textContent.toLowerCase(); // Matricule
            const nomPrenom = columns[1].textContent.toLowerCase(); // Nom & Prénom(s)
            const fonctionService = columns[2].textContent.toLowerCase(); // Fonction et Services
            const priseService = columns[3].textContent.toLowerCase(); // Prise de Service
            const telephone = columns[4].textContent.toLowerCase(); // Téléphone

            // Si le terme de recherche correspond à l'une des colonnes, afficher la ligne
            if (matricule.includes(searchTerm) || nomPrenom.includes(searchTerm) || fonctionService.includes(searchTerm) || priseService.includes(searchTerm) || telephone.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection

