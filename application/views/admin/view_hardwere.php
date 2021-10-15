<!-- Begin Page Content -->
<div style="overflow-x:auto;" class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
	<div class="card">
		<div class="card-header">Hardwere</div>
		<div class="card-body">
			<div class="row">
				<div class="col mb-3 text-right">
					<button type="button" class="btn btn-primary ml-auto" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas mr-2 fa-plus"></i>Add Hardware</button>
				</div>
			</div>

			<div class="table-responsive">
				<table id="table_umum" class="table table-bordered" style="width:100%">
					<thead>
						<tr>
							<th scope="col">No</th>
							<th scope="col">Nama Internal</th>
							<th scope="col">Jenis</th>
							<th scope="col">Pemilik</th>
							<th scope="col">Penyedia Data</th>
							<th scope="col">Bandwidth</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Tipe</th>
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
								<td><?= $d->jenis ?></td>
								<td><?= $d->pemilik ?></td>
								<td><?= $d->penyedia ?></td>
								<td><?= $d->bandwidth ?></td>
								<td><?= $d->jumlah ?></td>
								<td><?= $d->tipe ?></td>
								<td><?= $d->keterangan ?></td>
								<td>
									<button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
										Edit
									</button>
									<form action="<?= base_url('hardwere/delete') ?>" method="POST">
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
							<th scope="col">Jenis</th>
							<th scope="col">Pemilik</th>
							<th scope="col">Penyedia Data</th>
							<th scope="col">Bandwidth</th>
							<th scope="col">Jumlah</th>
							<th scope="col">Tipe</th>
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
								<td><?= $d->jenis ?></td>
								<td><?= $d->pemilik ?></td>
								<td><?= $d->penyedia ?></td>
								<td><?= $d->bandwidth ?></td>
								<td><?= $d->jumlah ?></td>
								<td><?= $d->tipe ?></td>
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
	});
	$(document).ready(function() {
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
					<form method="POST" action="<?= base_url('hardwere/edit'); ?>">
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Jenis :</label>
							<input type="text" name="jenis" value="<?= $d->jenis ?>" id="tambah_jenis" class="form-control">
							<?= form_error('jenis', '<small class="text-danger ml-3">', '</small>') ?>

							<input type="hidden" name="id" value="<?= $d->id; ?>" id="id_tampil">
						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Pemilik:</label>
							<textarea class="form-control" name="pemilik" id="tambah_pemilik" rows="3"><?= $d->pemilik ?></textarea>
							<?= form_error('pemilik', '<small class="text-danger ml-3">', '</small>') ?>

						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Penyedia Data Center :</label>
							<input type="text" name="penyedia" value="<?= $d->penyedia ?>" id="tambah_penyedia" class="form-control">
							<?= form_error('penyedia', '<small class="text-danger ml-3">', '</small>') ?>

						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Band Width :</label>
							<input type="text" name="bandwidth" value="<?= $d->bandwidth ?>" id="tambah_bandwidth" class="form-control">
							<?= form_error('bandwidth', '<small class="text-danger ml-3">', '</small>') ?>

						</div>

						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Jumlah :</label>
							<input type="number" name="jumlah" value="<?= $d->jumlah ?>" id="tambah_jumlah" class="form-control">
							<?= form_error('jumlah', '<small class="text-danger ml-3">', '</small>') ?>

						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Tipe :</label>
							<input type="text" name="tipe" value="<?= $d->tipe ?>" id="tambah_tipe" class="form-control">
							<?= form_error('tipe', '<small class="text-danger ml-3">', '</small>') ?>

						</div>
						<div class="form-group">
							<label for="recipient-name" class="col-form-label">Keterangan:</label>
							<input type="text" name="keterangan_hardwere" value="<?= $d->keterangan ?>" id="tambah_keterangan" class="form-control">
							<?= form_error('keterangan_hardwere', '<small class="text-danger ml-3">', '</small>') ?>
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
				<form method="POST" action="<?= base_url('hardwere/add'); ?>">
					<div class="form-group mt-3">
						<select class="form-select form-select-sm mb-3" name="id_aplikasi" aria-label=".form-select-lg example">
							<?php foreach ($dataumum as $d) : ?>
								<option value="<?= $d->id ?>"><?= $d->nama_intenal ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Jenis :</label>
						<input type="text" name="jenis" value="<?= set_value('jenis') ?>" id="tambah_jenis" class="form-control">
						<?= form_error('jenis', '<small class="text-danger ml-3">', '</small>') ?>

					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Pemilik:</label>
						<textarea class="form-control" name="pemilik" id="tambah_pemilik" rows="3"><?= set_value('pemilik') ?></textarea>
						<?= form_error('pemilik', '<small class="text-danger ml-3">', '</small>') ?>

					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Penyedia Data Center :</label>
						<input type="text" name="penyedia" <?= set_value('penyedia') ?> id="tambah_penyedia" class="form-control">
						<?= form_error('penyedia', '<small class="text-danger ml-3">', '</small>') ?>

					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Band Width :</label>
						<input type="text" name="bandwidth" value="<?= set_value('bandwidth') ?>" id="tambah_bandwidth" class="form-control">
						<?= form_error('bandwidth', '<small class="text-danger ml-3">', '</small>') ?>

					</div>

					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Jumlah :</label>
						<input type="number" name="jumlah" value="<?= set_value('jumlah') ?>" id="tambah_jumlah" class="form-control">
						<?= form_error('jumlah', '<small class="text-danger ml-3">', '</small>') ?>

					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Tipe :</label>
						<input type="text" name="tipe" value="<?= set_value('tipe') ?>" id="tambah_tipe" class="form-control">
						<?= form_error('tipe', '<small class="text-danger ml-3">', '</small>') ?>

					</div>
					<div class="form-group">
						<label for="recipient-name" class="col-form-label">Keterangan:</label>
						<textarea class="form-control" name="keterangan_hardwere" rows="3"><?= set_value('keterangan_hardwere') ?></textarea> <?= form_error('keterangan_hardwere', '<small class="text-danger ml-3">', '</small>') ?>


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
