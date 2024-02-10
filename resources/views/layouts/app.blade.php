<!DOCTYPE html>
<html lang="en-us">
	<head>
		<meta charset="utf-8">
		<title>{{ config('app.name', 'Laravel') }}</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="">
		<meta name="author" content="">
			
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- #CSS Links -->
		<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/font-awesome.min.css')}}">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-production-plugins.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-production.min.css')}}">
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-skins.min.css')}}">

		<!-- SmartAdmin RTL Support -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/smartadmin-rtl.min.css')}}"> 

		<!-- We recommend you use "your_style.css" to override SmartAdmin
		     specific styles this will also ensure you retrain your customization with each SmartAdmin update.
		<link rel="stylesheet" type="text/css" media="screen" href="css/your_style.css"> -->

		<!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
		<link rel="stylesheet" type="text/css" media="screen" href="{{asset('css/demo.min.css')}}">

		<!-- #FAVICONS -->
		<link rel="shortcut icon" href="{{asset('img/favicon/favicon.ico')}}" type="image/x-icon">
		<link rel="icon" href="{{asset('img/favicon/favicon.ico')}}" type="image/x-icon">

		<!-- #GOOGLE FONT -->
		<link rel="stylesheet" href="{{asset('http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700')}}">

		<!-- #APP SCREEN / ICONS -->
		<!-- Specifying a Webpage Icon for Web Clip 
			 Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
		<link rel="apple-touch-icon" href="{{asset('img/splash/sptouch-icon-iphone.png')}}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/splash/touch-icon-ipad.png')}}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{asset('img/splash/touch-icon-iphone-retina.png')}}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{asset('img/splash/touch-icon-ipad-retina.png')}}">
		
		<!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		
		<!-- Startup image for web apps -->
		<link rel="apple-touch-startup-image" href="{{asset('img/splash/ipad-landscape.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
		<link rel="apple-touch-startup-image" href="{{asset('img/splash/ipad-portrait.png')}}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
		<link rel="apple-touch-startup-image" href="{{asset('img/splash/iphone.png')}}" media="screen and (max-device-width: 320px)">

	</head>

	<!--

	TABLE OF CONTENTS.
	
	Use search to find needed section.
	
	===================================================================
	
	|  01. #CSS Links                |  all CSS links and file paths  |
	|  02. #FAVICONS                 |  Favicon links and file paths  |
	|  03. #GOOGLE FONT              |  Google font link              |
	|  04. #APP SCREEN / ICONS       |  app icons, screen backdrops   |
	|  05. #BODY                     |  body tag                      |
	|  06. #HEADER                   |  header tag                    |
	|  07. #PROJECTS                 |  project lists                 |
	|  08. #TOGGLE LAYOUT BUTTONS    |  layout buttons and actions    |
	|  09. #MOBILE                   |  mobile view dropdown          |
	|  10. #SEARCH                   |  search field                  |
	|  11. #NAVIGATION               |  left panel & navigation       |
	|  12. #MAIN PANEL               |  main panel                    |
	|  13. #MAIN CONTENT             |  content holder                |
	|  14. #PAGE FOOTER              |  page footer                   |
	|  15. #SHORTCUT AREA            |  dropdown shortcuts area       |
	|  16. #PLUGINS                  |  all scripts and plugins       |
	
	===================================================================
	
	-->
	
	<!-- #BODY -->
	<!-- Possible Classes

		* 'smart-style-{SKIN#}'
		* 'smart-rtl'         - Switch theme mode to RTL
		* 'menu-on-top'       - Switch to top navigation (no DOM change required)
		* 'no-menu'			  - Hides the menu completely
		* 'hidden-menu'       - Hides the main menu but still accessable by hovering over left edge
		* 'fixed-header'      - Fixes the header
		* 'fixed-navigation'  - Fixes the main menu
		* 'fixed-ribbon'      - Fixes breadcrumb
		* 'fixed-page-footer' - Fixes footer
		* 'container'         - boxed layout mode (non-responsive: will not work with fixed-navigation & fixed-ribbon)
	-->
	<body class="">

		<!-- #HEADER -->
		@auth
		<header id="header">

			<!-- #TOGGLE LAYOUT BUTTONS -->
			<!-- pulled right: nav area -->
			<div class="pull-right">
				
				<!-- collapse menu button -->
				<div id="hide-menu" class="btn-header pull-right">
					<span> <a href="javascript:void(0);" data-action="toggleMenu" title="Collapse Menu"><i class="fa fa-reorder"></i></a> </span>
				</div>
				<!-- end collapse menu -->
				
				<!-- #MOBILE -->
				<!-- Top menu profile link : this shows only when top menu is active -->
				<ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
					<li class="">
						<a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown"> 
							<img src="{{asset('img/avatars/sunny.png')}}" alt="John Doe" class="online" />  
						</a>
						<ul class="dropdown-menu pull-right">
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="profile.html" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="login.html" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
							</li>
						</ul>
					</li>
				</ul>

				<!-- logout button -->
				
				<div id="logout" class="btn-header transparent pull-right">
					<span> <a id = "logoutBtn" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> logout</span>
					<form action="{{route('logout')}}" id = "myForm" style = "display:none" method = "POST">
					@csrf
					</form>
					
				</div>
				
				<!-- end logout button -->

				<!-- search mobile button (this is hidden till mobile view port) -->
				<div id="search-mobile" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
				</div>
				<!-- end search mobile button -->
				
				<!-- #SEARCH -->
				<!-- input: search field -->
				
				<!-- end input: search field -->

				<!-- fullscreen button -->
				<div id="fullscreen" class="btn-header transparent pull-right">
					<span> <a href="javascript:void(0);" data-action="launchFullscreen" title="Full Screen"><i class="fa fa-arrows-alt"></i></a> </span>
				</div>
				<!-- end fullscreen button -->
				
				<!-- #Voice Command: Start Speech -->
				
				<!-- end voice command -->

				<!-- multiple lang dropdown : find all flags in the flags page -->
				
				<!-- end multiple lang -->

			</div>
			<!-- end pulled right: nav area -->

		</header>

		<!-- END HEADER -->

		<!-- #NAVIGATION -->
		<!-- Left panel : Navigation area -->
		<!-- Note: This width of the aside area can be adjusted through LESS variables -->
		<aside id="left-panel">

			<!-- User info -->
			
			<!-- end user info -->

			<nav>
				<!-- 
				NOTE: Notice the gaps after each icon usage <i></i>..
				Please note that these links work a bit different than
				traditional href="" links. See documentation for details.
				-->

				<ul>
					<li>
						<a href="{{route('home')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Home</span></a>	
					</li>
					<li>
						<a href="{{route('leaveRequest')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Request a leave</span></a>	
					</li>
					@if(auth()->user()->isAdmin())
					<li>
						<a href="{{route('roles.index')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Roles</span></a>	
					</li>
					<li>
						<a href="{{route('leaveRequestAdmin')}}" title="Dashboard"><i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Leave Requests</span></a>	
					</li>
					<li>
						<a href="{{route('users.index')}}"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Users</span> <span class="badge pull-right inbox-badge margin-right-13">14</span></a>
					</li>
					@endif
				</ul>
			</nav>
			

			<span class="minifyme" data-action="minifyMenu"> 
				<i class="fa fa-arrow-circle-left hit"></i> 
			</span>

		</aside>
		<!-- END NAVIGATION -->
		@endauth
		<!-- MAIN PANEL -->
		<div id="main" role="main">
		
			<!-- RIBBON -->
			<div id="ribbon">

				<span class="ribbon-button-alignment"> 
					
				</span>

				<!-- breadcrumb -->
				
				<!-- end breadcrumb -->

				<!-- You can also add more buttons to the
				ribbon for further usability

				Example below:

				<span class="ribbon-button-alignment pull-right">
				<span id="search" class="btn btn-ribbon hidden-xs" data-title="search"><i class="fa-grid"></i> Change Grid</span>
				<span id="add" class="btn btn-ribbon hidden-xs" data-title="add"><i class="fa-plus"></i> Add</span>
				<span id="search" class="btn btn-ribbon" data-title="search"><i class="fa-search"></i> <span class="hidden-mobile">Search</span></span>
				</span> -->

			</div>
			<!-- END RIBBON -->
			
			

			<!-- MAIN CONTENT -->
			<div id="content">
				@yield('content')
			</div>
			<!-- END MAIN CONTENT -->

		</div>
		
		<!-- END MAIN PANEL -->

		<!-- PAGE FOOTER -->
		<div class="page-footer">
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<span class="txt-color-white">SmartAdmin 1.8.2 <span class="hidden-xs"> - Web Application Framework</span> © 2014-2015</span>
				</div>

				<div class="col-xs-6 col-sm-6 text-right hidden-xs">
					<div class="txt-color-white inline-block">
						<i class="txt-color-blueLight hidden-mobile">Last account activity <i class="fa fa-clock-o"></i> <strong>52 mins ago &nbsp;</strong> </i>
						<div class="btn-group dropup">
							<button class="btn btn-xs dropdown-toggle bg-color-blue txt-color-white" data-toggle="dropdown">
								<i class="fa fa-link"></i> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu pull-right text-left">
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Download Progress</p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-success" style="width: 50%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Server Load</p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-success" style="width: 20%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<p class="txt-color-darken font-sm no-margin">Memory Load <span class="text-danger">*critical*</span></p>
										<div class="progress progress-micro no-margin">
											<div class="progress-bar progress-bar-danger" style="width: 70%;"></div>
										</div>
									</div>
								</li>
								<li class="divider"></li>
								<li>
									<div class="padding-5">
										<button class="btn btn-block btn-default">refresh</button>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE FOOTER -->

		<!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
		Note: These tiles are completely responsive,
		you can add as many as you like
		-->
		<div id="shortcut">
			<ul>
				<li>
					<a href="inbox.html" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
				</li>
				<li>
					<a href="calendar.html" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
				</li>
				<li>
					<a href="gmap-xml.html" class="jarvismetro-tile big-cubes bg-color-purple"> <span class="iconbox"> <i class="fa fa-map-marker fa-4x"></i> <span>Maps</span> </span> </a>
				</li>
				<li>
					<a href="invoice.html" class="jarvismetro-tile big-cubes bg-color-blueDark"> <span class="iconbox"> <i class="fa fa-book fa-4x"></i> <span>Invoice <span class="label pull-right bg-color-darken">99</span></span> </span> </a>
				</li>
				<li>
					<a href="gallery.html" class="jarvismetro-tile big-cubes bg-color-greenLight"> <span class="iconbox"> <i class="fa fa-picture-o fa-4x"></i> <span>Gallery </span> </span> </a>
				</li>
				<li>
					<a href="profile.html" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
				</li>
			</ul>
		</div>
		<!-- END SHORTCUT AREA -->

		<!--================================================== -->

		<!-- PACE LOADER - turn this on if you want ajax loading to show (caution: uses lots of memory on iDevices)-->
		{{-- <script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script> --}}

		<!-- Link to Google CDN's jQuery + jQueryUI; fall back to local -->
		<script src="{{asset('js/libs/jquery-2.1.1.min.js')}}"></script>
			
		<script src="{{asset('js/libs/jquery-ui-1.10.3.min.js')}}"></script>

		<!-- IMPORTANT: APP CONFIG -->
		<script src="{{asset('js/app.config.js')}}"></script>

		<!-- JS TOUCH : include this plugin for mobile drag / drop touch events-->
		<script src="{{asset('js/plugin/jquery-touch/jquery.ui.touch-punch.min.js')}}"></script> 

		<!-- BOOTSTRAP JS -->
		<script src="{{asset('js/bootstrap/bootstrap.min.js')}}"></script>

		<!-- CUSTOM NOTIFICATION -->
		<script src="{{asset('js/notification/SmartNotification.min.js')}}"></script>

		<!-- JARVIS WIDGETS -->
		<script src="{{asset('js/smartwidgets/jarvis.widget.min.js')}}"></script>

		<!-- EASY PIE CHARTS -->
		<script src="{{asset('js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js')}}"></script>

		<!-- SPARKLINES -->
		<script src="{{asset('js/plugin/sparkline/jquery.sparkline.min.js')}}"></script>

		<!-- JQUERY VALIDATE -->
		<script src="{{asset('js/plugin/jquery-validate/jquery.validate.min.js')}}"></script>

		<!-- JQUERY MASKED INPUT -->
		<script src="{{asset('js/plugin/masked-input/jquery.maskedinput.min.js')}}"></script>

		<!-- JQUERY SELECT2 INPUT -->
		<script src="{{asset('js/plugin/select2/select2.min.js')}}"></script>

		<!-- JQUERY UI + Bootstrap Slider -->
		<script src="{{asset('js/plugin/bootstrap-slider/bootstrap-slider.min.js')}}"></script>

		<!-- browser msie issue fix -->
		<script src="{{asset('js/plugin/msie-fix/jquery.mb.browser.min.js')}}"></script>

		<!-- FastClick: For mobile devices -->
		<script src="{{asset('js/plugin/fastclick/fastclick.min.js')}}"></script>

		<!--[if IE 8]>

		<h1>Your browser is out of date, please update your browser by going to www.microsoft.com/download</h1>

		<![endif]-->

		<!-- Demo purpose only -->
		<script src="{{asset('js/demo.min.js')}}"></script>

		<!-- MAIN APP JS FILE -->
		<script src="{{asset('js/app.min.js')}}"></script>

		<!-- ENHANCEMENT PLUGINS : NOT A REQUIREMENT -->
		<!-- Voice command : plugin -->
		<script src="{{asset('js/speech/voicecommand.min.js')}}"></script>

		<!-- SmartChat UI : plugin -->
		<script src="{{asset('js/smart-chat-ui/smart.chat.ui.min.js')}}"></script>
		<script src="{{asset('js/smart-chat-ui/smart.chat.manager.min.js')}}"></script>

		<!-- PAGE RELATED PLUGIN(S) 
		<script src="..."></script>-->

		<script type="text/javascript">

