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
                   @lang('lang.Lire la demande')
                   
                  </h4>
              </header>
              <div class="panel-body ">
                <div class="mail-header row">
                  <div class="col-md-8">
                    <h4 class="pull-left">  {{ $article->titre }} </h4>
                  </div>
				  <div class="col-md-4">
						@if($article->statut=='Résolu')
						<div class="compose-btn">
							<h4><span class="btn btn-round btn-success">@lang('lang.Résolu') <i class="fa fa-check"></i></span></h4>
								  
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
                                    <th>@lang('lang.Soumis par')</th>
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
						<span style="float:right;"><a href="{{url("admin/articles/{$reponse->articlejoint_id}")}}" target="_blank"> Consulter la demande jointe.</a><span><br/>
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
					
					<footer>
						@if($article->statut!='Résolu')
						
						<form action=" {{ url('{article}') }} " method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
							  <div class="form-group">
								<label>Message</label>
								<input type="hidden" name="article_id" value="{{ $article->id }}" />
								<textarea name="content" rows=7 id="ccomment" class="form-control"></textarea>
								@error('content')
								<div class="invalid-feedback">{{ $errors->first('content') }} </div>
								@enderror
							  </div>
							   <div class="form-group">
									<label class="">Pièce Jointe</label>
									 
									<input type="file" class="default" name="images" alt="@lang('lang.Pièce Jointe')">
									 
							   </div>
							   <div class="form-group">
									<label class="">Joindre une demande résolue</label><br/>
									<button type="button" class="btn btn-theme02" data-toggle="modal" data-target="#myModal"><i class="fa fa-paperclip"></i> Selectionner</button>
									<span class="label label-default" id="request-title"></span>
									
									<input type="hidden" id="request-id" name="articlejoint_id" />
									 
							   </div>
							  <div class="form-group">
								<button class="btn btn-theme" style="float:right;" type="submit">@lang('lang.Envoyer')</button>
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
	  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													<h4 class="modal-title">Joindre une demande résolue</h4>
												</div>
												<div class="modal-body">
													<div class="example-box-wrapper" id="accordion">
													 @foreach($articlesresolues as $r)
														<div class="panel-group" >
															<div class="panel">
																<div class="panel-heading">
																	<h4 class="panel-title">
																		<input type="hidden" id="{{$r->id}}"  value="{{$r->titre}}" />
																		<input type="radio" name="requete" class="list-child" value="{{$r->id}}" />
																		<a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$r->id}}" aria-expanded="false" class="collapsed">
																			{{$r->titre}}
																		</a>
																	</h4>
																</div>
																<div id="collapse{{$r->id}}" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
																	<div class="panel-body">
																		{{$r->contenu}}
																	</div>
																</div>
															</div> 
															
														</div>
													@endforeach
													
													</div>
													<ul class="pagination">
													<?php for($i=1; $i<=$total_pages; $i++) { ?>
													<li class="page-item" id="page-item-<?php echo $i; ?>" onclick="paginate('{{route('admin.paginate',['page'=>$i])}}', {{$i}})" ><span class="page-link"><?php echo $i; ?></span></li>
                                                    <!--  aria-current="page" span class="pagination_link" onclick="paginate('{{route('admin.paginate',['page'=>$i])}}')" style="cursor:pointer; padding:6px; border:1px solid #ccc;" id="<?php echo $i; ?>"><?php echo $i; ?></span-->
													<?php } ?>
													</ul>
												</div>
												<div class="modal-footer">
													
													<button type="button" class="btn btn-theme" onclick="addRequest();">Joindre</button>
												</div>
											</div>
										</div>
									</div>
    </section>

    <!-- Scripts -->
    <style>
	.page-item{
		cursor:pointer;
	}
    </style>
  <script src="{{ asset('js/app.js') }}"></script>

  <script type="text/javascript">
  function paginate(url, id){
	    $.ajax({
           type: "get",
           url: url,
           //data: form.serialize(), // serializes the form's elements.
           success: function(data)
           {
			   console.log(id);
              // $("#accordion").html(""); // show response from the php script.
              $("#accordion").html(data); 
              $(".page-item").removeClass("active"); 
              $("#page-item-"+id).addClass("active"); 
           }
         });
  }
  function addRequest(){
	  var id=$('input[name="requete"]:checked').val();
	  // alert(id);
	  if (id!=undefined){
		$("#request-title").html($("#"+id).val()+" <button class='close1'  type='button' onclick='removeRequest()'><i class='fa fa-times'></i></button>");
		$("#request-id").val(id);
	  }
	  $('#myModal').modal('hide');
	  $('#myModal').removeClass('show');
	  // $('#myModal .close').click();
	  $('.modal-backdrop').remove();
  }
  
  function removeRequest(){
	  // var id=$('input[name="requete"]:checked').val();
	  // alert(id);
	  $("#request-title").text("");
	  $("#request-id").val("");
	 
  }
    //wysihtml5 start

    // $('.wysihtml5').wysihtml5();

    //wysihtml5 end
  </script>
    @endsection