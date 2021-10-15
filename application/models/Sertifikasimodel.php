<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikasimodel extends CI_Model
{
	public function get_id_data_application()
	{
		$data_umum = $this->db->query('SELECT * FROM data_umum ORDER BY id DESC LIMIT 1')->row_array();

		return $data_umum['id'];
	}

	public function input_sertifikasi($data, $table)
	{
		$this->db->insert($table, $data);
	}
}
