@extends('layouts.app')

@section('content')

<section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row mt">
          
          <div class="col-sm-9">
            <section class="panel">
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                    View Message
                    <form action="#" class="pull-right mail-src-position">
                      <div class="input-append">
                        <input type="text" class="form-control " placeholder="Chercher une requête">
                      </div>
                    </form>
                  </h4>
              </header>
              <div class="panel-body ">
                <div class="mail-header row">
                  <div class="col-md-8">
                    <h4 class="pull-left"> Titre de la demande : {{ $article->titre }} </h4>
                  </div>
                  
                </div>
                <div class="mail-sender">
                  <div class="row">
                    <div class="col-md-9">
                        <table>
                            <thead>
                                <tr>
                                    <th>Soumis par :</th>
                                    <th>Type de demande</th>
                                    <th>Priorité de la demande</th>
                                    <th>Statut de la demande</th>   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>{{ $article->user->name }}</strong></td>
                                    <td><span>{{ $article->type }}</span></td>
                                    <td><span>{{ $article->prioirite }}</span></td>
                                    <td><span>{{ $article->statut }}</span></td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                    <div class="col-md-3">
                      <p class="date"> Ecrit le {!! $article->created_at->format('d-m-Y') !!}</p>
                    </div>
                  </div>
                </div>
                <div class="view-mail">
                  <p>{{ $article->contenu }}</p>
                </div>

        <aside class="mid-side">
            <div class="chat-room-head">
              <h3>Réponses à la demande</h3>
            </div>
            <div class="room-desk">
            
            @foreach($article->reponses()->latest()->get() as $reponse)
            
              <div class="room-box" >
              
                <h5 class="text-primary"><i class="fa fa-user"></i><span class="text-muted">@if($reponse->user->role !='user')
                 Reponse soumise par l'Administrateur
                  @else Reponse soumise par l'Utilisateur @endif
                  :</span> {{$reponse->user->name}} <span class="text-muted">Le :</span> {{$reponse->created_at}}</h5>
                
                <p>{{$reponse->content}} </p> 
             

                </div>
                @endforeach
                @if($article->statut!='Résolu')
            <form action="{{ url('updatestatut') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}" />
            <div><button type="submit" >Cochez pour résoudre</button></div>
            </form>
         
            <div class="form-group">
            <form action=" {{ url('{article}') }} " method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}" />
          <textarea name="content" id="ccomment" class="form-control"></textarea>
            @error('content')
            <div class="invalid-feedback">{{ $errors->first('content') }} </div>
            @enderror
          <div class="compose-btn" style="float: right;
margin-top: 10px;">
                      <button  type="submit" class="btn btn-theme btn-sm"><i class="fa fa-comment"></i> Laissez une réponse</button>
                      
                    </div>
            </form></div></div>
            @else
                <div class="compose-btn">
         
                      <h4><span class="badge badge-success">Marqué commme Résolu</span></h4>
                      @endif
                      </div> 
                     
                    
              </div>    
              
              
            
            
          
            
            
        </aside>

                
                
            </section>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>

    <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}"></script>

  <script type="text/javascript">
    //wysihtml5 start

    $('.wysihtml5').wysihtml5();

    //wysihtml5 end
  </script>
    @endsection