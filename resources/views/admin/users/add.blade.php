@extends('admin.layouts.admin_layout')

@section('content')
    @include('admin.shared.header', [
        'title' => __('Ajouter un nouvel utilisateur ').' ' ,
        'description' => __(''),
        'class' => ''
    ])

    <div class="container-fluid mt--7">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-10 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0">{{ __('Ajouter un nouvel utilisateur') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.store.user') }}" >
                            @csrf
                            @include('admin.users.forms.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
