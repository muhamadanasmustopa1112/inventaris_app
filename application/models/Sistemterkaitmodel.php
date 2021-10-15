<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SistemTerkaitModel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_sistem_terikat($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all_data_admin()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT sistem_tekait.id, sistem_tekait.sistem_tekait, sistem_tekait.keteangan, data_umum.nama_intenal FROM sistem_tekait INNER JOIN data_umum ON sistem_tekait.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_data_history_admin()
	{

		return $this->db->query("SELECT log_sistem_terkait.id, log_sistem_terkait.sistem_tekait, log_sistem_terkait.keteangan, log_sistem_terkait.change_date, data_umum.nama_intenal FROM log_sistem_terkait INNER JOIN data_umum ON log_sistem_terkait.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT sistem_tekait.id, sistem_tekait.sistem_tekait, sistem_tekait.keteangan, data_umum.nama_intenal,verifikasi.id FROM sistem_tekait INNER JOIN data_umum ON sistem_tekait.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		return $this->db->query("SELECT log_sistem_terkait.id, log_sistem_terkait.change_date, log_sistem_terkait.sistem_tekait, log_sistem_terkait.keteangan, data_umum.nama_intenal,verifikasi.id FROM log_sistem_terkait INNER JOIN data_umum ON log_sistem_terkait.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']} AND verifikasi.id = 2 ");
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('sistem_tekait');
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}
}
