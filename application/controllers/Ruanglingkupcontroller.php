<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruanglingkupcontroller extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('ruanglingkup');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$dataLayanan['data'] = $this->ruanglingkup->get_all_data_admin()->result();
		$dataLayanan['title'] = "Ruang Lingkup";
		$dataLayanan['data_history'] = $this->ruanglingkup->get_data_history_admin()->result();
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $dataLayanan);
		$this->load->view('admin/view_ruang_lingkup', $dataLayanan);
		$this->load->view('admin/template/footer', $dataLayanan);
	}

	public function edit()
	{
		$dataLayanan['data'] = $this->ruanglingkup->get_all_data_admin()->result();
		$dataLayanan['title'] = "Ruang Lingkup";
		$datLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('ruang_lingkup', 'ruang_lingkup', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataLayanan);
			$this->load->view('admin/view_ruang_lingkup', $dataLayanan);
			$this->load->view('admin/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'ruang_lingkup' => $this->input->post('ruang_lingkup', true)

			];

			$data_log = [

				'id_users' => $userData['id'],
				'aksi' => 'Edit Ruang Lingkup Aplikasi'
			];
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('ruang_lingkup', $dataa);

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('ruanglingkupcontroller');
		}
	}

	public function add()
	{
		$dataLayanan['data'] = $this->ruanglingkup->get_all_data_admin()->result();
		$dataLayanan['data_history'] = $this->ruanglingkup->get_data_history()->result();
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['title'] = "Ruang Lingkup";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('ruang', 'ruang_lingkup', 'required|trim');
		$this->form_validation->set_rules('id', 'id_aplikasi', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataLayanan);
			$this->load->view('admin/view_ruang_lingkup', $dataLayanan);
			$this->load->view('admin/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'ruang_lingkup' => $this->input->post('ruang', true),
				'id_aplikasi' => $this->input->post('id', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Ruang Lingkup Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->ruanglingkup->input_ruang_lingkup($dataa, 'ruang_lingkup');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('ruanglingkupcontroller');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Ruang Lingkup Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->ruanglingkup->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('ruanglingkupcontroller');
	}
	public function edit_data()
	{

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$dataLayanan['data'] = $this->ruanglingkup->get_all_data()->result();
		$dataLayanan['title'] = "Ruang Lingkup";
		$datLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('ruang_lingkup', 'ruang_lingkup', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataLayanan);
			$this->load->view('user/view_ruang_lingkup', $dataLayanan);
			$this->load->view('user/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'ruang_lingkup' => $this->input->post('ruang_lingkup', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Deleted Ruang Lingkup Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where(
				'id',
				$this->input->post('id')
			);
			$this->db->update('ruang_lingkup', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('ruanglingkupcontroller/user');
		}
	}

	public function add_data()
	{

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$dataLayanan['title'] = "Ruang Lingkup";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataLayanan['data'] = $this->ruanglingkup->get_all_data()->result();
		$dataLayanan['dataumum'] = $this->ruanglingkup->data_aplikasi()->result();
		$this->form_validation->set_rules('ruang_lingkup', 'ruang_lingkup', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataLayanan);
			$this->load->view('user/view_ruang_lingkup', $dataLayanan);
			$this->load->view('user/template/footer', $dataLayanan);
		} else {

			$dataa = [

				'ruang_lingkup' => $this->input->post('ruang_lingkup', true),
				'id_aplikasi' => $this->input->post('id_aplikasi', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Ruang Lingkup Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');


			$this->db->insert('ruang_lingkuo', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('ruanglingkupcontroller/user');
		}
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Ruang Lingkup Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->ruanglingkup->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('ruanglingkupcontroller/user');
	}


	public function user()
	{
		$dataLayanan['data'] = $this->ruanglingkup->get_all_data()->result();
		$dataLayanan['data_history'] = $this->ruanglingkup->get_data_history()->result();
		$dataLayanan['dataumum'] = $this->ruanglingkup->data_aplikasi()->result();
		$dataLayanan['title'] = "Ruang Lingkup";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('user/template/header', $dataLayanan);
		$this->load->view('user/view_ruang_lingkup', $dataLayanan);
		$this->load->view('user/template/footer', $dataLayanan);
	}
}
