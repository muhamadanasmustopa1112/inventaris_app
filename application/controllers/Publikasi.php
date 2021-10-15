<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('publikasimodel');
	}
	public function index()
	{
	}
	public function perizinan()
	{
		$data['data'] = $this->publikasimodel->get_perizinan();
		$this->load->view('publikasi/perizinan', $data);
	}
	public function informasi()
	{
		$data['data'] = $this->publikasimodel->get_informasi();
		$this->load->view('publikasi/informasi', $data);
	}
	public function pembayaran()
	{
		$data['data'] = $this->publikasimodel->get_pembayaran();
		$this->load->view('publikasi/pembayaran', $data);
	}
	public function pendaftaran()
	{
		$data['data'] = $this->publikasimodel->get_pendaftaran();
		$this->load->view('publikasi/pendaftaran', $data);
	}
	public function lainnya()
	{
		$data['data'] = $this->publikasimodel->get_lainnya();
		$this->load->view('publikasi/lainnya', $data);
	}
	public function pelaporan()
	{
		$data['data'] = $this->publikasimodel->get_pelaporan();
		$this->load->view('publikasi/pelaporan', $data);
	}

	public function detail()
	{
		// $key_informasi = $this->input->post('informasi', true);
		// $key_lainnya = $this->input->post('lainnya', true);
		// $key_pelaporan = $this->input->post('pelaporan', true);
		// $key_pemabayaran = $this->input->post('pembayaran', true);
		// $key_pendaftaran = $this->input->post('pendaftaran', true);
		// $key_perizinan = $this->input->post('perizinan', true);

		if (isset($_POST['informasi'])) {

			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();
			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		} else if (isset($_POST['lainnya'])) {
			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();
			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		} else if (isset($_POST['pelaporan'])) {
			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		} else if (isset($_POST['pembayaran'])) {
			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		} else if (isset($_POST['pendaftaran'])) {
			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		} else if (isset($_POST['perizinan'])) {
			$data['data_umum'] = $this->db->get_where('data_umum', ['id' => $this->input->post('id', true)])->row_array();

			$data['fitur'] = $this->db->get_where('fitur', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['sistem_keamanan'] = $this->db->get_where('sistem_keamanan', ['id_aplikasi' => $this->input->post('id', true)])->result();
			$data['profile'] = $this->db->get_where('profil', ['id_aplikasi' => $this->input->post('id', true)])->result();

			$this->load->view('publikasi/detail', $data);
		}
	}
}
