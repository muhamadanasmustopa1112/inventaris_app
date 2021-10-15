<!doctype html>
<html lang="en">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="<?= base_url('assets/images/logo.png') ?>">


	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">


	<title>Lainnya</title>
</head>

<body>
	<div class="container">
		<nav class="navbar navbar-expand-lg navbar-light bg-white">
			<a class="navbar-brand" href="<?= base_url() ?>">
				<img src="<?= base_url('image/logo-diskominfo.png') ?>" width="30" height="30" class="d-inline-block align-top" alt="">
				<span style="font-family:Verdana;">DISKOMINFO</span>
			</a>
			<di v class="collapse navbar-collapse" id="navbarNavAltMarkup">
				<div class="navbar-nav ml-auto" style="font-family: Verdana; color:black;">
					<a class="nav-link active mr-4" href="#">Home</a>
					<a class="nav-link mr-4" href="#">About</a>
					<a class="nav-link mr-4" href="#">Contact</a>
				</div>
			</di>
		</nav>
	</div>
	<div class="jumbotron jumbotron-fluid text-center" style="background-image: url('<?= base_url('image/bg.jpg'); ?>'); height:400px;">
		<div class="container" style="color: white;">
			<h1 class="display-4">Lainnya</h1>
			<p class="lead">Aplikasi Layanan Lainnya Majalengka</p>
		</div>
	</div>
	<div class="container mt-4">
		<h2 class="text-center">Data Aplikasi Lainnya</h2>
		<div class="card">
			<div class="card-header">Table Data</div>
			<div class="card-body">
				<table id="table_history" class="table  table-bordered" cellspacing="0" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Aplikasi</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Detail</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data as $d) {
						?>
							<tr>
								<th scope="row"><?= $no++; ?></th>
								<td><?= $d->nama_intenal ?></td>
								<td><?= $d->keteangan ?></td>
								<td>

									<form action="<?= base_url('publikasi/detail') ?>" method="POST">
										<input type="hidden" value="lainnya" />
										<input type="hidden" value="<?= $d->id ?>" name="id" />

										<button class="badge badge-primary" type="submit" name="lainnya">Detail</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<footer class="container-fluid text-center mt-3 p-3" style="background-color: #000;">
		<h6 style="color: white;">DISKOMINFO MAJALENGKA <?= date('Y') ?></h6>
	</footer>
	<!-- Optional JavaScript; choose one of the two! -->


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>

	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
	<script>
		$(document).ready(function() {
			$('#table_history').DataTable();
		});
	</script>


	<!-- Option 2: Separate Popper and Bootstrap JS -->
	<!--
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
    -->
</body>

</html>
