
@include('flash::message')


@if (session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif


<div class="pt-2 pb-2 pl-9 pr-9 ">
    <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
    <div class="form-group{{ $errors->has('firstname') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-firstname">{{ __('Nom') }}</label>
        <input type="text" name="firstname" id="input-firstname" class="form-control form-control-alternative{{ $errors->has('firstname') ? ' is-invalid' : '' }}" placeholder="{{ __('Nom') }}" value="{{ old('firstname', isset($user) ? $user->firstname :'') }}" required autofocus>

        @if ($errors->has('firstname'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstname') }}</strong>
                                        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('lastname') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-lastname">{{ __('Prenom') }}</label>
        <input type="text" name="lastname" id="input-lastname" class="form-control form-control-alternative{{ $errors->has('lastname') ? ' is-invalid' : '' }}" placeholder="{{ __('Prenom') }}" value="{{ old('lastname',  isset($user) ?$user->lastname :'') }}" required autofocus>

        @if ($errors->has('lastname'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastname') }}</strong>
                                        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
        <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email',  isset($user) ?$user->email :'') }}" required>

        @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
        @endif
    </div>
    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
        <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" >

        @if ($errors->has('password'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
    </div>
</div>
@push('scripts')


    <script type="text/javascript">




    </script>
@endpush
