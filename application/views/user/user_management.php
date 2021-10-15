				<!-- Begin Page Content -->
				<div style="overflow-x:auto;" class="container-fluid">
					<h2>Data User </h2>
					<?= $this->session->flashdata('message'); ?>
					<table id="table_umum" class="table table-striped table-bordered" style="width:100%">
						<thead>
							<tr>
								<th scope="col">No</th>
								<th scope="col">Username</th>
								<th scope="col">Email</th>
								<th scope="col">Role</th>
								<th scope="col">Status</th>
								<th scope="col">Activation</th>
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
									<td><?= $d->name ?></td>
									<td><?= $d->email ?></td>
									<?php if ($d->role_id == 1) {
									?>
										<td>Admin</td>
									<?php } else { ?>
										<td>Member</td>
									<?php } ?>
									<?php if ($d->is_active == 1) {
									?>
										<td style="color: green;">Active</td>
									<?php } else { ?>
										<td style="color: red;">Non Active</td>
									<?php } ?>
									<td>

										<form action="<?= base_url('admin/user_management_active') ?>" method="POST">

											<input type="hidden" name="id" value="<?= $d->id ?>">
											<button class="btn badge bg-success" style="color: white;">Activation</button>
										</form>
										<form action="<?= base_url('admin/user_management_non_aktif') ?>" method="POST">

											<input type="hidden" name="id" value="<?= $d->id ?>">
											<button class="btn badge bg-danger" style="color: white;">Non Activation</button>
										</form>

									</td>

									<td>
										<button type="button" class="btn badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
											Edit
										</button>
										<form action="<?= base_url('admin/user_management_delete') ?>" method="POST">
											<input type="hidden" name="id" value="<?= $d->id ?>" id="id">
											<button type="submit" class="btn badge bg-danger" style="color: white;">Hapus</button>
										</form>
									</td>

								</tr>
							<?php } ?>
						</tbody>
					</table>

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
									<form method="POST" action="<?= base_url('admin/user_management_edit'); ?>">
										<input type="hidden" name="id" value="<?= $d->id; ?>" id="id_tampil">

										<div class="form-group">
											<label for="username">Username:</label>
											<input type="text" name="name" class="form-control" id="name" placeholder="Your Name" value="<?= $d->name ?>" />
											<?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="email">Email address:</label>
											<input type="email" name="email" class="form-control" id="email" placeholder="Your Email" value="<?= $d->email ?>" />
											<?= form_error('email', '<small class="text-danger ml-3">', '</small>'); ?>
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
