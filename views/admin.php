<!DOCTYPE html>
<html lang="en">

<!--================================================================================
	Item Name: Materialize - Material Design Admin Template
	Version: 3.1
	Author: GeeksLabs
	Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="msapplication-tap-highlight" content="no">
<meta name="description"
	content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
<meta name="keywords"
	content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
<title>Materialize - Material Design Admin Template</title>

<!-- Favicons-->
<link rel="icon" href="images/favicon/favicon-32x32.png" sizes="32x32">
<!-- Favicons-->
<link rel="apple-touch-icon-precomposed"
	href="images/favicon/apple-touch-icon-152x152.png">
<!-- For iPhone -->
<meta name="msapplication-TileColor" content="#00bcd4">
<meta name="msapplication-TileImage"
	content="images/favicon/mstile-144x144.png">
<!-- For Windows Phone -->


<!-- CORE CSS-->
<link href="css/materialize.min.css" type="text/css" rel="stylesheet"
	media="screen,projection">
<link href="css/style.min.css" type="text/css" rel="stylesheet"
	media="screen,projection">
<!-- Custome CSS-->
<link href="css/custom/custom.min.css" type="text/css" rel="stylesheet"
	media="screen,projection">


<!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
<link href="js/plugins/perfect-scrollbar/perfect-scrollbar.css"
	type="text/css" rel="stylesheet" media="screen,projection">
<link href="js/plugins/jvectormap/jquery-jvectormap.css" type="text/css"
	rel="stylesheet" media="screen,projection">
<link href="js/plugins/chartist-js/chartist.min.css" type="text/css"
	rel="stylesheet" media="screen,projection">

</head>

