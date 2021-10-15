<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Layananmodel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_layanan($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data_admin()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT layanan.id, layanan.jenis_layanan, layanan.keterangan, data_umum.nama_intenal FROM layanan INNER JOIN data_umum ON layanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id WHERE data_umum.id_users");
	}
	public function get_data_history_admin()
	{

		return $this->db->query("SELECT log_layanan.id, log_layanan.jenis_layanan, log_layanan.change_date, log_layanan.keterangan, data_umum.nama_intenal FROM log_layanan INNER JOIN data_umum ON log_layanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id WHERE data_umum.id_users");
	}

	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT layanan.id, layanan.jenis_layanan, verifikasi.id, layanan.keterangan, data_umum.nama_intenal FROM layanan INNER JOIN data_umum ON layanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2  ");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT log_layanan.id, log_layanan.change_date, log_layanan.jenis_layanan, verifikasi.id, log_layanan.keterangan, data_umum.nama_intenal FROM log_layanan INNER JOIN data_umum ON log_layanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2  ");
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('layanan');
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}
}
