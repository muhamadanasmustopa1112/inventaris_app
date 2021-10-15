				<!-- Begin Page Content -->
				<div class="container-fluid">

					<?= $this->session->flashdata('message'); ?>

					<div class="card mt-3" id="perangkat_lunak">
						<div class="card-header">Edit Data</div>
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
									<form class="data" method="post" action="<?= base_url('user/edit_process'); ?>" enctype="multipart/form-data">
										<div class="tab-content" id="v-pills-tabContent">
											<div class="tab-pane fade show active" id="v-pills-data_umum" role="tabpanel" aria-labelledby="v-pills-home-tab">


												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Internal Aplikasi:</label>

													<input type="text" value="<?= $data_aplikasi['nama_intenal'] ?>" name="nama_internal" id="tambah_nama" class="form-control">

													<input type="hidden" value="<?= $data_aplikasi['id'] ?>" name="id_aplikasi" class="form-control">

													<?= form_error('nama_internal', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nama Eksternal Aplikasi:</label>
													<input type="text" name="nama_eksternal" value="<?= $data_aplikasi['nama_ekstenal'] ?>" id="tambah_eksternal" class="form-control">
													<?= form_error('nama_eksternal', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Keterangan Aplikasi:</label>
													<input type="text" value="<?= $data_aplikasi['keteangan'] ?>" name="keterangan" id="tambah_keterangan" class="form-control">
													<?= form_error('keterangan', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Sasaran Pelayanan:</label>

													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Lokal" <?php if ($data_aplikasi['sasaran_layanan'] == 'Lokal') echo 'checked' ?> /> Lokal</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Regional" <?php if ($data_aplikasi['sasaran_layanan'] == 'Regional') echo 'checked' ?> /> Regional</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Nasional" <?php if ($data_aplikasi['sasaran_layanan'] == 'Nasional') echo 'checked' ?> /> Nasional</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="sasaran_layanan" value=" Internasional" <?php if ($data_aplikasi['sasaran_layanan'] == 'Internasional') echo 'checked' ?>>Internasional</label>
													</div>
													<?= form_error('sasaran_layanan', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kategori Sistem Elektronik/Aplikasi:</label>
													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Strategis" <?php if ($data_aplikasi['kategori_sistem'] == 'Strategis') echo 'checked' ?>> Strategis</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Tinggi" <?php if ($data_aplikasi['kategori_sistem'] == 'Tinggi') echo 'checked' ?>> Tinggi</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_sistem" value="Rendah" <?php if ($data_aplikasi['kategori_sistem'] == 'Rendah') echo 'checked' ?>> Rendah</label>
													</div>
													<?= form_error('kategori_sistem', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label"> Kategori Akses:</label>
													<div class="radio">
														<label><input type="radio" name="kategori_akses" value="Online" <?php if ($data_aplikasi['kategori_akses'] == 'Online') echo 'checked' ?>> Online</label>
													</div>
													<div class="radio">
														<label><input type="radio" name="kategori_akses" value="Offline" <?php if ($data_aplikasi['kategori_akses'] == 'Offline') echo 'checked' ?>> Offline</label>
													</div>
													<?= form_error('kategori_akses', '<small class="text-danger ml-3">', '</small>') ?>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label"> Alamat URL:</label>
														<input type="text" value="<?= $data_aplikasi['alamar_url'] ?>" name="alamat_url" id="tambah_alamat" class="form-control">
														<?= form_error('alamat_url', '<small class="text-danger ml-3">', '</small>') ?>
													</div>
													<div class="form-group">
														<label for="recipient-name" class="col-form-label">Kesediaan untuk dipublikasi melalui layanan publik:</label>

														<div class="radio">
															<label><input type="radio" name="publikasi" value="Ya" <?php if ($data_aplikasi['publikasi'] == 'Ya') echo 'checked' ?>> Ya</label>
														</div>
														<div class="radio">
															<label><input type="radio" name="publikasi" value="TIdak" <?php if ($data_aplikasi['publikasi'] == 'Tidak') echo 'checked' ?>> TIdak</label>

														</div>
														<?= form_error('publikasi', '<small class="text-danger ml-3">', '</small>') ?>
													</div>

												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-fitur" role="tabpanel" aria-labelledby="v-pills-profile-tab">
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Fitur Utama:</label>
													<div class="row">
														<input type="hidden" value="<?= $fitur['id'] ?>" name="id_fitur" class="form-control">

														<div class="col">
															<textarea class="form-control" name="nama_fitur" rows="3" id="tambah_fungsi" placeholder="Fungsi Sistem"><?= $fitur['nama_fitur'] ?> </textarea>
															<?= form_error('nama_fitur', '<small class="text-danger ml-3">', '</small>') ?>
														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_fitur" rows="3" id="tambah_keterangan" placeholder="Keterangan"><?= $fitur['keterangan_fitur']; ?></textarea>
															<?= form_error('keterangan_fitur', '<small class="text-danger ml-3">', '</small>') ?>
														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-ruang" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">

													<input type="hidden" value="<?= $ruang_lingkuo['id'] ?>" name="id_ruang" class="form-control">

													<label for="recipient-name" class="col-form-label">Ruang Lingkup:</label>
													<textarea class="form-control" name="ruang_lingkup" id="tambah_ruang" rows="3" placeholder="Sesuai dengan UU 25 tahun 2009"><?= $ruang_lingkuo['ruang_lingkup'] ?></textarea>
													<?= form_error('ruang_lingkup', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-jenis" role="tabpanel" aria-labelledby="v-pills-settings-tab">
												<div class="form-group mt-3">
													<input type="hidden" value="<?= $layanan['id'] ?>" name="id_layanan" class="form-control">

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

													<textarea class="form-control" id="tambah_keterangan" name="keterangan_layanan" rows="3" placeholder="Keterangan"><?= $layanan['keterangan']; ?></textarea>
													<?= form_error('keterangan_layanan', '<small class="text-danger ml-3">', '</small>') ?>

												</div>


											</div>
											<div class="tab-pane fade" id="v-pills-pengamanan" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<input type="hidden" value="<?= $sistem_keamanan['id'] ?>" name="id_keamanan" class="form-control">

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Sistem Pengamanan:</label>

													<div class="row">
														<div class="col">
															<textarea class="form-control" name="sistem_pengamanan" id="tambah_pengamanan" rows="3" placeholder="Nama Sistem Pengamanan"><?= $sistem_keamanan['sistem_pengamanan'] ?></textarea>
															<?= form_error('sistem_pengamanan', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_keamanan" id="tambah_keterangan" rows="3" placeholder="Keterangan"><?= $sistem_keamanan['keterangan'] ?></textarea>
															<?= form_error('keterangan_keamanan', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
													</div>
												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-terkait" role="tabpanel" aria-labelledby="v-pills-messages-tab">
												<div class="form-group">
													<input type="hidden" value="<?= $sistem_tekait['id'] ?>" name="id_terkait" class="form-control">

													<label for="recipient-name" class="col-form-label">Sistem Terkait:</label>
													<div class="row">
														<div class="col">
															<textarea class="form-control" name="sistem_terkait" id="tambah_sistem" rows="3" placeholder="Nama Sistem Terkait"><?= $sistem_tekait['sistem_tekait'] ?></textarea>
															<?= form_error('sistem_terkait', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
														<div class="col">
															<textarea class="form-control" name="keterangan_terkait" id="tambah_keterangan" rows="3" placeholder="Keterangan"><?= $sistem_tekait['keteangan'] ?></textarea>
															<?= form_error('keterangan_terkait', '<small class="text-danger ml-3">', '</small>') ?>

														</div>
													</div>
												</div>
											</div>


											<div class="tab-pane fade" id="v-pills-profil" role="tabpanel" aria-labelledby="v-pills-messages-tab">

												<div class="form-group">
													<input type="hidden" value="<?= $profil['id'] ?>" name="id_profil" class="form-control">

													<label for="recipient-name" class="col-form-label">Nama Instansi:</label>
													<input type="text" value="<?= $profil['nama_instansi'] ?>" name="nama_instansi" id="tambah_nama" class="form-control">
													<?= form_error('nama_instansi', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Alamat:</label>
													<textarea class="form-control" name="alamat" id="tambah_alamat" rows="3"><?= $profil['alamat'] ?></textarea>
													<?= form_error('alamat', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Provinsi:</label>
													<input type="text" value="<?= $profil['provinsi'] ?>" name="provinsi" id="tambah_provinsi" class="form-control">
													<?= form_error('provinsi', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kota/Kabupaten:</label>
													<input type="text" value="<?= $profil['kabupaten'] ?>" name="kabupaten" id="tambah_kota" class="form-control">
													<?= form_error('kabupaten', '<small class="text-danger ml-3">', '</small>') ?>

												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Kode Pos:</label>
													<input type="text" value="<?= $profil['kode_pos'] ?>" name="kode_pos" id="tambah_kode_pos" class="form-control">
													<?= form_error('kode_pos', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Nomer Telepon:</label>
													<input type="text" value="<?= $profil['no_telp'] ?>" name="no_telp" id="tambah_no_telp" class="form-control">
													<?= form_error('no_telp', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Website:</label>
													<input type="text" value="<?= $profil['website'] ?>" name="website" id="tambah_website" class="form-control">
													<?= form_error('website', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
											</div>
											<div class="tab-pane fade" id="v-pills-perangkat" role="tabpanel" aria-labelledby="v-pills-messages-tab">
												<input type="hidden" value="<?= $hardwere['id'] ?>" name="id_hardwere" class="form-control">

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Jenis :</label>
													<input type="text" value="<?= $hardwere['jenis'] ?>" name="jenis" id="tambah_jenis" class="form-control">
													<?= form_error('jenis', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Pemilik:</label>
													<textarea class="form-control" name="pemilik" id="tambah_pemilik" rows="3"><?= $hardwere['pemilik'] ?></textarea>
													<?= form_error('pemilik', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Penyedia Data Center :</label>
													<input type="text" value="<?= $hardwere['penyedia'] ?>" name="penyedia" id="tambah_penyedia" class="form-control">
													<?= form_error('penyedia', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Band Width :</label>
													<input type="number" value="<?= $hardwere['bandwidth'] ?>" name="bandwidth" id="tambah_bandwidth" class="form-control">
													<?= form_error('bandwidth', '<small class="text-danger ml-3">', '</small>') ?>

												</div>

												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Jumlah :</label>
													<input type="number" value="<?= $hardwere['jumlah'] ?>" name="jumlah" id="tambah_jumlah" class="form-control">
													<?= form_error('jumlah', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Tipe :</label>
													<input type="text" value="<?= $hardwere['tipe'] ?>" name="tipe" id="tambah_tipe" class="form-control">
													<?= form_error('tipe', '<small class="text-danger ml-3">', '</small>') ?>

												</div>
												<div class="form-group">
													<label for="recipient-name" class="col-form-label">Keterangan:</label>
													<input type="text" value=" <?= $hardwere['keterangan'] ?> " name="keterangan_hardwere" id="tambah_keterangan" class="form-control">
													<?= form_error('keterangan_hardwere', '<small class="text-danger ml-3">', '</small>') ?>
												</div>
												<div class="form-group">
													<input type="submit" id="save_data_umum" value="Edit Data" name="save" class="btn btn-primary">
													</input>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
