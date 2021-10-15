<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logactivity extends CI_Model
{
	public function insert_activity($data, $tbale)
	{
		$this->db->insert($tbale, $data);
	}

	public function get_all_activity()
	{


		return $this->db->query("SELECT log_aktivitas.aksi,log_aktivitas.waktu,user.nama_lengkap FROM log_aktivitas INNER JOIN user ON log_aktivitas.id_users = user.id ORDER BY waktu DESC")->result();
	}
}
