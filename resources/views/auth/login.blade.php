
@extends('layouts.menu')
@section('header')
<div class="login-page">

    <div class="container">

        <form class="form-login" method="POST" action="{{ route('login') }}">
                        @csrf

            <h2 class="form-login-heading">{{ __('Connexion') }}</h2>
                <div class="login-wrap">

                        <input id="email" type="email" placeholder="Adresse e-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        <br>

                         <input id="password" type="password" placeholder="Entrer votre mot de passe" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <label class="checkbox">
                            <span class="pull-right">
                                <a data-toggle="modal" href="login.html#myModal"> Mot de passe oublié?</a>
                            </span>
                        </label>
                            <button type="submit" class="btn btn-theme btn-block">
                                <i class="fa fa-lock"></i>{{ __(' Connecter') }}
                            </button>       
                        <hr>
                        </div>
                        <!-- Modal -->
                    <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Mot de passe oublié ?</h4>
                                </div>

                                    <div class="modal-body">
                                        <p>Veuillez contactez votre administrateur système sur la portail PBF afin de récupérer votre mot de passe.</p>
                                    </div>
                                    <div class="modal-footer">
                                    <button data-dismiss="modal" class="btn btn-default" type="button">Fermer</button>
                
                                </div>
                            </div>
                        </div>
                    </div>
        <!-- modal -->
    </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="{{asset('lib/jquery.backstretch.min.js')}}"></script>
  <script>
  /*  $.backstretch("img/login-bg.jpg", {
      speed: 500
    });*/
  </script>
@endsection