<body>
	<!-- Start Page Loading -->
	<div id="loader-wrapper">
		<div id="loader"></div>
		<div class="loader-section section-left"></div>
		<div class="loader-section section-right"></div>
	</div>
	<!-- End Page Loading -->

	<!-- //////////////////////////////////////////////////////////////////////////// -->

	<!-- START HEADER -->
	<header id="header" class="page-topbar">
		<!-- start header nav-->
		<div class="navbar-fixed">
			<nav class="navbar-color">
				<div class="nav-wrapper">
					<ul class="left">
						<li><h1 class="logo-wrapper">
								<a href="index.html" class="brand-logo darken-1"><img
									src="images/materialize-logo.png" alt="materialize logo"></a> <span
									class="logo-text">Materialize</span>
							</h1></li>
					</ul>
					<div class="header-search-wrapper hide-on-med-and-down">
						<i class="mdi-action-search"></i> <input type="text" name="Search"
							class="header-search-input z-depth-2"
							placeholder="Explore Materialize" />
					</div>
					<ul class="right hide-on-med-and-down">
						<li><a href="javascript:void(0);"
							class="waves-effect waves-block waves-light toggle-fullscreen"><i
								class="mdi-action-settings-overscan"></i></a></li>
						<li><a href="javascript:void(0);"
							class="waves-effect waves-block waves-light notification-button"
							data-activates="notifications-dropdown"><i
								class="mdi-social-notifications"><small
									class="notification-badge">5</small></i> </a></li>
						<li><a href="#" data-activates="chat-out"
							class="waves-effect waves-block waves-light chat-collapse"><i
								class="mdi-communication-chat"></i></a></li>
						<li><a href="index.php?logout"
							class="waves-effect waves-block waves-light"><i
								class="mdi-action-settings-power"></i></a></li>
					</ul>

					<!-- notifications-dropdown -->
					<ul id="notifications-dropdown" class="dropdown-content">
						<li>
							<h5>
								NOTIFICATIONS <span class="new badge">5</span>
							</h5>
						</li>
						<li class="divider"></li>
						<li><a href="#!"><i class="mdi-action-add-shopping-cart"></i> A
								new order has been placed!</a> <time class="media-meta"
								datetime="2015-06-12T20:50:48+08:00">2 hours ago</time></li>
						<li><a href="#!"><i class="mdi-action-stars"></i> Completed the
								task</a> <time class="media-meta"
								datetime="2015-06-12T20:50:48+08:00">3 days ago</time></li>
						<li><a href="#!"><i class="mdi-action-settings"></i> Settings
								updated</a> <time class="media-meta"
								datetime="2015-06-12T20:50:48+08:00">4 days ago</time></li>
						<li><a href="#!"><i class="mdi-editor-insert-invitation"></i>
								Director meeting started</a> <time class="media-meta"
								datetime="2015-06-12T20:50:48+08:00">6 days ago</time></li>
						<li><a href="#!"><i class="mdi-action-trending-up"></i> Generate
								monthly report</a> <time class="media-meta"
								datetime="2015-06-12T20:50:48+08:00">1 week ago</time></li>
					</ul>
				</div>
			</nav>
		</div>
		<!-- end header nav-->
	</header>
	<!-- END HEADER -->

	<!-- //////////////////////////////////////////////////////////////////////////// -->

	<!-- START MAIN -->
	<div id="main">
		<!-- START WRAPPER -->
		<div class="wrapper">

			<!-- START LEFT SIDEBAR NAV-->
			<aside id="left-sidebar-nav">
				<ul id="slide-out" class="side-nav fixed leftside-navigation"
					style="margin-top: 1%">
					<li class="user-details cyan darken-2">
						<div class="row">
							<div class="col col s4 m4 l4">
								<img src="images/avatar.jpg" alt=""
									class="circle responsive-img valign profile-image">
							</div>
							<div class="col col s8 m8 l8">
								<ul id="profile-dropdown" class="dropdown-content">
									<li><a href="#"><i class="mdi-action-face-unlock"></i> Profile</a>
									</li>
									<li><a href="#"><i class="mdi-action-settings"></i> Settings</a>
									</li>
									<li><a href="#"><i class="mdi-communication-live-help"></i>
											Help</a></li>
									<li class="divider"></li>
									<li><a href="#"><i class="mdi-action-lock-outline"></i> Lock</a>
									</li>
									<li><a href="#"><i class="mdi-hardware-keyboard-tab"></i>
											Logout</a></li>
								</ul>
								<a
									class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn"
									href="#" data-activates="profile-dropdown"> <?php echo $_SESSION['user_name']; ?> <i
									class="mdi-navigation-arrow-drop-down right"></i></a>
								<p class="user-roal">Administrator</p>
							</div>
						</div>
					</li>
					<li class="bold active"><a href="index.html"
						class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i>
							Dashboard</a></li>


					<li class="bold"><a href="app-calendar.html"
						class="waves-effect waves-cyan"><i
							class="mdi-editor-insert-invitation"></i> Calendario</a></li>
					<li class="no-padding">
						<ul class="collapsible collapsible-accordion">

							<li class="bold"><a
								class="collapsible-header  waves-effect waves-cyan"><i
									class="mdi-social-pages"></i> Pages</a>
								<div class="collapsible-body">
									<ul>
										<li><a href="page-todo.html">ToDos</a></li>
									</ul>
								</div></li>
			
							<li class="bold"><a
								class="collapsible-header  waves-effect waves-cyan"><i
									class="mdi-action-account-circle"></i> Usuarios</a>
								<div class="collapsible-body">
									<ul>
										<li><a href="user-profile-page.html">Perfiles</a></li>
										<li><a href="user-register.html">Registrar Nuevos</a></li>
									</ul>
								</div></li>
						</ul>
					</li>
					
				</ul>
				<a href="#" data-activates="slide-out"
					class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i
					class="mdi-navigation-menu"></i></a>
			</aside>
			<!-- END LEFT SIDEBAR NAV-->

			<!-- //////////////////////////////////////////////////////////////////////////// -->

			<!-- START CONTENT -->
			<section id="content">

				<!--start container-->
				<div class="container">


					<!-- //////////////////////////////////////////////////////////////////////////// -->

					<!--card stats start-->
					<div id="card-stats">
						<div class="row">
							<div class="col s12 m6 l3">
								<div class="card">
									<div class="card-content  green white-text">
										<p class="card-stats-title">
											<i class="mdi-social-group-add"></i> New Clients
										</p>
										<h4 class="card-stats-number">566</h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span
												class="green-text text-lighten-5">from yesterday</span>
										</p>
									</div>
									<div class="card-action  green darken-2">
										<div id="clients-bar" class="center-align"></div>
									</div>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="card">
									<div class="card-content pink lighten-1 white-text">
										<p class="card-stats-title">
											<i class="mdi-editor-insert-drive-file"></i> New Invoice
										</p>
										<h4 class="card-stats-number">1806</h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span
												class="deep-purple-text text-lighten-5">from last month</span>
										</p>
									</div>
									<div class="card-action  pink darken-2">
										<div id="invoice-line" class="center-align"></div>
									</div>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="card">
									<div class="card-content blue-grey white-text">
										<p class="card-stats-title">
											<i class="mdi-action-trending-up"></i> Today Profit
										</p>
										<h4 class="card-stats-number">$806.52</h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span
												class="blue-grey-text text-lighten-5">from yesterday</span>
										</p>
									</div>
									<div class="card-action blue-grey darken-2">
										<div id="profit-tristate" class="center-align"></div>
									</div>
								</div>
							</div>
							<div class="col s12 m6 l3">
								<div class="card">
									<div class="card-content purple white-text">
										<p class="card-stats-title">
											<i class="mdi-editor-attach-money"></i>Total Sales
										</p>
										<h4 class="card-stats-number">$8990.63</h4>
										<p class="card-stats-compare">
											<i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span
												class="purple-text text-lighten-5">last month</span>
										</p>
									</div>
									<div class="card-action purple darken-2">
										<div id="sales-compositebar" class="center-align"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--card stats end-->

					<!-- //////////////////////////////////////////////////////////////////////////// -->

			
						<!-- //////////////////////////////////////////////////////////////////////////// -->

						<!--work collections start-->
						<div id="work-collections">
							<div class="row">
								<div class="col s12 m12 l6">
									<ul id="projects-collection" class="collection">
										<li class="collection-item avatar"><i
											class="mdi-file-folder circle light-blue darken-2"></i> <span
											class="collection-header">Projects</span>
											<p>Your Favorites</p> <a href="#" class="secondary-content"><i
												class="mdi-action-grade"></i></a></li>
										<li class="collection-item">
											<div class="row">
												<div class="col s6">
													<p class="collections-title">Web App</p>
													<p class="collections-content">AEC Company</p>
												</div>
												<div class="col s3">
													<span class="task-cat cyan">Development</span>
												</div>
												<div class="col s3">
													<div id="project-line-1"></div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s6">
													<p class="collections-title">Mobile App for Social</p>
													<p class="collections-content">iSocial App</p>
												</div>
												<div class="col s3">
													<span class="task-cat grey darken-3">UI/UX</span>
												</div>
												<div class="col s3">
													<div id="project-line-2"></div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s6">
													<p class="collections-title">Website</p>
													<p class="collections-content">MediTab</p>
												</div>
												<div class="col s3">
													<span class="task-cat teal">Marketing</span>
												</div>
												<div class="col s3">
													<div id="project-line-3"></div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s6">
													<p class="collections-title">AdWord campaign</p>
													<p class="collections-content">True Line</p>
												</div>
												<div class="col s3">
													<span class="task-cat green">SEO</span>
												</div>
												<div class="col s3">
													<div id="project-line-4"></div>
												</div>
											</div>
										</li>
									</ul>
								</div>
								<div class="col s12 m12 l6">
									<ul id="issues-collection" class="collection">
										<li class="collection-item avatar"><i
											class="mdi-action-bug-report circle red darken-2"></i> <span
											class="collection-header">Issues</span>
											<p>Assigned to you</p> <a href="#" class="secondary-content"><i
												class="mdi-action-grade"></i></a></li>
										<li class="collection-item">
											<div class="row">
												<div class="col s7">
													<p class="collections-title">
														<strong>#102</strong> Home Page
													</p>
													<p class="collections-content">Web Project</p>
												</div>
												<div class="col s2">
													<span class="task-cat pink accent-2">P1</span>
												</div>
												<div class="col s3">
													<div class="progress">
														<div class="determinate" style="width: 70%"></div>
													</div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s7">
													<p class="collections-title">
														<strong>#108</strong> API Fix
													</p>
													<p class="collections-content">API Project</p>
												</div>
												<div class="col s2">
													<span class="task-cat yellow darken-4">P2</span>
												</div>
												<div class="col s3">
													<div class="progress">
														<div class="determinate" style="width: 40%"></div>
													</div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s7">
													<p class="collections-title">
														<strong>#205</strong> Profile page css
													</p>
													<p class="collections-content">New Project</p>
												</div>
												<div class="col s2">
													<span class="task-cat light-green darken-3">P3</span>
												</div>
												<div class="col s3">
													<div class="progress">
														<div class="determinate" style="width: 95%"></div>
													</div>
												</div>
											</div>
										</li>
										<li class="collection-item">
											<div class="row">
												<div class="col s7">
													<p class="collections-title">
														<strong>#188</strong> SAP Changes
													</p>
													<p class="collections-content">SAP Project</p>
												</div>
												<div class="col s2">
													<span class="task-cat pink accent-2">P1</span>
												</div>
												<div class="col s3">
													<div class="progress">
														<div class="determinate" style="width: 10%"></div>
													</div>
												</div>
											</div>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<!--work collections end-->

						<!-- Floating Action Button -->
						<div class="fixed-action-btn" style="bottom: 50px; right: 19px;">
							<a class="btn-floating btn-large"> <i class="mdi-action-stars"></i>
							</a>
							<ul>
								<li><a href="css-helpers.html" class="btn-floating red"><i
										class="large mdi-communication-live-help"></i></a></li>
								<li><a href="app-widget.html"
									class="btn-floating yellow darken-1"><i
										class="large mdi-device-now-widgets"></i></a></li>
								<li><a href="app-calendar.html" class="btn-floating green"><i
										class="large mdi-editor-insert-invitation"></i></a></li>
								<li><a href="app-email.html" class="btn-floating blue"><i
										class="large mdi-communication-email"></i></a></li>
							</ul>
						</div>
						<!-- Floating Action Button -->

					</div>
					<!--end container-->
			
			</section>
			<!-- END CONTENT -->

			<!-- //////////////////////////////////////////////////////////////////////////// -->
			<!-- START RIGHT SIDEBAR NAV-->
			<aside id="right-sidebar-nav">
				<ul id="chat-out" class="side-nav rightside-navigation">
					<li class="li-hover"><a href="#" data-activates="chat-out"
						class="chat-close-collapse right"><i class="mdi-navigation-close"></i></a>
						<div id="right-search" class="row">
							<form class="col s12">
								<div class="input-field">
									<i class="mdi-action-search prefix"></i> <input
										id="icon_prefix" type="text" class="validate"> <label
										for="icon_prefix">Search</label>
								</div>
							</form>
						</div></li>
					<li class="li-hover">
						<ul class="chat-collapsible" data-collapsible="expandable">
							<li>
								<div class="collapsible-header teal white-text active">
									<i class="mdi-social-whatshot"></i>Recent Activity
								</div>
								<div class="collapsible-body recent-activity">
									<div class="recent-activity-list chat-out-list row">
										<div class="col s3 recent-activity-list-icon">
											<i class="mdi-action-add-shopping-cart"></i>
										</div>
										<div class="col s9 recent-activity-list-text">
											<a href="#">just now</a>
											<p>Jim Doe Purchased new equipments for zonal office.</p>
										</div>
									</div>
									<div class="recent-activity-list chat-out-list row">
										<div class="col s3 recent-activity-list-icon">
											<i class="mdi-device-airplanemode-on"></i>
										</div>
										<div class="col s9 recent-activity-list-text">
											<a href="#">Yesterday</a>
											<p>Your Next flight for USA will be on 15th August 2015.</p>
										</div>
									</div>
									<div class="recent-activity-list chat-out-list row">
										<div class="col s3 recent-activity-list-icon">
											<i class="mdi-action-settings-voice"></i>
										</div>
										<div class="col s9 recent-activity-list-text">
											<a href="#">5 Days Ago</a>
											<p>Natalya Parker Send you a voice mail for next conference.</p>
										</div>
									</div>
									<div class="recent-activity-list chat-out-list row">
										<div class="col s3 recent-activity-list-icon">
											<i class="mdi-action-store"></i>
										</div>
										<div class="col s9 recent-activity-list-text">
											<a href="#">Last Week</a>
											<p>Jessy Jay open a new store at S.G Road.</p>
										</div>
									</div>
									<div class="recent-activity-list chat-out-list row">
										<div class="col s3 recent-activity-list-icon">
											<i class="mdi-action-settings-voice"></i>
										</div>
										<div class="col s9 recent-activity-list-text">
											<a href="#">5 Days Ago</a>
											<p>Natalya Parker Send you a voice mail for next conference.</p>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header light-blue white-text active">
									<i class="mdi-editor-attach-money"></i>Sales Repoart
								</div>
								<div class="collapsible-body sales-repoart">
									<div class="sales-repoart-list  chat-out-list row">
										<div class="col s8">Target Salse</div>
										<div class="col s4">
											<span id="sales-line-1"></span>
										</div>
									</div>
									<div class="sales-repoart-list chat-out-list row">
										<div class="col s8">Payment Due</div>
										<div class="col s4">
											<span id="sales-bar-1"></span>
										</div>
									</div>
									<div class="sales-repoart-list chat-out-list row">
										<div class="col s8">Total Delivery</div>
										<div class="col s4">
											<span id="sales-line-2"></span>
										</div>
									</div>
									<div class="sales-repoart-list chat-out-list row">
										<div class="col s8">Total Progress</div>
										<div class="col s4">
											<span id="sales-bar-2"></span>
										</div>
									</div>
								</div>
							</li>
							<li>
								<div class="collapsible-header red white-text">
									<i class="mdi-action-stars"></i>Favorite Associates
								</div>
								<div class="collapsible-body favorite-associates">
									<div class="favorite-associate-list chat-out-list row">
										<div class="col s4">
											<img src="images/avatar.jpg" alt=""
												class="circle responsive-img online-user valign profile-image">
										</div>
										<div class="col s8">
											<p>Eileen Sideways</p>
											<p class="place">Los Angeles, CA</p>
										</div>
									</div>
									<div class="favorite-associate-list chat-out-list row">
										<div class="col s4">
											<img src="images/avatar.jpg" alt=""
												class="circle responsive-img online-user valign profile-image">
										</div>
										<div class="col s8">
											<p>Zaham Sindil</p>
											<p class="place">San Francisco, CA</p>
										</div>
									</div>
									<div class="favorite-associate-list chat-out-list row">
										<div class="col s4">
											<img src="images/avatar.jpg" alt=""
												class="circle responsive-img offline-user valign profile-image">
										</div>
										<div class="col s8">
											<p>Renov Leongal</p>
											<p class="place">Cebu City, Philippines</p>
										</div>
									</div>
									<div class="favorite-associate-list chat-out-list row">
										<div class="col s4">
											<img src="images/avatar.jpg" alt=""
												class="circle responsive-img online-user valign profile-image">
										</div>
										<div class="col s8">
											<p>Weno Carasbong</p>
											<p>Tokyo, Japan</p>
										</div>
									</div>
									<div class="favorite-associate-list chat-out-list row">
										<div class="col s4">
											<img src="images/avatar.jpg" alt=""
												class="circle responsive-img offline-user valign profile-image">
										</div>
										<div class="col s8">
											<p>Nusja Nawancali</p>
											<p class="place">Bangkok, Thailand</p>
										</div>
									</div>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</aside>
			<!-- LEFT RIGHT SIDEBAR NAV-->

		</div>
		<!-- END WRAPPER -->

	</div>
	<!-- END MAIN -->


