<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sistemterkait extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('sistemterkaitmodel');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$datFitur['title'] = "Sistem Terkait";
		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data_admin()->result();
		$datFitur['data_history'] = $this->sistemterkaitmodel->get_data_history_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $datFitur);
		$this->load->view('admin/view_sistem_terkait', $datFitur);
		$this->load->view('admin/template/footer', $datFitur);
	}

	public function edit()
	{
		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data_admin()->result();
		$datFitur['title'] = "Sistem Terkait";
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();

		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_sistem_terkait', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Sistem Terkait Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('sistem_tekait', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('sistemterkait');
		}
	}

	public function add()
	{
		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['title'] = "Sistem Terkait";
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_sistem_terkait', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true),
				'id_aplikasi' => $this->input->post('id_aplikasi', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Sistem Terkait Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->insert('sistem_tekait', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('sistemterkait');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Sistem Terkait Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->sistemterkaitmodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('sistemterkait');
	}
	public function edit_data()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data()->result();
		$datFitur['title'] = "Sistem Terkait";
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();

		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_sistem_terkait', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Sistem Terkait Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('sistem_tekait', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('sistemterkait/user');
		}
	}

	public function add_data()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['title'] = "Sistem Terkait";
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('sistem_terkait', 'sistem_terkait', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_terkait', 'keterangan_terkait', 'required|trim');


		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_sistem_terkait', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$dataa = [

				'sistem_tekait' => $this->input->post('sistem_terkait', true),
				'keteangan' => $this->input->post('keterangan_terkait', true),
				'id_aplikasi' => $this->input->post('id_aplikasi', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Sistem Terkait Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->insert('sistem_tekait', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('sistemterkait/user');
		}
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Sistem Terkait Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->sistemterkaitmodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('sistemterkait/user');
	}


	public function user()
	{
		$datFitur['data'] = $this->sistemterkaitmodel->get_all_data()->result();
		$datFitur['data_history'] = $this->sistemterkaitmodel->get_data_history()->result();
		$datFitur['dataumum'] = $this->sistemterkaitmodel->data_aplikasi()->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$datFitur['title'] = "Sistem Terkait";

		$this->load->view('user/template/header', $datFitur);
		$this->load->view('user/view_sistem_terkait', $datFitur);
		$this->load->view('user/template/footer', $datFitur);
	}
}
