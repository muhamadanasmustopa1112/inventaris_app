<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardwere extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('hardweremodel');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['data'] = $this->hardweremodel->get_all_data_admin()->result();
		$dataHardwere['data_history'] = $this->hardweremodel->get_data_history_admin()->result();
		$dataHardwere['dataumum'] = $this->db->get('data_umum')->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $dataHardwere);
		$this->load->view('admin/view_hardwere', $dataHardwere);
		$this->load->view('admin/template/footer', $dataHardwere);
	}

	public function edit()
	{
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['dataumum'] = $this->db->get('data_umum')->result();

		$dataHardwere['data'] = $this->hardweremodel->get_all_data_admin()->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataHardwere);
			$this->load->view('admin/view_hardwere', $dataHardwere);
			$this->load->view('admin/template/footer', $dataHardwere);
		} else {

			$dataa = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Hardwere Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('hardwere', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('hardwere');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Hardwere Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->hardweremodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('hardwere');
	}

	public function add()
	{
		$dataHardwere['data'] = $this->hardweremodel->get_all_data_admin()->result();
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['dataumum'] = $this->db->get('data_umum')->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataHardwere);
			$this->load->view('admin/view_hardwere', $dataHardwere);
			$this->load->view('admin/template/footer', $dataHardwere);
		} else {

			$dataa = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true),
				'id_aplikasi' =>  $this->input->post('id_aplikasi')

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Hardwere Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->insert('hardwere', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('hardwere');
		}
	}
	public function edit_data()
	{

		$dataHardwere['data'] = $this->hardweremodel->get_all_data()->result();
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['dataumum'] = $this->db->get('data_umum')->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataHardwere);
			$this->load->view('user/view_hardwere', $dataHardwere);
			$this->load->view('user/template/footer', $dataHardwere);
		} else {

			$dataa = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Hardwere Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('hardwere', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('hardwere/user');
		}
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Hardwere Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->hardweremodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('hardwere/user');
	}

	public function add_data()
	{
		$dataHardwere['data'] = $this->hardweremodel->get_all_data()->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['dataumum'] = $this->db->get('data_umum')->result();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();



		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('pemilik', 'pemilik', 'required|trim');
		$this->form_validation->set_rules('penyedia', 'penyedia', 'required|trim');
		$this->form_validation->set_rules('bandwidth', 'bandwidth', 'required|trim');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|trim');
		$this->form_validation->set_rules('tipe', 'tipe', 'required|trim');
		$this->form_validation->set_rules('keterangan_hardwere', 'keterangan_hardwere', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataHardwere);
			$this->load->view('user/view_hardwere', $dataHardwere);
			$this->load->view('user/template/footer', $dataHardwere);
		} else {

			$dataHardwere = [

				'jenis' => $this->input->post('jenis', true),
				'pemilik' => $this->input->post('pemilik', true),
				'penyedia' => $this->input->post('penyedia', true),
				'bandwidth' => $this->input->post('bandwidth', true),
				'jumlah' => $this->input->post('jumlah', true),
				'tipe' => $this->input->post('tipe'),
				'keterangan' => $this->input->post('keterangan_hardwere', true),
				'id_aplikasi' => $this->input->post('id_aplikasi')

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Deleted Hardwere Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->hardweremodel->input_hardwere($dataHardwere, 'hardwere');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('hardwere/user');
		}
	}

	public function user()
	{
		$dataHardwere['title'] = "Hardwere";
		$dataHardwere['data'] = $this->hardweremodel->get_all_data()->result();
		$dataHardwere['data_history'] = $this->hardweremodel->get_data_history()->result();
		$dataHardwere['dataumum'] = $this->hardweremodel->data_aplikasi()->result();
		$dataHardwere['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('user/template/header', $dataHardwere);
		$this->load->view('user/view_hardwere', $dataHardwere);
		$this->load->view('user/template/footer', $dataHardwere);
	}
}
