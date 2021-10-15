<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataapplication extends CI_Model
{

	public function tampil_data_admin()
	{
		return $this->db->query('SELECT data_umum.id, data_umum.nama_intenal, data_umum.nama_ekstenal, data_umum.publikasi, data_umum.alamar_url, data_umum.kategori_akses, data_umum.kategori_sistem, data_umum.sasaran_layanan, data_umum.keteangan, verifikasi.status FROM data_umum
       JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id');
	}
	public function tampil_data_history_admin()
	{
		return $this->db->query('SELECT log_edit.id_aplikasi, log_edit.nama_intenal, log_edit.nama_ekstenal, log_edit.publikasi, log_edit.alamar_url, log_edit.kategori_akses, log_edit.kategori_sistem, log_edit.change_date, log_edit.sasaran_layanan, log_edit.keteangan, verifikasi.status FROM log_edit
       JOIN verifikasi ON log_edit.id_verifikasi = verifikasi.id');
	}

	public function getAll()
	{
		return $this->db->query("SELECT * FROM data_umum WHERE id_verifikasi = 2 OR id_verifikasi = 3 ")->result();
	}
	public function tampil_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT data_umum.id, data_umum.nama_intenal, data_umum.nama_ekstenal, data_umum.publikasi, data_umum.alamar_url, data_umum.kategori_akses, data_umum.kategori_sistem, data_umum.sasaran_layanan, data_umum.keteangan, verifikasi.status FROM data_umum
       JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE data_umum.id_users ={$data['id']}");
	}
	public function tampil_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT log_edit.id, log_edit.nama_intenal, log_edit.nama_ekstenal, log_edit.publikasi, log_edit.alamar_url, log_edit.kategori_akses, log_edit.change_date, log_edit.kategori_sistem, log_edit.sasaran_layanan, log_edit.keteangan, verifikasi.status FROM log_edit
       JOIN verifikasi ON log_edit.id_verifikasi = verifikasi.id WHERE log_edit.id_users ={$data['id']}");
	}
	public function input_data_application($data, $table)
	{
		$this->db->insert($table, $data);
	}


	public function verify($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('data_umum');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('fitur');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('hardwere');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('layanan');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('pengguna_layanan');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('profil');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('ruang_lingkuo');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('sistem_keamanan');

		$this->db->where('id_aplikasi', $id);
		$this->db->delete('sistem_tekait');
	}
}
