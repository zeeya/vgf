
    <section class="content ">
        <div class="container d-md-flex   justify-content-center">
            <div class="forms new_compte register_compte col-md-5">
                <h2>Créer un compte</h2>
                <div class="sous-title">
                    <h3>Vous avez déjà un compte Job is You ? </h3>
                    <a href="#">Connectez-vous</a>
                </div>
                <form class="form-horizontal" method="POST" action="{{ route('admin.register') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="candidate_or_employer" value="candidate"/>
                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="last_name" name="name" class="form-control username" required="required"
                               value="{{old('name')}}" placeholder="{{__('Votre nom')}}">

                    </div>
                    <div class="form-group">
                        <label for="username">Adresse email</label>
                        <input type="email" name="email" class="form-control username" required="required"
                               value="{{old('email')}}" placeholder="{{__('Votre adresse email')}}">

                    </div>
                    <div class="form-group">
                        <label for="possword">Mot de passe :</label>
                        <input type="password" name="password" class="form-control password" required="required"
                               value="" placeholder="{{__('Votre mot de passe')}}">
                        <small>Votre mot de passe doit contenir 8 à 20 caractères dont au moins une minuscule, une
                            majuscule, un chiffre et un symbôle.
                        </small>
                    </div>
                    <input type="submit" class="btn btn-primary col btn-form mt-4" value="inscription">

                </form>
            </div>
        </div>
    </section>

