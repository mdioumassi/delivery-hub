@extends('layouts.app')

@section('title', 'Nouveau colis')

@section('content')
<div class="card">
    <div class="card-header">
        <h3>Nouveau colis</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('packages.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="type" class="form-label">Type</label>
                    <select name="type" id="type" class="form-select @error('type') is-invalid @enderror">
                        <option value="standard">Standard</option>
                        <option value="fragile">Fragile</option>
                        <option value="dangerous">Dangereux</option>
                    </select>
                    @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="weight" class="form-label">Poids</label>
                    <input type="text" name="weight" id="weight" class="form-control @error('weight') is-invalid @enderror">
                    @error('weight')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="unit_price" class="form-label">Prix unitaire</label>
                    <input type="number" step="0.01" name="unit_price" id="unit_price" class="form-control @error('unit_price') is-invalid @enderror">
                    @error('unit_price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="service_id" class="form-label">Service</label>
                    <select name="service_id" id="service_id" class="form-select @error('service_id') is-invalid @enderror">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->type }}</option>
                        @endforeach
                    </select>
                    @error('service_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="client_id" class="form-label">Client</label>
                    <select name="client_id" id="client_id" class="form-select @error('client_id') is-invalid @enderror">
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->firstname }} {{ $client->lastname }}</option>
                        @endforeach
                    </select>
                    @error('client_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Créer le colis</button>
                <a href="{{ route('packages.index') }}" class="btn btn-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>
@endsection