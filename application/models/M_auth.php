<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_auth extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    //Cek login user pada tabel akun di database
	public function autentikasi($table,$where){
		return $this->db->get_where($table,$where);
	}

	//Cek login user pada tabel akun di database
	public function autentikasi_data($table,$table2,$where){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.bagian='.$table2.'.kode_bagian');
    $this->db->where($where);
		return $this->db->get();
	}

	// Fungsi untuk insert log ke database
	public function insertLog($table,$data){
        return $this->db->insert('s_log.'.$table,$data);
	}

	// Fungsi untuk ambil data Log
	public function getLog($table){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->order_by($table.'.date', 'DESC');		
		return $this->db->get();
	}

	
}