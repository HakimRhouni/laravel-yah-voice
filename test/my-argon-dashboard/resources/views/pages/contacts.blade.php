@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])
<link href="{{ asset('assets/css/argon-dashboard.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/argon-dashboard.js') }}" defer></script>

<link rel="icon" type="image/png" href="{{ asset('img/logo-ct.png') }}">
@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Contacts pour ' . $compain->nom_compain])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-12 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h6>Liste des contacts pour la compain: {{ $compain->nom_compain }}</h6>
                        
                        <form action="{{ route('export-contacts-template') }}" method="GET">
    <button type="submit" class="btn btn-warning ">Télécharger le template CSV</button>
</form>


<form action="{{ route('import-contacts') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="compain_id" value="{{ $compain->id_compain }}">
    <div class="form-group">
        <label for="file">Choisir un fichier CSV :</label>
        <input type="file" name="file" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-warning">Importer Contacts</button>
</form>



                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email 1</th>
                                    <th>Email 2</th>
                                    <th>Numéro 1</th>
                                    <th>Numéro 2</th>
                                    <th>Mobile 1</th>
                                    <th>Mobile 2</th>
                                    <th>Téléphone 1</th>
                                    <th>Téléphone 2</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compain->contacts as $contact)
                                <tr>
                                    <td>{{ $contact->nom }}</td>
                                    <td>{{ $contact->email1 }}</td>
                                    <td>{{ $contact->email2 }}</td>
                                    <td>{{ $contact->num1 }}</td>
                                    <td>{{ $contact->num2 }}</td>
                                    <td>{{ $contact->mobile1 }}</td>
                                    <td>{{ $contact->mobile2 }}</td>
                                    <td>{{ $contact->tel1 }}</td>
                                    <td>{{ $contact->tel2 }}</td>
                                    <td>
    <!-- Delete Button -->
    <form action="{{ route('compains.deleteContact', ['compainId' => $compain->id_compain, 'contactId' => $contact->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce contact ?');" style="display:inline;">
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
