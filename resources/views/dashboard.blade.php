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
                    
                    <!--form method="POST" action="" class="pull-right mail-src-position">
                      {{ csrf_field() }}
                      <div class="input-append">
                        <input type="text" class="form-control " name="filter"  placeholder="Chercher une requête">
                      </div>
                    </form-->
                </h4>
              </header>
              <div class="panel-body minimal">
               
              
            </section>
          </div>
@endsection