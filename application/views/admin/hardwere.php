				<!-- Begin Page Content -->
				<div style="overflow-x:auto;" class="container-fluid">
					<?= $this->session->flashdata('message'); ?>
					<div class="card">
						<div class="card-header">
							Data Perangkat Keras
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col mb-3 text-right">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas mr-2 fa-plus"></i>Add Hardwere</button>
								</div>
							</div>
							<table id="table_umum" class="table  table-bordered" style="width:100%">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Pemilik</th>
										<th scope="col">Nama Perangkat</th>
										<th scope="col">Jumlah</th>


									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($data as $d) {
									?>
										<tr>
											<th scope="row"><?= $no++; ?></th>
											<td><?= $d->nama_instansi ?></td>
											<td><?= $d->nama_perangkat ?></td>
											<td><?= $d->jumlah ?></td>

										</tr>
									<?php } ?>
								</tbody>
							</table>


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
				</script>

				<!-- Modal Add Data -->
				<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add Data</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form method="POST" action="<?= base_url('user/add_hardwere'); ?>">
									<div class="col">
										<select class="form-select" name="id_users" aria-label=".form-select-lg example">
											<option selected>Select Pegawai Instansi</option>
											<?php foreach ($all_users as $user) : ?>
												<option value="<?= $user->id ?>"><?= $user->nama_lengkap ?></option>
											<?php endforeach ?>
										</select>
										<label for="recipient-name" class="col-form-label mt-2">Nama Perangkat:</label>
										<input type="text" name="nama_perangkat" id="tambah_eksternal" class="form-control">
									</div>
									<div class="col">

										<label for="recipient-name" class="col-form-label">Jumlah:</label>
										<input type="number" name="jumlah" id="tambah_eksternal" class="form-control">
										<button class="btn btn-primary mt-3" type="submit">Add Data</button>
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
