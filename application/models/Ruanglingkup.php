<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ruanglingkup extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_ruang_lingkup($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data_admin()
	{
		return $this->db->query("SELECT ruang_lingkup.id, ruang_lingkup.ruang_lingkup, data_umum.nama_intenal FROM ruang_lingkup INNER JOIN data_umum ON ruang_lingkup.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_data_history_admin()
	{
		return $this->db->query("SELECT log_ruang_lingkup.id, log_ruang_lingkup.ruang_lingkup,log_ruang_lingkup.change_date, data_umum.nama_intenal FROM log_ruang_lingkup INNER JOIN data_umum ON log_ruang_lingkup.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}

	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT ruang_lingkup.id, ruang_lingkup.ruang_lingkup, verifikasi.id, data_umum.nama_intenal FROM ruang_lingkup INNER JOIN data_umum ON ruang_lingkup.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT log_ruang_lingkup.id, log_ruang_lingkup.change_date, log_ruang_lingkup.ruang_lingkup, verifikasi.id, data_umum.nama_intenal FROM log_ruang_lingkup INNER JOIN data_umum ON log_ruang_lingkup.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}

	public function delete($id)
	{
		$this->db->where('id_ruang', $id);
		$this->db->delete('ruang_lingkup');
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}

	public function updateData($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
