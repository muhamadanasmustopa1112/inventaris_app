<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticketing extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('ticketingmodal');
		$this->load->library('form_validation');
		$this->load->model('logactivity');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title'] = "Ticketing";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->ticketingmodal->get_all();


		$this->load->view('admin/template/header', $data);
		$this->load->view('admin/ticketing', $data);
		$this->load->view('admin/template/footer', $data);
	}

	public function add()
	{
		$data['title'] = "Ticketing";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->ticketingmodal->get_all();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('jenis', 'jenis', 'required|trim');
		$this->form_validation->set_rules('pengajuan', 'Pengjaun / Masukan', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('user/template/header', $data);
			$this->load->view('user/ticketing', $data);
			$this->load->view('user/template/footer', $data);
		} else {

			$dataPengajuan = [
				'id_users' => $userData['id'],
				'jenis' => $this->input->post('jenis', true),
				'pesan' => $this->input->post('pengajuan', true),
				'status' => 'Menunggu di Acc'
			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Add Ticketing'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$this->db->set('waktu_pengajuan', 'NOW()', FALSE);
			$this->ticketingmodal->insert($dataPengajuan, 'ticketing');



			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Berhasil Tambah Data </div>');
			redirect('ticketing/user');
		}
	}

	public function user()
	{
		$data['title'] = "Ticketing";
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->ticketingmodal->get_where_user($userData['id']);

		$this->load->view('user/template/header', $data);
		$this->load->view('user/ticketing', $data);
		$this->load->view('user/template/footer', $data);
	}

	public function verifiy_application()
	{
		$data['title'] = "Ticketing";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['data'] = $this->ticketingmodal->get_all();


		$id = $this->input->post('id');
		$process = $this->input->post('process');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		if ($process == "Menunggu di Acc") {

			$data = array(
				'status' => 'Dalam Pengerjaan'
			);

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Process Ticketing'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$where = array('id' => $id);
			$this->ticketingmodal->verify($where, $data, 'ticketing');
		} else if ($process == "Dalam Pengerjaan") {

			$data = array(
				'status' => 'Selesai'
			);

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Process Ticketing Selesai'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');

			$where = array('id' => $id);
			$this->db->set('waktu_selesai', 'NOW()', FALSE);
			$this->ticketingmodal->verify($where, $data, 'ticketing');
		}



		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tolak Aplikasi Berhasil </div>');
		redirect('ticketing');



		// $userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		// $this->form_validation->set_rules('ticketing', 'Tikceting', 'required|trim');
		// $this->form_validation->set_rules('waktu_pengajuan', 'Waktu Pengajuan', 'required|trim');
		// $this->form_validation->set_rules('process', 'Process', 'required|trim');

		// if ($this->form_validation->run() == false) {
		// 	$this->load->view('admin/template/header', $data);
		// 	$this->load->view('admin/ticketing', $data);
		// 	$this->load->view('admin/template/footer', $data);
		// } else {

		// 	$id = $this->input->post('id');
		// 	$process = $this->input->post('process');

		// 	$data = [
		// 		'status' => $process
		// 	];




		// 	$data_log = [
		// 		'id_users' => $userData['id'],
		// 		'aksi' => 'Edit Process Ticketing'
		// 	];

		// 	// if ($process == "Selesai") {

		// 	// 	$this->db->set('waktu_selesai', 'NOW()', FALSE);
		// 	// }

		// 	$this->db->set('waktu', 'NOW()', FALSE);
		// 	$this->logactivity->insert_activity($data_log, 'log_aktivitas');

		// 	$this->db->where('id', $id);
		// 	$this->db->update('ticketing', $data);



		// 	$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		//     Verifikasi Aplikasi Berhasil </div>');
		// 	redirect('ticketing');
		// }
	}

	public function decline_application()
	{
		$id = $this->input->post('id');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data = array(
			'status' => 'Decline'
		);

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Decline Ticketing'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$where = array('id' => $id);
		$this->db->set('waktu_selesai', 'NOW()', FALSE);

		$this->ticketingmodal->verify($where, $data, 'ticketing');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Tolak Aplikasi Berhasil </div>');
		redirect('ticketing');
	}
}
