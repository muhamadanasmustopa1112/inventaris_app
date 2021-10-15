				<!-- Begin Page Content -->
				<div style="overflow-x:auto;" class="container-fluid">
					<?= $this->session->flashdata('message'); ?>
					<div class="card">
						<div class="card-header">Log Activity</div>
						<div class="card-body">

							<table id="table_umum" class="table  table-bordered" cellspacing="0" style="width:100%">
								<thead>
									<tr>
										<th scope="col">No</th>
										<th scope="col">Name User</th>
										<th scope="col">Action</th>
										<th scope="col">Time</th>

									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($data as $d) {
									?>
										<tr>
											<th scope="row"><?= $no++; ?></th>
											<td><?= $d->nama_lengkap ?></td>
											<td><?= $d->aksi ?></td>
											<td><?= $d->waktu ?></td>
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
