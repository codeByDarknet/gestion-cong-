@extends('grh.sidebar')

@section('title', 'Liste des services')

@section('content')

<div class="container-fluid py-4">

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">

                    <div class="d-flex flex-row justify-content-between">
                        <div>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
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
                        <table id="servicesTable" class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Responsable</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Employés</th>
                                    <th class="text-secondary  text-xxs font-weight-bolder opacity-7">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services->reverse() as $service)
                                <tr>
                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fa fa-building text-info me-2"></i>
                                            <span class="text-sm font-weight-bold">{{ $service->id }}</span>
                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <span class="text-sm font-weight-bold">{{ $service->nom }}</span>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <div class="d-flex align-items-center">
                                            <i class="fa fa-user-tie text-primary me-2"></i>
                                            <span class="badge bg-secondary">
                                                {{ optional($employes->where('service_id', $service->id)
                                                    ->firstWhere(fn($user) => $user->role->id === 2))->nom ?? 'Aucun' }}
                                            </span>

                                        </div>
                                    </td>

                                    <td class="align-middle text-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fa fa-users text-warning me-2"></i>
                                            <span class="text-sm font-weight-bold">{{ $employes->where('service_id', $service->id)->count() }}</span>
                                        </div>
                                    </td>

                                    <td class="align-middle">
                                        <a href="" class="text-primary font-weight-bold text-xs" data-bs-toggle="modal" data-bs-target="#modifService{{ $service->id }}">
                                            <i class="fas fa-edit me-2"></i>
                                        </a>
                                    </td>

                                    {{-- <td class="align-middle">

                                            <a type="button" class="btn btn-primary " data-bs-toggle="modal"
                                                        data-bs-target="#modifService{{ $service->id }}">

                                                        <i class="fas fa-edit me-2">

                                             </a>

                                    </td> --}}
                                </tr>

                                <!-- Modal de modification -->
                                <div class="modal fade" id="modifService{{ $service->id }}" tabindex="-1" aria-labelledby="modifService{{ $service->id }}Label" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Modifier le service {{ $service->id }}</h5>
                                                <button type="button" class="btn btn-secondary " data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- Formulaire de modification ici --}}
                                                <form action="{{ route('services.modifier', $service->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="nom" class="form-label">Nom du service</label>
                                                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $service->nom) }}" required>
                                                        @error('nom')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Modifier</button>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
<div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addServiceModalLabel">Ajouter un service</h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
            </div>
            {{-- formulaire d'ajout d'un employé --}}
            <div class="modal-body">
                <form action="{{ route('services.ajouter') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom du service</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" required>
                        @error('nom')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>

        </div>
    </div>
</div>



<script>
    // Fonction de filtrage
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#servicesTable tbody tr');

        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            const serviceId = columns[0].textContent.toLowerCase(); // ID du service
            const serviceNom = columns[1].textContent.toLowerCase(); // Nom du service
            const employeNom = columns[2].textContent.toLowerCase(); // Nom de l'employé
            const employeCount = columns[3].textContent.toLowerCase(); // Nombre d'employés

            // Si le terme de recherche correspond à l'une des colonnes, afficher la ligne
            if (serviceId.includes(searchTerm) || serviceNom.includes(searchTerm) || employeNom.includes(searchTerm) || employeCount.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection
