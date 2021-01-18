
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
    <h6 class="heading-small text-muted mb-4">{{ __('Information') }}</h6>


    <div class="form-group{{ $errors->has('return_type_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="return_type_id">{{ __('Type') }}</label>
        <select name="return_type_id" id="return_type_id"  class="form-control form-control-alternative{{ $errors->has('return_type_id') ? ' is-invalid' : '' }}" >
            <option disabled></option>
            @foreach ($return_types as $return_type)
                <option value="{{ $return_type->id }}" @if($return_type->id == $return_request->return_type_id) selected @endif>{{ $return_type->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('return_type_id'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('return_type_id') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('package_designation_id') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="package_designation_id">{{ __('Désignation') }}</label>
        <select name="package_designation_id" id="package_designation_id"  class="form-control form-control-alternative{{ $errors->has('package_designation_id') ? ' is-invalid' : '' }}" >
            <option disabled></option>
            @foreach ($designations as $designation)
                <option value="{{ $designation->id }}" @if($designation->id == $return_request->package_designation_id) selected @endif>{{ $designation->name }}</option>
            @endforeach
        </select>
        @if ($errors->has('package_designation_id'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('package_designation_id') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('weight_kg') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="weight_kg">{{ __('KG') }}</label>
        <input type="text" name="weight_kg" id="weight_kg" class="form-control form-control-alternative{{ $errors->has('weight_kg') ? ' is-invalid' : '' }}" placeholder="{{ __('KG') }}" value="{{ old('weight_kg',  isset($return_request) ?$return_request->weight_kg :'') }}" required autofocus>

        @if ($errors->has('weight_kg'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('weight_kg') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="form-group{{ $errors->has('n_kvps') ? ' has-danger' : '' }}">
        <label class="form-control-label" for="n_kvps">{{ __('kvps') }}</label>
        <input type="text" name="n_kvps" id="n_kvps" class="form-control form-control-alternative{{ $errors->has('n_kvps') ? ' is-invalid' : '' }}" placeholder="{{ __('kvps') }}" value="{{ old('n_kvps',  isset($return_request) ?$return_request->n_kvps :'') }}" required autofocus>

        @if ($errors->has('n_kvps'))
            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('n_kvps') }}</strong>
                                        </span>
        @endif
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-success mt-4">{{ __('Enregistrer') }}</button>
    </div>
</div>
@push('scripts')


    <script type="text/javascript">




    </script>
@endpush
