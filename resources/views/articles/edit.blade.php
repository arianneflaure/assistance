@extends('layouts.app')

@section('content')
<section id="main-content">
  <section class="wrapper">
      <div class="row mt">       
 <div class="">
    <section class="panel">
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                @lang('lang.Modifier la demande')
                    
                  </h4>
              </header>
              <div class="panel-body">
                
              <div class="panel-body">
                  <form  method="POST" action="{{ route('articles.update',$article->id) }}">
                  <input name="_method" type="hidden" value="PATCH">
                    {{ csrf_field() }}

                    

                    
                           
                    <div class="form-group row">
                    
                    <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('lang.Titre de la demande') }}</label>

                            <div class="col-md-6">
                                <input for="titre" id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ $article->titre }}" required autocomplete="titre de la demande" autofocus>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('lang.Selectionner le type de la demande') }}</label>

                            <div class="col-md-6">
                                <select for="type" type="text" id="type" class="form-control @error('type') is-invalid @enderror" name="type" value="{{  $article->type  }}">
                                <option value="Requête">@lang('lang.Requête')</option>
                                <option value="Bug du système">@lang('lang.Bug du système')</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="priorite" class="col-md-4 col-form-label text-md-right">{{ __('lang.Priorité de la demande') }}</label>
                        <div class="col-md-6">
                            <select for="priorite" id="priorite" type="text" class="form-control @error('priorite') is-invalid @enderror" name="priorite" value="{{  $article->priorite  }}">
                            <option value="Très Urgent">@lang('lang.Très Urgent')</option>
                                <option value="Urgent"> @lang('lang.Urgent')</option>
                                <option value="Intermediaire"> @lang('lang.Intermediaire')</option>
                                </select>
                                @error('priorite')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                     </div>

                     <div class="form-group row">
                            <label for="contenu" class="col-md-4 col-form-label text-md-right">{{ __('lang.Description de la demande') }}</label>
                            <div class="col-md-6">
                            <div class="compose-editor">
                      <textarea type="text" name="contenu" for="contenu" class="form-control {{ $errors->has('contenu') ? ' is-invalid' : '' }}" id="contenu" value="{{  $article->contenu  }}"></textarea>
                      @error('contenu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                            
                                
                     </div>
                    
                    <div class="compose-btn">
                     <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-check"></i> @lang('lang.Modifier')</button>
                      
                    </div>
                  </form>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <script type="text/javascript" src="lib/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
  <script type="text/javascript" src="lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

  <script type="text/javascript">
    //wysihtml5 start

    $('.wysihtml5').wysihtml5();

    //wysihtml5 end
  </script>
    @endsection