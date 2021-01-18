@extends('admin.layouts.admin_layout')

@section('content')
    @include('admin.shared.header', [
        'title' => __('Modifier l\'utilisateur :').' ' . $user->firstname .' '.$user->lastname,
        'description' => __(''),
        'class' => ''
    ])

    <div class="container-fluid mt--7">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <h3 class="mb-0 pl-4">{{ __('Modifier l\'utilisateur') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.update.user',[$user->id]) }}" autocomplete="off">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            @include('admin.users.forms.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
