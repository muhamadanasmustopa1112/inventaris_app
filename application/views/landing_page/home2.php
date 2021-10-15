<!DOCTYPE html>
<html lang="en">

<head>
	<title>Home</title>
	<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png') ?>">

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
</head>
<style>
	body {
		background-color: #0A6DAE;
	}

	#card-deck {
		width: 50px;
		height: 150px;
	}

	#icon-data {
		width: 80px;
		height: 80px;
	}
</style>

<body>

	<!-- <nav class="navbar navbar-expand-sm  navbar-dark">
		<a class="navbar-brand ml-4" href="#"> <img class="img-fluid" src="<?= base_url('image/logo-diskominfo.png') ?>" alt="Chania" style="height: 30px; width: 30px;"></a>

		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="#home">Home</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#tentang">About</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#tentang">Contact</a>
			</li>

		</ul>

	</nav> -->

	<nav class="navbar navbar-expand-lg navbar-light " style="color: #0A6DAE;">
		<div class="container-fluid">
			<a class="navbar-brand ml-4" href="#"> <img class="img-fluid" src="<?= base_url('image/logo-diskominfo.png') ?>" alt="Chania" style="height: 30px; width: 30px;"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" style="color: white;" href="#home">Home</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color: white;" href="#tentang">About</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" style="color: white;" href="#tentang">Contact</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div class="row mt-3" id="home">
		<div class="col-sm-7 ml-5" style="color: white;">
			<h1>SEMA</h1>
			<h3>Website untuk mencatat dan publikasi sistem elektronik di wilayah Kab.Majalengka</h3>
		</div>
		<div class="col-sm-4"><img class="img-fluid" src="image/vectroperson.png"></div>
	</div>
	<div class="jumbotron" style="background-color: white; margin-top: 5%;">
		<section class="page-section" id="services" style="color: black;">
			<div class="container">
				<h2 class="text-center mt-0">Dokumen</h2>
				<hr class="divider my-4" />
				<div class="row">
					<div class="col-lg-3 col-md-6 text-center">
						<div class="mt-5">
							<img class="img-fluid" src="image/world.png">
							<h3 class="h4 mb-2">Alamat Sistem</h3>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="mt-5">
							<img class="img-fluid" src="image/database.png">
							<h3 class="h4 mb-2">Database</h3>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="mt-5">
							<img class="img-fluid" src="image/medal.png">
							<h3 class="h4 mb-2">Sertifikat</h3>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 text-center">
						<div class="mt-5">
							<img class="img-fluid" src="image/file.png">
							<h3 class="h4 mb-2">File</h3>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="text-daftar" style="margin-top:5%;">
		<h2 class="text-center mt-0" style="color: white;">Sistem Elektronik Majalengka</h2>
		<hr class="divider my-4" />
		<div class="row" style="margin-left: 3%; margin-right: 3%; margin-top: 5%;">

			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">

						<h5 class="card-title">Perizinan</h5>

						<p class="card-text">Aplikasi yang berkaitan dengan proses perizinan</p>
						<a href="<?= base_url('publikasi/perizinan') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Pembayaran</h5>
						<p class="card-text">Aplikasi yang berkaitan dengan proses pembayaran</p>
						<a href="<?= base_url('publikasi/pembayaran') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6" style="margin-top: 3%;">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Pelaporan Masyarakat</h5>
						<p class="card-text">Aplikasi yang berkaitan dengan proses Pelaporan Masyarakat</p>
						<a href="<?= base_url('publikasi/pelaporan') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6" style="margin-top: 3%;">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Pendaftaran</h5>
						<p class="card-text">Aplikasi yang berkaitan dengan proses Pendaftaran</p>
						<a href="<?= base_url('publikasi/pendaftaran') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6" style="margin-top: 3%;">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Publikasi Informasi</h5>
						<p class="card-text">Aplikasi yang berkaitan dengan Publikasi Informasi</p>
						<a href="<?= base_url('publikasi/informasi') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
			<div class="col-sm-6" style="margin-top: 3%;">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Lainnya</h5>
						<p class="card-text">Aplikasi yang berkaitan dengan proses lainnya</p>
						<a href="<?= base_url('publikasi/lainnya') ?>" class="btn btn-primary">Kunjungi</a>
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt-5" style="background-color: white;" id="tentang">
			<h1 class="mt-3	text-center">Tentang Kami</h1>
			<div class="row p-5">
				<div class="col-7 ml-3">
					<p>Dinas Komunikasi dan Informatika Kabupaten Majalengka dibentuk berdasarkan Peraturan Daerah Kabupaten Majalengka Nomor 14 Tahun 2016 tentang Organisasi Perangkat Daerah Kabupaten Majalengka. Sebagai unsur satuan Organisasi Perangkat Daerah Dinas Komunikasi dan Informatika menjalankan tugas dalam melaksanakan sebagian urusan rumah tangga Daerah yang meliputi penyelenggaraan di bidang Komunikasi dan Informatika. Dinas Komunikasi dan Informatika Kabupaten Majalengka dipimpin oleh seorang Kepala Dinas yang berkedudukan dan bertanggungjawab kepada Bupati melalui Sekretaris Daerah yang mempunyai tugas pokok merumuskan, menyelenggarakan, membina dan mengevaluasi urusan Pemerintahan Daerah berdasarkan asas Desentralisasi dan Tugas Pembantuan pada bidang Komunikasi, Informatika dan Statistik Sektoral. Berdasarkan Peraturan Daerah Kabupaten Majalengka Nomor 14 Tahun 2016 tentang Organisasi Perangkat Daerah Kabupaten Majalengka, bahwa Dinas Komunikasi dan Informatika Kabupaten Majalengka merupakan Dinas baru yang berdiri sendiri, sebagai Pelaksana Teknis Operasional di bidang Komunikasi, Informatika dan Statistik sektoral. Sebagai lembaga yang mengelola urusan Komunikasi dan Informatika, Dinas Komunikasi dan Informatika Kabupaten Majalengka memiliki visi, yaitu :
					</p>
					<p>
						“ TERWUJUDNYA MASYARAKAT MAJALENGKA YANG MAKMUR BERBASIS TEKNOLOGI INFORMASI DAN KOMUNIKASI ”
						Pembangunan Infrastruktur Komunikasi dan Informatika daerah bertujuan untuk meningkatkan akses informasi publik terhadap proses dan hasil pembangunan di daerah. Kemudahan akses informasi pembangunan sangat mempengaruhi partisipasi publik dalam proses pembangunan, baik sebagai pelaku maupun objek pembangunan. Sasarannya adalah meningkatnya wawasan masyarakat terhadap proses-proses pembangunan yang tengah dan telah dilaksanakan, sehingga mereka mampu memanfaatkan berbagai peluang dan hasil pembangunan bagi peningkatan taraf kehidupannya. Di samping itu, infrastruktur Komunikasi dan Informatika sangat vital sebagai prasarana untuk meningkatkan kinerja Satuan Kerja Perangkat Daerah (SKPD) di lingkungan Pemerintah Daerah Kabupaten Majalengka.</p>
				</div>
				<div class="col-4 ml-5">
					<h4 class="mb-4">Kontak Informasi</h4>
					<p> <i class="fas mr-2 fa-phone-alt"></i>(0223)8292292</p>
					<p><i class="fas mr-2 fa-map-marker-alt"></i>Jalan Pangeran muhammad KM.5 Kelurahan Simpeureum Kecamatan Cigasong Kabupaten Majalengka Provinsi Jawa Barat 45476</p>
					<p>diskominfo@majalengkakab.go.id</p>
					<p><i class="fas mr-2 fa-blog"></i>www.diskominfo.majalengkakab.go.id</p>
				</div>

			</div>
		</div>
</body>

</html>
