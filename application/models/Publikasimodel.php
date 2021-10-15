<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Publikasimodel extends CI_Model
{
	public function get_perizinan()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id, data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Perizinan' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
	public function get_pelaporan()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id,data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Pelaporan Masyarakat' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
	public function get_informasi()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id,data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Publikasi Informasi' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
	public function get_pembayaran()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id,data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Pembayaran' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
	public function get_pendaftaran()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id,data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Pendaftaran' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
	public function get_lainnya()
	{
		return $this->db->query("SELECT data_umum.nama_intenal, data_umum.id,data_umum.image,data_umum.publikasi,data_umum.keteangan,sasaran_layanan,alamar_url,layanan.jenis_layanan FROM data_umum JOIN layanan ON data_umum.id = layanan.id_aplikasi JOIN verifikasi ON data_umum.id_verifikasi = verifikasi.id WHERE jenis_layanan = 'Lainnya' AND data_umum.publikasi = 'Ya' AND data_umum.id_verifikasi = 2 ORDER BY nama_intenal ASC")->result();
	}
}
