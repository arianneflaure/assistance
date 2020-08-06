@extends('layouts.app')

@section('content')
<!--sidebar start-->
<section id="main-content">

  <section class="wrapper">
    <div class="">
      <section class="panel">
			 <!--div class="row mt">
				  <div class="col-sm-3">
				  @if(Auth::check()) 
						@if(auth()->user()->role==='user')
					<section class="panel">
					  <div class="panel-body">
						
						  <a href="{{ route('articles.create') }}" class="btn btn-compose">
							<i class="fa fa-pencil"></i>  Soumettre une requête
						  </a>
						  @endif
						@endif
					  </div>
					</section>
					</div>
			 </div-->
              <header class="panel-heading wht-bg">
                <h4 class="gen-case">
                    <span> Inbox ({{$count}})</span>
                    <!--form method="POST" action="" class="pull-right mail-src-position">
                      {{ csrf_field() }}
                      <div class="input-append">
                        <input type="text" class="form-control " name="filter"  placeholder="Chercher une requête">
                      </div>
                    </form-->
                </h4>
              </header>
              <div class="panel-body minimal">
                <div class="mail-option">
                  <div class="chk-all">
                 
                    <div class="btn-group ">
                      <a data-toggle="dropdown"class="btn mini all">
                         @lang('lang.Filtrer les demandes')
                        <i class="fa fa-angle-down "></i>
                      </a>
                      <ul class="dropdown-menu">
						<?php if ($priorite!='') {?>
						<li><a href="{{ route('admin.articles',['priorite'=>$priorite]) }}"> @lang('lang.Toutes les demandes')</a></li>
                        <li><a href="{{ route('admin.articles',['priorite'=>$priorite,'statut'=>'Résolu']) }}"> @lang('lang.Résolues')</a></li>
                        <li><a href="{{ route('admin.articles',['priorite'=>$priorite,'statut'=>'Non Résolu']) }}">@lang('lang.Non Résolues')</a></li>
						<?php } else { ?>
                        <li><a href="{{ route('admin.articles') }}"> @lang('lang.Toutes les demandes')</a></li>
                        <li><a href="{{ route('admin.articles',['statut'=>'Résolu']) }}"> @lang('lang.Résolues')</a></li>
                        <li><a href="{{ route('admin.articles',['statut'=>'Non Résolu']) }}">@lang('lang.Non Résolues')</a></li>
						<?php } ?>
                      </ul>
                    </div>
                  </div>
				  <div class="btn-group hidden-phone">
                    <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                      <i class="fa fa-download"></i> Exporter
                      <i class="fa fa-angle-down "></i>
                      </a>
                    <ul class="dropdown-menu">
                      <li><a onclick="exportData(event.target);" data-href="{{route('articles.export',['statut'=>$statut])}}"><i class="fa fa-file-text-o"></i> Toutes les données</a></li>
                      <li class="divider"></li>
                      <li><a href="#" onclick="showperiod();"><i class="fa fa-calendar"></i> Par Periode</a></li>
                    </ul>
				 </div>
                </div>
				<div class="row" id="periode" style="display: none;">
				   <div class="col-md-12">
						<form class="form-inline" role="form " method="get" action="{{ route('articles.export') }}">
						<div class="input-group input-large"  data-date="01/01/2014" data-date-format="mm/dd/yyyy">
						   <input type="text" class="form-control dpd1" name="from">
							  <span class="input-group-addon">To</span>
						   <input type="text" class="form-control dpd2" name="to">
						   <input type="hidden" value="{{$statut}}" name="statut">
						</div>
						<button type="submit"  class="btn btn-danger" >Exporter <i class="fa fa-download"></i></button>
					   </form>     
				   </div>
				</div>
                <div class="table-inbox-wrap ">
                @if(isset($info))
				<div class="row alert alert-info">{{ $info }}</div>
				@endif
				
				{!! $articles->links("pagination.default") !!}
		
        <div class="row mt">
          <div class="col-md-12">
            <div class="">
              <table class="table table-hover table-inbox ">
              <thead>
              <tr>
                  <th>@lang('lang.Titre de la demande')</th>
                  <th>@lang('lang.Type de demande')</th>
                  <th>@lang('lang.Soumis par')</th>
                  <th>@lang('lang.Priorité')</th>
                  <th>@lang('lang.Date de création')</th>
                  <th></th>
                      
              </tr>
              </thead>
                    <tbody>
					@foreach($articles as $article)
                      <tr <?php if($article->statut=='Non Résolu') { ?>class="unread" <?php } ?> onclick="window.location.href='{{url("admin/articles/{$article->id}")}}';">
                     
                        <td class="view-message  dont-show"><a href="{{url("admin/articles/{$article->id}")}}">{{ $article->titre }}</a></td>
                        <td class="view-message "><a href="{{url("admin/articles/{$article->id}")}}">{{ $article->type }}</a></td>
                        <td class="view-message  dont-show">
							<a href="{{url("admin/articles/{$article->id}")}}">
							{{$article->user->name }} 
							</a>
						</td>
						<td>
							<?php if($article->priorite=='Très Urgent') { ?>
							<span class="label label-danger"> @lang('lang.Très Urgent')</span>
							<?php } ?>
							<?php if($article->priorite=='Urgent') { ?>
							<span class="label label-warning">@lang('lang.Urgent')</span>
							<?php } ?>
							<?php if($article->priorite=='Intermediaire') { ?>
							<span class="label label-info">@lang('lang.Intermediaire')</span>
							<?php } ?>
							
						</td>
						<td class="view-message  text-left"> {!! $article->created_at->format('d-m-Y') !!}</td>
						<td>
							<p>
							@if($article->image != '')
							
							<a class="atch-thumb" href="{{ url('/images/articles') }}/{{$article->image }}" target="_BLANK"> <i class="fa fa-paperclip"></i>
							 </a>
							@endif
							
							</p>
						</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                 </div> 
                 </div> 
                 </div> 
                  
				 
       
                </div>
            
            </section>
          </div>
        </div>
      </section>
    </section>
<script>
   function exportData(_this) {
	  $('#periode').hide();
      let _url = $(_this).data('href');
      window.location.href = _url;
   }
    // $('#periode').hide(); 
   
   function showperiod(){
	   // if ($('#periode').is(":visible") === true) {
		  // $('#periode').hide(); 
	   // }
	   // else{
		  $('#periode').show(); 
	   // }
   }
</script>
@endsection