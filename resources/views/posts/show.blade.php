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
                    <h4 class="pull-left"> {{ $post->titre }} </h4>
                  </div>
                  <div class="col-md-4">
                    <div class="compose-btn pull-right">
                      <a href="mail_compose.html" class="btn btn-sm btn-theme"><i class="fa fa-reply"></i> Traiter la demande</a>
                      </div>
                  </div>
                </div>
                <div class="mail-sender">
                  <div class="row">
                    <div class="col-md-8">
                      <img src="img/ui-zac.jpg" alt="">
                      <strong>{{ $post->user->name }}</strong>
                      <span>{{ $post->user->email }}</span>
                      <span>{{ $post->statut }}</span> 
                    </div>
                    <div class="col-md-4">
                      <p class="date"> Ecrit le {!! $post->created_at->format('d-m-Y') !!}</p>
                    </div>
                  </div>
                </div>
                <div class="view-mail">
                  <p>{{ $post->contenu }}</p>
                </div>
                
            </section>
          </div>
        </div>
      </section>
      <!-- /wrapper -->
    </section>
    @endsection