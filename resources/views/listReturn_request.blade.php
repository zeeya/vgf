@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Liste des demandes') }}</div>
                <div class="card-body">
                
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Compteur</th>
                            <th scope="col">N° KVPS</th>
                            <th scope="col">Désignation colis</th>
                            <th scope="col">Type de retour</th>
                            <th scope="col">Pois total</th>
                            <th scope="col">Date de demande</th>
                            <th scope="col">Actions</th>

                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($return_requests as $return_request)
                        <tr>
                            <th scope="row">{{ $return_request->id ?  $return_request->id : '--' }}</th>
                            <th scope="row">{{ $return_request->n_kvps ?  $return_request->n_kvps : '--' }}</th>
                            <td>{{ $return_request->package_designation ?  $return_request->package_designation : '--' }}</td>
                            <td>{{ $return_request->return_type ?  $return_request->return_type : '--' }}</td>
                            <td>{{ $return_request->weight_kg ?  $return_request->weight_kg : '--' }} Kg</td>
                            <td>{{ $return_request->created_at ?  $return_request->created_at : '--' }}</td>
                            <td>
                                <a class="" href="{{ route('imprimer', [$return_request->id]) }}">
                                    {{ __('Voir') }}
                                </a>
                                <a class="" href="{{ URL::to('retour/modifier/'.$return_request->id ) }}">
                                    {{ __('Modifier') }}
                                </a>
                                <a class="" href="{{ route('supprimerReturn_request', [$return_request->id]) }}">
                                    {{ __('Supprimer') }}
                                </a>
                            </td>

                            </tr>
                        <tr>
                        
                    @endforeach

        
                    </tbody>
                </table>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
