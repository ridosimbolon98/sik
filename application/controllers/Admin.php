<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Rido
 */

class Admin extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('level') != "ADMIN") {
			echo "<script>alert('Anda dilarang akses halaman ini tanpa autentikasi');</script>";
			echo "<script>location='".base_url()."auth';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_auth');
			$this->load->model('m_admin');
			$this->load->model('m_log');
		}		
	}

	
	function index(){
		$data['title'] = "Data Inspeksi";
		redirect(base_url('/admin/area_temuan'));
	}
	
	function db(){
		date_default_timezone_set("Asia/Jakarta");

		$data['title'] = "Data Inspeksi";
		$tahun         = $this->input->post('tahun');
		if (isset($tahun)) {
			$data['tahun'] = $tahun;
			$now = date('Y');

			// untuk box jumlah temuan
			$data['tem_baru']     = $this->m_admin->getSumTemNew($now)->num_rows();
			$data['tem_open']     = $this->m_admin->getSumTemOpen($tahun)->num_rows();
			$data['tem_blm_dtgp'] = $this->m_admin->getSumTemBlmDtgp($tahun)->num_rows();
			$data['tem_close']    = $this->m_admin->getSumTemClose($tahun)->num_rows();

			// untuk grafik temuan
			$data['jml_tem_jan'] = $this->m_admin->getSumTemuanPeriode($tahun.'-01')->result(); 
			$data['jml_tem_feb'] = $this->m_admin->getSumTemuanPeriode($tahun.'-02')->result(); 
			$data['jml_tem_mar'] = $this->m_admin->getSumTemuanPeriode($tahun.'-03')->result(); 
			$data['jml_tem_apr'] = $this->m_admin->getSumTemuanPeriode($tahun.'-04')->result(); 
			$data['jml_tem_mei'] = $this->m_admin->getSumTemuanPeriode($tahun.'-05')->result(); 
			$data['jml_tem_jun'] = $this->m_admin->getSumTemuanPeriode($tahun.'-06')->result(); 
			$data['jml_tem_jul'] = $this->m_admin->getSumTemuanPeriode($tahun.'-07')->result(); 
			$data['jml_tem_agu'] = $this->m_admin->getSumTemuanPeriode($tahun.'-08')->result(); 
			$data['jml_tem_sep'] = $this->m_admin->getSumTemuanPeriode($tahun.'-09')->result(); 
			$data['jml_tem_okt'] = $this->m_admin->getSumTemuanPeriode($tahun.'-10')->result(); 
			$data['jml_tem_nov'] = $this->m_admin->getSumTemuanPeriode($tahun.'-11')->result(); 
			$data['jml_tem_des'] = $this->m_admin->getSumTemuanPeriode($tahun.'-12')->result(); 
			
		} else {
			$tahun = date('Y');
			$data['tahun'] = $tahun;

			$now = date('Y');

			// untuk box jumlah temuan
			$data['tem_baru']     = $this->m_admin->getSumTemNew($now)->num_rows();
			$data['tem_open']     = $this->m_admin->getSumTemOpen($tahun)->num_rows();
			$data['tem_blm_dtgp'] = $this->m_admin->getSumTemBlmDtgp($tahun)->num_rows();
			$data['tem_close']    = $this->m_admin->getSumTemClose($tahun)->num_rows();

			// untuk grafik temuan
			$data['jml_tem_jan'] = $this->m_admin->getSumTemuanPeriode($tahun.'-01')->result(); 
			$data['jml_tem_feb'] = $this->m_admin->getSumTemuanPeriode($tahun.'-02')->result(); 
			$data['jml_tem_mar'] = $this->m_admin->getSumTemuanPeriode($tahun.'-03')->result(); 
			$data['jml_tem_apr'] = $this->m_admin->getSumTemuanPeriode($tahun.'-04')->result(); 
			$data['jml_tem_mei'] = $this->m_admin->getSumTemuanPeriode($tahun.'-05')->result(); 
			$data['jml_tem_jun'] = $this->m_admin->getSumTemuanPeriode($tahun.'-06')->result(); 
			$data['jml_tem_jul'] = $this->m_admin->getSumTemuanPeriode($tahun.'-07')->result(); 
			$data['jml_tem_agu'] = $this->m_admin->getSumTemuanPeriode($tahun.'-08')->result(); 
			$data['jml_tem_sep'] = $this->m_admin->getSumTemuanPeriode($tahun.'-09')->result(); 
			$data['jml_tem_okt'] = $this->m_admin->getSumTemuanPeriode($tahun.'-10')->result(); 
			$data['jml_tem_nov'] = $this->m_admin->getSumTemuanPeriode($tahun.'-11')->result(); 
			$data['jml_tem_des'] = $this->m_admin->getSumTemuanPeriode($tahun.'-12')->result(); 
			
		}
		
		$this->load->view('admin/v_db', $data);
	}

	// menampilkan data user
	function user() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Data User";

		$data['bagian'] = $this->m_admin->getData('inspeksi_mst.bagian')->result();
		$data['user']   = $this->m_admin->getData('inspeksi_mst.user')->result();

		$this->load->view('admin/v_user', $data);
	}

	// tambah user ke sistem
	function tambah_user() {
		date_default_timezone_set("Asia/Jakarta");

		// ambil input dari form
		$nik      = trim(htmlspecialchars($this->input->post("nik")));
		$nama     = trim(htmlspecialchars($this->input->post("nama")));
		$pwd      = trim($this->input->post("password"));
		$bagian   = trim(htmlspecialchars($this->input->post("bagian")));
		$level    = trim(htmlspecialchars($this->input->post("level")));
		$inputed  = $this->session->userdata("username");

		// hash password
		$password = password_hash($pwd, PASSWORD_DEFAULT);

		// cek apakah nik sudah ada di sistem atau tidak
		$where_nik = array('nik' => $nik);
		$is_nik    = $this->m_admin->getWhere('inspeksi_mst.user', $where_nik)->result();
		if (count($is_nik) > 0) {
			$this->session->set_flashdata("warning", "NIK: $nik, sudah ada di dalam sistem. Silakan pilih NIK lain.");
			redirect(base_url("admin/user"));
			exit;
		}

		$user_baru = array(
			'nik'        => $nik,
			'nama'       => $nama,
			'username'   => $nik,
			'password'   => $password,
			'level'      => $level,
			'bagian'     => $bagian,
			'status_user'=> true,
			'created_at' => date('Y-m-d H:m:s'),
			'updated_at' => date('Y-m-d H:m:s'),
			'input_by'   => $inputed
		);

		$insert_data = $this->m_admin->insertData('inspeksi_mst.user', $user_baru);
		if ($insert_data) {
			$log_type = 'insert';
			$log_desc = "Tambah Data User dengan NIK: $nik";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

			$this->session->set_flashdata("success", "Berhasil input user baru dengan username: $nik");
			redirect(base_url("admin/user"));
		} else {
			$this->session->set_flashdata("error", "Gagal input user baru");
			redirect(base_url("admin/user"));
		}
	}

	// ubah data user
	function ubah_user() {
		date_default_timezone_set("Asia/Jakarta");

		// dapatkan input dari user
		$nik     = trim(htmlspecialchars($this->input->post("nik")));
		$nik_old = trim(htmlspecialchars($this->input->post("nik1")));
		$nama    = trim(htmlspecialchars($this->input->post("nama")));
		$bagian  = trim(htmlspecialchars($this->input->post("bagian")));
		$level   = trim(htmlspecialchars($this->input->post("level")));
		$inputed = $this->session->userdata("username");

		// cek apakah nik sudah ada di sistem atau tidak jika NIK berubah
		$where_nik = array('nik' => $nik);
		if ($nik_old != $nik) {
			$is_nik    = $this->m_admin->getWhere('inspeksi_mst.user', $where_nik)->result();
			if (count($is_nik) > 0) {
				$this->session->set_flashdata("warning", "NIK: $nik, sudah ada di dalam sistem. Silakan pilih NIK lain.");
				redirect(base_url("admin/user"));
				exit;
			}
		}

		$user_update = array(
			'nik'        => $nik,
			'nama'       => $nama,
			'username'   => $nik,
			'level'      => $level,
			'bagian'     => $bagian,
			'status_user'=> true,
			'updated_at' => date('Y-m-d H:m:s'),
			'input_by'   => $inputed
		);

		$update_data = $this->m_admin->updateData('inspeksi_mst.user', $user_update, $where_nik);
		if ($update_data) {
			$log_type = 'update';
			$log_desc = "Ubah Data User dengan NIK: $nik";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

			$this->session->set_flashdata("success", "Berhasil ubah data user dengan username: $nik");
			redirect(base_url("admin/user"));
		} else {
			$this->session->set_flashdata("error", "Gagal ubah data user!");
			redirect(base_url("admin/user"));
		}
	}

	// update status user
	function update_status_user($nik) {
		date_default_timezone_set('Asia/Jakarta');
		
		$where_user = array('nik' => $nik);
		$user = $this->m_admin->getWhere('inspeksi_mst.user', $where_user)->result();
		if (count($user) <= 0) {
			$this->session->set_flashdata("warning", "NIK: $nik, tidak terdapat di sistem!");
			redirect(base_url("admin/user"));
		}

		if ($user[0]->status_user == 't') {
			$data_status = array('status_user' => false);
		} else {
			$data_status = array('status_user' => true);
		}

		// update status
		$update_status = $this->m_admin->updateData('inspeksi_mst.user', $data_status, $where_user);
		if ($update_status) {
			$log_type = 'update';
			$log_desc = "Update Data Status User dengan NIK: $nik";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata("success", "Berhasil update status user dengan username: $nik");
			redirect(base_url("admin/user"));
		} else {
			$this->session->set_flashdata("error", "Gagal update status user");
			redirect(base_url("admin/user"));
		}
	}

	// reset password user
	function reset_password() {
		date_default_timezone_set("Asia/Jakarta");
		$inputed = $this->session->userdata('username');

		// ambil passwrod dari form input
		$nik       = trim($this->input->post('nik'));
		$pass      = trim($this->input->post('password'));
		// hash password
		$password = password_hash($pass, PASSWORD_DEFAULT);

		$where_nik = array('username' => $nik);
		$data_pass = array(
			'password'   => $password,
			'updated_at' => date("Y-m-d H:i:s"),
			'input_by'   => $inputed
		);

		// reset pasword
		$reset_pass = $this->m_admin->updateData('inspeksi_mst.user', $data_pass, $where_nik);
		if ($update_status) {
			$log_type = 'update';
			$log_desc = "Reset Password User dengan NIK: $nik";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata("success", "Berhasil reset password user dengan username: $nik");
			redirect(base_url("admin/user"));
		} else {
			$this->session->set_flashdata("error", "Gagal reset password user");
			redirect(base_url("admin/user"));
		}

	}





	// FUNGSI UNTUK MENAMPILKAN HALAMAN JADWAL
	function jadwal(){
		date_default_timezone_set("Asia/Jakarta");
		$data['title']   = "Data Jadwal Inspeksi";

		$kd_bagian   = $this->session->userdata('bagian');
		$whereBagian = array('kode_bagian' => $kd_bagian);
		$dataBagian  = $this->m_admin->getWhere('inspeksi_mst.bagian', $whereBagian)->result();
		$whereBU     = array('idbu' => $dataBagian[0]->idbu);
		$where_user  = array('status_user' => true, 'level' => 'INSPEKTOR');

		// cek apakah ada inputan periode
		$periode         = $this->input->post('periode');
		if (isset($periode)) {
			$wh_periode      = array('periode' => $periode);

			$data['bagian']  = $this->m_admin->getWhere('inspeksi_mst.bagian', $whereBU)->result();
			$data['area']    = $this->m_admin->getArea('inspeksi_mst.area')->result();
			$data['jadwal']  = $this->m_admin->getJadwal('inspeksi_trx.jadwal','inspeksi_mst.user', $wh_periode)->result();
			$data['jadwal_temp']  = $this->m_admin->getJadwal('inspeksi_tmp.jadwal','inspeksi_mst.user', $wh_periode)->result();
			$data['user']    = $this->m_admin->getWhere('inspeksi_mst.user', $where_user)->result();

			$this->load->view('admin/v_jadwal', $data);
		} else {
			$periode         = date('Y-m');
			$wh_periode      = array('periode' => $periode);

			$data['bagian']  = $this->m_admin->getWhere('inspeksi_mst.bagian', $whereBU)->result();
			$data['area']    = $this->m_admin->getArea('inspeksi_mst.area')->result();
			$data['jadwal']  = $this->m_admin->getJadwal('inspeksi_trx.jadwal','inspeksi_mst.user', $wh_periode)->result();
			$data['jadwal_temp'] = $this->m_admin->getJadwal('inspeksi_tmp.jadwal','inspeksi_mst.user', $wh_periode)->result();
			$data['user']    = $this->m_admin->getWhere('inspeksi_mst.user', $where_user)->result();

			$this->load->view('admin/v_jadwal', $data);
		}
	}

	// tambah data jadwal ke tabel inspeksi_trx.jadwal
  function tambah_jadwal() {
		date_default_timezone_set("Asia/Jakarta");
		$username   = $this->session->userdata('username');

		// ambil data form  input
		$tgl_inspeksi = $this->input->post("tgl_inspeksi");
		$shift        = $this->input->post("shift");
		$inspektor    = $this->input->post("inspektor");
		$id_jadwal    = 'JA'.time();

		$data_jadwal = array(
			'id_jadwal'       => $id_jadwal,
			'id_user'         => $inspektor,
			'tgl_inspeksi'    => $tgl_inspeksi,
			'periode'         => date('Y-m'),
			'shift_inspeksi'  => $shift,
			'status_inspeksi' => false
		);

		// insert data jadwal
		$insert_data = $this->m_admin->insertData('inspeksi_trx.jadwal', $data_jadwal);
		if($insert_data) {
			$log_type = 'insert';
			$log_desc = "Tambah Data Jadwal Inspeksi ID: $id_jadwal, oleh: $username";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil tambah data jadwal.");
			redirect(base_url("admin/jadwal"));
		} else{
			$this->session->set_flashdata('error', "Gagal tambah data jadwal.");
			redirect(base_url("admin/jadwal"));
		}
	}

	// HAPUS JADWAL
	function hapus_jadwal($id_jadwal) {
		date_default_timezone_set("Asia/Jakarta");
		// insert data jadwal
		$delete_jadwal = $this->m_admin->deleteJadwal($id_jadwal);
		if($delete_jadwal) {
			$log_type = 'delete';
			$log_desc = "Hapus Data Jadwal Inspeksi ID: $id_jadwal";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil hapus data jadwal.");
			redirect(base_url("admin/jadwal"));
		} else{
			$this->session->set_flashdata('error', "Gagal hapus data jadwal.");
			redirect(base_url("admin/jadwal"));
		}
	}
	
	// Restore JADWAL dari temporary
	function restore_jadwal($id_jadwal) {
		date_default_timezone_set("Asia/Jakarta");
		// insert data jadwal
		$restore_jadwal = $this->m_admin->restoreJadwal($id_jadwal);
		if($restore_jadwal) {
			$log_type = 'insert';
			$log_desc = "Restore Data Jadwal Inspeksi ID: $id_jadwal";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil restore data jadwal.");
			redirect(base_url("admin/jadwal"));
		} else{
			$this->session->set_flashdata('error', "Gagal restore data jadwal.");
			redirect(base_url("admin/jadwal"));
		}
	}



	// menampilkan data area inspeksi
	function area() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Data Area Inspeksi";

		$data['area']   = $this->m_admin->getArea('inspeksi_mst.area')->result();
		$data['bagian'] = $this->m_admin->getData('inspeksi_mst.bagian')->result();

		$this->load->view('admin/v_area', $data);
	}

	// tambah area baru
	function tambah_area() {
		date_default_timezone_set("Asia/Jakarta");
		
		// ambil data input post
		$kd_area   = htmlspecialchars(trim($this->input->post("kode_area"))); 
		$bagian    = htmlspecialchars(trim($this->input->post("bagian"))); 
		$nama_area = htmlspecialchars(trim($this->input->post("nama_area")));
		$inputed   = $this->session->userdata("username");
		
		// cek apakah kode area sudah ada di table area atau belum
		$where_area = array('kode_area' => $kd_area);
		$is_area = $this->m_admin->getWhere('inspeksi_mst.area', $where_area)->result();
		if (count($is_area) > 0) {
			$this->session->set_flashdata("warning", "Kode area: $kd_area, sudah ada disistem. Silakan gunakan kode area lain. Terima kasih.");
			redirect(base_url("admin/area"));
			exit;
		}

		$area_baru = array(
			'id'          => time(),
			'kode_bagian' => $bagian,
			'kode_area'   => $kd_area,
			'desk_area'   => $nama_area,
			'status'      => true,
			'created_at'  => date('Y-m-d H:m:s'),
			'updated_at'  => date('Y-m-d H:m:s'),
			'updated_by'  => $inputed
		);

		// input ke table area
		$insert_area = $this->m_admin->insertData('inspeksi_mst.area', $area_baru);
		if($insert_area) {
			$log_type = 'insert';
			$log_desc = "Tambah Data Area Inspeksi KD: $kd_area";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil tambah data area inspeksi baru dengan kode: $kd_area.");
			redirect(base_url("admin/area"));
		} else{
			$this->session->set_flashdata('error', "Gagal tambah data area inspeksi baru.");
			redirect(base_url("admin/area"));
		}
	}
	
	// update status area
	function update_status_area($kd_area) {
		date_default_timezone_set('Asia/Jakarta');
		
		$where_area = array('kode_area' => $kd_area);
		$area = $this->m_admin->getWhere('inspeksi_mst.area', $where_area)->result();
		if (count($area) <= 0) {
			$this->session->set_flashdata("warning", "Kode area: $kd_area, tidak terdapat di sistem!");
			redirect(base_url("admin/area"));
		}

		if ($area[0]->status == 't') {
			$data_status = array('status' => false);
		} else {
			$data_status = array('status' => true);
		}

		// update status
		$update_status = $this->m_admin->updateData('inspeksi_mst.area', $data_status, $where_area);
		if ($update_status) {
			$log_type = 'update';
			$log_desc = "Update Data Status Area dengan KD: $kd_area";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata("success", "Berhasil update status area dengan kode: $kd_area");
			redirect(base_url("admin/area"));
		} else {
			$this->session->set_flashdata("error", "Gagal update status area");
			redirect(base_url("admin/area"));
		}
	}

	// ubah data area
	function ubah_area() {
		date_default_timezone_set("Asia/Jakarta");

		// dapatkan input dari user
		$kd_area   = htmlspecialchars(trim($this->input->post("kode_area"))); 
		$bagian    = htmlspecialchars(trim($this->input->post("bagian"))); 
		$nama_area = htmlspecialchars(trim($this->input->post("nama_area")));
		$inputed = $this->session->userdata("username");

		// cek apakah area sudah ada di sistem atau tidak jika NIK berubah
		$where_area = array('kode_area' => $kd_area);

		$area_update = array(
			'kode_bagian' => $bagian,
			'desk_area'   => $nama_area,
			'updated_at'  => date('Y-m-d H:m:s'),
			'updated_by'  => $inputed
		);

		$update_area = $this->m_admin->updateData('inspeksi_mst.area', $area_update, $where_area);
		if ($update_area) {
			$log_type = 'update';
			$log_desc = "Ubah Data Area dengan Kode: $kd_area";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

			$this->session->set_flashdata("success", "Berhasil ubah data area dengan kode: $kd_area");
			redirect(base_url("admin/area"));
		} else {
			$this->session->set_flashdata("error", "Gagal ubah data area!");
			redirect(base_url("admin/area"));
		}
	}



	
	// menampilkan data bagian
	function bagian() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Data Bagian Inspeksi";

		$data['bagian'] = $this->m_admin->getData('inspeksi_mst.bagian')->result();
		$this->load->view('admin/v_bagian', $data);
	}

	// tambah bagian baru
	function tambah_bagian() {
		date_default_timezone_set("Asia/Jakarta");
		
		// ambil data input post
		$idbu      = htmlspecialchars(trim($this->input->post("idbu"))); 
		$kd_bagian = htmlspecialchars(trim($this->input->post("kode_bagian"))); 
		$bagian    = htmlspecialchars(trim($this->input->post("nama_bagian"))); 
		$inputed   = $this->session->userdata("username");
		
		// cek apakah kode area sudah ada di table area atau belum
		$where_bagian = array('kode_bagian' => $kd_bagian);
		$is_bagian = $this->m_admin->getWhere('inspeksi_mst.bagian', $where_bagian)->result();
		if (count($is_area) > 0) {
			$this->session->set_flashdata("warning", "Kode bagian: $kd_bagian, sudah ada disistem. Silakan gunakan kode bagian lain. Terima kasih.");
			redirect(base_url("admin/area"));
			exit;
		}

		$bagian_baru = array(
			'id'          => time(),
			'kode_bagian' => strtoupper($kd_bagian),
			'deskripsi'   => strtoupper($bagian),
			'idbu'        => $idbu,
			'status_bagian' => true,
			'created_at'  => date('Y-m-d H:m:s'),
			'updated_at'  => date('Y-m-d H:m:s'),
			'updated_by'  => $inputed
		);

		// input ke table area
		$insert_bagian = $this->m_admin->insertData('inspeksi_mst.bagian', $bagian_baru);
		if($insert_bagian) {
			$log_type = 'insert';
			$log_desc = "Tambah Data Bagian Inspeksi KD: $kd_bagian";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil tambah data bagian inspeksi baru dengan kode: $kd_bagian.");
			redirect(base_url("admin/bagian"));
		} else{
			$this->session->set_flashdata('error', "Gagal tambah data bagian inspeksi baru.");
			redirect(base_url("admin/bagian"));
		}
	}

	// update status area
	function update_status_bagian($kd_bagian) {
		date_default_timezone_set('Asia/Jakarta');
		
		$where_bagian = array('kode_bagian' => $kd_bagian);
		$bagian       = $this->m_admin->getWhere('inspeksi_mst.bagian', $where_bagian)->result();
		if (count($bagian) <= 0) {
			$this->session->set_flashdata("warning", "Kode bagian: $kd_bagian, tidak terdapat di sistem!");
			redirect(base_url("admin/bagian"));
		}

		if ($bagian[0]->status_bagian == 't') {
			$data_status = array('status_bagian' => false);
		} else {
			$data_status = array('status_bagian' => true);
		}

		// update status
		$update_status = $this->m_admin->updateData('inspeksi_mst.bagian', $data_status, $where_bagian);
		if ($update_status) {
			$log_type = 'update';
			$log_desc = "Update Data Status Bagian dengan KD: $kd_bagian";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata("success", "Berhasil update status bagian dengan kode: $kd_area");
			redirect(base_url("admin/bagian"));
		} else {
			$this->session->set_flashdata("error", "Gagal update status bagian");
			redirect(base_url("admin/bagian"));
		}
	}

	// ubah data bagian
	function ubah_bagian() {
		date_default_timezone_set("Asia/Jakarta");

		// dapatkan input dari user
		$kd_bagian = htmlspecialchars(trim($this->input->post("kode_bagian"))); 
		$bagian    = htmlspecialchars(trim($this->input->post("nama_bagian"))); 
		$inputed = $this->session->userdata("username");

		// cek apakah area sudah ada di sistem atau tidak jika NIK berubah
		$where_bagian = array('kode_bagian' => $kd_bagian);

		$bagian_update = array(
			'desk_area'   => $bagian,
			'updated_at'  => date('Y-m-d H:m:s'),
			'updated_by'  => $inputed
		);

		$update_bagian = $this->m_admin->updateData('inspeksi_mst.bagian', $bagian_update, $where_bagian);
		if ($update_bagian) {
			$log_type = 'update';
			$log_desc = "Ubah Data Bagian dengan Kode: $kd_bagian";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);

			$this->session->set_flashdata("success", "Berhasil ubah data bagian dengan kode: $kd_bagian");
			redirect(base_url("admin/bagian"));
		} else {
			$this->session->set_flashdata("error", "Gagal ubah data bagian!");
			redirect(base_url("admin/bagian"));
		}
	}






	// menampilkan data area temuan
	function area_temuan(){
		date_default_timezone_set("Asia/Jakarta");

		$data['title'] = "Daftar Area Temuan";
		$data['area_temuan'] = $this->m_admin->getArea('inspeksi_mst.area')->result();

		$this->load->view('admin/v_area_temuan', $data);
	}

	// melakukan end of periode untuk generate poin per area di periode tertentu
	function eop() {
		date_default_timezone_set("Asia/Jakarta");
		$periode = $this->input->post("periode");
		$inputed = $this->session->userdata('username');

		// ambil data area
		$area = $this->m_admin->getArea('inspeksi_mst.area')->result();

		$where_periode = array('periode' => $periode);
		$iter = 1;
		foreach ($area as $row) {
			// cek apakah sudah dieop atau tidak
			$where_eop = array(
				'kode_area' => $row->kode_area,
				'periode'   => $periode
			);

			$is_eop = $this->m_admin->getWhere('inspeksi_trx.report', $where_eop)->result();
			if (count($is_eop) > 0) {
				continue;
			} 			

			$poin_min = $this->m_admin->getPoinMin($periode, $row->kode_area)->result();
			$total_poin = ($poin_min[0]->total_poin === null) ? 0 : $poin_min[0]->total_poin ;
			$poin_area = array(
				'id'          => time().$iter,
				'kode_area'   => $row->kode_area,
				'periode'     => $periode,
				'poin_min'    => $total_poin,
				'inserted_at' => date('Y-m-d H:m:s'),
				'eop_by'      => $inputed
			);

			$insert_report = $this->m_admin->insertData('inspeksi_trx.report', $poin_area);
			if ($insert_report) {
				$log_type = 'insert';
				$log_desc = "Tambah Data Report Area: $row->kode_area, Periode: $periode";
				$ip       = $this->input->ip_address();
				$userLog  = $this->session->userdata("username");
				date_default_timezone_set("Asia/Jakarta");
				$data_log = array(
					'username'      => $userLog,
					'type_log'      => $log_type,
					'deskripsi_log' => $log_desc,
					'date'          => date("Y-m-d H:i:s"),
					'ip'            => $ip
				);
				$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			} else {
				continue;
			}
			$iter++;
		}

		$this->session->set_flashdata("success", "Berhasil EOP periode: $periode");
		redirect(base_url("admin/report"));
	}

	// menampilkan temuan inspeksi berdasarkan area temuan
	function data_temuan($kd_area) {
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;
		
		date_default_timezone_set("Asia/Jakarta");
		$data['title']   = "Data Temuan Area: $kd_area";
		$data['kd_area'] = $kd_area;
		$tahun = date('Y');

		$data['temuan_area'] = $this->m_admin->getTemuanByArea($tahun, $kd_area)->result();

		$this->load->view('admin/v_temuan_per_area', $data);
	}

	// ambil data gambar temuan
	public function get_img_temuan() {
		$id = $this->input->post('data');
		$where = array(
			'id' => $id
		);
 
		$data = $this->m_admin->getWhere('inspeksi_trx.temuan_inspeksi', $where)->result();
		echo json_encode($data[0]->foto_temuan);
	}
	
	// ambil data gambar inspeksi
	public function get_img_inspeksi() {
		$id = $this->input->post('data');
		$where = array(
			'id' => $id
		);
 
		$data = $this->m_admin->getWhere('inspeksi_trx.inspeksi', $where)->result();
		echo json_encode($data[0]->evidence);
	}

	// menampilkan halaman report
	function report() {
		date_default_timezone_set("Asia/Jakarta");
		$data['area'] = $this->m_admin->getArea("inspeksi_mst.area")->result();
		
		$prd  = $this->input->post('periode');
		$area = $this->input->post('area');
		if (isset($prd)) {
			$periode = $prd;
			if ($area == "SEMUA") {
				$where_periode = array('periode' => $periode);
			} else {
				$where_periode = array('periode' => $periode, 'inspeksi_trx.report.kode_area' => $area);
			}
			
			$data['title'] = "Report Temuan Inspeksi Periode: $periode";
			$data['report'] = $this->m_admin->getReportTemuan('inspeksi_trx.report', 'inspeksi_mst.area', 'inspeksi_mst.user', $where_periode)->result();
		} else {
			$periode = date("Y-m");
			$where_periode = array('periode' => $periode);

			$data['title'] = "Report Temuan Inspeksi Periode: $periode";
			$data['report'] = $this->m_admin->getReportTemuan('inspeksi_trx.report', 'inspeksi_mst.area', 'inspeksi_mst.user', $where_periode)->result();
		}

		$this->load->view('admin/v_report', $data);
	}


	// Menampilkan Panduan Penggunaan Sistem
	function panduan(){
		$data['title'] = "Panduan Penggunaan Sistem - Admin";
		$this->load->view("admin/v_panduan", $data);
	}


	// menampilkan data inspeksi
	function inspeksi() {
		date_default_timezone_set("Asia/Jakarta");
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;
		
		$thn = $this->input->post('tahun');
		if (isset($thn)) {
			$data['title'] = "Data Inspeksi Tahun $thn";
			$data['tahun'] = $thn;
			$data['inspeksi'] = $this->m_admin->getDataInspeksiBerjalan($thn)->result();
		} else {
			$tahun = date('Y');
			$data['tahun'] = $tahun;
			$data['title'] = "Data Inspeksi Tahun $tahun";
			$data['inspeksi'] = $this->m_admin->getDataInspeksiBerjalan($tahun)->result();
		}

		$this->load->view('admin/v_data_inspeksi', $data);
	}


	// HAPUS Data Inspeksi
	function hapus_inspeksi($id) {
		date_default_timezone_set("Asia/Jakarta");
		// insert data jadwal
		$delete_data_inspeksi = $this->m_admin->deleteDataInspeksi($id);
		if($delete_data_inspeksi) {
			$log_type = 'delete';
			$log_desc = "Hapus Data Inspeksi ID: $id";
			$ip       = $this->input->ip_address();
			$userLog  = $this->session->userdata("username");
			date_default_timezone_set("Asia/Jakarta");
			$data_log = array(
				'username'      => $userLog,
				'type_log'      => $log_type,
				'deskripsi_log' => $log_desc,
				'date'          => date("Y-m-d H:i:s"),
				'ip'            => $ip
			);
			$this->m_log->insertLog('inspeksi_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil hapus data inspeksi.");
			redirect(base_url("admin/inspeksi"));
		} else{
			$this->session->set_flashdata('error', "Gagal hapus data inspeksi.");
			redirect(base_url("admin/inspeksi"));
		}
	}
	



	/**
	 * ===========================================================================
	 */
	// Menampilkan Data Log
	public function log(){
		$data['title'] = "Data Log";
		$data['log']   = $this->m_admin->getLog('inspeksi_log.tb_log')->result();
		$this->load->view('admin/v_log', $data);
	}

	// Menampilkan Data Active USer
	public function user_active(){
		$this->load->library('decodesession');
		$data['title'] = "Data User Active";
		// get data session from s_tmp.ci_sessions
		$res = array();
		$i = 0;
		$all_session = $this->m_admin->show_active_users()->result();
		foreach ($all_session as $key) {
			$decode_sess = $this->decodesession->unserialize(base64_decode($key->data));
			array_push($res, (object)[
				'id' => $key->id,
				'ip_address' => $key->ip_address,
				'timestamp' => $key->timestamp,
				'data' => $decode_sess,
			]);
		}
	
		$data['user_active'] = $res;
		
		$this->load->view('admin/v_active_user', $data);
	}

	// Hapus session user lain selain admin
	public function delete_session(){
		$sess = $this->session->session_id;
		try {
			$delete_sess = $this->m_admin->deleteSession('inspeksi_tmp.ci_sessions', $sess);
			if ($delete_sess) {
				redirect(base_url('admin/user_active'));
			}
		} catch (Exception  $e) {
			echo "Gagal saat delete session!.\nMessage: ".$e->getMessage();
		}
	}

}