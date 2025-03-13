@extends('responsable.sidebar')

@section('title', 'Liste des Employés')

@section('content')

<div class="container py-4">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h5 class="fw-bold mb-0">Service : {{ $service->nom }}</h5>
        </div>
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h6 class="mb-0 fw-bold">Liste des Employés</h6>
                    <div class="search-wrapper position-relative">
                        <i class="fas fa-search position-absolute ms-3" style="top: 10px;"></i>
                        <input type="text" id="searchInput" class="form-control ps-5" placeholder="Rechercher un employé...">
                    </div>
                </div>
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0 table-hover">
                        <thead class="bg-light">
                            <tr>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Matricule</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Nom & Prénom</th>
                                <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Poste</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Prise de Service</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Téléphone</th>
                                <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-8 px-3 py-3">Statistiques</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTable">
                            @foreach ($employes as $employe)
                            <tr class="searchable ">
                                <td class="align-middle text-center px-3 py-3">
                                    <span class="badge bg-light text-dark fw-bold">{{ $employe->matricule }}</span>
                                </td>
                                <td class="align-middle px-3 py-3">
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-circle me-3">
                                            <span class="text-white text-uppercase">{{ strtoupper(substr($employe->nom, 0, 2)) }}</span>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-0 text-sm fw-bold">{{ $employe->nom }} {{ $employe->prenom }}</h6>
                                            <span class="text-xs text-muted">{{ $employe->email }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle px-3 py-3">
                                    <p class="mb-0 text-sm fw-medium">{{ $employe->fonction }}</p>

                                </td>
                                <td class="align-middle text-center px-3 py-3">
                                    <span class="badge bg-info bg-opacity-10 text-white px-3 py-2">
                                        {{ $employe->date_de_prise_de_service }}
                                    </span>
                                </td>
                                <td class="align-middle text-center px-3 py-3">
                                    <span class="text-sm">{{ $employe->telephone }}</span>
                                </td>
                                <td class="align-middle px-3 py-3">
                                    <div class="d-flex flex-column ">
                                        <div >
                                            <span class="text-sm fw-medium text-secondary">En cours :</span> {{ $employe->demandes()->where('statut', 'Demandée')->count() }}
                                        </div>
                                        <div >
                                            <span class="text-sm fw-medium text-secondary">Acceptées :</span> {{ $employe->demandes()->where('statut', 'Acceptée')->count() }}
                                        </div>
                                        <div >
                                            <span class="text-sm fw-medium text-secondary">Refusées :</span> {{ $employe->demandes()->where('statut', 'Rejetée')->count() }}
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.searchable');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
});
</script>

<style>
.avatar-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(310deg, #f97316, #ff8a4c);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    font-size: 14px;
    box-shadow: 0 3px 6px rgba(249, 115, 22, 0.2);
}

.table th {
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.table-hover tbody tr:hover {
    background-color: rgba(249, 115, 22, 0.05);
    transition: background-color 0.2s ease;
}

.search-wrapper {
    position: relative;
    width: 250px;
}

.badge {
    font-weight: 500;
}
</style>
@endsection
