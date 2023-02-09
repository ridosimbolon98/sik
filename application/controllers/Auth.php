<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * @author Rido
	 */

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('m_auth');
		$this->load->model('m_log');	
	}

	public function index()
	{
		$data['title'] = "Sistem Inspeksi Kolaborasi | Login Page";
		$this->load->view('auth/v_loginv2', $data);
	}
	
	public function index1()
	{
		$data['title'] = "Sistem Inspeksi Kolaborasi | On Maintenance Page";
		$this->load->view('dev', $data);
	}

	function login(){
    $this->load->database();
		date_default_timezone_set("Asia/Jakarta");

		$username = htmlspecialchars(trim($this->input->post('username')));
		$password = htmlspecialchars(trim($this->input->post('password')));
		$where    = array(
			'username' => $username
		);

		$user     = $this->m_auth->autentikasi_data('inspeksi_mst.user','inspeksi_mst.bagian',$where)->result();
		
		if(count($user) > 0){
			// cek password user
			$is_valid_user = password_verify($password, $user[0]->password);
			if (!$is_valid_user) {
				$this->session->set_flashdata('error', "Password anda salah. Terima kasih!");
				redirect(base_url("auth"));
			}
			// cek apakah user masih aktif atau tidak
			if ($data[0]->status_user == 'false') {
				$this->session->set_flashdata('error', "User: $username, sudah tidak aktif. Silakan hubungi IT untuk mengaktifkan kembali. Terima kasih!");
				redirect(base_url("auth"));
			}

			// jika user aktif, set session
			$level    = $user[0]->level;
			$nik      = $user[0]->nik;
			$bagian   = $user[0]->bagian;
			$nama     = $user[0]->nama;

			// menyimpan data session
			$data_session  = array(
				'username' => $username,
				'level'    => $level,
				'nik'      => $nik,
				'status'   => "logged",
				'bagian'   => $bagian,
				'nama'     => $nama
			);

			// Mencatat log login
 			$this->session->set_userdata($data_session);
			$log_type = 'login';
			$log_desc = "Login User $username";
			$ip       = $this->input->ip_address();
			$userLog  = $username;
			
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

			switch ($level) {
				case 'ADMIN':
					redirect(base_url("admin"));
					break;
		
				case 'INSPEKTOR':
					redirect(base_url("inspektor"));
					break;

				case 'USER':
					redirect(base_url("user"));
					break;
				
				default:
					// user
					break;
			} 
		} else {
			$this->session->set_flashdata('error', "User: $username, tidak terdaftar pada sistem. Terima kasih!");
			redirect(base_url("auth"));
		}
	}

	// Fungsi untuk logout
	function logout() {
		date_default_timezone_set("Asia/Jakarta");

		// Mencatat log logout
		$log_type = 'logout';
		$log_desc = 'Logout User';
		$ip       = $this->input->ip_address();
		$userLog  = $this->session->userdata("username");
		$data_log = array(
			'username'      => $userLog,
			'type_log'      => $log_type,
			'deskripsi_log' => $log_desc,
			'date'          => date("Y-m-d H:i:s"),
			'ip'            => $ip
		);
		$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

		// hapus session dan redirect ke halaman login
		$this->session->sess_destroy();
		redirect(base_url('auth'));
	}

	
}
