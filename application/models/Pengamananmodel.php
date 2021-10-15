<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengamananmodel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_pengamanan($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data_admin()
	{

		return $this->db->query("SELECT sistem_keamanan.id, sistem_keamanan.sistem_pengamanan, sistem_keamanan.keterangan, data_umum.nama_intenal FROM sistem_keamanan INNER JOIN data_umum ON sistem_keamanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_data_history_admin()
	{

		return $this->db->query("SELECT log_sistem_keamanan.id,log_sistem_keamanan.change_date, log_sistem_keamanan.sistem_pengamanan, log_sistem_keamanan.keterangan, data_umum.nama_intenal FROM log_sistem_keamanan INNER JOIN data_umum ON log_sistem_keamanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT sistem_keamanan.id, sistem_keamanan.sistem_pengamanan, sistem_keamanan.keterangan, verifikasi.id, data_umum.nama_intenal FROM sistem_keamanan INNER JOIN data_umum ON sistem_keamanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT log_sistem_keamanan.id, log_sistem_keamanan.change_date, log_sistem_keamanan.sistem_pengamanan, log_sistem_keamanan.keterangan, verifikasi.id, data_umum.nama_intenal FROM log_sistem_keamanan INNER JOIN data_umum ON log_sistem_keamanan.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('sistem_keamanan');
	}
	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}
}
