<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('profilemodel');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$dataLayanan['data'] = $this->profilemodel->get_all_data_admin()->result();
		$dataLayanan['data_history'] = $this->profilemodel->get_data_history_admin()->result();
		$dataLayanan['title'] = "Profile";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $dataLayanan);
		$this->load->view('admin/view_profile', $dataLayanan);
		$this->load->view('admin/template/footer', $dataLayanan);
	}

	public function edit()
	{

		$dataLayanan['data'] = $this->profilemodel->get_all_data_admin()->result();
		$dataLayanan['title'] = "Profile";
		$datLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required|trim');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim');
		$this->form_validation->set_rules('website', 'website', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataLayanan);
			$this->load->view('admin/view_profile', $dataLayanan);
			$this->load->view('admin/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'nama_instansi' => $this->input->post('nama_instansi', true),
				'alamat' => $this->input->post('alamat', true),
				'provinsi' => $this->input->post('provinsi', true),
				'kabupaten' => $this->input->post('kabupaten', true),
				'kode_pos' => $this->input->post('kode_pos', true),
				'no_telp' => $this->input->post('no_telp', true),
				'website' => $this->input->post('website', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Profile Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where(
				'id',
				$this->input->post('id')
			);
			$this->db->update('profil', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('profile');
		}
	}

	public function add()
	{
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Profile Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->profilemodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('profile');
	}
	public function edit_data()
	{

		$dataLayanan['data'] = $this->profilemodel->get_all_data()->result();
		$datLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataLayanan['title'] = "Profile";

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_instansi', 'nama_instansi', 'required|trim');
		$this->form_validation->set_rules('alamat', 'alamat', 'required|trim');
		$this->form_validation->set_rules('provinsi', 'provinsi', 'required|trim');
		$this->form_validation->set_rules('kabupaten', 'kabupaten', 'required|trim');
		$this->form_validation->set_rules('kode_pos', 'kode_pos', 'required|trim');
		$this->form_validation->set_rules('no_telp', 'no_telp', 'required|trim');
		$this->form_validation->set_rules('website', 'website', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataLayanan);
			$this->load->view('user/view_profile', $dataLayanan);
			$this->load->view('user/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'nama_instansi' => $this->input->post('nama_instansi', true),
				'alamat' => $this->input->post('alamat', true),
				'provinsi' => $this->input->post('provinsi', true),
				'kabupaten' => $this->input->post('kabupaten', true),
				'kode_pos' => $this->input->post('kode_pos', true),
				'no_telp' => $this->input->post('no_telp', true),
				'website' => $this->input->post('website', true)

			];


			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Profile Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where(
				'id',
				$this->input->post('id')
			);
			$this->db->update('profil', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('profile/user');
		}
	}

	public function add_data()
	{
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Profile Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->profilemodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('profile/user');
	}


	public function user()
	{
		$dataLayanan['data'] = $this->profilemodel->get_all_data()->result();
		$dataLayanan['data_history'] = $this->profilemodel->get_data_history()->result();
		$dataLayanan['title'] = "Profile";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('user/template/header', $dataLayanan);
		$this->load->view('user/view_profile', $dataLayanan);
		$this->load->view('user/template/footer', $dataLayanan);
	}
}