<div style="min-height:28.6vh"></div>
	<!-- //////////////////////////////////////////////////////////////////////////// -->

	<!-- START FOOTER -->
	<footer class="page-footer">
		<div class="footer-copyright">
			<div class="container">
				Copyright © 2015 <a class="grey-text text-lighten-4"
					href="http://themeforest.net/user/geekslabs/portfolio?ref=geekslabs"
					target="_blank">GeeksLabs</a> All rights reserved. <span
					class="right"> Design and Developed by <a
					class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span>
			</div>
		</div>
	</footer>
	<!-- END FOOTER -->


	<!-- ================================================
    Scripts
    ================================================ -->

	<!-- jQuery Library -->
	<script type="text/javascript" src="js/plugins/jquery-1.11.2.min.js"></script>
	<!--materialize js-->
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<!--scrollbar-->
	<script type="text/javascript"
		src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

	<!-- chartist -->
	<script type="text/javascript"
		src="js/plugins/chartist-js/chartist.min.js"></script>

	<!-- sparkline -->
	<script type="text/javascript"
		src="js/plugins/sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript"
		src="js/plugins/sparkline/sparkline-script.js"></script>


	<!--plugins.js - Some Specific JS codes for Plugin Settings-->
	<script type="text/javascript" src="js/plugins.min.js"></script>
	<!--custom-script.js - Add your own theme custom JS-->
	<script type="text/javascript" src="js/custom-script.js"></script>
	<!-- Toast Notification -->
	<script type="text/javascript">
    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
            Materialize.toast('<span>Hiya! I am a toast.</span>', 1500);
        }, 1500);
        setTimeout(function() {
            Materialize.toast('<span>You can swipe me too!</span>', 3000);
        }, 5000);
        setTimeout(function() {
            Materialize.toast('<span>You have new order.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 15000);
    });
    </script>
</body>

</html>