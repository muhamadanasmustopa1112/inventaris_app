<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dataumum extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('dataapplication');
		$this->load->model('fitur');
		$this->load->model('ruanglingkup');
		$this->load->model('hardweremodel');
		$this->load->model('layananmodel');
		$this->load->model('penggunalayananmodel');
		$this->load->model('profilemodel');
		$this->load->model('sertifikasimodel');
		$this->load->model('pengamananmodel');
		$this->load->model('sistemterkaitmodel');
		$this->load->model('logactivity');
		$this->load->model('inbox');
		$this->load->library('Pdf');
		if (!$this->session->userdata('email')) {
			redirect('auth');
		}
	}

	public function index()
	{
		$dataApplicatios['title'] = "Data Umum Aplikasi";
		$dataApplicatios['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataApplicatios['data'] = $this->dataapplication->tampil_data_admin()->result();
		$dataApplicatios['data_history'] = $this->dataapplication->tampil_data_history_admin()->result();

		$this->load->view('admin/template/header',  $dataApplicatios);
		$this->load->view('admin/data_umum',  $dataApplicatios);
		$this->load->view('admin/template/footer',  $dataApplicatios);
	}

	public function verifiy_application()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$id = $this->input->post('id');

		$data = array(
			'id_verifikasi' => 2
		);

		$where = array('id' => $id);

		$data_notifikasi = array(
			'pesan' => 'Accept'
		);

		$where_id_aplikasi = array('id_aplikasi' => $id);

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Approve Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->dataapplication->verify($where, $data, 'data_umum');
		$this->inbox->update($where_id_aplikasi, $data_notifikasi, 'notifikasi');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Verifikasi Aplikasi Berhasil </div>');
		redirect('dataumum');
	}

	public function decline_application()
	{
		$id = $this->input->post('id');
		$pesan = $this->input->post('pesan');
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data = array(
			'id_verifikasi' => 3
		);

		$data_notifikasi = array(
			'pesan' => $pesan
		);

		$where_id_aplikasi = array('id_aplikasi' => $id);

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Decline Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');

		$where = array('id' => $id);

		$this->dataapplication->verify($where, $data, 'data_umum');
		$this->inbox->update($where_id_aplikasi, $data_notifikasi, 'notifikasi');

		$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Tolak Aplikasi Berhasil </div>');
		redirect('dataumum');
	}

	public function edit()
	{
		$dataApplicatios['title'] = "Data Umum Aplikasi";
		$dataApplicatios['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataApplicatios['data'] = $this->dataapplication->tampil_data_admin()->result();


		$this->form_validation->set_rules('nama_internal', 'Nama Intenal', 'required|trim');
		$this->form_validation->set_rules('nama_eksternal', 'nama_eksternal Intenal', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
		$this->form_validation->set_rules('sasaran_layanan', 'sasaran_layanan', 'required|trim');
		$this->form_validation->set_rules('kategori_sistem', 'kategori_sistem', 'required|trim');
		$this->form_validation->set_rules('publikasi', 'publikasi', 'required|trim');
		$this->form_validation->set_rules('kategori_akses', 'kategori_akses', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $dataApplicatios);
			$this->load->view('admin/data_umum', $dataApplicatios);
			$this->load->view('admin/template/footer', $dataApplicatios);
		} else {

			$id = $this->input->post('id');
			$nama_internal = $this->input->post('nama_internal');
			$nama_eksternal = $this->input->post('nama_eksternal');
			$keterangan = $this->input->post('keterangan');
			$sasaran_layanan = $this->input->post('sasaran_layanan');
			$kategori_sistem = $this->input->post('kategori_sistem');
			$kategori_akses = $this->input->post('kategori_akses');
			$alamat_url = $this->input->post('alamat_url');
			$publikasi = $this->input->post('publikasi');

			$data = [

				'id' => $this->input->post('id'),
				'nama_intenal' => $nama_internal,
				'nama_ekstenal' => $nama_eksternal,
				'keteangan' => $keterangan,
				'sasaran_layanan' => $sasaran_layanan,
				'kategori_sistem' => $kategori_sistem,
				'kategori_akses' => $kategori_akses,
				'alamar_url' => $alamat_url,
				'publikasi' => $publikasi
			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Data Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $id);
			$this->db->update('data_umum', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('dataumum');
		}
	}

	public function delete()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$id = $this->input->post('id');

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->dataapplication->delete($id);

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('dataumum');
	}
	public function edit_data()
	{

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = "Data Umum Aplikasi";
		$dataApplicatios['data'] = $this->dataapplication->tampil_data()->result();


		$this->form_validation->set_rules('nama_internal', 'Nama Intenal', 'required|trim');
		$this->form_validation->set_rules('nama_eksternal', 'nama_eksternal Intenal', 'required|trim');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required|trim');
		$this->form_validation->set_rules('sasaran_layanan', 'sasaran_layanan', 'required|trim');
		$this->form_validation->set_rules('kategori_sistem', 'kategori_sistem', 'required|trim');
		$this->form_validation->set_rules('publikasi', 'publikasi', 'required|trim');
		$this->form_validation->set_rules('kategori_akses', 'kategori_akses', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('admin/template/header', $data);
			$this->load->view('admin/data_umum', $dataApplicatios);
			$this->load->view('admin/template/footer', $data);
		} else {

			$id = $this->input->post('id');
			$nama_internal = $this->input->post('nama_internal');
			$nama_eksternal = $this->input->post('nama_eksternal');
			$keterangan = $this->input->post('keterangan');
			$sasaran_layanan = $this->input->post('sasaran_layanan');
			$kategori_sistem = $this->input->post('kategori_sistem');
			$kategori_akses = $this->input->post('kategori_akses');
			$alamat_url = $this->input->post('alamat_url');
			$publikasi = $this->input->post('publikasi');

			$data = [

				'id' => $this->input->post('id'),
				'nama_intenal' => $nama_internal,
				'nama_ekstenal' => $nama_eksternal,
				'keteangan' => $keterangan,
				'sasaran_layanan' => $sasaran_layanan,
				'kategori_sistem' => $kategori_sistem,
				'kategori_akses' => $kategori_akses,
				'alamar_url' => $alamat_url,
				'publikasi' => $publikasi
			];

			$data_log = [
				'id_users' => $userData['id'],
				'aksi' => 'Edit Data Aplikasi'
			];

			$this->db->set('waktu', 'NOW()', FALSE);
			$this->logactivity->insert_activity($data_log, 'log_aktivitas');
			$this->db->where('id', $id);
			$this->db->update('data_umum', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di update </div>');
			redirect('dataumum/user');
		}
	}

	public function delete_data()
	{
		$userData = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$id = $this->input->post('id');
		$this->dataapplication->delete($id);

		$data_log = [
			'id_users' => $userData['id'],
			'aksi' => 'Deleted Aplikasi'
		];

		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Data sudah di Hapus </div>');
		redirect('dataumum/user');
	}

	public function user()
	{
		$data['title'] = "Data Umum Aplikasi";
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$dataApplicatios['data'] = $this->dataapplication->tampil_data()->result();
		$dataApplicatios['data_history'] = $this->dataapplication->tampil_data_history()->result();

		$this->load->view('user/template/header',  $data);
		$this->load->view('user/data_umum',  $dataApplicatios);
		$this->load->view('user/template/footer',  $dataApplicatios);
	}

	public function print()
	{
		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
		$pdf = new FPDF('L', 'mm',  array(210, 330));
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);

		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(57, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Nama Eksternal', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Sasaran Layanan', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Kategori Sistem', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Alamat URL', 1, 1, 'C');

		$pdf->SetFont('Arial', '', 10);
		$d = $this->dataapplication->getAll();
		$no = 1;


		foreach ($d as $data) {
			$cellWidth = 60; //lebar sel
			$cellHeight = 6; //tinggi sel satu baris normal

			//periksa apakah teksnya melibihi kolom?
			if ($pdf->GetStringWidth($data->keteangan) < $cellWidth && $pdf->GetStringWidth($data->alamar_url) < 40) {
				//jika tidak, maka tidak melakukan apa-apa
				$line = 1;
			} else {
				//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
				//dengan memisahkan teks agar sesuai dengan lebar sel
				//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

				$textLength = strlen($data->keteangan);	//total panjang teks
				$errMargin = 5;		//margin kesalahan lebar sel, untuk jaga-jaga
				$startChar = 0;		//posisi awal karakter untuk setiap baris
				$maxChar = 0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
				$textArray = array();	//untuk menampung data untuk setiap baris
				$tmpString = "";		//untuk menampung teks untuk setiap baris (sementara)

				while ($startChar < $textLength) { //perulangan sampai akhir teks
					//perulangan sampai karakter maksimum tercapai
					while (
						$pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
						($startChar + $maxChar) < $textLength
					) {
						$maxChar++;
						$tmpString = substr($data->keteangan, $startChar, $maxChar);
					}
					//pindahkan ke baris berikutnya
					$startChar = $startChar + $maxChar;
					//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
					array_push($textArray, $tmpString);
					//reset variabel penampung
					$maxChar = 0;
					$tmpString = '';
				}
				//dapatkan jumlah baris
				$line = count($textArray);
			}



			//tulis selnya
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
			$pdf->Cell(57, ($line * $cellHeight), $data->nama_intenal, 1, 0); //sesuaikan ketinggian dengan jumlah garis
			$pdf->Cell(50, ($line * $cellHeight), $data->nama_ekstenal, 1, 0); //sesuaikan ketinggian dengan jumlah garis

			//memanfaatkan MultiCell sebagai ganti Cell
			//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
			//ingat posisi x dan y sebelum menulis MultiCell
			$xPos = $pdf->GetX();
			$yPos = $pdf->GetY();
			$pdf->MultiCell($cellWidth, $cellHeight, $data->keteangan, 1);

			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + $cellWidth, $yPos);
			$pdf->Cell(40, ($line * $cellHeight), $data->sasaran_layanan, 1, 1); //sesuaikan ketinggian dengan jumlah garis

			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + 100, $yPos);
			$pdf->Cell(40, ($line * $cellHeight), $data->kategori_sistem, 1, 1); //sesuaikan ketinggian dengan jumlah garis
			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + 140, $yPos);
			$pdf->Cell(50, ($line * $cellHeight), $data->alamar_url, 1, 1); //sesuaikan ketinggian dengan jumlah garis


		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR FITUR APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Fitur', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$data_fitur = $this->fitur->get_all_data_admin()->result();
		$no = 0;

		foreach ($data_fitur as $fitur) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $fitur->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $fitur->nama_fitur, 1, 0);
			$pdf->Cell(0, 6, $fitur->keterangan_fitur, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR RUANG LINGKUP APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Ruang Lingkup', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$data_ruang = $this->ruanglingkup->get_all_data_admin()->result();
		$no = 0;

		foreach ($data_ruang as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(0, 6, $data->ruang_lingkup, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SISTEM KEAMANAN APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Sistem Pengamanan', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$sistem_keamanan = $this->pengamananmodel->get_all_data_admin()->result();
		$no = 0;

		foreach ($sistem_keamanan as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->sistem_pengamanan, 1, 0);
			$pdf->Cell(0, 6, $data->keterangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SISTEM TERKAIT APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Sistem Terkait', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$sistem_terkait = $this->sistemterkaitmodel->get_all_data_admin()->result();
		$no = 0;

		foreach ($sistem_terkait as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->sistem_tekait, 1, 0);
			$pdf->Cell(0, 6, $data->keteangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR LAYANAN APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Jenis Layanan', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$layanan = $this->layananmodel->get_all_data_admin()->result();
		$no = 0;

		foreach ($layanan as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->jenis_layanan, 1, 0);
			$pdf->Cell(0, 6, $data->keterangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR PROFIL APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Instansi', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Alamat', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Provinsi', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Kabupaten', 1, 0, 'C');
		$pdf->Cell(20, 6, 'Kode Pos', 1, 0, 'C');
		$pdf->Cell(30, 6, 'No Telp', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Website', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$profil = $this->profilemodel->get_all_data_admin()->result();
		$no = 0;

		foreach ($profil as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(40, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(40, 6, $data->nama_instansi, 1, 0);
			$pdf->Cell(60, 6, $data->alamat, 1, 0);
			$pdf->Cell(30, 6, $data->provinsi, 1, 0);
			$pdf->Cell(30, 6, $data->kabupaten, 1, 0);
			$pdf->Cell(20, 6, $data->kode_pos, 1, 0);
			$pdf->Cell(30, 6, $data->no_telp, 1, 0);
			$pdf->Cell(50, 6, $data->website, 1, 0);
		}
		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SERVER APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Jenis', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Pemilik', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Penyedia', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Bandwidth', 1, 0, 'C');
		$pdf->Cell(20, 6, 'Jumlah', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Tipe', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$hardwere = $this->hardweremodel->get_all_data_admin()->result();
		$no = 0;

		foreach ($hardwere as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(40, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(40, 6, $data->jenis, 1, 0);
			$pdf->Cell(60, 6, $data->pemilik, 1, 0);
			$pdf->Cell(30, 6, $data->penyedia, 1, 0);
			$pdf->Cell(30, 6, $data->bandwidth, 1, 0);
			$pdf->Cell(20, 6, $data->jumlah, 1, 0);
			$pdf->Cell(30, 6, $data->tipe, 1, 0);
			$pdf->Cell(50, 6, $data->keterangan, 1, 0);
		}

		$pdf->Output();
	}
	public function print_user()
	{
		// error_reporting(0);
		// // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
		// $pdf = new FPDF('L', 'mm',  array(210, 330));
		// $pdf->AddPage();
		// $pdf->SetFont('Arial', 'B', 16);
		// $pdf->Cell(0, 7, 'DAFTAR APLIKASI DISKOMINFO', 0, 1, 'C');
		// $pdf->Cell(10, 7, '', 0, 1);

		// $pdf->SetFont('Arial', 'B', 10);
		// $pdf->Cell(10, 6, 'No', 1, 0, 'C');
		// $pdf->Cell(57, 6, 'Nama Internal', 1, 0, 'C');
		// $pdf->Cell(50, 6, 'Nama Eksternal', 1, 0, 'C');
		// $pdf->Cell(70, 6, 'Keterangan', 1, 0, 'C');
		// $pdf->Cell(40, 6, 'Sasaran Layanan', 1, 0, 'C');
		// $pdf->Cell(40, 6, 'Kategori Sistem', 1, 0, 'C');
		// $pdf->Cell(40, 6, 'Alamat URL', 1, 1, 'C');

		// $pdf->SetFont('Arial', '', 10);
		// $d = $this->dataapplication->tampil_data()->result();
		// $no = 0;
		// foreach ($d as $data) {
		// 	$no++;
		// 	$pdf->Cell(10, 6, $no, 1, 0, 'C');
		// 	$pdf->Cell(57, 6, $data->nama_intenal, 1, 0);
		// 	$pdf->Cell(50, 6, $data->nama_ekstenal, 1, 0);
		// 	$pdf->Cell(70, 6, $data->keteangan, 1, 0);
		// 	$pdf->Cell(40, 6, $data->sasaran_layanan, 1, 0);
		// 	$pdf->Cell(40, 6, $data->kategori_sistem, 1, 0);
		// 	$pdf->Cell(40, 6, $data->alamar_url, 1, 1);
		// }
		// $pdf->Output();


		error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
		$pdf = new FPDF('L', 'mm',  array(210, 330));
		$pdf->AddPage();
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Cell(10, 7, '', 0, 1);

		$pdf->SetFont(
			'Arial',
			'B',
			10
		);
		$pdf->Cell(
			10,
			6,
			'No',
			1,
			0,
			'C'
		);
		$pdf->Cell(57, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Nama Eksternal', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Keterangan', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Sasaran Layanan', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Kategori Sistem', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Alamat URL', 1, 1, 'C');

		$pdf->SetFont('Arial', '', 10);
		$d = $this->dataapplication->tampil_data()->result();
		$no = 1;


		foreach ($d as $data) {
			$cellWidth = 60; //lebar sel
			$cellHeight = 6; //tinggi sel satu baris normal

			//periksa apakah teksnya melibihi kolom?
			if ($pdf->GetStringWidth($data->keteangan) < $cellWidth && $pdf->GetStringWidth($data->alamar_url) < 40) {
				//jika tidak, maka tidak melakukan apa-apa
				$line = 1;
			} else {
				//jika ya, maka hitung ketinggian yang dibutuhkan untuk sel akan dirapikan
				//dengan memisahkan teks agar sesuai dengan lebar sel
				//lalu hitung berapa banyak baris yang dibutuhkan agar teks pas dengan sel

				$textLength = strlen($data->keteangan);	//total panjang teks
				$errMargin = 5;		//margin kesalahan lebar sel, untuk jaga-jaga
				$startChar = 0;		//posisi awal karakter untuk setiap baris
				$maxChar = 0;			//karakter maksimum dalam satu baris, yang akan ditambahkan nanti
				$textArray = array();	//untuk menampung data untuk setiap baris
				$tmpString = "";		//untuk menampung teks untuk setiap baris (sementara)

				while ($startChar < $textLength) { //perulangan sampai akhir teks
					//perulangan sampai karakter maksimum tercapai
					while (
						$pdf->GetStringWidth($tmpString) < ($cellWidth - $errMargin) &&
						($startChar + $maxChar) < $textLength
					) {
						$maxChar++;
						$tmpString = substr($data->keteangan, $startChar, $maxChar);
					}
					//pindahkan ke baris berikutnya
					$startChar = $startChar + $maxChar;
					//kemudian tambahkan ke dalam array sehingga kita tahu berapa banyak baris yang dibutuhkan
					array_push($textArray, $tmpString);
					//reset variabel penampung
					$maxChar = 0;
					$tmpString = '';
				}
				//dapatkan jumlah baris
				$line = count($textArray);
			}



			//tulis selnya
			$pdf->SetFillColor(255, 255, 255);
			$pdf->Cell(10, ($line * $cellHeight), $no++, 1, 0, 'C', true); //sesuaikan ketinggian dengan jumlah garis
			$pdf->Cell(57, ($line * $cellHeight), $data->nama_intenal, 1, 0); //sesuaikan ketinggian dengan jumlah garis
			$pdf->Cell(50, ($line * $cellHeight), $data->nama_ekstenal, 1, 0); //sesuaikan ketinggian dengan jumlah garis

			//memanfaatkan MultiCell sebagai ganti Cell
			//atur posisi xy untuk sel berikutnya menjadi di sebelahnya.
			//ingat posisi x dan y sebelum menulis MultiCell
			$xPos = $pdf->GetX();
			$yPos = $pdf->GetY();
			$pdf->MultiCell($cellWidth, $cellHeight, $data->keteangan, 1);

			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + $cellWidth, $yPos);
			$pdf->Cell(40, ($line * $cellHeight), $data->sasaran_layanan, 1, 1); //sesuaikan ketinggian dengan jumlah garis

			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + 100, $yPos);
			$pdf->Cell(
				40,
				($line * $cellHeight),
				$data->kategori_sistem,
				1,
				1
			); //sesuaikan ketinggian dengan jumlah garis
			//kembalikan posisi untuk sel berikutnya di samping MultiCell 
			//dan offset x dengan lebar MultiCell
			$pdf->SetXY($xPos + 140, $yPos);
			$pdf->Cell(50, ($line * $cellHeight), $data->alamar_url, 1, 1); //sesuaikan ketinggian dengan jumlah garis


		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR FITUR APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Fitur', 1, 0, 'C');
		$pdf->Cell(
			0,
			6,
			'Keterangan',
			1,
			0,
			'C'
		);


		$pdf->SetFont('Arial', '', 10);
		$data_fitur = $this->fitur->get_all_data()->result();
		$no = 0;

		foreach ($data_fitur as $fitur) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $fitur->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $fitur->nama_fitur, 1, 0);
			$pdf->Cell(0, 6, $fitur->keterangan_fitur, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR RUANG LINGKUP APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Ruang Lingkup', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$data_ruang = $this->ruanglingkup->get_all_data()->result();
		$no = 0;

		foreach ($data_ruang as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(0, 6, $data->ruang_lingkup, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SISTEM KEAMANAN APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Sistem Pengamanan', 1, 0, 'C');
		$pdf->Cell(0, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$sistem_keamanan = $this->pengamananmodel->get_all_data()->result();
		$no = 0;

		foreach ($sistem_keamanan as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(
				10,
				6,
				$no,
				1,
				0,
				'C'
			);
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->sistem_pengamanan, 1, 0);
			$pdf->Cell(0, 6, $data->keterangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SISTEM TERKAIT APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(
			65,
			6,
			'Nama Internal',
			1,
			0,
			'C'
		);
		$pdf->Cell(
			65,
			6,
			'Sistem Terkait',
			1,
			0,
			'C'
		);
		$pdf->Cell(
			0,
			6,
			'Keterangan',
			1,
			0,
			'C'
		);


		$pdf->SetFont('Arial', '', 10);
		$sistem_terkait = $this->sistemterkaitmodel->get_all_data()->result();
		$no = 0;

		foreach ($sistem_terkait as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->sistem_tekait, 1, 0);
			$pdf->Cell(0, 6, $data->keteangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR LAYANAN APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(65, 6, 'Jenis Layanan', 1, 0, 'C');
		$pdf->Cell(
			0,
			6,
			'Keterangan',
			1,
			0,
			'C'
		);


		$pdf->SetFont('Arial', '', 10);
		$layanan = $this->layananmodel->get_all_data()->result();
		$no = 0;

		foreach ($layanan as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(65, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(65, 6, $data->jenis_layanan, 1, 0);
			$pdf->Cell(0, 6, $data->keterangan, 1, 0);
		}

		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR PROFIL APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont(
			'Arial',
			'B',
			10
		);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Instansi', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Alamat', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Provinsi', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Kabupaten', 1, 0, 'C');
		$pdf->Cell(
			20,
			6,
			'Kode Pos',
			1,
			0,
			'C'
		);
		$pdf->Cell(30, 6, 'No Telp', 1, 0, 'C');
		$pdf->Cell(
			50,
			6,
			'Website',
			1,
			0,
			'C'
		);


		$pdf->SetFont('Arial', '', 10);
		$profil = $this->profilemodel->get_all_data()->result();
		$no = 0;

		foreach ($profil as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(10, 6, $no, 1, 0, 'C');
			$pdf->Cell(40, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(40, 6, $data->nama_instansi, 1, 0);
			$pdf->Cell(60, 6, $data->alamat, 1, 0);
			$pdf->Cell(30, 6, $data->provinsi, 1, 0);
			$pdf->Cell(30, 6, $data->kabupaten, 1, 0);
			$pdf->Cell(20, 6, $data->kode_pos, 1, 0);
			$pdf->Cell(30, 6, $data->no_telp, 1, 0);
			$pdf->Cell(50, 6, $data->website, 1, 0);
		}
		$pdf->Ln(20);
		$pdf->SetFont('Arial', 'B', 16);
		$pdf->Cell(0, 7, 'DAFTAR SERVER APLIKASI DISKOMINFO', 0, 1, 'C');
		$pdf->Ln(5);
		$pdf->SetFont('Arial', 'B', 10);
		$pdf->Cell(10, 6, 'No', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Nama Internal', 1, 0, 'C');
		$pdf->Cell(40, 6, 'Jenis', 1, 0, 'C');
		$pdf->Cell(60, 6, 'Pemilik', 1, 0, 'C');
		$pdf->Cell(
			30,
			6,
			'Penyedia',
			1,
			0,
			'C'
		);
		$pdf->Cell(
			30,
			6,
			'Bandwidth',
			1,
			0,
			'C'
		);
		$pdf->Cell(20, 6, 'Jumlah', 1, 0, 'C');
		$pdf->Cell(30, 6, 'Tipe', 1, 0, 'C');
		$pdf->Cell(50, 6, 'Keterangan', 1, 0, 'C');


		$pdf->SetFont('Arial', '', 10);
		$hardwere = $this->hardweremodel->get_all_data()->result();
		$no = 0;

		foreach ($hardwere as $data) {
			$no++;
			$pdf->Ln();
			$pdf->Cell(
				10,
				6,
				$no,
				1,
				0,
				'C'
			);
			$pdf->Cell(40, 6, $data->nama_intenal, 1, 0);
			$pdf->Cell(40, 6, $data->jenis, 1, 0);
			$pdf->Cell(60, 6, $data->pemilik, 1, 0);
			$pdf->Cell(
				30,
				6,
				$data->penyedia,
				1,
				0
			);
			$pdf->Cell(
				30,
				6,
				$data->bandwidth,
				1,
				0
			);
			$pdf->Cell(20, 6, $data->jumlah, 1, 0);
			$pdf->Cell(30, 6, $data->tipe, 1, 0);
			$pdf->Cell(50, 6, $data->keterangan, 1, 0);
		}

		$pdf->Output();
	}
}
