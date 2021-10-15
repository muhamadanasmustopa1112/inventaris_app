<!-- Begin Page Content -->
<div style="overflow-x:auto;" class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<div class="card">
		<div class="card-header">Profile</div>
		<div class="card-body">
			<div class="row">
				<div class="col mb-2 text-right">
				</div>
			</div>
			<div class="table-responsive">
				<table id="table_umum" class="table table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Internal</th>
							<th scope="col">Nama Instansi</th>
							<th scope="col">Alamat</th>
							<th scope="col">Provinsi</th>
							<th scope="col">Kabupaten</th>
							<th scope="col">Kode Pos</th>
							<th scope="col">No Telp</th>
							<th scope="col">Website</th>
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
								<td><?= $d->nama_instansi ?></td>
								<td><?= $d->alamat ?></td>
								<td><?= $d->provinsi ?></td>
								<td><?= $d->kabupaten ?></td>
								<td><?= $d->kode_pos ?></td>
								<td><?= $d->no_telp ?></td>
								<td><?= $d->website ?></td>
								<td>
									<button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
										Edit
									</button>
									<form action="<?= base_url('profile/delete_data') ?>" method="POST">
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
			<div class="row">
				<div class="col mb-2 text-right">
				</div>
			</div>
			<div class="table-responsive">
				<table id="table_history" class="table table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Internal</th>
							<th scope="col">Nama Instansi</th>
							<th scope="col">Alamat</th>
							<th scope="col">Provinsi</th>
							<th scope="col">Kabupaten</th>
							<th scope="col">Kode Pos</th>
							<th scope="col">No Telp</th>
							<th scope="col">Website</th>
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
								<td><?= $d->nama_instansi ?></td>
								<td><?= $d->alamat ?></td>
								<td><?= $d->provinsi ?></td>
								<td><?= $d->kabupaten ?></td>
								<td><?= $d->kode_pos ?></td>
								<td><?= $d->no_telp ?></td>
								<td><?= $d->website ?></td>
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
					<form method="POST" action="<?= base_url('profile/edit_data'); ?>">
						<input type="hidden" name="id" value="<?= $d->id; ?>" id="id_tampil">

						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Nama Instansi:</label>
							<input type="text" name="nama_instansi" value="<?= $d->nama_instansi ?>" id="tambah_nama" class="form-control">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Alamat:</label>
							<textarea class="form-control" name="alamat" id="tambah_alamat" rows="3"><?= $d->alamat ?></textarea>
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Provinsi:</label>
							<input type="text" name="provinsi" value="<?= $d->provinsi ?>" id="tambah_provinsi" class="form-control">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Kota/Kabupaten:</label>
							<input type="text" name="kabupaten" value="<?= $d->kabupaten ?>" id="tambah_kota" class="form-control">
						</div>

						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Kode Pos:</label>
							<input type="text" name="kode_pos" value=" <?= $d->kode_pos ?>" id="tambah_kode_pos" class="form-control">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Nomer Telepon:</label>
							<input type="text" name="no_telp" value="<?= $d->no_telp ?>" id="tambah_no_telp" class="form-control">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Website:</label>
							<input type="text" name="website" value="<?= $d->website ?>" id="tambah_website" class="form-control">
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
