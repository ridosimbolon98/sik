<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Rido Martupa
 */

class User extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('level') != "user") {
			echo "<script>alert('Anda dilarang akses halaman ini tanpa autentikasi');</script>";
			echo "<script>location='".base_url()."auth';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_auth');
			$this->load->model('m_home');
			$this->load->model('m_user');
			$this->load->model('m_log');
		}		
	}

	function data($auditie){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title'] = "Audit 5R | User Page";
		$data['auditie'] = $auditie;
        $data['id_user'] = $this->session->userdata('user_id');
        $whereUserId   = array('id_user' => $data['id_user']);
        $data['user']  = $this->m_user->getUserById('s_mst.tb_user', 's_mst.tb_dept',$whereUserId)->result();
		$data['area']  = $data['user'][0]->kat_dept;
		$bagian        = $auditie;
		$dept          = $this->session->userdata('dept');
		$where         = array(
			's_trx.tb_audit.kd_dept_audit' => $bagian,
			'otorisasi'   => 'SUDAH',
		);
		
		$data['auditie']    = $auditie;

		$whereAud           = array('kd_dept_audit' => $bagian, 'status' => false, 'otorisasi' => 'BELUM');

		$data['jlh_otor']   = $this->m_user->getWhere('s_trx.tb_audit', $whereAud)->num_rows();
        $data['jlh_refa']   = $this->m_user->getRefOtherNum($bagian)->num_rows();
        $data['jlh_temuan'] = $this->m_user->getJlhTemNum($bagian)->result();

		$data['dept']      = $this->m_user->getDept('s_mst.tb_dept')->result();
		$data['audit']     = $this->m_user->getAllAudit('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_index', $data);
	}
	
	function index(){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title'] = "Audit 5R | User Page";
        $data['id_user'] = $this->session->userdata('user_id');
        $whereUserId   = array('id_user' => $data['id_user']);
        $data['user']  = $this->m_user->getUserById('s_mst.tb_user', 's_mst.tb_dept',$whereUserId)->result();
		$data['area']  = $data['user'][0]->kat_dept;
		$bagian        = $this->session->userdata('bagian');
		$dept          = $this->session->userdata('dept');
		$where         = array(
			's_mst.tb_dept.bagian_dept' => $dept,
		);

		$data['auditie']    = $this->m_user->getWhere('s_mst.tb_dept',$where)->result();
		$this->load->view('user/v_area', $data);
	}

	// ambil data gambar
	public function getImg(){
		$id = $this->input->post('data');
		$where = array(
			'id_audit' => $id
		);
 
		$data = $this->m_user->getWhere('s_trx.tb_audit', $where)->result();
		echo json_encode($data[0]->gambar);
	}

	// ambil data gambar
	public function getImgSesudah(){
		$id = $this->input->post('data');
		$where = array(
			'id_audit' => $id
		);
 
		$data = $this->m_user->getWhere('s_trx.tb_audit', $where)->result();
		echo json_encode($data[0]->gambar_sesudah);
	}

	// menampilkan halaman data temuan referensi
	function ref_audit(){
		$app_url           = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url          .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']  = $app_url;
		
		$data['title']     = "Audit 5R | Temuan Referensi Page";
        $kd_dept           = $this->session->userdata('bagian');
		$dept              = $this->session->userdata('dept');
		$where             = array('dept_ref' => $dept);
        $data['ref_audit'] = $this->m_user->getRefAudit('s_trx.tb_referensi', 's_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_ref_audit', $data);
	}

	// menampilkan halaman data temuan referensi
	function ref_temuan(){
		$app_url           = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url          .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']  = $app_url;
		
		$data['title']     = "Audit 5R | Temuan Referensi Page";
        $kd_dept           = $this->session->userdata('bagian');
        $dept              = $this->session->userdata('dept');
		$where             = array('s_trx.tb_audit.kd_dept_audit' => $kd_dept, 'status_ref' => false);
        $data['ref_audit'] = $this->m_user->getRefAudit('s_trx.tb_referensi', 's_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_ref_temuan', $data);
	}

	// Tambah data referensi temuan
	function add_ref(){
		$this->load->helper('string');
		date_default_timezone_set("Asia/Jakarta");
		$app_url           = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url          .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']  = $app_url;

		$id_audit   = $this->input->post('id_audit');
		$bagian_ref = $this->input->post('referensi');
		$alasan     = $this->input->post('alasan');
		$token      = strtoupper(random_string('alnum', 3));
		$kd_ref     = 'RF'.date('Ymdhi').$token;

		// cek apakah sudah ada temuan ref dibagian dgn id audit terssebut
		$whereRef   = array (
			'id_audit' => $id_audit,
			'dept_ref' => $bagian_ref,
		);
		$isRef      = $this->m_user->getWhere('s_trx.tb_referensi', $whereRef)->result();
		if (count($isRef) > 0) {
			$this->session->set_flashdata('warning', "Gagal tambah referensi audit. ID Audit: $id_audit dan Referensi Bagian: $bagian_ref, sudah ada di sistem.");
			echo "<script>location='".base_url()."user';</script>";
			exit;
		}

		$data_ref   = array(
			'kd_ref'     => $kd_ref,
			'id_audit'   => $id_audit,
			'dept_ref'   => $bagian_ref,
			'deskripsi'  => '',
			'status_ref' => false,
			'updated'    => date("Y-m-d H:i:s"),
			'alasan_ref' => $alasan,
		);

		$insert_ref = $this->m_user->insert('s_trx.tb_referensi', $data_ref);
		if ($insert_ref){
			$log_type = 'insert';
			$log_desc = "Tambah data referensi temuan audit id: ".$id_audit.", referensi: ".$bagian_ref;
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil tambah referensi audit.");
			redirect(base_url('user'));
		} else{
			$this->session->set_flashdata('error', "Gagal tambah referensi audit. Ada kesalahan di server!");
			echo "<script>location='".base_url()."user';</script>";
			exit;
		}
	}

	// Fungsi untuk update progress temuan referensi
	function update_ref(){
		$kd_ref    = $this->input->post('kd_ref');
		$deskripsi = $this->input->post('deskripsi');

		$whereRef  = array('kd_ref' => $kd_ref); 

		$data_ref  = array(
			'deskripsi'  => $deskripsi,
			'updated'    => date("Y-m-d H:i:s"),
		);

		$update_ref = $this->m_user->updateData('s_trx.tb_referensi', $data_ref, $whereRef);
		if ($update_ref){
			$log_type = 'update';
			$log_desc = "Update data progress perbaikan referensi temuan audit KD: ".$kd_ref;
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil update progress referensi audit.");
			redirect(base_url('user'));
		} else{
			$this->session->set_flashdata('error', "Gagal update progress referensi audit. Ada kesalahan di server!");
			echo "<script>location='".base_url()."user';</script>";
			exit;
		}
	}

	// fungsi untuk close referensi temuan
	function close_ref($kd_ref){
		date_default_timezone_set("Asia/Jakarta");
		$data_ref = array(
			'status_ref' => true,
			'updated'    => date("Y-m-d H:i:s"),
		);
		$where    = array('kd_ref' => $kd_ref);
		$update_ref = $this->m_user->updateData('s_trx.tb_referensi', $data_ref, $where);
		if ($update_ref){
			$log_type = 'update';
			$log_desc = "Close Temuan Referensi Audit KD: $kd_ref";
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil close temuan referensi audit kode: $kd_ref.");
			redirect(base_url('user'));
		} else{
			$this->session->set_flashdata('error', "Gagal close temuan referensi audit kode: $kd_ref. Ada kesalahan di server!");
			echo "<script>location='".base_url()."user';</script>";
			exit;
		}
	}

	// menampilkan data jadwal audit bagian
	function jadwal(){
		$data['title'] = "Audit 5R | Jadwal Audit Page";
        $bagian        = $this->session->userdata('bagian');
		$dept          = $this->session->userdata('dept');
        $whereDept     = array('id_dept' => $bagian);
        $data['dept']  = $this->m_user->getWhere('s_mst.tb_dept', $whereDept)->result();
		$auditee       = $data['dept'][0]->section;
		$where         = array('section' => $auditee);
		$data['jadwal']= $this->m_user->getJadwalAuditor('s_trx.tb_jadwal','s_mst.tb_user',$where)->result();
		
		$this->load->view('user/v_jadwal', $data);
	}

	// Fungsi untuk menampilkan Laporan Ketidaksesuaian Bagian
	function lk(){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title'] = "Audit 5R | Lap Ketidaksesuaian Page";
		$id_dept       = $this->session->userdata('bagian');
		$dept          = $this->session->userdata('dept');
		$where2        = array('id_dept' => $id_dept);
		$data['dept']  = $this->m_user->getWhere('s_mst.tb_dept', $where2)->result();
		$data['area']  = $data['dept'][0]->kat_dept;
		$where         = array(
			's_mst.tb_dept.bagian_dept' => $dept,
		);

		$data['auditie']    = $this->m_user->getWhere('s_mst.tb_dept',$where)->result();
		
		$this->load->view('user/v_lkarea', $data);
	}
	
	function data_lk($auditie){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title'] = "Audit 5R | Lap Ketidaksesuaian Page";
		$id_dept       = $auditie;
		$dept          = $this->session->userdata('dept');
        $where         = array('s_trx.tb_audit.kd_dept_audit' => $id_dept, 'otorisasi' => 'SUDAH');
        $where2        = array('id_dept' => $id_dept);
        $data['dept']  = $this->m_user->getWhere('s_mst.tb_dept', $where2)->result();
		$data['area']  = $data['dept'][0]->kat_dept;
        $data['audit'] = $this->m_user->getAllAudit('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_lk', $data);
	}

	// Menampilkan data audit yg belum diotorisasi
	function otorisasi($auditie){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Audit 5R | Otorisasi Audit Page";
		$data['auditie'] = $auditie;

		$userid        = $this->session->userdata('user_id');
		$bagian        = $auditie;
		$dept          = $this->session->userdata('dept');
		$whereAudit    = array(
			'periode'       => date('Y-m'),
			's_trx.tb_audit.kd_dept_audit' => $bagian,
			'status'        => false,
			'otorisasi'     => 'BELUM',
		);

		$whereRef           = array('s_trx.tb_audit.kd_dept_audit' => $bagian, 'status_ref' => false);
		$whereAud           = array('kd_dept_audit' => $bagian, 'status' => false, 'otorisasi' => 'BELUM');

		$data['jlh_otor'] = $this->m_user->getWhere('s_trx.tb_audit', $whereAud)->num_rows();
    $data['jlh_refa'] = $this->m_user->getRefAudit('s_trx.tb_referensi', 's_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $whereRef)->num_rows();

		$data['audit']    = $this->m_user->getAllAudit('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $whereAudit)->result();
		$this->load->view('user/v_otorisasi', $data);
	}

	// untuk otorisasi data audit per bagian per hari itu
	function otorAudit($auditie){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Audit 5R | Otorisasi Audit Page";
		$userid        = $this->session->userdata('user_id');
		$bagian        = $auditie;
		$dept          = $this->session->userdata('dept');
		$whereAudit    = array(
			'periode'       => date('Y-m'),
			's_trx.tb_audit.kd_dept_audit' => $bagian,
			'status'        => false,
			'otorisasi'     => 'BELUM',
		);

		$whereJA = array(
			'id_dept' => $bagian,
			'periode' => date('Y-m'),
		);

		$data_otor = array('otorisasi' => 'SUDAH');
		$data_ja   = array('realisasi' => true, 'realisasi_audit' => date('Y-m-d'));

		$dataOtor = $this->m_user->getAllAudit('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $whereAudit)->result();
		
		$wh_aud    = array(
			'id_auditor' => $dataOtor[0]->user_audit
		);

		$data_wa_aud = $this->m_user->getWhere('s_mst.tb_wa', $wh_aud)->result();
		
		// data utk notif wa
		$waktu     = time();
		$jlh_tem   = count($dataOtor);
		$des	   = "Anda telah melakukan audit di bagian: ".$dept." hari ini, ".date('d-m-Y')." dengan total item temuan yang sudah diotorisasi sebanyak: ".$jlh_tem." temuan.\n\n*Terima kasih atas kerjasamanya*.";
		$status_wa = false;
		$tipe_trx  = "OTORISASI";
		$no_wa_aud = $data_wa_aud[0]->no_wa;

		$data_notif = array(
			'id'        => $waktu,
			'user'      => $data_wa_aud[0]->nama,
			'no_wa'     => $no_wa_aud,
			'tipe_trx'  => $tipe_trx,
			'deskripsi' => $des,
			'date'      => date("Y-m-d H:i:s"),
			'status'    => $status_wa,
		);	

		// lakukan otorisasi
		foreach ($dataOtor as $row) {
			$where[$row->id_audit] = array('id_audit' => $row->id_audit);
			// cek r4
			if(($row->kd_tem_audit == '41') || ($row->kd_tem_audit == '42') || ($row->kd_tem_audit == '96') || ($row->kd_tem_audit == '97')) {
				$data_or4 = array(
					'rekomendasi' => "Sudah Konsisten",
					'status' => true,
					'otorisasi' => 'SUDAH',
					'gambar_sesudah' => $row->gambar,
					'date_close' => date("Y-m-d H:i:s")
				);
				$update = $this->m_user->updateData('s_trx.tb_audit', $data_or4,  $where[$row->id_audit]);
			} else {
				$update = $this->m_user->updateData('s_trx.tb_audit', $data_otor,  $where[$row->id_audit]);
			}


			if ($update) {
				$this->session->set_flashdata('success', "Berhasil otorisasi data audit.");
			} else {
				$this->session->set_flashdata('error', "Gagal otorisasi data audit. Ada kesalahan di server!");
			}
		}

		if ($update){
			// kirim notif wa
			// $send_notif = $this->m_user->insert('s_wa.tb_notif', $data_notif);
			// if (!$send_notif) {
			// 	$this->session->set_flashdata('error', "Gagal kirim notifikasi otorisasi wa.");
			// }
			
			// LAKUKAN REALISASI JADWAL AUDIT
			$isRealisasi = $this->m_user->updateData('s_trx.tb_jadwal', $data_ja, $whereJA);
			if (!$isRealisasi) {
				$this->session->set_flashdata('isrealisasi', "Gagal update realisasi jadwal.");
			}

			$log_type = 'update';
			$log_desc = "Otorisasi Audit Periode:".date("Y-m-d")."By User";
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil otorisasi data audit.");
			redirect(base_url('user/data/'.$auditie));
		} else{
			$this->session->set_flashdata('error', "Gagal otorisasi data audit. Ada kesalahan di server!");
			echo "<script>location='".base_url()."user/data/'".$auditie.";</script>";
			exit;
		}
	}

	// Fungsi untuk hapus data audit yang tidak sesudai oleh user
	function del_audit($id_audit){
		$this->load->helper('file');
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$where      = array('id_audit' => $id_audit);
		$data_audit = $this->m_user->get('s_trx.tb_audit', $where)->result();
		$gbr_awal   = $data_audit[0]->gambar;
		$gbr_ssdh   = $data_audit[0]->gambar_sesudah;
		
		// transfer to history audit
		$transfer = $this->m_user->insertLogAudit('s_trx.tb_audit', 's_log.tb_audit', $id_audit)->result();
		if(!$transfer){
			$this->session->set_flashdata('error', "Gagal replikasi data audit ID: $id_audit. Silakan ulangi lagi");
			redirect(base_url('user/otorisasi'));
		}

		// delete gambar awal dari server
		//for ($i=0; $i < count(json_decode($gbr_awal, true)) ; $i++) { 
			//unlink($_SERVER['DOCUMENT_ROOT'].'/temuan_audit/'.json_decode($gbr_awal, true)[$i]);
		//}

		// delete gambar sesudah dari server
		//for ($i=0; $i < count(json_decode($gbr_ssdh, true)) ; $i++) { 
			//unlink($_SERVER['DOCUMENT_ROOT'].'/temuan_audit/'.json_decode($gbr_ssdh, true)[$i]);
		//}

		// delete data audit dari database
		$delete = $this->m_user->delete('s_trx.tb_audit', $where);
		if ($delete){
			$log_type = 'delete';
			$log_desc = "Hapus Data Audit ID: $id_audit";
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil hapus data audit ID: $id_audit.");
			redirect(base_url('user/otorisasi'));
		} else{
			$this->session->set_flashdata('error', "Gagal hapus data audit ID: $id_audit. Ada kesalahan di server!");
			echo "<script>location='".base_url()."user/otorisasi';</script>";
			exit;
		}
	}

    // Fungsi untuk update gambar sesudah
	function update_gbr(){
		$this->load->library('compress');
		
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;
		$username  = $this->session->userdata("username");

		date_default_timezone_set("Asia/Jakarta");
    $id_audit = $this->input->post('id_audit');
		$jumlah   = count($_FILES['files']['name']);
		
		$whereAud = array('id_audit' => $id_audit);

		// cek apakah data audit sudah close
		$isClosed  = array('id_audit' => $id_audit, 'status' => 't');
		$dataAudit = $this->m_user->getWhere('s_trx.tb_audit', $isClosed)->num_rows();
		$data_audit = $this->m_user->getWhere('s_trx.tb_audit', $whereAud)->result();
		if ($dataAudit > 0) {
			$this->session->set_flashdata('error', "Gagal update gambar tindak lanjut temuan audit ID: $id_audit. Temuan audit sudah di closed!");
			echo "<script>location='".base_url()."user/lk';</script>";
			exit;
		}

		$wh_aud    = array(
			'id_auditor' => $data_audit[0]->user_audit
		);
		$data_wa_aud = $this->m_user->getWhere('s_mst.tb_wa', $wh_aud)->result();

		// data utk notif wa
		$waktu     = time();
		$des	   = "User auditie *".strtoupper($username)."* telah melakukan tindak lanjut temuan dengan ID: ".$id_audit.", per tanggal ".date("d-m-Y").". Harap auditor segera dilakukan pengecekan dan jika sudah sesuai, silakan temuan tersebut untuk di closed.\n\nTerima kasih atas kerjasamanya.";
		$status_wa = false;
		$tipe_trx  = "TINDAK LANJUT AUDITIE";

		$data_notif = array(
			'id'        => $waktu,
			'user'      => $data_wa_aud[0]->nama,
			'no_wa'     => $data_wa_aud[0]->no_wa,
			'tipe_trx'  => $tipe_trx,
			'deskripsi' => $des,
			'date'      => date("Y-m-d H:i:s"),
			'status'    => $status_wa,
		);
		
		for ($i=0; $i < $jumlah; $i++) {
			// config upload
			$root_folder             = $_SERVER['DOCUMENT_ROOT'].'/temuan_audit/';
			$imname[$i]              = $_FILES['files']['tmp_name'][$i];
			$source_photo[$i]        = $imname[$i];
			$namecreate[$i]          = "AUDIT5R_".$i."_".$id_audit."_".time();
			$namecreatenumber[$i]    = rand(1000 , 10000);
			$picname[$i]             = $namecreate[$i].$namecreatenumber[$i];
			$finalname[$i]           = $picname[$i].".jpeg";
			$dest_photo[$i]          = $root_folder.$finalname[$i];
			$compressimage[$i]       = $this->compress->compress_image($source_photo[$i], $dest_photo[$i], 60);

			if($compressimage[$i]){
				$data_gbr[$i]['file_name'] = $finalname[$i];
			} else {
				echo "<pre>";
				print_r('error upload gambar audit');
				echo "</pre>";
			}
			$data_gbr[$i] = $data_gbr[$i]['file_name'];
		}

		$data_update = array(
			'gambar_sesudah' => json_encode($data_gbr),
			'updated' => date('Y-m-d')
		);
		$whereUpd = array('id_audit' => $id_audit);
		$update = $this->m_user->updateData('s_trx.tb_audit', $data_update, $whereUpd);

		if ($update){
			// kirim notif wa
			$send_notif = $this->m_user->insert('s_wa.tb_notif', $data_notif);
			if (!$send_notif) {
				$this->session->set_flashdata('error', "Gagal kirim notifikasi tindak lanjut wa.");
			}
			
			$log_type = 'insert';
			$log_desc = "Insert Gambar Temuan Audit ID: $id_audit, By User: $username";
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
			$this->m_log->insertLog('s_log.tb_log', $data_log);
			$this->session->set_flashdata('success', "Berhasil submit gambar tindak lanjut temuan audit ID: $id_audit.");
			redirect(base_url('user/lk'));
		} else {
			$this->session->set_flashdata('error', "Gagal submit gambar tindak lanjut sesudah audit ID: $id_audit.");
			echo "<script>location='".base_url()."user/lk';</script>";
			exit;
		}
	}

	// menampilkan halaman detail temuan per id
	function detail_temuan($id_audit){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title']  = "User Audit | Detail Temuan Audit 5R";
		$data['id_user']= $this->session->userdata('user_id');
        $whereUserId    = array('id_user' => $data['id_user']);
		$data['user']   = $this->m_user->getUserById('s_mst.tb_user', 's_mst.tb_dept',$whereUserId)->result();
		$data['area']   = $data['user'][0]->kat_dept;
		$where          = array('id_audit' => $id_audit);

		$data['temuan'] = $this->m_user->getAuditPerID('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_detail_temuan', $data);
	}

	// menampilkan halaman detail temuan per id
	function detail_tref($kd_ref){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title']  = "User Audit | Detail Temuan Referensi Audit 5R";
		$data['id_user']= $this->session->userdata('user_id');
        $whereUserId    = array('id_user' => $data['id_user']);
		$data['user']   = $this->m_user->getUserById('s_mst.tb_user', 's_mst.tb_dept',$whereUserId)->result();
		$data['area']   = $data['user'][0]->kat_dept;

		$where          = array('kd_ref' => $kd_ref);
		$data['temuan'] = $this->m_user->getRefAudit('s_trx.tb_referensi', 's_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();
		$this->load->view('user/v_detail_ref', $data);
	}

	// fungsi untuk menampilkan data ranking user
	function ranking(){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title']   = "User Audit | Data Ranking Audit 5R";
		$data['dept']    = $this->session->userdata('dept');
		$data['id_user'] = $this->session->userdata('user_id');
		$whereUserId     = array('id_user' => $data['id_user']);
		$data['user']    = $this->m_user->getUserById('s_mst.tb_user', 's_mst.tb_dept',$whereUserId)->result();
		$data['area']    = $data['user'][0]->kat_dept;
		$where           = array(
			'bagian_dept'   => $data['dept'],
		);
		$data['ranking'] = $this->m_user->getRankingData('s_trx.tb_ranking', 's_mst.tb_dept', $where)->result();
		$this->load->view('user/v_ranking', $data);
	}

	function export(){
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;


		$id_dept       = 19;
		$dept          = $this->session->userdata('dept');
		$where         = array('s_trx.tb_audit.kd_dept_audit' => $id_dept, 'otorisasi' => 'SUDAH');
		$where2        = array('id_dept' => $id_dept);
		$data_audit = $this->m_user->getAllAudit('s_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan', $where)->result();

		// Load plugin PHPExcel nya
		// include APPPATH.'third_party/PHPExcel/PHPExcel.php';
		$this->load->library('PHPExcel/phpexcel');
		// Panggil class PHPExcel nya
		$excel = new PHPExcel();
		// Settingan awal fil excel
		$excel->getProperties()->setCreator('DCMS | NBI')
								->setLastModifiedBy('DCMS | NBI')
								->setTitle("Matriks Permohonan Penambahan dan Perubahan Dokumen")
								->setSubject("Matriks Permohonan Penambahan dan Perubahan Dokumen")
								->setDescription("Matriks Permohonan Penambahan dan Perubahan Dokumen")
								->setKeywords("Matriks Permohonan Penambahan dan Perubahan Dokumen");
		// Buat sebuah variabel untuk menampung pengaturan style dari header tabel
		$style_col = array(
		'font' => array('bold' => true), // Set font nya jadi bold
		'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
		);
		// Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
		$style_row = array(
		'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
		),
		'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
		)
		);

		$excel->setActiveSheetIndex(0)->setCellValue('A1', 'Keterangan');
		$excel->setActiveSheetIndex(0)->setCellValue('B1', "Rekomendasi");
		$excel->setActiveSheetIndex(0)->setCellValue('C1', "PIC");
		$excel->setActiveSheetIndex(0)->setCellValue('D1', "Due Date");
		$excel->setActiveSheetIndex(0)->setCellValue('E1', "Gambar");

		// Apply style header yang telah kita buat tadi ke masing-masing kolom header
		$excel->getActiveSheet()->getStyle('A1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('C1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('D1')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('E1')->applyFromArray($style_col);

		$numrow = 2; // Set baris pertama untuk isi tabel adalah baris ke 4
		foreach($data_audit as $row){ 
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $row->ket_audit);
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $row->rekomendasi);
				$excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row->koor_dept);
				$excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row->due_date);

				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('C'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('D'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('E'.$numrow)->applyFromArray($style_row);

				$url_img = $app_url.'/temuan_audit/AUDIT5R_0_1591_16656542563580.jpeg';
				$gdImage = imagecreatefromjpeg($url_img);
				$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
				$objDrawing->setName('Sample image');
				$objDrawing->setDescription('TEST');
				$objDrawing->setImageResource($gdImage);
				$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
				$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
				$objDrawing->setHeight(150);
				$objDrawing->setCoordinates('E'.$numrow);
				$objDrawing->setWorksheet($excel->getActiveSheet());

				$excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(120);// Set width kolom A
				$numrow++; // Tambah 1 setiap kali looping
			}
		// Set width kolom
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(30); // Set width kolom A
		$excel->getActiveSheet()->getColumnDimension('C')->setWidth(10); // Set width kolom B
		$excel->getActiveSheet()->getColumnDimension('D')->setWidth(10); // Set width kolom C
		$excel->getActiveSheet()->getColumnDimension('E')->setWidth(50); // Set width kolom D
		
		// Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
		$excel->getActiveSheet()->getRowDimension(1)->setRowHeight(30);
		// Set orientasi kertas jadi LANDSCAPE
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		// Set judul file excel nya
		$excel->getActiveSheet(0)->setTitle("Temuan Dokumen");
		$excel->setActiveSheetIndex(0);
		// Proses file excel
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="audit.xlsx"'); // Set nama file excel nya
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
}

}