@extends('layouts.app')

@section('content')
<div class="col-sm-9">
            <section class="panel">
            <div class="row mt">
          <div class="col-sm-3">
            <section class="panel">
              <div class="panel-body">
                <a href="{{ route('posts.create') }}" class="btn btn-compose">
                  <i class="fa fa-pencil"></i>  Soumettre une requête
                  </a>
                
              </div>
            </section>
            </div>
          @yield('content')
        </div>
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                    Inbox (3)
                    <form action="#" class="pull-right mail-src-position">
                      <div class="input-append">
                        <input type="text" class="form-control " placeholder="Chercher une requête">
                      </div>
                    </form>
                  </h4>
              </header>
              <div class="panel-body minimal">
                <div class="mail-option">
                  <div class="chk-all">
                    <div class="pull-left mail-checkbox">
                      <input type="checkbox" class="">
                    </div>
                    
                  </div>
                  
                <div class="table-inbox-wrap ">
                @if(isset($info))
            <div class="row alert alert-info">{{ $info }}</div>
        @endif
        {!! $posts->links() !!}
        @foreach($posts as $post)
                  <table class="table table-inbox table-hover">
                    <tbody>
                      <tr class="unread">
                        <td class="inbox-small-cells">
                          <input type="checkbox" class="mail-checkbox">
                        </td>
                        <td class="view-message  dont-show"><a href="{{url("posts/{$post->id}")}}">{{ $post->titre }}</a></td>
                        <td class="view-message "><a href="{{url("posts/{$post->id}")}}">{{ $post->statut }}</a></td>
                        <td class="view-message "><a href="{{url("posts/{$post->id}")}}">{{ $post->type }}</a></td>
                        <td class="view-message "><a href="{{url("posts/{$post->id}")}}">{{ $post->priorite }}</a></td>
                        <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                        <td class="view-message  text-right">Requete créée par {{ $post->user->name }} le {!! $post->created_at->format('d-m-Y') !!}</td>
                        
                        <td class="view-message  text-right"><a href="{{ route('posts.edit', $post->id) }}">Traiter la demande </td>
                      
        

                        <td class="view-message  text-right">Requete créée par {{ $post->user->name }} le {!! $post->created_at->format('d-m-Y') !!}</td>
                      </tr>
                      
                    </tbody>
                  </table>
                  @endforeach
        {!! $posts->links() !!}
                </div>
              </div>
            </section>
          </div>
@endsection