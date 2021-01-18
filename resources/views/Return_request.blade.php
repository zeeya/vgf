@extends('layouts.app')



@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">{{ __('Demande de retour') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('Return_request.create') }}">

                        @csrf



                        @if ($errors->any())

                            <div class="alert alert-danger">

                                <ul>

                                    @foreach ($errors->all() as $error)

                                        <li>{{ $error }}</li>

                                    @endforeach

                                </ul>

                            </div>

                        @endif

                        <div class="form-group row">

                            <label for="n_kvps" class="col-md-4 col-form-label text-md-right">{{ __('N° KVPS') }}</label>

                            <div class="col-md-6">

                                <input id="n_kvps" type="text" class="form-control" name="n_kvps" autocomplete="n_kvps" value="{{ old('n_kvps') }}">

                            </div>

                        </div>

                        <strong>{{ __('Votre adresse') }}</strong>

                        <div class="form-group row">

                            <label for="name_adress_shipping" class="col-md-4 col-form-label text-md-right">{{ __('Nom complet') }}</label>

                            <div class="col-md-6">

                                <input value="{{ $adress_shipping != '' ? $adress_shipping->name : old('name_adress_shipping') }}" id="name_adress_shipping" type="text" placeholder="Société" class="form-control" name="name_adress_shipping"   autocomplete="name_adress_shipping">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="adress_adress_shipping" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">

                                <input value="{{ $adress_shipping != '' ? $adress_shipping->adress : old('adress_adress_shipping') }}" id="adress_adress_shipping" type="text" class="form-control" name="adress_adress_shipping" placeholder="N°/rue"   autocomplete="adress_adress_shipping">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="postcode_adress_shipping" class="col-md-4 col-form-label text-md-right">{{ __('Code Postal ') }}</label>

                            <div class="col-md-6">

                                <input value="{{ $adress_shipping != '' ? $adress_shipping->postcode : old('postcode_adress_shipping') }}" id="postcode_adress_shipping" type="text" class="form-control" name="postcode_adress_shipping" placeholder="CP"   autocomplete="postcode_adress_shipping">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

                            <div class="col-md-6">

                                <input value="{{ $adress_shipping != '' ? $adress_shipping->city : old('city_adress_shipping') }}" id="city" type="text" class="form-control" placeholder="Ville" name="city_adress_shipping"   autocomplete="city">

                            </div>

                        </div>

                        <div class="form-group row">

                            <label for="phone_adress_shipping" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>

                            <div class="col-md-6">

                                <input value="{{ $adress_shipping != '' ? $adress_shipping->phone : old('phone_adress_shipping') }}" id="phone_adress_shipping" type="text" class="form-control"  placeholder="N° de téléphone" name="phone_adress_shipping"   autocomplete="phone_adress_shipping">

                            </div>

                        </div>

                        @if(is_null($package_designations))

                            // not found

                        @else 

                        <strong>{{ __('Désignation colis') }}</strong>

                            @foreach ($package_designations as $package_designation)

                                <div class="input-group">

                                <div class="input-group-text">

                                    <input class="form-check-input" id="package_designation_id_{{ $package_designation->id }}" name="package_designation_id" type="radio" value="{{ $package_designation->id }}" {{ ($package_designation->id == old('package_designation_id')) ? 'checked' : '' }}>

                                </div>

                                <label for="package_designation_id_{{ $package_designation->id }}">{{ $package_designation->name }}</label>

                                </div>

                            @endforeach

                        @endif

                        @if(is_null($return_types))

                            // not found

                        @else 

                        <strong>{{ __('Type de retour') }}</strong>



                            @foreach ($return_types as $return_type)

                                <div class="input-group">

                                <div class="input-group-text">

                                    <input class="form-check-input" id="return_type_id_{{ $return_type->id }}" name="return_type_id" type="radio" value="{{ $return_type->id }}" {{ ($return_type->id == old('return_type_id')) ? 'checked' : '' }}>

                                </div>

                                <label for="return_type_id_{{ $return_type->id }}">{{ $return_type->name }}</label>

                                </div>

                            @endforeach

                        @endif

                        <div class="form-group row">

                            <label for="weight_kg" class="col-md-4 col-form-label text-md-right">{{ __('Pois total du retour') }}</label>

                            <div class="col-md-6">

                                <input id="weight_kg" type="text" class="form-control" name="weight_kg" placeholder="Poids en kg"  value="{{ old('n_kvps') }}"  autocomplete="weight_kg">

                            </div>

                        </div>

   

                    

                        <div class="form-group row mb-0">

                            <div class="col-md-6 offset-md-4">

                                <button type="submit" class="btn btn-primary">

                                    {{ __('Générer l\'étiquette') }}

                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection

