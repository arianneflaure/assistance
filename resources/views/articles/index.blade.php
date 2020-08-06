@extends('layouts.app')

@section('content')
<!--sidebar start-->
<section id="main-content">

  <section class="wrapper">
    <div class="">
      <section class="panel">
				@if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
          </div>
				@endif
				  
				@if ($message = Session::get('error'))
          <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
          </div>
				@endif
				   
				@if ($message = Session::get('warning'))
          <div class="alert alert-warning alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
          </div>
				@endif
				   
				@if ($message = Session::get('info'))
          <div class="alert alert-info alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
              <strong>{{ $message }}</strong>
          </div>
				@endif
				
        <header class="panel-heading wht-bg">
          <h4 class="gen-case">
            <span> Inbox ({{$count}})</span>
            <!--form method="POST" action="" class="pull-right mail-src-position">
                  {{ csrf_field() }}
                  <div class="input-append">
                    <input type="text" class="form-control " name="filter" placeholder="Chercher une requête">
                  </div>
                </form>-->
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
                  <li><a href="{{route('articles.index')}}"> @lang('lang.Toutes les demandes')</a></li>
                  <li><a href="{{route('articles.index',['statut'=>'Résolu'])}}"> @lang('lang.Résolues')</a></li>
                  <li><a href="{{route('articles.index',['statut'=>'Non Résolu'])}}">@lang('lang.Non Résolues')</a></li>
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

          <div>
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
                      <th>Titre de le demande</th>
                      <th>Type de la demande</th>
                      <th>Administrateur</th>
                      <th>Priorité</th>
                      <th>Date de création</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                    <tbody>
					@foreach($articles as $article)
                      <tr <?php if($article->statut=='Non Résolu') { ?>class="unread" <?php } ?>  onclick="window.location.href='{{url("admin/articles/{$article->id}")}}';">
                     
                        <td class="view-message  dont-show"><a href="{{url("articles/{$article->id}")}}">{{ $article->titre }}</a></td>
						<td class="view-message "><a href="{{url("articles/{$article->id}")}}">{{ $article->type }}</a></td>
                        <td class="view-message  dont-show">
							<a href="{{url("articles/{$article->id}")}}">
							{{$article->admin->name }}
							
						</td>
						<td><?php if($article->priorite=='Très Urgent') { ?>
							<span class="label label-danger "> @lang('lang.Très Urgent')</span>
							<?php } ?>
							<?php if($article->priorite=='Urgent') { ?>
							<span class="label label-warning ">@lang('lang.Urgent')</span>
							<?php } ?>
							<?php if($article->priorite=='Intermediaire') { ?>
							<span class="label label-info">@lang('lang.Intermediaire')</span>
							<?php } ?>
							</a>
						</td>
                        <td class="view-message  text-left"> {!! $article->created_at->format('d-m-Y') !!}</td>
						<td>
							<!--a class="btn btn-primary btn-xs" style="border-color: #3c763d; background-color: #3c763d; color: #ffffff;" href="{{url("articles/{$article->id}")}}">@lang('lang.Lire') <i class="fa fa-folder-open-o"></i></a-->
							<p>
							@if($article->image != '')
							
							<a class="atch-thumb" href="{{ url('/images/articles') }}/{{$article->image }}" target="_BLANK"> <i class="fa fa-paperclip"></i>
							 </a>
							@endif
							
							</p>
						</td>
						<td>
							<!--a class="btn btn-primary btn-xs" style="border-color: #3c763d; background-color: #3c763d; color: #ffffff;" href="{{url("articles/{$article->id}")}}">@lang('lang.Lire') <i class="fa fa-folder-open-o"></i></a-->
							<p>
							
							@if($article->statut=='Non Résolu')
							<a  style="margin-top: 8px; " href="{{ route('articles.edit', $article->id) }}"> <i class="fa fa-edit"></i></a>
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
             </div>
            </section>
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