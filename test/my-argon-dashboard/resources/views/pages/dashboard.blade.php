@extends('layouts.app', ['class' => 'g-sidenav-show bg-black'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'List Compain'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0">Compain List</h6>
                        <a href="{{ route('compains.create') }}" class="btn btn-primary">Ajouter une compain</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0 table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom Compain</th>
                                    <th>Actif</th>
                                    <th>Date de création</th>
                                    <th>Actions</th> <!-- Nouvelle colonne pour les actions -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compains as $compain)
                                <tr onclick="window.location='{{ route('compains.showContacts', $compain->id_compain) }}'">
                                    <td>{{ $compain->id_compain }}</td>
                                    <td>{{ $compain->nom_compain }}</td>
                                    <td>
                                    <span class="badge" style="background-color: {{ $compain->actif ? '#66C046' : '#dc3545' }};">
    {{ $compain->actif ? 'Actif' : 'Inactif' }}
</span>

                                    </td>
                                    <td>{{ $compain->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <!-- Bouton Modifier -->
                                        <a href="{{ route('compains.edit', $compain->id_compain) }}" class="btn btn-warning btn-sm">Modifier</a>

                                        <!-- Bouton Supprimer -->
                                        <form action="{{ route('compains.destroy', $compain->id_compain) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette compain ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
@endsection
