<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layanan extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('layananmodel');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$dataLayanan['data'] = $this->layananmodel->get_all_data_admin()->result();
		$dataLayanan['data_history'] = $this->layananmodel->get_data_history_admin()->result();
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();
		$dataLayanan['title'] = "Layanan";
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->load->view('admin/template/header', $dataLayanan);
		$this->load->view('admin/view_layanan', $dataLayanan);
		$this->load->view('admin/template/footer', $dataLayanan);
	}

	public function delete()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Layanan Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->layananmodel->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('layanan');
	}

	public function add()
	{
		$dataLayanan['data'] = $this->layananmodel->get_all_data_admin()->result();
		$dataLayanan['title'] = "Layanan";
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();

		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataLayanan);
			$this->load->view('admin/view_layanan', $dataLayanan);
			$this->load->view('admin/template/footer', $dataLayanan);
		} else {


			$dataa = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true),
				'id_aplikasi' => $this->input->post('id_aplikasi')

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Layanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->layananmodel->input_layanan($dataa, 'layanan');
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('layanan');
		}
	}
	public function edit()
	{
		$dataLayanan['data'] = $this->layananmodel->get_all_data_admin()->result();
		$dataLayanan['title'] = "Layanan";
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();

		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataLayanan);
			$this->load->view('admin/view_layanan', $dataLayanan);
			$this->load->view('admin/template/footer', $dataLayanan);
		} else {


			$dataa = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Layanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->where('id', $this->input->post('id'));
			$this->db->update('layanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('layanan');
		}
	}
	public function delete_data()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Layanan Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->layananmodel->delete($id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('layanan/user');
	}

	public function add_data()
	{
		$dataLayanan['title'] = "Layanan";
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();

		$dataLayanan['data'] = $this->layananmodel->get_all_data()->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('id_aplikasi', 'id_aplikasi', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataLayanan);
			$this->load->view('user/view_layanan', $dataLayanan);
			$this->load->view('user/template/footer', $dataLayanan);
		} else {


			$dataLayanan = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true),
				'id_aplikasi' => $this->input->post('id_aplikasi')

			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Layanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');


			$this->layananmodel->input_layanan($dataLayanan, 'layanan');


			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil tambah data </div>');
			redirect('layanan/user');
		}
	}
	public function edit_data()
	{
		$dataLayanan['data'] = $this->layananmodel->get_all_data()->result();
		$dataLayanan['title'] = "Layanan";
		$dataLayanan['dataumum'] = $this->db->get('data_umum')->result();

		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis_layanan', 'jenis_layanan', 'required|trim');
		$this->form_validation->set_rules('keterangan_layanan', 'keterangan_layanan', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('user/template/header', $dataLayanan);
			$this->load->view('user/view_layanan', $dataLayanan);
			$this->load->view('user/template/footer', $dataLayanan);
		} else {


			$dataa = [

				'jenis_layanan' => $this->input->post('jenis_layanan', true),
				'keterangan' => $this->input->post('keterangan_layanan', true)

			];
			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Layanan Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);

			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $this->input->post('id'));
			$this->db->update('layanan', $dataa);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('layanan/user');
		}
	}

	public function user()
	{
		$dataLayanan['data'] = $this->layananmodel->get_all_data()->result();
		$dataLayanan['data_history'] = $this->layananmodel->get_data_history()->result();
		$dataLayanan['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataLayanan['dataumum'] = $this->layananmodel->data_aplikasi()->result();
		$dataLayanan['title'] = "Layanan";

		$this->load->view('user/template/header', $dataLayanan);
		$this->load->view('user/view_layanan', $dataLayanan);
		$this->load->view('user/template/footer', $dataLayanan);
	}
}
