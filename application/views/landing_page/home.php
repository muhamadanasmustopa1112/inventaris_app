<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png') ?>">


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<title>Home</title>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-white">
			<a class="navbar-brand" href="#">
				<img src="<?= base_url('image/logo-diskominfo.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
				<span style="font-family:Verdana;">DISKOMINFO</span>
			</a>
			<div class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto" style="font-family: Verdana; color:black;">
					<a class="nav-link active mr-4" href="#">Home</a>
					<a class="nav-link mr-4" href="#">About</a>
					<a class="nav-link mr-4" href="#">Contact</a>
				</div>
			</div>
		</nav>
	</div>

	<div class="jumbotron jumbotron-fluid" style="background-image: url('image/bg.jpg'); height:600px;">
		<div class="container text-center" style="color: white;">
			<h1 class="display-4" style="font-family: Verdana, Geneva, Tahoma, sans-serif;">Layanan Aplikasi</h1>
			<p class="lead">Pilih layanan aplikasi yang ada di Majalengka</p>

			<div class="row mt-5 text-center">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div class="row">
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/perizinan') ?>"><img src="<?= base_url('image/perizinan.png') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Perizinan</span>
						</div>
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/pembayaran') ?>"><img src="<?= base_url('image/pembayaran.png') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Pembayaran</span>
						</div>
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/pelaporan') ?>"><img src="<?= base_url('image/pelaporan.png') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Pelaporan Masyarakat</span>
						</div>

					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row mt-5 text-center">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<div class="row">
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/pendaftaran') ?>"><img src="<?= base_url('image/pendaftaran.jpg') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Pendaftaran</span>
						</div>
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/informasi') ?>"><img src="<?= base_url('image/publikasi.png') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Publikasi Informasi</span>
						</div>
						<div class="col-sm-4" style="color: white;">
							<a href="<?= base_url('publikasi/lainnya') ?>"><img src="<?= base_url('image/lainnya.png') ?>" class="img img-fluid bg-white p-3  rounded-circle" alt=""></a>
							<span class="mt-2" style="font-weight: bold;">Lainnya</span>
						</div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>

		</div>
	</div>
	<footer class="container-fluid text-center">
		<h6>DISKOMINFO MAJALENGKA <?= date('Y') ?></h6>
	</footer>
	<!-- Optional JavaScript; choose one of the two! -->

	<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>
