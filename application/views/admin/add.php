				<!-- Begin Page Content -->
				<div class="container-fluid">
					<button class="btn btn-primary" id="softwere">Softwere</button>
					<button class="btn btn-primary" id="hardwere">Hardwere</button>
					<?= $this->session->flashdata('message'); ?>

					<div class="card mt-3" id="perangkat_lunak">
						<div class="card-header">Add Data</div>
						<div class="card-body">
							<div class="row">
								<div class="col-3 ">
									<div class="nav flex-column nav-pills " id="v-pills-tab" role="tablist" aria-orientation="vertical">
										<a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-data_umum" role="tab" aria-controls="v-pills-home" aria-selected="true">Data Umum</a>
										<a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-fitur" role="tab" aria-controls="v-pills-profile" aria-selected="false">Fungsi</a>
										<a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-ruang" role="tab" aria-controls="v-pills-messages" aria-selected="false">Ruang Lingkup</a>
										<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-jenis" role="tab" aria-controls="v-pills-settings" aria-selected="false">Jenis Layanan</a>
										<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-pengamanan" role="tab" aria-controls="v-pills-settings" aria-selected="false">Sistem Pengamanan</a>
										<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-terkait" role="tab" aria-controls="v-pills-settings" aria-selected="false">Sistem Terkait</a>

										<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-profil" role="tab" aria-controls="v-pills-settings" aria-selected="false">Profil Aplikasi</a>
										<a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-perangkat" role="tab" aria-controls="v-pills-settings" aria-selected="false">Perangkat Keras</a>
									</div>
								</div>
								<div class="col-9 border border-primary">
									<form class="data" method="post" action="<?= base_url('admin/add'); ?>" enctype="multipart/form-data">
										<div class="tab-content" id="v-pills-tabContent">
											<div class="tab-pane fade show active" id="v-pills-data_umum" role="tabpanel" aria-labelledby="v-pills-home-tab">
												<div class="form-group mt-3">
													<select class="form-select form-select-lg" name="id_users" aria-label=".form-select-lg example">
														<option selected>Select Pegawai Instansi</option>
														<?php foreach ($all_users as $user) : ?>
															<option value="<?= $user->id ?>"><?= $user->nama_lengkap ?></option>
														<?php endforeach ?>
													</select>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Internal Aplikasi:</label>
													<input type="text" value="<?= set_value('nama_internal'); ?>" name="nama_internal" id="tambah_nama" class="form-control">
													<?= form_error('nama_internal', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Eksternal Aplikasi:</label>
													<input type="text" name="nama_eksternal" value="<?= set_value('nama_eksternal'); ?>" id="tambah_eksternal" class="form-control">
													<?= form_error('nama_eksternal', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Keterangan Aplikasi:</label>
													<input type="text" value="<?= set_value('keterangan'); ?>" name="keterangan" id="tambah_keterangan" class="form-control">
													<?= form_error('keterangan', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Sasaran Pelayanan:</label>

													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Lokal"> Lokal</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Regional"> Regional</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Nasional"> Nasional</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Internasional"> Internasional</label>
													</div>
													<?= form_error('sasaran_layanan', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kategori Sistem Elektronik/Aplikasi:</label>

													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Strategis"> Strategis</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Tinggi"> Tinggi</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Rendah"> Rendah</label>
													</div>
													<?= form_error('kategori_sistem', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label"> Kategori Akses:</label>
													<div class="radio">
														<label><input type="radio" name="kategori_akses" value="Online"> Online</label>

													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_akses" value="Offline"> Offline</label>
													</div>
													<?= form_error('kategori_akses', '<small class="text-danger ml-3">', '</small>') ?>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label"> Alamat URL:</label>
														<input type="text" value="<?= set_value('alamat_url'); ?>" name="alamat_url" id="tambah_alamat" class="form-control">
														<?= form_error('alamat_url', '<small class="text-danger ml-3">', '</small>') ?>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Kesediaan untuk dipublikasi melalui layanan publik:</label>

														<div class="radio">
															<label><input type="radio" name="publikasi" value="Ya"> Ya</label>
														</div>
														<div class="radio">
															<label><input type="radio" name="publikasi" value="TIdak"> TIdak</label>
														</div>
														<?= form_error('publikasi', '<small class="text-danger ml-3">', '</small>') ?>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Tampilan UI Aplikasi:</label>

														<div class="mb-3">

															<input class="form-control" name="userfile" type="file" id="formFile" size="30">
															<?= form_error('userfile', '<small class="text-danger ml-3">', '</small>') ?>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-fitur" role="tabpanel" aria-labelledby="v-pills-profile-tab">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Fitur Utama:</label>
													<div class="row">

														<div class="col">
															<textarea class="form-control" name="nama_fitur" rows="3" id="tambah_fungsi" placeholder="Fungsi Sistem"><?= set_value('nama_fitur'); ?> </textarea>
															<?= form_error('nama_fitur', '<small class="text-danger ml-3">', '</small>') ?>
														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_fitur" rows="3" id="tambah_keterangan" placeholder="Keterangan"><?= set_value('keterangan_fitur'); ?></textarea>
															<?= form_error('keterangan_fitur', '<small class="text-danger ml-3">', '</small>') ?>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-ruang" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">

													<label for="recipient-name" class="col-form-label">Ruang Lingkup:</label>
													<textarea class="form-control" name="ruang_lingkup" id="tambah_ruang" rows="3" placeholder="Sesuai dengan UU 25 tahun 2009"><?= set_value('ruang_lingkup'); ?></textarea>
													<?= form_error('ruang_lingkup', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-jenis" role="tabpanel" aria-labelledby="v-pills-settings-tab">
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
													<?= form_error('jenis_layanan', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">

													<textarea class="form-control" id="tambah_keterangan" name="keterangan_layanan" rows="3" placeholder="Keterangan"><?= set_value('keterangan_layanan'); ?></textarea>
													<?= form_error('keterangan_layanan', '<small class="text-danger ml-3">', '</small>') ?>

												</div>

											</div>
											<div class="tab-pane fade" id="v-pills-pengamanan" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Sistem Pengamanan:</label>

													<div class="row">
														<div class="col">
															<textarea class="form-control" name="sistem_pengamanan" id="tambah_pengamanan" rows="3" placeholder="Nama Sistem Pengamanan"><?= set_value('sistem_pengamanan'); ?></textarea>
															<?= form_error('sistem_pengamanan', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_keamanan" id="tambah_keterangan" rows="3" placeholder="Keterangan"><?= set_value('keterangan_keamanan'); ?></textarea>
															<?= form_error('keterangan_keamanan', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-terkait" role="tabpanel" aria-labelledby="v-pills-messages-tab">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Sistem Terkait:</label>
													<div class="row">
														<div class="col">
															<textarea class="form-control" name="sistem_terkait" id="tambah_sistem" rows="3" placeholder="Nama Sistem Terkait"><?= set_value('sistem_terkait'); ?></textarea>
															<?= form_error('sistem_terkait', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_terkait" id="tambah_keterangan" rows="3" placeholder="Keterangan"><?= set_value('keterangan_terkait'); ?></textarea>
															<?= form_error('keterangan_terkait', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
													</div>
												</div>
											</div>


											<div class="tab-pane fade" id="v-pills-profil" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Instansi:</label>
													<input type="text" value="<?= set_value('nama_instansi'); ?>" name="nama_instansi" id="tambah_nama" class="form-control">
													<?= form_error('nama_instansi', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Alamat:</label>
													<textarea class="form-control" name="alamat" id="tambah_alamat" rows="3"><?= set_value('alamat'); ?></textarea>
													<?= form_error('alamat', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Provinsi:</label>
													<input type="text" value="<?= set_value('provinsi'); ?>" name="provinsi" id="tambah_provinsi" class="form-control">
													<?= form_error('provinsi', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kota/Kabupaten:</label>
													<input type="text" value="<?= set_value('kabupaten'); ?>" name="kabupaten" id="tambah_kota" class="form-control">
													<?= form_error('kabupaten', '<small class="text-danger ml-3">', '</small>') ?>

												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kode Pos:</label>
													<input type="text" value="<?= set_value('kode_pos'); ?>" name="kode_pos" id="tambah_kode_pos" class="form-control">
													<?= form_error('kode_pos', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nomer Telepon:</label>
													<input type="text" value="<?= set_value('no_telp'); ?>" name="no_telp" id="tambah_no_telp" class="form-control">
													<?= form_error('no_telp', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Website:</label>
													<input type="text" value="<?= set_value('website'); ?>" name="website" id="tambah_website" class="form-control">
													<?= form_error('website', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-perangkat" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Jenis :</label>
													<input type="text" value="<?= set_value('jenis'); ?>" name="jenis" id="tambah_jenis" class="form-control">
													<?= form_error('jenis', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Pemilik:</label>
													<textarea class="form-control" name="pemilik" id="tambah_pemilik" rows="3"><?= set_value('pemilik'); ?></textarea>
													<?= form_error('pemilik', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Penyedia Data Center :</label>
													<input type="text" value="<?= set_value('penyedia'); ?>" name="penyedia" id="tambah_penyedia" class="form-control">
													<?= form_error('penyedia', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Band Width :</label>
													<input type="number" value="<?= set_value('bandwidth'); ?>" name="bandwidth" id="tambah_bandwidth" class="form-control">
													<?= form_error('bandwidth', '<small class="text-danger ml-3">', '</small>') ?>

												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Jumlah :</label>
													<input type="number" value="<?= set_value('jumlah'); ?>" name="jumlah" id="tambah_jumlah" class="form-control">
													<?= form_error('jumlah', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Tipe :</label>
													<input type="text" value="<?= set_value('tipe'); ?>" name="tipe" id="tambah_tipe" class="form-control">
													<?= form_error('tipe', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Keterangan:</label>
													<input type="text" <?= set_value('keterangan_hardwere'); ?> name="keterangan_hardwere" id="tambah_keterangan" class="form-control">
													<?= form_error('keterangan_hardwere', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<input type="submit" id="save_data_umum" value="Save Data" name="save" class="btn btn-primary">
													</input>
												</div>

											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3" id="perangkat_keras" style="display: none;">
						<div class="card-header">Hardwere</div>
						<div class="card-body">

							<div class="row">
								<form action="<?= base_url('admin/add_hardwere') ?>" method="POST">
									<div class="col-md-7">
										<select class="form-select" name="id_users" aria-label=".form-select-lg example">
											<option selected>Select Pegawai Instansi</option>
											<?php foreach ($all_users as $user) : ?>
												<option value="<?= $user->id ?>"><?= $user->nama_lengkap ?></option>
											<?php endforeach ?>
										</select>
										<label for="recipient-name" class="col-form-label mt-2">Nama Perangkat:</label>
										<input type="text" name="nama_perangkat" id="tambah_eksternal" class="form-control">
									</div>
									<div class="col-md-7">

										<label for="recipient-name" class="col-form-label">Jumlah:</label>
										<input type="number" name="jumlah" id="tambah_eksternal" class="form-control">
										<button class="btn btn-primary mt-3" type="submit">Add Data</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script>
					$(document).ready(function() {
						$("#softwere").click(function() {
							$("#perangkat_keras").hide(1000);
							$("#perangkat_lunak").show(1000);
						});
						$("#hardwere").click(function() {
							$("#perangkat_lunak").hide(1000);
							$("#perangkat_keras").show(1000);
						});
					});
				</script>
