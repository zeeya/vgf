@component('mail::message')
# Demande de retour

Nouvelle demande de retour par {{ $user->firstname }} {{ $user->lastname }}!

N° KVPS: {{ $return_request->n_kvps }}

Pois total du retour: {{ $return_request->weight_kg }}

Désignation colis: {{ $return_request->package_designation }}

Type de retour: {{ $return_request->return_type }}

Demande faite le: {{ date('d-m-Y', strtotime($return_request->created_at)) }}

Merci,<br>
{{ config('app.name') }}
@endcomponent