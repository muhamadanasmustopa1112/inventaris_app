<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profilemodel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_profile($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT profil.id, profil.nama_instansi, profil.alamat, profil.website,  profil.no_telp,  profil.kode_pos,  profil.provinsi, profil.kabupaten, verifikasi.id, data_umum.nama_intenal FROM profil INNER JOIN data_umum ON profil.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']}  AND verifikasi.id = 2");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT log_profil_aplikasi.id, log_profil_aplikasi.nama_instansi, log_profil_aplikasi.alamat, log_profil_aplikasi.website,  log_profil_aplikasi.no_telp,  log_profil_aplikasi.kode_pos,  log_profil_aplikasi.provinsi, log_profil_aplikasi.change_date, log_profil_aplikasi.kabupaten, verifikasi.id, data_umum.nama_intenal FROM log_profil_aplikasi INNER JOIN data_umum ON log_profil_aplikasi.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']}  AND verifikasi.id = 2");
	}

	public function get_all_data_admin()
	{

		return $this->db->query("SELECT profil.id, profil.nama_instansi, profil.alamat, profil.website,  profil.no_telp,  profil.kode_pos,  profil.provinsi, profil.kabupaten, data_umum.nama_intenal FROM profil INNER JOIN data_umum ON profil.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}

	public function get_data_history_admin()
	{

		return $this->db->query("SELECT log_profil_aplikasi.id, log_profil_aplikasi.nama_instansi, log_profil_aplikasi.alamat, log_profil_aplikasi.website,  log_profil_aplikasi.no_telp,  log_profil_aplikasi.kode_pos,  log_profil_aplikasi.provinsi, log_profil_aplikasi.kabupaten, log_profil_aplikasi.change_date, data_umum.nama_intenal FROM log_profil_aplikasi INNER JOIN data_umum ON log_profil_aplikasi.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('profil');
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}
}
