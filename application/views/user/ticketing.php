				<!-- Begin Page Content -->
				<div style="overflow-x:auto;" class="container-fluid">
					<?= $this->session->flashdata('message'); ?>
					<div class="card">
						<div class="card-header">
							Ticketing
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col mb-3 text-right">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fas mr-2 fa-plus"></i>Add Ticket</button>
								</div>
							</div>
							<table id="table_umum" class="table  table-bordered" style="width:100%">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Jenis</th>
										<th scope="col">Ticket</th>
										<th scope="col">Status</th>
										<th scope="col">Waktu Pengajuan</th>
										<th scope="col">Waktu Selesai</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($data as $d) {
									?>
										<tr>
											<th scope="row"><?= $no++; ?></th>
											<td><?= $d->jenis ?></td>
											<td><?= $d->pesan ?></td>
											<?php
											$status = $d->status;
											if ($status == "Menunggu di Acc") {
											?>
												<td><span class="badge bg-primary"><?= $d->status ?></span></td>
											<?php
											} else if ($status == "Dalam Pengerjaan") {
											?>
												<td><span class="badge bg-warning"><?= $d->status ?></span></td>
											<?php
											} else if ($status == "Decline") {
											?>
												<td><span class="badge bg-danger"><?= $d->status ?></span>
												</td>
											<?php
											} else {
											?>
												<td><span class="badge bg-success"><?= $d->status ?></span>
												</td>

											<?php } ?>

											<td><?= $d->waktu_pengajuan ?></td>
											<td><?= $d->waktu_selesai ?></td>

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
								<form method="POST" action="<?= base_url('ticketing/add'); ?>">
									<div class="form-group mt-3">
										<select class="form-select form-select-sm mb-3" name="jenis" aria-label=".form-select-lg example">
											<option value="Pengajuan">Pengajuan</option>
											<option value="Komplain">Komplain</option>
										</select>
									</div>
									<div class="form-group">
										<label for="recipient-name" class="col-form-label">Masukan / Pengajuan:</label>
										<div class="row">
											<div class="col">
												<textarea class="form-control" name="pengajuan" rows="3" id="tambah_fungsi"></textarea>
											</div>
										</div>
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
