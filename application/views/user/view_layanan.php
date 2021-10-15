<!-- Begin Page Content -->
<div style="overflow-x:auto;" class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<div class="card">
		<div class="card-header">Layanan</div>
		<div class="card-body">
			<div class="row">
				<div class="col text-right mb-2">
					<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#addModal"> <i class="fas mr-2 fa-plus"></i>Layanan</button>
				</div>
			</div>
			<div class="table-responsive">
				<table id="table_umum" class="table table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Internal</th>
							<th scope="col">Jenis Layanan</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Aksi</th>

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
								<td><?= $d->jenis_layanan ?></td>
								<td><?= $d->keterangan ?></td>
								<td>
									<button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
										Edit
									</button>
									<form action="<?= base_url('layanan/delete_data') ?>" method="POST">
										<input type="hidden" name="id" value="<?= $d->id ?>" id="id">
										<button type="submit" class="btn badge bg-danger" style="color: white;">Hapus</button>
									</form>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
	<div class="card mt-3">
		<div class="card-header">Table History</div>
		<div class="card-body">

			<div class="table-responsive">
				<table id="table_history" class="table table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Internal</th>
							<th scope="col">Jenis Layanan</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Tanggal diubah</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($data_history as $d) {
						?>
							<tr>
								<th scope="row"><?= $no++; ?></th>
								<td><?= $d->nama_intenal ?></td>
								<td><?= $d->jenis_layanan ?></td>
								<td><?= $d->keterangan ?></td>
								<td><?= $d->change_date ?></td>

							</tr>
						<?php } ?>
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
	$(document).ready(function() {
		$('#table_umum').DataTable();
		$('#table_history').DataTable();
	});
</script>

<!-- Modal Edit Data -->
<?php foreach ($data as $d) : ?>
	<div class="modal fade" id="editModal<?= $d->id ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Data</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form method="POST" action="<?= base_url('layanan/edit_data'); ?>">
						<div class="form-group mt-3">
							<select class="form-select form-select-sm mb-3" name="jenis_layanan" aria-label=".form-select-lg example">
								<option selected>Jenis Layanan</option>
								<option value="Perizinan">Perizinan</option>
								<option value="Pembayaran">Pembayaran</option>
								<option value="Pelaporan Masyarakat">Pelaporan Masyarakat</option>
								<option value="Pendaftaran">Pendaftaran</option>
								<option value="Publikasi Informasi">Publikasi Informasi</option>
								<option value="Lainnya">Lainnya</option>
							</select>

						</div>
						<div class="form-group">
							<input type="hidden" name="id" value="<?= $d->id; ?>" id="id_tampil">
							<textarea class="form-control" id="tambah_keterangan" name="keterangan_layanan" rows="3" placeholder="Keterangan"><?= $d->keterangan ?></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Edit Data</button>
				</div>
				</form>

			</div>
		</div>
	</div>
<?php endforeach; ?>

<!-- /Modal Edit Data -->

<!-- Modal Add Data -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form method="POST" action="<?= base_url('layanan/add_data'); ?>">
					<div class="form-group mt-3">
						<select class="form-select form-select-sm mb-3" name="id_aplikasi" aria-label=".form-select-lg example">
							<?php foreach ($dataumum as $d) : ?>
								<option value="<?= $d->id ?>"><?= $d->nama_intenal ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group mt-3">
						<select class="form-select form-select-sm mb-3" name="jenis_layanan" aria-label=".form-select-lg example">
							<option selected>Jenis Layanan</option>
							<option value="Perizinan">Perizinan</option>
							<option value="Pembayaran">Pembayaran</option>
							<option value="Pelaporan Masyarakat">Pelaporan Masyarakat</option>
							<option value="Pendaftaran">Pendaftaran</option>
							<option value="Publikasi Informasi">Publikasi Informasi</option>
							<option value="Lainnya">Lainnya</option>
						</select>

					</div>
					<div class="form-group">
						<textarea class="form-control" id="tambah_keterangan" name="keterangan_layanan" rows="3" placeholder="Keterangan"></textarea>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Add Data</button>
			</div>
			</form>

		</div>
	</div>
</div>

<!-- /Modal Add Data -->
