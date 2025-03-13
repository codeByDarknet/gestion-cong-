@extends('grh.sidebar')

@section('title', 'Liste des types de conges')

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">

                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ajoutTypeCongeModal">
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
                            <table id="typesTable" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Description</th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Duree Min</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Duree Max</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types->reverse() as $type)
                                    <tr class="hover-effect py-0">
                                        <!-- Type -->
                                        <td class="py-1">
                                            <span class="badge text-muted px-3">
                                                <i class="fas fa-file-signature me-1"></i> {{ $type->libelle }}
                                            </span>
                                        </td>

                                        <!-- Description tronquée avec tooltip -->
                                        <td class="py-1">
                                            <p class="text-xs  mb-0" data-bs-toggle="tooltip" title="{{ $type->description }}">
                                                {{ strlen($type->description) > 30 ? substr($type->description, 0, 30) . '...' : $type->description }}
                                            </p>
                                        </td>

                                        <!-- Durée Min -->
                                        <td class="py-1">
                                            <span class="badge bg-gradient-info opacity-80   text-white px-3 ">
                                                <i class="fas fa-clock me-1"></i>
                                                @if ($type->duree_min > 30)
                                                    {{ round($type->duree_min / 30, 1) }} mois
                                                @else
                                                    {{ $type->duree_min }} jours
                                                @endif
                                            </span>
                                        </td>

                                        <!-- Durée Max -->
                                        <td class="py-1">
                                            <span class="badge bg-gradient-warning bg-opacity-5 text-dark px-3 ">
                                                <i class="fas fa-calendar-day me-1"></i>
                                                @if ($type->duree_max > 30)
                                                    {{ round($type->duree_max / 30, 1) }} mois
                                                @else
                                                    {{ $type->duree_max }} jours
                                                @endif
                                            </span>
                                        </td>

                                        <!-- Action Modifier -->
                                        <td class="text-center">
                                            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modifType{{ $type->id }}">
                                                <i class="fas fa-edit me-1"></i> Modifier
                                            </a>
                                        </td>
                                    </tr>


                                        <div class="modal fade" id="modifType{{ $type->id }}" tabindex="-1" aria-labelledby="modifType{{ $type->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog modal-md">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                            <h5 class="modal-title" id="modifTypeModalLabel">
                                                                <i class="fa-solid fa-pen-to-square"></i> Modifier le type : <strong>{{ $type->libelle }}</strong>
                                                            </h5>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close"> <i class="fa fa-close"></i></button>
                                                    </div>
                                                    {{-- formulaire de modification --}}
                                                    <div class="modal-body">
                                                        <form action="{{ route('typesdemandes.modifier', $type->id) }}" method="POST" class=" bg-white shadow rounded">
                                                            @csrf
                                                            @method('PUT')

                                                            <div class="mb-3">
                                                                <label for="nom" class="form-label">Nom</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                                                                    <input type="text" class="form-control @error('nom') is-invalid @enderror" id="libelle" name="libelle" value="{{ old('nom', $type->libelle) }}" required>
                                                                    @error('libelle')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="description" class="form-label fw-bold">Description</label>
                                                                <div class="input-group">
                                                                    <span class="input-group-text bg-light">
                                                                        <i class="fa-solid fa-file-lines text-secondary"></i>
                                                                    </span>
                                                                    <textarea
                                                                        class="form-control @error('description') is-invalid @enderror"
                                                                        id="description"
                                                                        name="description"
                                                                        rows="2"
                                                                        placeholder="Décrivez le type de demande..."
                                                                        style="resize: none;"
                                                                        required
                                                                    >{{ old('description', $type->description) }}</textarea>
                                                                    @error('description')
                                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                {{-- <small class="text-muted mt-1">
                                                                    <i class="fa-solid fa-circle-info text-primary"></i>
                                                                    Donnez une description claire et concise
                                                                </small> --}}
                                                            </div>

                                                            <div class="row g-3">
                                                                <div class="col-md-6">
                                                                    <label for="duree_min" class="form-label">Durée Min<span class="text-muted">(jour)</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                                                                        <input type="number" nin="1" class="form-control @error('duree_min') is-invalid @enderror" id="duree_min" name="duree_min" value="{{ old('duree_min', $type->duree_min) }}" required>
                                                                        @error('duree_min')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <label for="duree_max" class="form-label">Durée Max<span class="text-muted">(jour)</span></label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>

                                                                        <input type="number" min="1"  class="form-control @error('duree_max') is-invalid @enderror" id="duree_max" name="duree_max" value="{{ old('duree_max', $type->duree_max) }}"  required>
                                                                        @error('duree_max')
                                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

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




                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




<div class="modal fade" id="ajoutTypeCongeModal" tabindex="-1" aria-labelledby="ajoutTypeCongeLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ajoutTypeCongeLabel">
                    <i class="fa-solid fa-plus-circle"></i> Ajouter un Type de Congé
                </h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-close"></i>
                </button>
            </div>

            <!-- Formulaire d'ajout -->
            <div class="modal-body">
                <form action="{{ route('typesdemandes.ajouter') }}" method="POST" class="bg-white ">
                    @csrf

                    <!-- Nom du congé -->
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                            <input type="text" class="form-control @error('libelle') is-invalid @enderror" id="libelle" name="libelle" placeholder="Ex: Congé annuel" required>
                            @error('libelle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa-solid fa-file-lines"></i></span>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="2" placeholder="Ex: Congé payé annuel..." required></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Durée Min & Max -->
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="duree_min" class="form-label">Durée Min <span class="text-muted">(jour)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hourglass-start"></i></span>
                                <input type="number" min="1" class="form-control @error('duree_min') is-invalid @enderror" id="duree_min" name="duree_min" placeholder="Ex: 5" required>
                                @error('duree_min')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="duree_max" class="form-label">Durée Max <span class="text-muted">(jour)</span></label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa-solid fa-hourglass-end"></i></span>
                                <input type="number"  min="1" class="form-control @error('duree_max') is-invalid @enderror" id="duree_max" name="duree_max" placeholder="Ex: 30" required>
                                @error('duree_max')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Bouton Ajouter -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fa-solid fa-check-circle"></i> Ajouter
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>




<script>
    // Fonction de filtrage
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('#typesTable tbody tr');

        rows.forEach(row => {
            const columns = row.querySelectorAll('td');
            const nom = columns[0].textContent.toLowerCase();
            const description = columns[1].textContent.toLowerCase();
            const dureeMin = columns[2].textContent.toLowerCase();
            const dureeMax = columns[3].textContent.toLowerCase();

            // Si le terme de recherche correspond à l'une des colonnes, afficher la ligne
            if (nom.includes(searchTerm) || description.includes(searchTerm) || dureeMin.includes(searchTerm) || dureeMax.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>


@endsection
