<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @author Rido
 */

class Inspektor extends CI_Controller {
	function __construct(){
		parent::__construct();

		if ($this->session->userdata('level') != "INSPEKTOR") {
			echo "<script>alert('Anda dilarang akses halaman ini tanpa autentikasi');</script>";
			echo "<script>location='".base_url()."auth';</script>";
		} else {
			$this->load->helper('url');
			$this->load->model('m_auth');
			$this->load->model('m_inspektor');
			$this->load->model('m_log');
		}		
	}

	// ambil data area berdasarkan temuan per auditor
	function index1() {
		date_default_timezone_set("Asia/Jakarta");
		$today = date('Y-m-d');
		$data['title'] = "Temuan Inspeksi Per: $today";
		$nik           = $this->session->userdata("nik");

		// ambil data area
		// $data['area'] = $this->m_auditor->getAreaByAuditor('inspeksi_trx.tb_audit', 'inspeksi_mst.bagian', $userid)->result();

		$this->load->view('inspektor/temuan_hari_ini', $data);
	}

	// menampilkan list inspeksi hari ini
	function index() {
		date_default_timezone_set('Asia/Jakarta');
		$data['title'] = "Halaman Temuan Hari Ini";
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$user_id = $this->session->userdata('username');
		$where   = array('user_inspektor' => $user_id, 'tgl_inspeksi' => date('Y-m-d')); 

		// ambil data temuan inspeksi hari ini
		$data['temuan_inspeksi'] = $this->m_inspektor->getDataInspeksiHariIni('inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.item_temuan', 'inspeksi_mst.bagian', 'inspeksi_mst.area', $where)->result();
		$this->load->view('inspektor/temuan_hari_ini', $data);
	}

	// menampilkan data area temuan inspeksi
	function area_temuan() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Area Temuan";
		$user_id       = $this->session->userdata('username');
		$where         = array('user_inspektor' => $user_id);

		// ambil data area temuan
		$data['area'] = $this->m_inspektor->getArea('inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.area', $where)->result();

