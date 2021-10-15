<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sistemkeamanan extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('pengamananmodel');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['data'] = $this->pengamananmodel->get_all_data_admin()->result();
		$datFitur['data_history'] = $this->pengamananmodel->get_data_history_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $datFitur);
		$this->load->view('admin/view_keamanan', $datFitur);
		$this->load->view('admin/template/footer', $datFitur);
	}

	public function edit()
	{
		$datFitur['data'] = $this->pengamananmodel->get_all_data_admin()->result();
		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_keamanan', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Sistem Kemanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('sistem_keamanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('sistemkeamanan');
		}
	}
	public function add()
	{
		$datFitur['data'] = $this->pengamananmodel->get_all_data_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_keamanan', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true),
				'id_aplikasi' => $this->input->post('id_aplikasi', true),

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Sistem Keamanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->insert('sistem_keamanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('sistemkeamanan');
		}
	}
	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Sistem Keamanan Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->pengamananmodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('sistemkeamanan');
	}
	public function edit_data()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();;
		$datFitur['data'] = $this->pengamananmodel->get_all_data()->result();
		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_keamanan', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Sistem Keamanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('sistem_keamanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('sistemkeamanan/user');
		}
	}
	public function add_data()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$datFitur['data'] = $this->pengamananmodel->get_all_data()->result();
		$datFitur['dataumum'] = $this->pengamananmodel->data_aplikasi()->result();

		$this->form_validation->set_rules('sistem_pengamanan', 'sistem_pengamanan', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_keamanan', 'keterangan_keamanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_keamanan', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_pengamanan' => $this->input->post('sistem_pengamanan', true),
				'keterangan' => $this->input->post('keterangan_keamanan', true),
				'id_aplikasi' => $this->input->post('id_aplikasi', true),

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Sistem Keamanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->insert('sistem_keamanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('sistemkeamanan/user');
		}
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Sistem Keamanan Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->pengamananmodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('sistemkeamanan/user');
	}


	public function user()
	{
		$datFitur['title'] = "Sistem Keamanan";
		$datFitur['data'] = $this->pengamananmodel->get_all_data()->result();
		$datFitur['data_history'] = $this->pengamananmodel->get_data_history()->result();
		$datFitur['dataumum'] = $this->pengamananmodel->data_aplikasi()->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('user/template/header', $datFitur);
		$this->load->view('user/view_keamanan', $datFitur);
		$this->load->view('user/template/footer', $datFitur);
	}
}
