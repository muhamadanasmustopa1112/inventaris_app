<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inbox extends CI_Model
{


	public function get_all()
	{
		return $this->db->query("SELECT notifikasi.id,notifikasi.id_aplikasi,notifikasi.pesan,notifikasi.waktu,data_umum.nama_intenal,data_umum.id,verifikasi.status FROM notifikasi INNER JOIN data_umum ON notifikasi.id_aplikasi = data_umum.id INNER JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE verifikasi.id = 1 ORDER BY waktu DESC")->result();
	}
	public function get_where_user($id_users)
	{
		return $this->db->query("SELECT notifikasi.id,notifikasi.id_aplikasi,notifikasi.pesan,notifikasi.waktu,data_umum.nama_intenal,data_umum.id,verifikasi.status FROM notifikasi INNER JOIN data_umum ON notifikasi.id_aplikasi = data_umum.id INNER JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id INNER JOIN user ON data_umum.id_users = user.id WHERE user.id = '$id_users' AND verifikasi.id = 2 OR verifikasi.id = 3 ORDER BY waktu DESC")->result();
	}

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function update($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