document.addEventListener("DOMContentLoaded", function(event) { 
    pageSetUp()
});
		
		// $(window).load(function() {


				
		// 		/* DO NOT REMOVE : GLOBAL FUNCTIONS!
		// 		 *
		// 		 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
		// 		 *pageSetUp
		// 		 * // activate tooltips
		// 		 * $("[rel=tooltip]").tooltip();
		// 		 *
		// 		 * // activate popovers
		// 		 * $("[rel=popover]").popover();
		// 		 *
		// 		 * // activate popovers with hover states
		// 		 * $("[rel=popover-hover]").popover({ trigger: "hover" });
		// 		 *
		// 		 * // activate inline charts
		// 		 * runAllCharts();
		// 		 *
		// 		 * // setup widgets
		// 		 * setup_widgets_desktop();
		// 		 *
		// 		 * // run form elements
		// 		 * runAllForms();
		// 		 *
		// 		 ********************************
		// 		 *
		// 		 * pageSetUp() is needed whenever you load a page.
		// 		 * It initializes and checks for all basic elements of the page
		// 		 * and makes rendering easier.
		// 		 *
		// 		 */
				
		// 		 pageSetUp();
		// 		//  document.getElementById("logoutBtn").addEventListener("click",function(e) {
		// 		// 	e.preventDefault(); // cancel the link
		// 		// 	document.getElementById("myForm").submit(); // but make sure nothing has name or ID="submit"
		// 		// });
				 
		// 		/*
		// 		 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
		// 		 * eg alert("my home function");
		// 		 * 
		// 		 * var pagefunction = function() {
		// 		 *   ...
		// 		 * }
		// 		 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
		// 		 * 
		// 		 * TO LOAD A SCRIPT:
		// 		 * var pagefunction = function (){ 
		// 		 *  loadScript(".../plugin.js", run_after_loaded);	
		// 		 * }
		// 		 * 
		// 		 * OR
		// 		 * 
		// 		 * loadScript(".../plugin.js", run_after_loaded);
		// 		 */
				
		// 	})
		
		</script>

		<!-- Your GOOGLE ANALYTICS CODE Below -->
		<script type="text/javascript">
			var _gaq = _gaq || [];
				_gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
				_gaq.push(['_trackPageview']);
			
			(function() {
				var ga = document.createElement('script');
				ga.type = 'text/javascript';
				ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
			})();

		</script>

	</body>

</html>