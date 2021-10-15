<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventaris_api extends CI_Controller
{
	function index()
	{
		$this->load->view('template/header');
		$this->load->view('admin/data_umum');
		$this->load->view('template/footer');
	}

	function action()
	{
		if ($this->input->post('data_action')) {

			$data_action = $this->input->post('data_action');

			if ($data_action == "fetch_all") {

				$api_url = "http://localhost/inventaris_app/api";
				$client = curl_init($api_url);
				curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

				$response = curl_exec($client);
				curl_close($client);

				$result = json_decode($response);

				$output = '';

				if (count($result) > 0) {

					$no = 0;

					foreach ($result as $row) {


						$output .= '
						<tr>
							<th>' . $no++ . '</th>
							<td>' . $row->nama_intenal . '</td>
							<td>' . $row->nama_ekstenal . '</td>
							<td>' . $row->keteangan . '</td>
							<td>' . $row->sasaran_layanan . '</td>
							<td>' . $row->kategori_sistem . '</td>
							<td>' . $row->kategori_akses . '</td>
							<td>' . $row->alamar_url . '</td>
							<td>' . $row->publikasi . '</td>
							<td>' . $row->status . '</td>
							<td> <form action="' . base_url('dataumum/verifiy_application') . '" method="POST">

											<input type="hidden" name="id" value="' . $row->id . '">
											<button class="btn badge bg-success" style="color: white;">Verifikasi</button>
										</form>
										<form action="' . base_url('dataumum/decline_application') . '" method="POST">

											<input type="hidden" name="id" value="' . $row->id . '">
											<button class="btn badge bg-danger" style="color: white;">Tolak</button>
										</form> </td>
						</tr>';
					}
				} else {

					$output .= '
					<tr>
						<td colspan="4" align="center">No Data Found</td>
					</tr>';
				}

				echo $output;
			}
		}
	}
}