		$this->load->view('inspektor/area_temuan', $data);
	}
	
	// menampilkan data area inspeksi
	function area_inspeksi() {
		date_default_timezone_set("Asia/Jakarta");
		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$data['title'] = "Halaman Data Inspeksi";
		$user_id       = $this->session->userdata('username');
		$where         = array('user_inspektor' => $user_id);

		// ambil data area temuan
		$data['inspeksi'] = $this->m_inspektor->getWhere('inspeksi_trx.inspeksi', $where)->result();

		$this->load->view('inspektor/inspeksi', $data);
	}
	
	// menampilkan data area temuan inspeksi
	function tanggapan() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Area Temuan";
		$user_id       = $this->session->userdata('username');
		$where         = array('user_inspektor' => $user_id);

		// ambil data area temuan
		$data['area'] = $this->m_inspektor->getArea('inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.area', $where)->result();

		$this->load->view('inspektor/area_tanggapan', $data);
	}
	
	// menampilkan data temuan per area inspeksi
	function temuan($kd_area) {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Temuan $kd_area";
		$data['kd_area'] = $kd_area;

		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$user_id = $this->session->userdata('username');
		$where   = array(
			'user_inspektor' => $user_id, 
			'kd_area'        => $kd_area,
			'tgl_inspeksi'   => date('Y-m-d')
		); 

		// ambil data temuan inspeksi hari ini
		$data['temuan_inspeksi'] = $this->m_inspektor->getDataInspeksiHariIni('inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.item_temuan', 'inspeksi_mst.bagian', 'inspeksi_mst.area', $where)->result();
		$this->load->view('inspektor/temuan_inspeksi', $data);
	}
	
	// menampilkan data temuan per area inspeksi
	function tanggapan_temuan($kd_area) {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Temuan $kd_area";
		$data['kd_area'] = $kd_area;

		$app_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
		$app_url .= "://" . $_SERVER['HTTP_HOST'];
		$data['SITE_URL']= $app_url;

		$user_id = $this->session->userdata('username');
		$where   = array(
			'user_inspektor' => $user_id, 
			'kd_area'        => $kd_area,
			'tgl_inspeksi'   => date('Y-m-d')
		); 

		// ambil data temuan inspeksi hari ini
		$data['temuan_inspeksi'] = $this->m_inspektor->getDataInspeksiHariIni('inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.item_temuan', 'inspeksi_mst.bagian', 'inspeksi_mst.area', $where)->result();
		$this->load->view('inspektor/v_tanggapan', $data);
	}

	// ubah tanggapan temuan
	function ubah_tanggapan() {
		date_default_timezone_set("Asia/Jakarta");
		$id        = $this->input->post('id_tem');
		$kd_area   = $this->input->post('kd_area');
		$tanggapan = htmlspecialchars(trim($this->input->post('tanggapan')));

		$where_id = array('id' => $id);
		$data_tgp = array(
			'tanggapan'  => $tanggapan,
			'updated_at' => date('Y-m-d H:m:s')
		);

		$update = $this->m_inspektor->updateData('inspeksi_trx.temuan_inspeksi', $data_tgp, $where_id);
		if($update) {
			$log_type = 'update';
			$log_desc = "Ubah Data Tanggapan Temuan Inspeksi";
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
			$this->session->set_flashdata('success', "Berhasil submit data tanggapan temuan inspeksi.");
			redirect(base_url("inspektor/tanggapan_temuan/$kd_area"));
		} else{
			$this->session->set_flashdata('error', "Gagal submit data tanggapan temuan inspeksi.");
			redirect(base_url("inspektor/tanggapan_temuan/$kd_area"));
		}
	}

	// menampilkan form inspeksi
	function form() {
		date_default_timezone_set('Asia/Jakarta');
		$data['title'] = "Halaman Form Inspeksi";
		$kd_bagian = $this->session->userdata('bagian');

		$whereBagian = array('kode_bagian' => $kd_bagian);
		$whereUnsur  = array('unsur_tem' => $kd_bagian);
		$dataBagian  = $this->m_inspektor->getWhere('inspeksi_mst.bagian', $whereBagian)->result();
		$whereBU     = array('idbu' => $dataBagian[0]->idbu);

		$data['area']        = $this->m_inspektor->getData('inspeksi_mst.area')->result();
		$data['bagian']      = $this->m_inspektor->getWhere('inspeksi_mst.bagian', $whereBU)->result();
		$data['item_temuan'] = $this->m_inspektor->getDataTemuan('inspeksi_mst.item_temuan',$whereUnsur)->result();

		$this->load->view('inspektor/v_form', $data);
	}

	// submit data inspeksi ke database
	function submit_form() {
		date_default_timezone_set("Asia/Jakarta");
		$username = $this->session->userdata("username");
		//library compress gambar audit		
		$this->load->library('compress');

		// ambil data dari post
		$bagian      = $this->input->post("bagian");
		$area        = $this->input->post("area");
		$tanggal     = $this->input->post("tanggal");
		$item_temuan = $this->input->post("item_temuan");
		$keterangan  = trim($this->input->post("keterangan"));
		$shift       = trim($this->input->post("shift"));
		$id_temuan   = time();

		// ambil data temuan
		$where_tem = array('id_tem' => $item_temuan);
		$data_temuan = $this->m_inspektor->getWhere('inspeksi_mst.item_temuan', $where_tem)->result();
		
		// config upload eviden
		$root_folder             = $_SERVER['DOCUMENT_ROOT'].'/temuan_inspeksi/';
		$flname                  = $_FILES['eviden']['tmp_name'];
		$source_photo            = $flname;
		$namecreate              = "TEMUAN_INSPEKSI_".$id_temuan;
		$namecreatenumber        = rand(1000 , 10000);
		$picname                 = $namecreate.$namecreatenumber;
		$finalname               = $picname.".jpeg";
		$dest_photo              = $root_folder.$finalname;
		$compressimage           = $this->compress->compress_image($source_photo, $dest_photo, 60);

		// cek apakah compress berhasil
		if($compressimage){
			$data_gbr = $finalname;
		} else {
			echo "<pre>";
			print_r('error upload gambar audit');
			echo "</pre>";
			exit;
		}

		$data_inspeksi = array(
			'id'            => $id_temuan,
			'user_inspektor'=> $username,
			'kd_bagian'     => $bagian,
			'kd_area'       => $area,
			'tgl_inspeksi'  => date('Y-m-d'),
			'kd_temuan'     => $item_temuan,
			'shift'         => $shift,
			'unsur'         => $data_temuan[0]->unsur_tem,
			'poin_min'      => $data_temuan[0]->poin_min,
			'keterangan'    => $keterangan,
			'foto_temuan'   => $data_gbr,
			'status_tem'    => false,
			'created_at'    => date("Y-m-d H:m:s"),
			'updated_at'    => date("Y-m-d H:m:s"),
			'periode'       => date("Y-m")
		);

		// insert table inspeksi_trx.temuan_inspeksi
		$insert_temuan = $this->m_inspektor->insertData('inspeksi_trx.temuan_inspeksi', $data_inspeksi);
		if($insert_temuan) {
			$log_type = 'insert';
			$log_desc = 'Tambah Data Inspeksi Area: '.$area.', Bagian: '.$bagian;
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

			// cek realisasi inspeksi pada jadwal
			$where_jadwal = array(
				'id_user'        => $username,
				'tgl_inspeksi'   => date('Y-m-d'),
				'shift_inspeksi' => $shift
			);

			$is_realisasi = $this->m_inspektor->getWhere('inspeksi_trx.jadwal', $where_jadwal)->num_rows();
			if ($is_realisasi > 0) {
				// belum direalisasi
				$realisasi_jadwal = array(
					'status_inspeksi' => true,
					'tgl_realisasi'   => date('Y-m-d H:m:s'),
					'keterangan'      => $area.'--'.$bagian.'--'.$keterangan
				);

				// update jadwal
				$update_jadwal = $this->m_inspektor->updateData('inspeksi_trx.jadwal', $realisasi_jadwal, $where_jadwal);

				if ($update_jadwal) {
					$this->session->set_flashdata('success', "Berhasil submit data inspeksi.");
					$res = array('success' => 'Berhasil Submit Data');
					return json_encode($res);
				} else {
					$this->session->set_flashdata('success', "Berhasil submit data inspeksi, namun gagal realisasi jadwal.");
					$res = array('success' => 'Berhasil Submit Data, namun gagal realisasi jadwal');
					return json_encode($res);
				}
			}

			$this->session->set_flashdata('success', "Berhasil submit data inspeksi.");
			$res = array('success' => 'Berhasil Submit Data');
			return json_encode($res);

		} else{
			$this->session->set_flashdata('error', "Gagal submit data inspeksi.");
			$res = array('failed' => 'Gagal Submit Data');
			return json_encode($res);
		}
	}
	
	// submit data inspeksi ke database
	function submit_form2() {
		date_default_timezone_set("Asia/Jakarta");
		$username = $this->session->userdata("username");
		//library compress gambar audit		
		$this->load->library('compress');

		// ambil data dari post
		$area        = $this->input->post("area_inspeksi[]");
		$tanggal     = $this->input->post("tanggal");
		$keterangan  = trim($this->input->post("keterangan"));
		$shift       = trim($this->input->post("shift"));
		$id_ins      = time();
		
		// config upload eviden
		$root_folder             = $_SERVER['DOCUMENT_ROOT'].'/temuan_inspeksi/';
		$flname                  = $_FILES['eviden']['tmp_name'];
		$source_photo            = $flname;
		$namecreate              = "INSPEKSI_".$id_ins;
		$namecreatenumber        = rand(1000 , 10000);
		$picname                 = $namecreate.$namecreatenumber;
		$finalname               = $picname.".jpeg";
		$dest_photo              = $root_folder.$finalname;
		$compressimage           = $this->compress->compress_image($source_photo, $dest_photo, 60);

		// cek apakah compress berhasil
		if($compressimage){
			$data_gbr = $finalname;
		} else {
			echo "<pre>";
			print_r('error upload gambar inspeksi');
			echo "</pre>";
			exit;
		}

		$data_inspeksi = array(
			'id'            => $id_ins,
			'user_inspektor'=> $username,
			'area'          => json_encode($area),
			'tgl_inspeksi'  => date('Y-m-d'),
			'shift'         => $shift,
			'evidence'      => $data_gbr,
			'keterangan'    => $keterangan,
			'periode'       => date("Y-m"),
			'input_by'      => $username,
			'inserted_at'   => date("Y-m-d H:m:s"),
			'updated_at'    => date("Y-m-d H:m:s")
		);

		// insert table inspeksi_trx.temuan_inspeksi
		$insert_inspeksi = $this->m_inspektor->insertData('inspeksi_trx.inspeksi', $data_inspeksi);
		if($insert_inspeksi) {
			$log_type = 'insert';
			$log_desc = 'Tambah Data Inspeksi';
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

			// cek realisasi inspeksi pada jadwal
			$where_jadwal = array(
				'id_user'        => $username,
				'tgl_inspeksi'   => date('Y-m-d'),
				'shift_inspeksi' => $shift
			);

			$is_realisasi = $this->m_inspektor->getWhere('inspeksi_trx.jadwal', $where_jadwal)->num_rows();
			if ($is_realisasi > 0) {
				// belum direalisasi
				$realisasi_jadwal = array(
					'status_inspeksi' => true,
					'tgl_realisasi'   => date('Y-m-d H:m:s'),
					'keterangan'      => json_encode($area).'--'.$keterangan
				);

				// update jadwal
				$update_jadwal = $this->m_inspektor->updateData('inspeksi_trx.jadwal', $realisasi_jadwal, $where_jadwal);

				if ($update_jadwal) {
					$this->session->set_flashdata('success', "Berhasil submit data inspeksi.");
					redirect(base_url("inspektor/area_inspeksi"));
				} else {
					$this->session->set_flashdata('success', "Berhasil submit data inspeksi, namun gagal realisasi jadwal.");
					redirect(base_url("inspektor/area_inspeksi"));
				}
			}

			$this->session->set_flashdata('success', "Berhasil submit data inspeksi.");
			redirect(base_url("inspektor/area_inspeksi"));

		} else{
			$this->session->set_flashdata('error', "Gagal submit data inspeksi.");
			redirect(base_url("inspektor/area_inspeksi"));
		}
	}

	// ambil data gambar temuan
	public function get_img_temuan() {
		$id = $this->input->post('data');
		$where = array(
			'id' => $id
		);
 
		$data = $this->m_inspektor->getWhere('inspeksi_trx.temuan_inspeksi', $where)->result();
		echo json_encode($data[0]->foto_temuan);
	}

	// ambil data gambar inspeksi
	public function get_img_inspeksi() {
		$id = $this->input->post('data');
		$where = array(
			'id' => $id
		);
 
		$data = $this->m_inspektor->getWhere('inspeksi_trx.inspeksi', $where)->result();
		echo json_encode($data[0]->evidence);
	}


	// close temuan inspeksi
	function close_temuan($kd_area, $id) {
		date_default_timezone_set("Asia/Jakarta");

		$where_id = array('id' => $id);
		$data_close = array(
			'status_tem' => true,
			'updated_at' => date('Y-m-d H:m:s')
		);

		$update = $this->m_inspektor->updateData('inspeksi_trx.temuan_inspeksi', $data_close, $where_id);
		if($update) {
			$log_type = 'update';
			$log_desc = "Close Temuan Inspeksi ID: $id";
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
			$this->session->set_flashdata('success', "Berhasil close temuan inspeksi dengan ID: $id.");
			redirect(base_url("inspektor/tanggapan_temuan/$kd_area"));
		} else{
			$this->session->set_flashdata('error', "Gagal close temuan inspeksi.");
			redirect(base_url("inspektor/tanggapan_temuan/$kd_area"));
		}
	}

	// hapus temuan inspeksi dan insert ke temporary
	function hapus_temuan($id_temuan) {
		date_default_timezone_set("Asia/Jakarta");
		$username = $this->session->userdata("username");

		$delete_temuan = $this->m_inspektor->deleteDataInspeksi($id_temuan);
		if($delete_temuan) {
			$log_type = 'delete';
			$log_desc = "Hapus Data Temuan Inspeksi ID: $id_temuan, oleh: $username";
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
			redirect(base_url("inspektor/area_temuan"));
		} else{
			$this->session->set_flashdata('error', "Gagal hapus data inspeksi.");
			redirect(base_url("inspektor/area_temuan"));
		}
	}

	// HAPUS Data Inspeksi
	function hapus_inspeksi($id) {
		date_default_timezone_set("Asia/Jakarta");
		// insert data jadwal
		$delete_data_inspeksi = $this->m_inspekstor->deleteInspeksi($id);
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
			redirect(base_url("inspektor/area_inspeksi"));
		} else{
			$this->session->set_flashdata('error', "Gagal hapus data inspeksi.");
			redirect(base_url("inspektor/area_inspeksi"));
		}
	}

	// menampilkan data jadwal user inspektor
	function jadwal() {
		date_default_timezone_set("Asia/Jakarta");
		$data['title'] = "Halaman Jadwal Inspeksi";
		$username = $this->session->userdata("username");
		$where_user = array('id_user' => $username);
		$data['jadwal'] = $this->m_inspektor->getWhere('inspeksi_trx.jadwal', $where_user)->result();

		$this->load->view('inspektor/v_jadwal', $data);
	}

}