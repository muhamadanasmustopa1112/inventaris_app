<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title><?= $title ?></title>
	<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png') ?>">


	<!-- Custom fonts for this template-->
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">


	<!-- Custom styles for this template-->
	<link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">

	<style>
		.my-custom-scrollbar {
			position: relative;
			height: 500px;
			overflow: auto;
		}

		.table-wrapper-scroll-y {
			display: block;
		}

		.tableFixHead {
			overflow-y: auto;
			height: 100px;
		}

		.tableFixHead thead th {
			position: sticky;
			top: 0;
		}
	</style>



</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user') ?>">
				<div class="sidebar-brand-icon rotate-n-15">
					<img class="img-fluid" src="<?= base_url('assets/images/logo.png') ?>" alt="">
				</div>
				<div class="sidebar-brand-text mx-3">Kominfo Majalengka </div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">

			<!-- Nav Item - Dashboard -->
			<li class="nav-item ">
				<a class="nav-link" href="<?= base_url('user') ?>">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Input Data
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('user/add') ?>">
					<i class="fas fa-folder-plus"></i>
					<span>Add Data</span>
				</a>
			</li>
			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('ticketing/user') ?>">
					<i class="fas fa-folder-plus"></i>
					<span>Ticketing</span>
				</a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">
			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('user/inbox') ?>">
					<i class="fas fa-folder-plus"></i>
					<span>Inbox</span>
				</a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<div class="sidebar-heading">
				View Data
			</div>

			<li class="nav-item">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDataApplication" aria-controls="collapseDataApplication">
					<i class="fas fa-fw fa-folder"></i>
					<span>Data Application</span>
				</a>
				<div id="collapseDataApplication" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Data Application</h6>
						<a class="collapse-item" href="<?= base_url('dataumum/user') ?>">Data Umum Apikasi</a>
						<a class="collapse-item" href="<?= base_url('fiturcontroller/user') ?>">Fitur</a>
						<a class="collapse-item" href="<?= base_url('hardwere/user') ?>">Hardwere</a>
						<a class="collapse-item" href="<?= base_url('layanan/user') ?>">Layanan</a>
						<a class="collapse-item" href="<?= base_url('profile/user') ?>"> Profile Aplikasi</a>
						<a class="collapse-item" href="<?= base_url('ruanglingkupcontroller/user') ?>">Ruang Lingkup Aplikasi</a>
						<a class="collapse-item" href="<?= base_url('sistemkeamanan/user') ?>">Sistem Keamanan</a>
						<a class="collapse-item" href="<?= base_url('sistemterkait/user') ?>">Sistem Terkait</a>

					</div>
				</div>

			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?= base_url('user/hardwere') ?>">
					<i class="fas fa-folder-plus"></i>
					<span>Hardwere</span>
				</a>
			</li>




		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">



					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">






						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $user['nama_lengkap'] ?></span>
							</a>
							<!-- Dropdown - User Information -->
							<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
									<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
									Logout
								</a>
							</div>
						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->
