@extends('layouts.app')

@section('content')

<div class="col-sm-9">
            <section class="panel">
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                Rédiger une demande
                    <form action="#" class="pull-right mail-src-position">
                      <div class="input-append">
                      <input type="text" class="form-control " placeholder="Chercher une requête">
                      </div>
                    </form>
                  </h4>
              </header>
              <div class="panel-body">
                
              <div class="panel-body">
                  <form  method="POST" action="{{ route('posts.store') }}">
                    {{ csrf_field() }}
                           
                    <div class="form-group row">
                            <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('Titre de la demande') }}</label>

                            <div class="col-md-6">
                                <input for="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre') }}" required autocomplete="titre de la demande" autofocus>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Selectionner le type de demande:') }}</label>

                            <div class="col-md-6">
                                <select for="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}">
                                <option>Requête</option>
                                <option>Bug du système</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="priorite" class="col-md-4 col-form-label text-md-right">{{ __('Priorité de la demande') }}</label>
                        <div class="col-md-6">
                            <select for="priorite" type="text" class="form-control @error('priorite') is-invalid @enderror" name="priorite" value="{{ old('priorite') }}">
                                <option>Très Urgent</option>
                                <option> Urgent</option>
                                <option> Intermediaire</option>
                                </select>
                                @error('priorite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="contenu" class="col-md-4 col-form-label text-md-right">{{ __('Description de la demande') }}</label>
                            <div class="col-md-6">
                            <div class="compose-editor">
                      <textarea type="text" name="contenu" for="contenu" class="wysihtml5 form-control {{ $errors->has('contenu') ? ' is-invalid' : '' }}" id="contenu"></textarea>
                    
                    </div>
                            
                                
                     </div>
                    
                    <div class="compose-btn">
                      <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i> Envoyer</button>
                      
                    </div>
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>

@endsection