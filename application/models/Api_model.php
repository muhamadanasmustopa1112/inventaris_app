<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{
	function fetch_all()
	{
		return $this->db->query('SELECT data_umum.id, data_umum.nama_intenal, data_umum.nama_ekstenal, data_umum.publikasi, data_umum.alamar_url, data_umum.kategori_akses, data_umum.kategori_sistem, data_umum.sasaran_layanan, data_umum.keteangan, verifikasi.status FROM data_umum
       JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id');
	}
}
