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
                    <!--form action="#" class="pull-right mail-src-position">
                      <div class="input-append">
                        <input type="text" class="form-control " placeholder="Chercher une requête">
                      </div>
                    </form-->
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
            @if($reponse->user->role !='user')
              <div class="room-box">
              
                <h5 class="text-primary"><i class="fa fa-user"></i><span class="text-muted"> Reponse soumisse par l'Administrateur :</span> {{$reponse->user->name}} <span class="text-muted">Le :</span> {{$reponse->created_at}}</h5>
                <p>{{$reponse->content}} </p>
                <p>
              </div>
              @endif
              @endforeach
              
            </div>
            
            @if(auth()->user()->role !='user')
            <div class="form-group">
            <form action=" {{ url('{article}') }} " method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="article_id" value="{{ $article->id }}" />
          <textarea name="content" id="ccomment" class="form-control"></textarea>
          
          <div class="compose-btn">
                      <button type="submit" class="btn btn-theme btn-sm"><i class="fa fa-comment"></i> Laissez un commentaire</button>
                      
                    </div>
            </form></div>
            @endif
        </aside>

                
                
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