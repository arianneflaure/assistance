<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!--script src="{{ asset('js/app.js') }}" defer></script-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('lib/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<!--external css-->
	<link href="{{ asset('lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
	<!-- Custom styles for this template -->
	<link href="{{ asset('css/style.css')}}" rel="stylesheet">
	<link href="{{ asset('css/style-responsive.css')}}" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-fileupload/bootstrap-fileupload.css')}}" />
	<!--link href="{{ asset('lib/bootstrap-wysihtml5/bootstrap-wysihtml5.css')}}" rel="stylesheet"-->
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-datepicker/css/datepicker.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-timepicker/compiled/timepicker.css')}}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-datetimepicker/datertimepicker.css')}}" />

   
</head>

<body>
    <section id="container">
    <!-- **********************************************************************************************************************************************************
                TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
        <header class="header black-bg">
            <!--div class="sidebar-toggle-box">
                <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
            </div-->
            <!--logo start-->
            <a href="#" class="logo"><b>ASSISTANCE EN <span>LIGNE</span></b></a>
            <!--logo end-->
       
            <div class="top-menu">
			
					    <!--ul class="nav pull-right top-menu">
						<li class="nav-item dropdown">
							<a class="logout" href="#" id="navbarDropdownFlag" role="button" data-toggle="dropdown"
								aria-haspopup="true" aria-expanded="false"><!--@lang('lang.Changer de langue') --  
								<img width="20" height="20" alt="{{ session('locale') }}"
										src="{!! asset('img/flags/' . session('locale') . '-flag.png') !!}"/>
							</a>
							<div id="flags" class="dropdown-menu" aria-labelledby="navbarDropdownFlag">
								@foreach(config('app.locales') as $locale)
									@if($locale != session('locale'))
										<a class="logout" href="{{ route('language', $locale) }}"><!--@lang('lang.Selectionner ')--
											<img width="20" height="20" alt="{{ session('locale') }}"
													src="{!! asset('img/flags/' . $locale . '-flag.png') !!}"/>
										</a>
									@endif
								@endforeach
							<!--/div>
						 </li>
						 </ul--> 
	 
                    <ul class="nav pull-right top-menu">
					@foreach(config('app.locales') as $locale)
						@if($locale != session('locale'))
						<li>
										<a class="logout" style="background: none; border: 0px !important;" href="{{ route('language', $locale) }}"><!--@lang('lang.Selectionner ')-->
											<img width="20" height="20" alt="{{ session('locale') }}"
													src="{!! asset('img/flags/' . $locale . '-flag.png') !!}"/>
										</a>
						</li>
						@endif
					@endforeach
						<li><a class="logout" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a><form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
					</li>
                    </ul>
                </div>
        </header>
                            
        <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <!--ul class="sidebar-menu" id="nav-accordion"-->
        <div class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href=""><i class="fa fa-user" style="font-size: 40px;"></i></a></p>
          @if(Auth::check()) 
          <h5 class="centered" style="color:#32323a;">{{auth()->user()->name}}</h5>
          @if(auth()->user()->role==='user')
          <!--h5 class="centered">je suis Utilisateur</h5-->
			<div class="panel-body">
			 <a href="{{ route('articles.create') }}" class="btn btn-compose">
				<i class="fa fa-pencil"></i>  @lang('lang.Nouvelle Demande')
			 </a>
			  <ul class="nav nav-pills nav-stacked mail-nav">
					
					  <li <?php if(!isset($_GET["statut"])) { ?> class="active" <?php } ?>><a href="{{ route('articles.index') }}"> <i class="fa fa-inbox"></i> @lang('lang.Toutes les demandes')  <span class="label label-theme pull-right inbox-notification">{{$count}}</span></a></li>
					  <li <?php if(isset($_GET["statut"]) && $_GET["statut"]=='Non Résolu') { ?> class="active" <?php } ?> ><a href="{{ route('articles.index',['statut'=>'Non Résolu']) }}"><i class="fa fa-envelope-o"></i> @lang('lang.Demandes Non Résolues')  <span class="label label-theme pull-right inbox-notification">{{$countnonresolu}}</span></a></li>
					  <li <?php if(isset($_GET["statut"]) && $_GET["statut"]=='Résolu') { ?> class="active" <?php } ?> ><a href="{{ route('articles.index',['statut'=>'Résolu']) }}"> <i class="fa fa-file-text-o"></i> @lang('lang.Demandes Résolues')  <span class="label label-theme pull-right inbox-notification">{{$countresolu}}</span></a></li>
				
			   </ul>
			 
			</div>
          
         
          @else
          <!--h5 class="centered"> je suis Admin</h5-->
		  <div class="panel-body">
			
		   <ul class="nav nav-pills nav-stacked mail-nav">
						
					  <li <?php if(Route::currentRouteName()=="admin") { ?> class="active" <?php } ?>><a href="{{ route('admin') }}" > <i class="fa fa-dashboard"></i> @lang('lang.Tableau de bord') </a></li>
					  <li <?php if(!isset($_GET["priorite"]) && (Route::currentRouteName()!="admin")) { ?> class="active" <?php } ?>><a href="{{ route('admin.articles') }}"> <i class="fa fa-inbox"></i> @lang('lang.Toutes les demandes')  <span class="label label-theme pull-right inbox-notification">{{$countadmin}}</span></a></li>
					  <li <?php if(isset($_GET["priorite"]) && $_GET["priorite"]=='Très Urgent') { ?> class="active" <?php } ?> ><a href="{{ route('admin.articles',['priorite'=>'Très Urgent']) }}"><i class="fa fa-envelope-o"></i> @lang('lang.Demandes Très Urgentes')  <span class="label label-theme pull-right inbox-notification">{{$countadmintresurgent}}</span></a></li>
            <li <?php if(isset($_GET["priorite"]) && $_GET["priorite"]=='Urgent') { ?> class="active" <?php } ?> ><a href="{{ route('admin.articles',['priorite'=>'Urgent']) }}"> <i class="fa fa-file-text-o"></i> @lang('lang.Demandes Urgentes')   <span class="label label-theme pull-right inbox-notification">{{$countadminurgent}}</span></a></li>
					  <li <?php if(isset($_GET["priorite"]) && $_GET["priorite"]=='Intermediaire') { ?> class="active" <?php } ?> ><a href="{{ route('admin.articles',['priorite'=>'Intermediaire']) }}"> <i class="fa fa-tasks"></i> @lang('lang.Demandes Intermediaires')  <span class="label label-theme pull-right inbox-notification">{{$countadminintermediaire}}</span></a></li>
				
			</ul>
			</div> 
          
          @endif
  @endif
		
      </div>
      </div>
    </aside>
    
      
                        
                    
            @yield('content')
                    
                

            </section>
            <script type="text/javascript">
    /*$(document).ready(function() {
      var unique_id = $.gritter.add({
        // (string | mandatory) the heading of the notification
        title: 'Welcome to Dashio!',
        // (string | mandatory) the text inside the notification
        text: 'Hover me to enable the Close Button. You can hide the left sidebar clicking on the button next to the logo. Developed by <a href="http://alvarez.is" target="_blank" style="color:#4ECDC4">Alvarez.is</a>.',
        // (string | optional) the image to display on the left
        image: 'img/ui-sam.jpg',
        // (bool | optional) if you want it to fade out on its own or just sit there
        sticky: false,
        // (int | optional) the time you want it to be alive for before fading out
        time: 8000,
        // (string | optional) the class name you want to apply to that specific message
        class_name: 'my-sticky-class'
      });

      return false;
    });*/
  </script>
  <script type="application/javascript">
   /* $(document).ready(function() {
      $("#date-popover").popover({
        html: true,
        trigger: "manual"
      });
      $("#date-popover").hide();
      $("#date-popover").click(function(e) {
        $(this).hide();
      });

      /*$("#my-calendar").zabuto_calendar({
        action: function() {
          return myDateFunction(this.id, false);
        },
        action_nav: function() {
          return myNavFunction(this.id);
        },
        ajax: {
          url: "show_data.php?action=1",
          modal: true
        },
        legend: [{
            type: "text",
            label: "Special event",
            badge: "00"
          },
          {
            type: "block",
            label: "Regular event",
          }
        ]
      });
    });*/

    function myNavFunction(id) {
      $("#date-popover").hide();
      var nav = $("#" + id).data("navigation");
      var to = $("#" + id).data("to");
      console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
	
	
  </script>
  
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{ asset('lib/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{ asset('lib/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{ asset('lib/jquery.scrollTo.min.js')}}"></script>
  <!--script src="{{ asset('lib/jquery.sparkline.js')}}"></script-->
  <script src="{{ asset('lib/jquery.nicescroll.js')}}" type="text/javascript"></script>
  
  <!--common script for all pages-->
  <!--script type="text/javascript" src="{{ asset('lib/common-scripts.js')}}"></script-->
  <!--script type="text/javascript" src="{{ asset('lib/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script-->
  
  <!--script for dashboard-->
   <!--script for this page-->
  <script type="text/javascript" src="{{ asset('lib/jquery-ui-1.9.2.custom.min.js')}}"></script>

  <script type="text/javascript" src="{{ asset('lib/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-daterangepicker/date.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-daterangepicker/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
  <script src="{{ asset('lib/advanced-form-components.js')}}"></script>

  <!--script type="text/javascript" src="{{ asset('lib/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
  <script type="text/javascript" src="{{ asset('lib/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script-->
  

  <script type="text/javascript">
    //wysihtml5 start

   // $('.wysihtml5').wysihtml5();

    //wysihtml5 end
  </script>
  </body>

</html>
