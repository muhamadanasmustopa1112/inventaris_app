<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hardweremodel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_hardwere($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function get_all_data_admin()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT hardwere.id, hardwere.jenis, hardwere.pemilik, 
                                        hardwere.penyedia, hardwere.bandwidth, hardwere.jumlah,
                                        hardwere.tipe, hardwere.keterangan, data_umum.nama_intenal FROM hardwere INNER JOIN data_umum ON hardwere.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_data_history_admin()
	{
		return $this->db->query("SELECT log_hardwere.id, log_hardwere.jenis, log_hardwere.pemilik, 
                                        log_hardwere.penyedia, log_hardwere.bandwidth, log_hardwere.jumlah,
                                        log_hardwere.tipe, log_hardwere.keterangan, log_hardwere.change_date, data_umum.nama_intenal FROM log_hardwere INNER JOIN data_umum ON log_hardwere.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id");
	}
	public function get_all_data()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT hardwere.id, hardwere.jenis, hardwere.pemilik, 
                                        hardwere.penyedia, hardwere.bandwidth, hardwere.jumlah,
                                        hardwere.tipe, hardwere.keterangan,verifikasi.id, data_umum.nama_intenal FROM hardwere INNER JOIN data_umum ON hardwere.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']}  AND verifikasi.id = 2 ");
	}
	public function get_data_history()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT log_hardwere.id,  log_hardwere.jenis, log_hardwere.pemilik, 
                                        log_hardwere.penyedia, log_hardwere.bandwidth, log_hardwere.jumlah,
                                        log_hardwere.tipe, log_hardwere.change_date, log_hardwere.keterangan,verifikasi.id, data_umum.nama_intenal FROM log_hardwere INNER JOIN data_umum ON log_hardwere.id_aplikasi = data_umum.id INNER JOIN user ON data_umum.id_users = user.id INNER JOIN verifikasi ON verifikasi.id = data_umum.id_verifikasi WHERE data_umum.id_users = {$data['id']}  AND verifikasi.id = 2 ");
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('hardwere');
	}

	public function data_aplikasi()
	{
		$data = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		return $this->db->query("SELECT * FROM data_umum WHERE id_users = {$data['id']}");
	}
}
