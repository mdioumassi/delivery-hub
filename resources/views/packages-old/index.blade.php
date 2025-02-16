@extends('layouts.app')

@section('title', 'Gestion des colis')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des colis</h1>
    <a href="{{ route('packages.create') }}" class="btn btn-primary">Nouveau colis</a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Poids</th>
                        <th>Prix unitaire</th>
                        <th>Statut</th>
                        <th>Client</th>
                        <th>Service</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($packages as $package)
                    <tr>
                        <td>{{ $package->id }}</td>
                        <td>{{ $package->type }}</td>
                        <td>{{ $package->weight }}</td>
                        <td>{{ number_format($package->unit_price, 2) }} €</td>
                        <td>
                            <span class="badge bg-{{ $package->status == 1 ? 'success' : 'warning' }}">
                                {{ $package->status == 1 ? 'Actif' : 'En attente' }}
                            </span>
                        </td>
                        <td>{{ $package->client->firstname }} {{ $package->client->lastname }}</td>
                        <td>{{ $package->service->type }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('packages.edit', $package) }}" class="btn btn-sm btn-info">Modifier</a>
                                <form action="{{ route('packages.destroy', $package) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $packages->links() }}
    </div>
</div>
@endsection
