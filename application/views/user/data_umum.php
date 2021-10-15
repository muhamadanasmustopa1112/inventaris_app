				<!-- Begin Page Content -->
				<div class="container-fluid">
					<?= $this->session->flashdata('message'); ?>
					<div class="card">
						<div class="card-header">Data Umum</div>
						<div class="card-body">
							<div class="table-responsive">
								<div class="row">
									<div class="col text-right mb-2">
										<form action="<?= base_url('dataumum/print_user') ?>" method="POST">
											<button type="submit" class="btn btn-primary">Print</button>
										</form>
									</div>
								</div>
								<table id="example" class="table table-bordered" width="100%">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama Internal</th>
											<th scope="col">Nama Eksternal</th>
											<th scope="col">Keterangan</th>
											<th scope="col">Sasaran Layanan</th>
											<th scope="col">Kategori Sistem</th>
											<th scope="col">Kategori Akses</th>
											<th scope="col">Alamat Url</th>
											<th scope="col">Publikasi</th>
											<th scope="col">Status Verifikasi</th>
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
												<td><?= $d->nama_ekstenal ?></td>
												<td><?= $d->keteangan ?></td>
												<td><?= $d->sasaran_layanan ?></td>
												<td><?= $d->kategori_sistem ?></td>
												<td><?= $d->kategori_akses ?></td>
												<td><?= $d->alamar_url ?></td>
												<td><?= $d->publikasi ?></td>
												<?php
												$status = $d->status;
												if ($status == "Decline") {
												?>
													<td><span class="badge bg-danger"><?= $d->status ?></span></td>
												<?php
												} else if ($status == "On Process") {
												?>
													<td><span class="badge bg-warning"><?= $d->status ?></span></td>
												<?php
												} else {
												?>
													<td><span class="badge bg-success"><?= $d->status ?></span>
													</td>
												<?php
												}
												?>
												<td>
													<div class="row">
														<div class="col mb-2">
															<!-- <button type="button" class="btn p-2 badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
																	<i class="far fa-edit"></i></button> -->
															<form action="<?= base_url('user/edit_all') ?>" method="POST">
																<input type="hidden" name="id" value="<?= $d->id ?>" id="id">
																<button type="submit" class="btn badge p-2 bg-warning" style="color: white;">
																	<i class="far fa-edit"></i>
																</button>
															</form>
														</div>
														<div class="col">
															<form action="<?= base_url('dataumum/delete') ?>" method="POST">
																<input type="hidden" name="id" value="<?= $d->id ?>" id="id">
																<button type="submit" class="btn badge p-2 bg-danger" style="color: white;"><i class="fas fa-trash"></i></button>
															</form>
														</div>
													</div>
												</td>
											</tr>
										<?php } ?>
									</tbody>
								</table>

							</div>

						</div>
					</div>

					<div class="card mt-4">
						<div class="card-header">Table History</div>
						<div class="card-body">

							<div class="table-responsive">
								<table id="table_history" class="table table-bordered">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama Internal</th>
											<th scope="col">Nama Eksternal</th>
											<th scope="col">Keterangan</th>
											<th scope="col">Sasaran Layanan</th>
											<th scope="col">Kategori Sistem</th>
											<th scope="col">Kategori Akses</th>
											<th scope="col">Alamat Url</th>
											<th scope="col">Publikasi</th>
											<th scope="col">Status Verifikasi</th>
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
												<td><?= $d->nama_ekstenal ?></td>
												<td><?= $d->keteangan ?></td>
												<td><?= $d->sasaran_layanan ?></td>
												<td><?= $d->kategori_sistem ?></td>
												<td><?= $d->kategori_akses ?></td>
												<td><?= $d->alamar_url ?></td>
												<td><?= $d->publikasi ?></td>
												<?php
												$status = $d->status;
												if ($status == "Decline") {
												?>
													<td><span class="badge bg-danger"><?= $d->status ?></span></td>
												<?php
												} else if ($status == "On Process") {
												?>
													<td><span class="badge bg-warning"><?= $d->status ?></span></td>
												<?php
												} else {
												?>
													<td><span class="badge bg-success"><?= $d->status ?></span>
													</td>
												<?php
												}
												?>
												<td><?= $d->change_date ?></td>
											</tr>
										<?php
										} ?>
									</tbody>
								</table>

							</div>

						</div>
					</div>
				</div>
				<!-- /.container-fluid -->

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
									<form method="POST" action="<?= base_url('dataumum/edit'); ?>">
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Nama Internal Aplikasi:</label>
											<input type="text" name="nama_internal" id="tambah_nama" class="form-control" value="<?= $d->nama_intenal ?>">
											<input type="hidden" name="id" id="tambah_nama" class="form-control" value="<?= $d->id ?>">
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Nama Eksternal Aplikasi:</label>
											<input type="text" name="nama_eksternal" id="tambah_eksternal" class="form-control" value="<?= $d->nama_ekstenal ?>">
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Keterangan Aplikasi:</label>
											<input type="text" name="keterangan" id="tambah_keterangan" class="form-control" value="<?= $d->keteangan ?>">
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Sasaran Pelayanan:</label>
											<div class="radio">
												<label><input type="radio" name="sasaran_layanan" value=" Lokal" <?php if ($d->sasaran_layanan == 'Lokal') echo 'checked' ?> /> Lokal</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="sasaran_layanan" value=" Regional" <?php if ($d->sasaran_layanan == 'Regional') echo 'checked' ?> /> Regional</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="sasaran_layanan" value=" Nasional" <?php if ($d->sasaran_layanan == 'Nasional') echo 'checked' ?> /> Nasional</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="sasaran_layanan" value=" Internasional" <?php if ($d->sasaran_layanan == 'Internasional') echo 'checked' ?>>Internasional</label>
											</div>
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">Kategori Sistem Elektronik/Aplikasi:</label>
											<div class="radio">
												<label><input type="radio" name="kategori_sistem" value="Strategis" <?php if ($d->kategori_sistem == 'Strategis') echo 'checked' ?>> Strategis</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="kategori_sistem" value="Tinggi" <?php if ($d->kategori_sistem == 'Tinggi') echo 'checked' ?>> Tinggi</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="kategori_sistem" value="Rendah" <?php if ($d->kategori_sistem == 'Rendah') echo 'checked' ?>> Rendah</label>
											</div>
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label"> Kategori Akses:</label>
											<div class="radio">
												<label><input type="radio" name="kategori_akses" value="Online" <?php if ($d->kategori_akses == 'Online') echo 'checked' ?>> Online</label>
											</div>
											<div class="radio">
												<label><input type="radio" name="kategori_akses" value="Offline" <?php if ($d->kategori_akses == 'Offline') echo 'checked' ?>> Offline</label>
											</div>
											<div class="form-group">
												<label for="recipient-name" class="col-form-label"> Alamat URL:</label>
												<input type="text" name="alamat_url" id="tambah_alamat" class="form-control" value="<?= $d->alamar_url ?>">
											</div>
											<div class="form-group">
												<label for="recipient-name" class="col-form-label">Kesediaan untuk dipublikasi melalui layanan publik:</label>
												<div class="radio">
													<label><input type="radio" name="publikasi" value="Ya" <?php if ($d->publikasi == 'Ya') echo 'checked' ?>> Ya</label>
												</div>
												<div class="radio">
													<label><input type="radio" name="publikasi" value="TIdak" <?php if ($d->publikasi == 'Tidak') echo 'checked' ?>> TIdak</label>

												</div>
											</div>
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

				<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
				<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
				<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
				<script>
					$(document).ready(function() {
						$('#example').DataTable();
						$('#table_history').DataTable();
					});
				</script>
