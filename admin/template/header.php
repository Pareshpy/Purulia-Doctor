<?php
$logged = $_SESSION['username'];
$stmt = "SELECT * FROM `admin` WHERE `username` = '$logged'";
$req = $conn->query($stmt);
$res = $req->fetch_object();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Purulia Doctors Admin</title>
	<!-- core:css -->
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/core/core.css">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<link rel="stylesheet" href="<?= base_url ?>/assets/vendors/select2/select2.min.css">
	<!-- endinject -->
	<!-- Layout styles -->

	<link rel="stylesheet" href="<?= base_url ?>/assets/css/demo_5/style.css">
	<!-- End layout styles -->
	<!-- <link rel="shortcut icon" href="<?= base_url ?>/assets/images/favicon.png" /> -->
</head>

<body>
	<div class="main-wrapper">

		<!-- partial:partials/_navbar.html -->
		<div class="horizontal-menu">
			<nav class="navbar top-navbar">
				<div class="container">
					<div class="navbar-content">
						<a href="./dashboard.php" class="navbar-brand">
							Purulia&nbsp;<span>Doctors</span>
						</a>
						<!-- <form class="search-form">
							<div class="input-group">
								<div class="input-group-prepend">
									<div class="input-group-text">
										<i data-feather="search"></i>
									</div>
								</div>
								<input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
							</div>
						</form> -->
						<ul class="navbar-nav">

							<!-- <li class="nav-item dropdown nav-apps">
								<a class="nav-link dropdown-toggle" href="#" id="appsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="grid"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="appsDropdown">
									<div class="dropdown-header d-flex align-items-center justify-content-between">
										<p class="mb-0 font-weight-medium">Web Apps</p>
										<a href="javascript:;" class="text-muted">Edit</a>
									</div>
									<div class="dropdown-body">
										<div class="d-flex align-items-center apps">
											<a href="pages/apps/chat.html"><i data-feather="message-square" class="icon-lg"></i><p>Chat</p></a>
											<a href="pages/apps/calendar.html"><i data-feather="calendar" class="icon-lg"></i><p>Calendar</p></a>
											<a href="pages/email/inbox.html"><i data-feather="mail" class="icon-lg"></i><p>Email</p></a>
											<a href="pages/general/profile.html"><i data-feather="instagram" class="icon-lg"></i><p>Profile</p></a>
										</div>
									</div>
									<div class="dropdown-footer d-flex align-items-center justify-content-center">
										<a href="javascript:;">View all</a>
									</div>
								</div>
							</li> -->
							<!-- <li class="nav-item dropdown nav-messages">
								<a class="nav-link dropdown-toggle" href="#" id="messageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="mail"></i>
								</a>
								<div class="dropdown-menu" aria-labelledby="messageDropdown">
									<div class="dropdown-header d-flex align-items-center justify-content-between">
										<p class="mb-0 font-weight-medium">9 New Messages</p>
										<a href="javascript:;" class="text-muted">Clear all</a>
									</div>
									<div class="dropdown-body">
										<a href="javascript:;" class="dropdown-item">
											<div class="figure">
												<img src="https://via.placeholder.com/30x30" alt="userr">
											</div>
											<div class="content">
												<div class="d-flex justify-content-between align-items-center">
													<p>Leonardo Payne</p>
													<p class="sub-text text-muted">2 min ago</p>
												</div>	
												<p class="sub-text text-muted">Project status</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="figure">
												<img src="https://via.placeholder.com/30x30" alt="userr">
											</div>
											<div class="content">
												<div class="d-flex justify-content-between align-items-center">
													<p>Carl Henson</p>
													<p class="sub-text text-muted">30 min ago</p>
												</div>	
												<p class="sub-text text-muted">Client meeting</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="figure">
												<img src="https://via.placeholder.com/30x30" alt="userr">
											</div>
											<div class="content">
												<div class="d-flex justify-content-between align-items-center">
													<p>Jensen Combs</p>												
													<p class="sub-text text-muted">1 hrs ago</p>
												</div>	
												<p class="sub-text text-muted">Project updates</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="figure">
												<img src="https://via.placeholder.com/30x30" alt="userr">
											</div>
											<div class="content">
												<div class="d-flex justify-content-between align-items-center">
													<p>Amiah Burton</p>
													<p class="sub-text text-muted">2 hrs ago</p>
												</div>
												<p class="sub-text text-muted">Project deadline</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="figure">
												<img src="https://via.placeholder.com/30x30" alt="userr">
											</div>
											<div class="content">
												<div class="d-flex justify-content-between align-items-center">
													<p>Yaretzi Mayo</p>
													<p class="sub-text text-muted">5 hr ago</p>
												</div>
												<p class="sub-text text-muted">New record</p>
											</div>
										</a>
									</div>
									<div class="dropdown-footer d-flex align-items-center justify-content-center">
										<a href="javascript:;">View all</a>
									</div>
								</div>
							</li> -->
							<!-- <li class="nav-item dropdown nav-notifications">
								<a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i data-feather="bell"></i>
									<div class="indicator">
										<div class="circle"></div>
									</div>
								</a>
								<div class="dropdown-menu" aria-labelledby="notificationDropdown">
									<div class="dropdown-header d-flex align-items-center justify-content-between">
										<p class="mb-0 font-weight-medium">6 New Notifications</p>
										<a href="javascript:;" class="text-muted">Clear all</a>
									</div>
									<div class="dropdown-body">
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="user-plus"></i>
											</div>
											<div class="content">
												<p>New customer registered</p>
												<p class="sub-text text-muted">2 sec ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="gift"></i>
											</div>
											<div class="content">
												<p>New Order Recieved</p>
												<p class="sub-text text-muted">30 min ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="alert-circle"></i>
											</div>
											<div class="content">
												<p>Server Limit Reached!</p>
												<p class="sub-text text-muted">1 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="layers"></i>
											</div>
											<div class="content">
												<p>Apps are ready for update</p>
												<p class="sub-text text-muted">5 hrs ago</p>
											</div>
										</a>
										<a href="javascript:;" class="dropdown-item">
											<div class="icon">
												<i data-feather="download"></i>
											</div>
											<div class="content">
												<p>Download completed</p>
												<p class="sub-text text-muted">6 hrs ago</p>
											</div>
										</a>
									</div>
									<div class="dropdown-footer d-flex align-items-center justify-content-center">
										<a href="javascript:;">View all</a>
									</div>
								</div>
							</li> -->
							<li class="nav-item dropdown nav-profile">
								<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<img src="https://images.unsplash.com/photo-1552083375-1447ce886485?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=128&q=80" alt="profile">
								</a>
								<div class="dropdown-menu" aria-labelledby="profileDropdown">
									<div class="dropdown-header d-flex flex-column align-items-center">
										<div class="figure mb-3">
											<img src="https://images.unsplash.com/photo-1552083375-1447ce886485?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=128&q=80" alt="">
										</div>
										<div class="info text-center">
											<p class="name font-weight-bold mb-0"><?= $res->first . ' ' . $res->last ?></p>
											<p class="email text-muted mb-3"><?= $res->email ?></p>
										</div>
									</div>
									<div class="dropdown-body">
										<ul class="profile-nav p-0 pt-3">
											<!-- <li class="nav-item">
												<a href="pages/general/profile.html" class="nav-link">
													<i data-feather="user"></i>
													<span>Profile</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="javascript:;" class="nav-link">
													<i data-feather="edit"></i>
													<span>Edit Profile</span>
												</a>
											</li>
											<li class="nav-item">
												<a href="javascript:;" class="nav-link">
													<i data-feather="repeat"></i>
													<span>Switch User</span>
												</a>
											</li> -->
											<li class="nav-item">
												<a href="./logout.php" class="nav-link">
													<i data-feather="log-out"></i>
													<span>Log Out</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
							<i data-feather="menu"></i>
						</button>
					</div>
				</div>
			</nav>
			<nav class="bottom-navbar">
				<div class="container">
					<ul class="nav page-navigation">
						<li class="nav-item">
							<a class="nav-link" href="./dashboard.php">
								<i class="link-icon" data-feather="box"></i>
								<span class="menu-title">Dashboard</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="./doctors.php" class="nav-link">
								<i class="link-icon" data-feather="users"></i>
								<span class="menu-title">Doctors</span>
								<!-- <i class="link-arrow"></i> -->
							</a>
							<!-- <div class="submenu">
								<ul class="submenu-item">
									<li class="category-heading">Email</li>
									<li class="nav-item"><a class="nav-link" href="pages/email/inbox.html">Inbox</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/email/read.html">Read</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/email/compose.html">Compose</a></li>
									<li class="category-heading">Other
									<li>
									<li class="nav-item"><a class="nav-link" href="pages/apps/chat.html">Chat</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/apps/calendar.html">Calendar</a></li>
								</ul>
							</div> -->
						</li>
						<li class="nav-item mega-menu">
							<a href="./clinics.php" class="nav-link">
								<i class="link-icon" data-feather="home"></i>
								<span class="menu-title">Clinics</span>
								<!-- <i class="link-arrow"></i> -->
							</a>

						</li>
						<li class="nav-item">
							<a href="./bloodbanks.php" class="nav-link">
								<i class="link-icon" data-feather="plus-square"></i>
								<span class="menu-title">Blood Banks</span>
								<!-- <i class="link-arrow"></i> -->
							</a>
							<!-- <div class="submenu">
								<ul class="submenu-item">
									<li class="nav-item"><a class="nav-link" href="pages/forms/basic-elements.html">Basic Elements</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/forms/advanced-elements.html">Advanced Elements</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/forms/editors.html">Editors</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/forms/wizard.html">Wizard</a></li>
								</ul>
							</div> -->
						</li>
						<li class="nav-item">
							<a href="./categories.php" class="nav-link">
								<i class="link-icon" data-feather="grid"></i>
								<span class="menu-title">Categories</span>
								<!-- <i class="link-arrow"></i> -->
							</a>
							<!-- <div class="submenu">
								<ul class="submenu-item">
									<li class="nav-item"><a class="nav-link" href="./add_category.php"> Add Category</a></li>
									
								</ul>
							</div> -->
						</li>
						<li class="nav-item">
							<a href="./specialties.php" class="nav-link">
								<i class="link-icon" data-feather="activity"></i>
								<span class="menu-title">Specialties</span>
								<!-- <i class="link-arrow"></i> -->
							</a>
							<!-- <div class="submenu">
								<ul class="submenu-item">
									<li class="nav-item"><a class="nav-link" href="pages/icons/feather-icons.html">Feather Icons</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/icons/flag-icons.html">Flag Icons</a></li>
									<li class="nav-item"><a class="nav-link" href="pages/icons/mdi-icons.html">Mdi Icons</a></li>
								</ul>
							</div> -->
						</li>
						<li class="nav-item mega-menu">
							<a href="./degrees.php" class="nav-link">
								<i class="link-icon" data-feather="book"></i>
								<span class="menu-title">Degrees</span>
								<!-- <i class="link-arrow"></i> -->
							</a>

						</li>
						<li class="nav-item mega-menu">
							<a href="./zones.php" class="nav-link">
								<i class="link-icon" data-feather="globe"></i>
								<span class="menu-title">Zones</span>
								<!-- <i class="link-arrow"></i> -->
							</a>

						</li>
						<!-- <li class="nav-item">
							<a href="https://www.nobleui.com/html/documentation/docs.html" target="_blank" class="nav-link">
								<i class="link-icon" data-feather="hash"></i>
								<span class="menu-title">Documentation</span></a>
						</li> -->
					</ul>
				</div>
			</nav>
		</div>
		<!-- partial -->