@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">




@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-8 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Modifier la compain</h6>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('compains.update', $compain->id_compain) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nom_compain">Nom de la compain</label>
                                <input type="text" name="nom_compain" class="form-control" id="nom_compain" value="{{ $compain->nom_compain }}" required>
                            </div>
                            <div class="form-group">
                                <label for="actif">Statut</label>
                                <select name="actif" class="form-control" id="actif" required>
                                    <option value="1" {{ $compain->actif ? 'selected' : '' }}>Actif</option>
                                    <option value="0" {{ !$compain->actif ? 'selected' : '' }}>Inactif</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
