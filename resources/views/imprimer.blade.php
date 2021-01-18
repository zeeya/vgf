@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('exportpdf', ['return_request' => $return_request,'adress_shipping' => $adress_shipping,'package_designation' => $package_designation,'return_type' => $return_type])
            <a class="btn btn-primary downolad-pdf" target="_blanc" href="{{ URL::to('/imprimer/pdf/'.collect(request()->segments())->last() ) }}">imprimer l'étiquette</a>

        </div>


    </div>

 
</div>
@endsection
