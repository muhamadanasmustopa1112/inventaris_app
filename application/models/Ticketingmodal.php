<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ticketingmodal extends CI_Model
{

	public function insert($data, $table)
	{
		$this->db->insert($table, $data);
	}

	public function get_all()
	{
		return $this->db->query("SELECT ticketing.id, ticketing.jenis, ticketing.id_users, ticketing.pesan, ticketing.status, ticketing.waktu_pengajuan, ticketing.waktu_selesai, user.nama_lengkap,user.email FROM ticketing INNER JOIN user ON ticketing.id_users = user.id")->result();
	}
	public function get_where_user($id_users)
	{
		return $this->db->query("SELECT ticketing.id, ticketing.jenis, ticketing.id_users, ticketing.pesan, ticketing.status, ticketing.waktu_pengajuan, ticketing.waktu_selesai, user.nama_lengkap,user.email FROM ticketing INNER JOIN user ON ticketing.id_users = user.id WHERE user.id = '$id_users' ")->result();
	}

	public function verify($where, $data, $table)
	{
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
