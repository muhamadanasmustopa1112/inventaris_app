<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('dataapplication');
		$this->load->model('fitur');
		$this->load->model('ruanglingkup');
		$this->load->model('hardweremodel');
		$this->load->model('layananmodel');
		$this->load->model('penggunalayananmodel');
		$this->load->model('profilemodel');
		$this->load->model('sertifikasimodel');
		$this->load->model('pengamananmodel');
		$this->load->model('sistemterkaitmodel');
		$this->load->model('logactivity');
		$this->load->model('inbox');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Dashboard";
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_application'] = $this->db->get_where('data_umum', ['id_users' => $userData['id']])->num_rows();
		$data['data_ticket'] = $this->db->get_where('ticketing', ['id_users' => $userData['id']])->num_rows();
		$data['data_hardwere'] = $this->db->get_where('perangkat_keras', ['id_users' => $userData['id']])->num_rows();


		$data['aplikasi_terverifikasi'] = $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 2 AND id_users = {$userData['id']}")->num_rows();

		$data['aplikasi_not_verify'] = $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 3 AND id_users = {$userData['id']}")->num_rows();

		$data['aplikasi_on_process'] = $this->db->query("SELECT * FROM data_umum WHERE  id_verifikasi = 1 AND id_users = {$userData['id']}")->num_rows();

		$this->load->view('user/template/header', $data);
		$this->load->view('user/dashboardAdmin', $data);
		$this->load->view('user/template/footer', $data);
	}

	public function add()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Add data";

		$this->form_validation->set_rules('userfile', 'Image', 'file_type[image/jpeg|image/gif|image/png|image/jpg|image/heic]');
		$this->form_validation->set_rules('nama_internal', 'Nama Intenal', 'required|trim');
		$this->form_validation->set_rules('nama_eksternal', 'nama_eksternal Intenal', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
		$this->form_validation->set_rules('sasaran_layanan', 'sasaran_layanan', 'required|trim');
		$this->form_validation->set_rules('kategori_sistem', 'kategori_sistem', 'required|trim');
		$this->form_validation->set_rules('publikasi', 'publikasi', 'required|trim');
		$this->form_validation->set_rules('kategori_akses', 'kategori_akses', 'required|trim');
		$this->form_validation->set_rules('alamat_url', 'alamat_url', 'required|trim');
		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');
		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');
		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');
		$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required|trim');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim');
		$this->form_validation->set_rules('website', 'website', 'required|trim');
		$this->form_validation->set_rules('ruang_lingkup', 'ruang_lingkup', 'required|trim');
		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');
		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $data);
			$this->load->view('user/add', $data);
			$this->load->view('user/template/footer', $data);
		} else {

			$config['upload_path']          = 'uploads/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg|heic';
			$config['max_size']             = 5000;


			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('userfile')) {
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('admin/template/header', $error);
				$this->load->view('admin/add', $error);
				$this->load->view('admin/template/footer', $error);
			} else {

				$data = $this->upload->data();

				$image = $data['file_name'];



				$dataApplication = [

					'nama_intenal' => $this->input->post('nama_internal', true),
					'nama_ekstenal' => $this->input->post('nama_eksternal', true),
					'keteangan' => $this->input->post('keterangan'),
					'sasaran_layanan' => $this->input->post('sasaran_layanan', true),
					'kategori_sistem' => $this->input->post('kategori_sistem', true),
					'kategori_akses' => $this->input->post('kategori_akses', true),
					'alamar_url' => $this->input->post('alamat_url', true),
					'publikasi' => $this->input->post('publikasi', true),
					'image' => $image,
					'id_verifikasi' => 1,
					'id_users' => $userData['id']
				];


				$this->dataapplication->input_data_application($dataApplication, 'data_umum');
			}




			$dataFitur = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true),
				'id_aplikasi' => $this->fitur->get_id_data_application()

			];

			$this->fitur->input_fitur($dataFitur, 'fitur');

			$dataHardwere = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true),
				'id_aplikasi' => $this->hardweremodel->get_id_data_application()

			];


			$this->hardweremodel->input_hardwere($dataHardwere, 'hardwere');

			$dataLayanan = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true),
				'id_aplikasi' => $this->layananmodel->get_id_data_application()

			];


			$this->layananmodel->input_layanan($dataLayanan, 'layanan');



			$dataProfile = [

				'nama_instansi' => $this->input->post('nama_instansi', true),
				'alamat' => $this->input->post('alamat', true),
				'provinsi' => $this->input->post('provinsi', true),
				'kabupaten' => $this->input->post('kabupaten', true),
				'kode_pos' => $this->input->post('kode_pos', true),
				'no_telp' => $this->input->post('no_telp', true),
				'website' => $this->input->post('website', true),
				'id_aplikasi' => $this->profilemodel->get_id_data_application()

			];

			$this->profilemodel->input_profile($dataProfile, 'profil');

			$dataRuangLingkup = [

				'ruang_lingkup' => $this->input->post('ruang_lingkup', true),
				'id_aplikasi' => $this->ruanglingkup->get_id_data_application()

			];

			$this->ruanglingkup->input_ruang_lingkup($dataRuangLingkup, 'ruang_lingkup');



			$dataKeamanan = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true),
				'id_aplikasi' => $this->pengamananmodel->get_id_data_application()

			];


			$this->pengamananmodel->input_pengamanan($dataKeamanan, 'sistem_keamanan');



			$dataSistemTerkait = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true),
				'id_aplikasi' => $this->sistemterkaitmodel->get_id_data_application()

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Data Aplikasi'
			];

			$data_inbox = [
				'id_aplikasi' => $this->inbox->get_id_data_application(),
				'pesan' => 'Need Approve'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->inbox->insert($data_inbox, 'notifikasi');

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->sistemterkaitmodel->input_sistem_terikat($dataSistemTerkait, 'sistem_tekait');

			$this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">
            Tambah Data Aplikasi Berhasil </div>');
			redirect('user/add');
		}
	}

	public function inbox()
	{
		$dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->inbox->get_where_user($dataUser['id']);
		$data['title'] = "Inbox";

		$this->load->view('user/template/header', $data);
		$this->load->view('user/inbox', $data);
		$this->load->view('user/template/footer', $data);
	}

	public function add_hardwere()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Add data";

		$this->form_validation->set_rules('nama_perangkat', 'Nama Perangkat Keras', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $data);
			$this->load->view('user/add', $data);
			$this->load->view('user/template/footer', $data);
		} else {

			$data_perangkat = [
				'id_users' => $this->input->post('id', true),
				'nama_perangkat' => $this->input->post('nama_perangkat', true),
				'jumlah' => $this->input->post('jumlah', true)
			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Hardwere'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->insert('perangkat_keras', $data_perangkat);

			$this->session->set_flashdata('message', '<div class="alert alert-success mt-2" role="alert">
            Tambah Data Aplikasi Berhasil </div>');
			redirect('user/add');
		}
	}

	public function hardwere()
	{
		$dataUser = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data'] = $this->db->query("SELECT perangkat_keras.id, perangkat_keras.nama_perangkat, perangkat_keras.jumlah, user.id, user.nama_lengkap, instansi.id, instansi.nama_instansi FROM perangkat_keras INNER JOIN user ON perangkat_keras.id_users = user.id INNER JOIN instansi ON user.id_instansi =  instansi.id WHERE perangkat_keras.id_users = {$dataUser['id']}")->result();

		$data['title'] = "Hardwere";

		$this->load->view('user/template/header', $data);
		$this->load->view('user/hardwere', $data);
		$this->load->view('user/template/footer', $data);
	}

	public function edit_all()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_aplikasi'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

		$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['hardwere'] = $this->db->get_where('hardwere', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['layanan'] = $this->db->get_where('layanan', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['profil'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['ruang_lingkuo'] = $this->db->get_where('ruang_lingkup', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['sistem_tekait'] = $this->db->get_where('sistem_tekait', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['title'] = "Hardwere";

		$this->load->view('user/template/header', $data);
		$this->load->view('user/edit_all', $data);
		$this->load->view('user/template/footer', $data);
	}

	public function edit_process()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['data_aplikasi'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

		$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['hardwere'] = $this->db->get_where('hardwere', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['layanan'] = $this->db->get_where('layanan', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['profil'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['ruang_lingkuo'] = $this->db->get_where('ruang_lingkup', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['sistem_tekait'] = $this->db->get_where('sistem_tekait', ['id_aplikasi' => $this->input->post('id', true)])->row_array();

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Edit All Data";
		$data['error'] = "";
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('nama_internal', 'Nama Intenal', 'required|trim');
		$this->form_validation->set_rules('nama_eksternal', 'nama_eksternal Intenal', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
		$this->form_validation->set_rules('sasaran_layanan', 'sasaran_layanan', 'required|trim');
		$this->form_validation->set_rules('kategori_sistem', 'kategori_sistem', 'required|trim');
		$this->form_validation->set_rules('publikasi', 'publikasi', 'required|trim');
		$this->form_validation->set_rules('kategori_akses', 'kategori_akses', 'required|trim');
		$this->form_validation->set_rules('alamat_url', 'alamat_url', 'required|trim');
		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');
		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');
		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');
		$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required|trim');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim');
		$this->form_validation->set_rules('website', 'website', 'required|trim');
		$this->form_validation->set_rules('ruang_lingkup', 'ruang_lingkup', 'required|trim');
		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');
		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $data);
			$this->load->view('user/edit_all', $data);
			$this->load->view('user/template/footer', $data);
		} else {

			$dataApplication = [

				'nama_intenal' => $this->input->post('nama_internal', true),
				'nama_ekstenal' => $this->input->post('nama_eksternal', true),
				'keteangan' => $this->input->post('keterangan'),
				'sasaran_layanan' => $this->input->post('sasaran_layanan', true),
				'kategori_sistem' => $this->input->post('kategori_sistem', true),
				'kategori_akses' => $this->input->post('kategori_akses', true),
				'alamar_url' => $this->input->post('alamat_url', true),
				'publikasi' => $this->input->post('publikasi', true)
			];

			$this->db->where('id', $this->input->post('id_aplikasi'));
			$this->db->update('data_umum', $dataApplication);

			$dataFitur = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true)

			];


			$this->db->where('id', $this->input->post('id_fitur'));
			$this->db->update('fitur', $dataFitur);

			$dataHardwere = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true)

			];



			$this->db->where('id', $this->input->post('id_hardwere'));
			$this->db->update('hardwere', $dataHardwere);

			$dataLayanan = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true)

			];



			$this->db->where('id', $this->input->post('id_layanan'));
			$this->db->update('layanan', $dataLayanan);




			$dataProfile = [

				'nama_instansi' => $this->input->post('nama_instansi', true),
				'alamat' => $this->input->post('alamat', true),
				'provinsi' => $this->input->post('provinsi', true),
				'kabupaten' => $this->input->post('kabupaten', true),
				'kode_pos' => $this->input->post('kode_pos', true),
				'no_telp' => $this->input->post('no_telp', true),
				'website' => $this->input->post('website', true)

			];


			$this->db->where('id', $this->input->post('id_profil'));
			$this->db->update('profil', $dataProfile);

			$dataRuangLingkup = [

				'ruang_lingkup' => $this->input->post('ruang_lingkup', true)

			];


			$this->db->where('id', $this->input->post('id_ruang'));
			$this->db->update('ruang_lingkup', $dataRuangLingkup);



			$dataKeamanan = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true)

			];



			$this->db->where('id', $this->input->post('id_keamanan'));
			$this->db->update('sistem_keamanan', $dataKeamanan);



			$dataSistemTerkait = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true)

			];


			$this->db->where('id', $this->input->post('id_terkait'));
			$this->db->update('sistem_tekait', $dataSistemTerkait);

			$data_log = [

				'id_users' => $userData['id'],
				'aksi' => 'Add Data Aplikasi'

			];


			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Edit Data Aplikasi Berhasil </div>');
			redirect('dataumum/user');
		}
	}
}
