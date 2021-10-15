				<!-- Begin Page Content -->
				<div style="overflow-x:auto;" class="container-fluid">
					<?= $this->session->flashdata('message'); ?>
					<div class="card">
						<div class="card-header">
							User Management
						</div>
						<div class="card-body">
							<div class="row">
								<div class="col text-right mb-2">
									<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add"><i class="fas fa-plus mr-3"></i>Add User</button>
								</div>
							</div>
							<div class="table-responsive">
								<table id="table_umum" class="table table-bordered" style="width:100%">
									<thead>
										<tr>
											<th scope="col">No</th>
											<th scope="col">Nama Instansi</th>
											<th scope="col">Nama Lengkap</th>
											<th scope="col">NIP</th>
											<th scope="col">Email</th>
											<th scope="col">Role</th>
											<th scope="col">Status</th>
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
												<td><?= $d->nama_instansi ?></td>
												<td><?= $d->nama_lengkap ?></td>
												<td><?= $d->nip ?></td>
												<td><?= $d->email ?></td>
												<?php if ($d->role_id == 1) {
												?>
													<td>Admin</td>
												<?php } else { ?>
													<td>Member</td>
												<?php } ?>
												<?php if ($d->is_active == 1) {
												?>
													<td style="color: green;"><span class="badge bg-success">Active</span>
													</td>
												<?php } else { ?>
													<td style="color: red;"><span class="badge bg-danger">Non Active </span>
													</td>
												<?php } ?>

												<td>
													<button type="button" class="btn p-2 mb-2 badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal<?= $d->id ?>" style="color: white;">
														<i class="far fa-edit"></i>
													</button>
												</td>

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

										<div class="form-group mt-3">
											<select class="form-select form-select-sm mb-3" name="id_instansi" aria-label=".form-select-lg example">
												<?php foreach ($instansi as $data) : ?>
													<option value="<?= $data->id ?>" <?php if ($d->role_id == 1) echo 'selected = selected'; ?>> <?= $data->nama_instansi ?></option>
												<?php endforeach; ?>
											</select>
										</div>
										<div class="form-group">
											<label for="username">Nama Lengkap:</label>
											<input type="text" name="nama_lengkap" value="<?= $d->nama_lengkap ?>" class="form-control" id="name" placeholder="Nama Lengkap" />
											<?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="username">NIP:</label>
											<input type="number" name="nip" value="<?= $d->nip ?>" class="form-control" id="name" placeholder="NIP" />
											<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="email">Email address:</label>
											<input type="email" name="email" value="<?= $d->email ?>" class="form-control" id="email" placeholder=" Email" />
											<?= form_error('email', '<small class="text-danger ml-3">', '</small>'); ?>
										</div>
										<div class="form-group">
											<label for="role">Role:</label>
											<select class="form-select form-select-sm" name="role" aria-label=".form-select-sm example">
												<option value="1" <?php if ($d->role_id == 1) echo 'selected = selected'; ?>> Admin</option>
												<option value="2" <?php if ($d->role_id == 2) echo 'selected = selected'; ?>> Member</option>
											</select>
											<?= form_error('role', '<small class="text-danger ml-3">', '</small>'); ?>
										</div>

										<div class="form-group">
											<label for="role">Is Active:</label>
											<select class="form-select form-select-sm" name="is_active" aria-label=".form-select-sm example">
												<option value="1" <?php if ($d->is_active == 1) echo 'selected = selected'; ?>> Active</option>
												<option value="0" <?php if ($d->is_active == 0) echo 'selected = selected'; ?>> Non Active</option>
											</select>
											<?= form_error('role', '<small class="text-danger ml-3">', '</small>'); ?>
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

				<!-- Modal Add -->
				<div class="modal fade" id="add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add User</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form method="POST" action="<?= base_url('admin/user_management_add'); ?>">

									<div class="form-group mt-3">
										<select class="form-select form-select-sm mb-3" name="id_instansi" aria-label=".form-select-lg example">
											<?php foreach ($instansi as $d) : ?>
												<option value="<?= $d->id ?>"><?= $d->nama_instansi ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									<div class="form-group">
										<label for="username">Nama Lengkap:</label>
										<input type="text" name="nama_lengkap" class="form-control" id="name" placeholder="Nama Lengkap" />
										<?= form_error('nama_lengkap', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="username">NIP:</label>
										<input type="number" name="nip" class="form-control" id="name" placeholder="NIP" />
										<?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="email">Email address:</label>
										<input type="email" name="email" class="form-control" id="email" placeholder=" Email" />
										<?= form_error('email', '<small class="text-danger ml-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="role">Role:</label>
										<select class="form-select form-select-sm" name="role" aria-label=".form-select-sm example">
											<option selected>Role user</option>
											<option value="1">Admin</option>
											<option value="2">Member</option>
										</select>
										<?= form_error('role', '<small class="text-danger ml-3">', '</small>'); ?>
									</div>
									<div class="form-group">
										<label for="email">Password:</label>
										<input type="password" name="password" class="form-control" />
										<?= form_error('email', '<small class="text-danger ml-3">', '</small>'); ?>
									</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
							</form>
						</div>
					</div>
				</div>
