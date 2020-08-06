@extends('layouts.app')

@section('content')

<section id="main-content">
      <section class="wrapper">
        <!-- page start-->
        <div class="row mt">
          
          <div class="col-sm-9">
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
                    @lang('lang.Lire la demande')
                
                </h4>
              </header>
              <div class="panel-body ">
                <div class="mail-header row">
                  <div class="col-md-8">
                    <h4 class="pull-left"> {{ $article->titre }} </h4>
                  </div> 
				  <div class="col-md-4">
						@if($article->statut!='Résolu')
						<div style="margin-top: 50px;">
							<form action="{{ url('updatestatut') }}" method="POST">
							{{ csrf_field() }}
							<input type="hidden" name="article_id" value="{{ $article->id }}" />
							 <button type="submit" class="btn btn-info"><i class="fa fa-thumbs-o-up"></i> Valider les réponses
							</button> 
							
							
							</form>
						</div>
						@else
						<div class="compose-btn">
							<h4><span class="btn btn-round btn-success">@lang('lang.Résolu')<i class="fa fa-check"></i></span></h4>
								  
						</div> 
						@endif
                  </div>
                  
                </div>
                <div class="mail-sender">
                  <div class="row">
                    <div class="col-md-12">
                        <table  class="table table-inbox table-hover">
                            <thead>
                                <tr>
                                    <th>@lang('lang.Soumis par') </th>
                                    <th>@lang('lang.Type')</th>
                                    <th>@lang('lang.Priorité')</th>
                                    <th>@lang('lang.Statut')</th>   
                                    <th>Date</th>   
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>{{ $article->user->name }}</strong></td>
                                    <td><span style="font-size: 11px;">{{ $article->type }}</span></td>
                                    <td><span style="font-size: 11px;">{{ $article->priorite }}</span></td>
                                    <td><span style="font-size: 11px;">{{ $article->statut }}</span></td>
                                    <td><span style="font-size: 11px;">{!! $article->created_at->format('d-m-Y') !!}</span></td>
                                </tr>
                            </tbody>
                        </table>
                      
                    </div>
                    <!--div class="col-md-3">
                      <p class="date"> Ecrit le {!! $article->created_at->format('d-m-Y') !!}</p>
                    </div-->
                  </div>
                </div>
                <div class="view-mail">
                  <p>{{ $article->contenu }}</p>
                </div>

				 
               
				@if($article->image != '')
				<a class="atch-thumb" href="{{ url('/images/articles') }}/{{$article->image }}" target="_BLANK"> <i class="fa fa-paperclip"></i> Télécharger pièce jointe
				 </a>
				@endif
				
                <hr style="border: 1px solid #EFF2F7;"/>

				<aside class="mid-side">
					<?php if ($article->reponses()->count()> 0) {?>
					<div class="chat-room-head">
					  <h4>@lang('lang.Réponses à la demande')</h4>
					</div>
					
					<div class="room-desk">
					
					   @foreach($article->reponses()->latest()->get() as $reponse)
					
					    <div class="room-box" <?php if($reponse->user->id !=Auth::user()->id) {  ?> style="float:right; text-align:right;" <?php }?>>
					  
						
						
						<p>{{$reponse->content}} </p> 
						<p class="text-primary">
						<span class="text-muted">
						  @if($reponse->user->id !=Auth::user()->id)
							{{$reponse->user->name}}
						  @else 
							  Vous
						  @endif
						  :
						</span>  
						<span> {{$reponse->created_at}}</span>
						<?php if($reponse->articlejoint_id !=0) {  ?>
						<hr style="border: 1px solid #EFF2F7;">
						<span style="float:right;"><a href="{{url("articles/{$reponse->articlejoint_id}")}}" target="_blank"> Consulter la demande jointe.</a><span><br/>
						<!--span style="float:right;"><a href="#"> <i class="fa fa-paperclip"></i></a><span-->
						<?php }  ?>
						@if($reponse->images != '')
						<br/>
						<a class="atch-thumb" href="{{ url('/images/reponses') }}/{{$reponse->images }}" target="_BLANK"> <i class="fa fa-paperclip"></i> Télécharger pièce jointe
						 </a>
						@endif
						
						</p>
					 

					   </div>
						@endforeach
					</div>
					<?php } ?>
					<!--@if($article->statut!='Résolu')
					
				 
					div class="form-group">
					<form action=" {{ url('{article}') }} " method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="article_id" value="{{ $article->id }}" />
				    <textarea name="content" id="ccomment" class="form-control"></textarea>
					@error('content')
					<div class="invalid-feedback">{{ $errors->first('content') }} </div>
					@enderror
				    <div class="compose-btn" style="float: right;margin-top: 10px;">
					<button  type="submit" class="btn btn-theme btn-sm"><i class="fa fa-comment"></i> Laissez une réponse</button>	  
				    </div>
					</form>
					</div>
					
					@else
					<div class="compose-btn">
						<h4><span class="badge badge-success">Marqué commme Résolu</span></h4>
							  
					</div> 
					@endif-->
							 
							
						 
					  
					  
					
					
					<footer>
						@if($article->statut!='Résolu')
						
						<form action=" {{ url('{article}') }} " method="POST" enctype="multipart/form-data">
							<div class="col-md-12">
							{{ csrf_field() }}
								  <div class="form-group">
									<input type="hidden" name="article_id" value="{{ $article->id }}" />
									<label>Message</label>
									<textarea name="content" id="ccomment" rows=7 class="form-control"></textarea>
									@error('content')
									<div class="invalid-feedback">{{ $errors->first('content') }} </div>
									@enderror
									
								  </div>
								  <div class="form-group">
									  <label class="">Pièce Jointe</label>
									 
										<input type="file" class="default" name="images" alt="@lang('lang.Pièce Jointe')">
									 
								  </div>
								  <div class="form-group">
									<button class="btn btn-theme" style="float:right;" type="submit">@lang('lang.Envoyer')</button>
								   </div>
							</div>	 
						</form>
						@endif

					</footer>
						
						
					</aside> 
             </div>    
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