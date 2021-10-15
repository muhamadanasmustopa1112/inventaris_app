<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fiturcontroller extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('fitur');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$datFitur['data'] = $this->fitur->get_all_data_admin()->result();
		$datFitur['data_history'] = $this->fitur->get_data_history_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Fitur";

		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/view_fitur', $datFitur);
		$this->load->view('admin/template/footer', $datFitur);
	}

	public function edit()
	{
		$datFitur['title'] = "Fitur";
		$datFitur['data'] = $this->fitur->get_all_data_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_fitur', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$dataa = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true)

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Fitur Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);

			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('fitur', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('fiturcontroller');
		}
	}

	public function add()
	{
		$datFitur['title'] = "Fitur";
		$datFitur['data'] = $this->fitur->get_all_data_admin()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $datFitur);
			$this->load->view('admin/view_fitur', $datFitur);
			$this->load->view('admin/template/footer', $datFitur);
		} else {

			$id_aplikasi = $this->input->post('id_aplikasi');

			$dataa = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true),
				'id_aplikasi' => $id_aplikasi

			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Fitur Aplikasi'
			];

			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->fitur->input_fitur($dataa, 'fitur');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil menambah data </div>');
			redirect('fiturcontroller');
		}
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Fitur Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->fitur->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('fiturcontroller');
	}
	public function edit_data()
	{
		$datFitur['title'] = "Fitur";
		$datFitur['data'] = $this->fitur->get_all_data()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_fitur', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$dataa = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Fitur Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('fitur', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('fiturcontroller/user');
		}
	}

	public function add_data()
	{
		$datFitur['title'] = "Fitur";
		$datFitur['data'] = $this->fitur->get_all_data()->result();
		$datFitur['dataumum'] = $this->db->get('data_umum')->result();
		$datFitur['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('nama_fitur', 'nama_fitur', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_fitur', 'keterangan_fitur', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $datFitur);
			$this->load->view('user/view_fitur', $datFitur);
			$this->load->view('user/template/footer', $datFitur);
		} else {

			$id_aplikasi = $this->input->post('id_aplikasi');

			$dataa = [

				'nama_fitur' => $this->input->post('nama_fitur', true),
				'keterangan_fitur' => $this->input->post('keterangan_fitur', true),
				'id_aplikasi' => $id_aplikasi

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Fitur Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->fitur->input_fitur($dataa, 'fitur');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil menambah data </div>');
			redirect('fiturcontroller/user');
		}
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Fitur Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->fitur->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('fiturcontroller/user');
	}

	public function user()
	{
		$data['title'] = "Fitur";
		$datFitur['data'] = $this->fitur->get_all_data()->result();
		$datFitur['data_history'] = $this->fitur->get_data_history()->result();
		$datFitur['dataumum'] = $this->fitur->data_aplikasi()->result();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('user/template/header', $data);
		$this->load->view('user/view_fitur', $datFitur);
		$this->load->view('user/template/footer', $datFitur);
	}
}
