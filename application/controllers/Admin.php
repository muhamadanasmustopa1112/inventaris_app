<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
		$data['title'] = "Dashboard";
		$data['error'] = "";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['dataumum'] = $this->db->get('data_umum');
		$data['data_application'] = $this->db->get('data_umum')->num_rows();
		$data['data_instansi'] = $this->db->get('instansi')->num_rows();
		$data['data_ticket'] = $this->db->get('ticketing')->num_rows();
		$data['data_hardwere'] = $this->db->get('perangkat_keras')->num_rows();
		$data['aplikasi_terverifikasi'] = $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 2")->num_rows();
		$data['aplikasi_not_verify'] = $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 3")->num_rows();
		$data['aplikasi_on_process'] = $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 1")->num_rows();

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/dashboardAdmin', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function add()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Add Data";
		$data['error'] = "";
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['all_users'] = $this->db->get_where('user', ['is_active' => 1])->result();

		$this->form_validation->set_rules('id_users', 'Nama Instansi', 'required|trim');
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
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/add', $data);
			$this->load->view('admin/template/footer', $data);
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
					'id_users' => $this->input->post('id_users', true)
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

			$this->sistemterkaitmodel->input_sistem_terikat($dataSistemTerkait, 'sistem_tekait');
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

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
				Tambah Data Aplikasi Berhasil </div>');
			redirect('admin/add');
		}
	}


	public function user_management()
	{
		$dataUser['title'] = "User Managemnet";
		$dataUser['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataUser['data'] = $this->db->query('SELECT instansi.id,instansi.nama_instansi, instansi.alamat, user.id, user.nama_lengkap, user.nip, user.email, user.role_id, user.is_active, user.date_created FROM instansi
       JOIN user ON user.id_instansi = instansi.id')->result();
		$dataUser['instansi'] = $this->db->get('instansi')->result();
		$this->load->view('admin/template/header', $dataUser);
		$this->load->view('admin/user_management', $dataUser);
		$this->load->view('admin/template/footer', $dataUser);
	}


	public function user_management_edit()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataUser['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataUser['data'] = $this->db->query('SELECT instansi.id,instansi.nama_instansi, instansi.alamat, user.id, user.nama_lengkap, user.nip, user.email, user.role_id, user.is_active, user.date_created FROM instansi
       JOIN user ON user.id_instansi = instansi.id')->result();
		$dataUser['title'] = "User Management";


		$this->form_validation->set_rules('id_instansi', 'Nama Instansi', 'required|trim');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required|trim');
		$this->form_validation->set_rules('nip', 'NIP', 'required|trim');
		$this->form_validation->set_rules('is_active', 'Is Active', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');


		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataUser);
			$this->load->view('admin/user_management', $dataUser);
			$this->load->view('admin/template/footer', $dataUser);
		} else {

			$email = $this->input->post('email', true);
			$dataa = [
				'id_instansi' => $this->input->post('id_instansi', true),
				'nama_lengkap' => $this->input->post('nama_lengkap', true),
				'nip' => $this->input->post('nip', true),
				'email' => $email,
				'role_id' => $this->input->post('role', true),
				'is_active' => $this->input->post('is_active')

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Update User Management'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('user', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('admin/user_management');
		}
	}

	public function user_management_delete()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$id = $this->input->post('id');

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted User Managament'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');

		$this->db->where('id', $id);
		$this->db->delete('user');


		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('admin/user_management');
	}

	public function user_management_add()
	{
		$this->form_validation->set_rules('id_instansi', 'Nama Instansi', 'required|trim');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('role', 'Role', 'required|trim');
		$this->form_validation->set_rules('nip', 'NIP', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules(
			'password',
			'Password',
			'required|trim|min_length[6]'
		);

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataUser['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataUser['data'] = $this->db->query('SELECT instansi.id,instansi.nama_instansi, instansi.alamat, user.id, user.nama_lengkap, user.nip, user.email, user.role_id, user.is_active, user.date_created FROM instansi
       JOIN user ON user.id_instansi = instansi.id')->result();
		$dataUser['title'] = "User Management";

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataUser);
			$this->load->view('admin/user_management', $dataUser);
			$this->load->view('admin/template/footer', $dataUser);
		} else {

			$email = $this->input->post('email', true);
			$dataa = [
				'id_instansi' => htmlspecialchars($this->input->post('id_instansi', true)),
				'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
				'nip' => htmlspecialchars($this->input->post('nip', true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role', true)),
				'is_active' => 1,
				'date_created' => time()

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add User Management'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->insert('user', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Success Add User </div>');
			redirect('admin/user_management');
		}
	}

	public function log_activity()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->logactivity->get_all_activity();
		$data['title'] = "Log Activity";

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/log_activity', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function inbox()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->inbox->get_all();
		$data['title'] = "Inbox";

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/inbox', $data);
		$this->load->view('admin/template/footer', $data);
	}
	public function add_hardwere()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Add data";
		$data['all_users'] = $this->db->get_where('user', ['is_active' => 1])->result();


		$this->form_validation->set_rules('nama_perangkat', 'Nama Perangkat Keras', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/add', $data);
			$this->load->view('admin/template/footer', $data);
		} else {

			$data_perangkat = [
				'id_users' => $this->input->post('id_users', true),
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
			redirect('admin/add');
		}
	}

	public function hardwere()
	{
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['all_users'] = $this->db->get_where('user', ['is_active' => 1])->result();


		$data['data'] = $this->db->query("SELECT perangkat_keras.id, perangkat_keras.nama_perangkat, perangkat_keras.jumlah, user.id, user.nama_lengkap, instansi.id, instansi.nama_instansi FROM perangkat_keras INNER JOIN user ON perangkat_keras.id_users = user.id INNER JOIN instansi ON user.id_instansi =  instansi.id")->result();

		$data['title'] = "Hardwere";

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/hardwere', $data);
		$this->load->view('admin/template/footer', $data);
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

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/edit_all', $data);
		$this->load->view('admin/template/footer', $data);
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
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/edit_all', $data);
			$this->load->view('admin/template/footer', $data);
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
			redirect('dataumum');
		}
	}
}
