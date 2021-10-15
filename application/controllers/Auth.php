<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('logactivity');
	}

	public function index()
	{
		$this->load->view('landing_page/home');
	}

	public function login()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/login');
		} else {

			$this->_login();
		}
	}


	private function _login()
	{
		$email =  $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {

			if ($user['is_active'] == 0) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Your email is not been actived! </div>');
				redirect('auth/login');
			} else {

				if (password_verify($password, $user['password'])) {

					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];


					if ($data['role_id'] == 1) {
						$this->session->set_userdata($data);

						$data_log = [
							'id_users' => $user['id'],
							'aksi' => 'Login ' . ' ' .  $user['nama_lengkap']
						];

						$this->db->set('waktu', 'NOW()', FALSE);
						$this->logactivity->insert_activity($data_log, 'log_aktivitas');
						redirect('admin');
					} else {
						$this->session->set_userdata($data);
						$data_log = [
							'id_users' => $user['id'],
							'aksi' => 'Login ' . ' ' . $user['nama_lengkap']
						];
						$this->db->set('waktu', 'NOW()', FALSE);
						$this->logactivity->insert_activity($data_log, 'log_aktivitas');
						redirect('user');
					}
				} else {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Your password is wrong! </div>');
					redirect('auth/login');
				}
			}
		} else {


			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Your email is not register! </div>');
			redirect('auth/login');
		}
	}

	public function registration()
	{
		//validsari form regiter
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]');
		$this->form_validation->set_rules(
			'pass',
			'Password',
			'required|trim|min_length[6]|matches[re_pass]',
			[
				'matches' => 'Password not match!',
				'min_length' => 'Password too short!'
			]
		);

		$this->form_validation->set_rules('re_pass', 'Password', 'required|trim|matches[pass]');

		if ($this->form_validation->run() == false) {
			$this->load->view('auth/register');
		} else {

			$email = $this->input->post('email', true);
			$data = [

				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($email),
				'password' => password_hash($this->input->post('pass'), PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 0,
				'date_created' => time()

			];

			$token = base64_encode(random_bytes(32));
			$user_token = [

				'email' => $email,
				'token' => $token,
				'date_created' => time()

			];

			$this->db->insert('user', $data);
			$this->db->insert('user_token', $user_token);

			$this->_sendEmail($token, 'verify');

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Congratulations! your account has been be created. Please Activate </div>');
			redirect('auth');
		}
	}

	private function _sendEmail($token, $type)
	{
		$config = [

			'protocol'   => 'smtp',
			'smtp_host'  => 'ssl://smtp.gmail.com',
			'smtp_user'  => 'cammpapp@gmail.com',
			'smtp_pass'  => 'cammpapp123',
			'smtp_port'  => 465,
			'mail_type'  => 'html',
			'charset'    => 'utf-8',
			'newline'    => "\r\n"
		];

		$this->load->library('email', $config);
		$this->email->initialize($config);

		$this->email->from('cammpapp@gmail.com', 'CAMMP');
		$this->email->to($this->input->post('email', true));

		if ($type == 'verify') {

			$this->email->subject('Account Activation');
			$this->email->message('Click this link to Activation your account : ' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token));
		}

		if ($this->email->send()) {
			return true;
		} else {

			echo $this->email->print_debugger();
			die;
		}
	}

	public function logout()
	{
		$user = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$data_log = [
			'id_users' => $user['id'],
			'aksi' => 'Logout ' . ' ' . $user['nama_lengkap']
		];
		$this->db->set('waktu', 'NOW()', FALSE);
		$this->logactivity->insert_activity($data_log, 'log_aktivitas');

		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been logout account </div>');
		redirect('auth/login');
	}

	public function verify()
	{
		$email = $this->input->get('email');
		$token = $this->input->get('token');

		$user = $this->db->get_where('user', ['email' => $email])->row_array();

		if ($user) {

			$user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

			if ($user_token) {


				if (time() - $user_token['date_created'] < (60 * 60 * 24)) {

					$this->db->set('is_active', 1);
					$this->db->where('email', $email);
					$this->db->update('user');

					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> ' . $email . ' hass been 
                    activated. Please login </div>');
					redirect('auth');
				} else {

					$this->db->delete('user', ['email' => $email]);
					$this->db->delete('user_token', ['email' => $email]);

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Account Activation Failed! Token Expire </div>');
					redirect('auth');
				}
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Account Activation Failed! Wrong Token </div>');
				redirect('auth');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Account Activation Failed! Wrong email </div>');
			redirect('auth');
		}
	}
}
