<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Fitur extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_fitur($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data_admin()
	{
		return $this->db->query("SELECT fitur.id, fitur.nama_fitur, fitur.keterangan_fitur, data_umum.nama_intenal FROM fitur INNER JOIN data_umum ON fitur.id_aplikasi = data_umum.id");
	}
	public function get_data_history_admin()
	{
		return $this->db->query("SELECT log_fitur.id, log_fitur.nama_fitur, log_fitur.change_date, log_fitur.keterangan_fitur, data_umum.nama_intenal FROM log_fitur INNER JOIN data_umum ON log_fitur.id_aplikasi = data_umum.id");
	}

	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT fitur.id, fitur.nama_fitur, fitur.keterangan_fitur,verifikasi.id, data_umum.nama_intenal FROM fitur INNER JOIN data_umum ON fitur.id_aplikasi = data_umum.id INNER JOIN verifikasi ON verifikasi.id =  data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT log_fitur.id, log_fitur.change_date, log_fitur.nama_fitur, log_fitur.keterangan_fitur,verifikasi.id, data_umum.nama_intenal FROM log_fitur INNER JOIN data_umum ON log_fitur.id_aplikasi = data_umum.id INNER JOIN verifikasi ON verifikasi.id =  data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2");
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']} ");
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('fitur');
	}
}
