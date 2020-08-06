@extends('layouts.app')

@section('content')
<!--sidebar start-->
<section id="main-content">
<section class="wrapper">
       <!-- <div class="row">
          <div class="">

            custom chart end
            <div class="row mt">-->
              <!-- SERVER STATUS PANELS
              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                  
                    <h5>Requêtes soumises : {{count($articles)}} </h5>
                  </div> 
                  
                  
                </div>-->
                <!-- /grey-panel 
              </div>

              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>Requêtes résolues</h5>
                  </div>
                  
                  
                </div>-->
                <!-- /grey-panel 
              </div>

              <div class="col-md-4">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <h5>Requêtes non résolues</h5>
                  </div>
                  
                  
                </div>-->
                <!-- /grey-panel 
              </div>

              
              
            </div>
            
            
            
              
        </div>-->

        
        <!-- /row -->
      </section>
  <section class="wrapper">
    <div class="">
      <section class="panel">
        <div class="row mt">
          <div class="col-sm-3">
          @if(Auth::check()) 
                @if(auth()->user()->role==='user')
            <section class="panel">
              <div class="panel-body">
                
                  <a href="{{ route('articles.intermediaire') }}" class="btn btn-compose">
                    <i class="fa fa-pencil"></i>  Soumettre une requête
                  </a>
                  @endif
                @endif
              </div>
            </section>
            </div>
        </div>
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                    <span> Inbox ({{count($articles)}})</span> <span> Résolues ({{count($resolues)}})</span> Non Résolues ({{count($nonresolues)}}) 
                    <form method="POST" action="" class="pull-right mail-src-position">
                      {{ csrf_field() }}
                      <div class="input-append">
                        <input type="text" class="form-control " name="filter" placeholder="Chercher une requête">
                      </div>
                    </form>
                </h4>
              </header>
              <div class="panel-body minimal">
                <div class="mail-option">
                <div class="table-inbox-wrap ">
                @if(isset($info))
            <div class="row alert alert-info">{{ $info }}</div>
        @endif
        {!! $nourgentes->links() !!}
        
        @foreach($nourgentes as $nourgente)
        
                  <table class="table table-inbox table-hover">
                    <tbody>
                      <tr class="unread">
                        <td class="inbox-small-cells">
                          <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="view-message  dont-show"><a href="{{url("articles/{$article->id}")}}">{{ $article->titre }}</a></td>
                        <td class="view-message "><a href="{{url("articles/{$article->id}")}}">{{ $article->statut }}</a></td>
                        <td class="view-message "><a href="{{url("articles/{$article->id}")}}">{{ $article->type }}</a></td>
                        <td class="view-message "><a href="{{url("articles/{$article->id}")}}">{{ $article->priorite }}</a></td>
                        @if(auth()->user()->role==='user')
                        <td class="view-message  text-right"><a href="{{ route('articles.edit', $article->id) }}">Modifier la demande </td>
                        @else
                        <td class="view-message  text-right"><a href="">Traiter la demande </td>
                        @endif
                        <td class="view-message  text-right">Requete créée par {{ $article->user->name }} le {!! $article->created_at->format('d-m-Y') !!}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                  @endforeach
        {!! $articles->links() !!}
                </div>
              </div>
            </section>
          </div>
@endsection