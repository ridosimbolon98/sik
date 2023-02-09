<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inspektor extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function insertData($table,$data) {
		return $this->db->insert($table,$data);
	}

    function getData($table){
        return $this->db->get($table);
    }

    function deleteData($table,$where){
        $this->db->where($where);
        return $this->db->delete($table);
    }

    function getWhere($table,$where){
        return $this->db->get_where($table,$where);
    }

    function updateData($table,$data,$where){
        $this->db->where($where);
		return $this->db->update($table,$data);
    }

    function getUser($table,$where) {
        $this->db->select("$table.nik, $table.nama, $table.username, $table.level. $table.bagian, $table.status_user");
        $this->db->where($where);
        $this->db->order_by($table.'.nama', 'ASC');
        return $this->db->get();
    }

    // Fungsi untuk mengambil data area yg sudah diinspeksi 
    function getArea($table,$table2,$where) {
		$this->db->select("distinct($table.kd_area), $table2.desk_area");
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_area='.$table2.'.kode_area', 'left');
        $this->db->where($where);
        $this->db->order_by($table.'.kd_area', 'ASC');
		return $this->db->get();
	}
    
    
    // Fungsi untuk mengambil data inspeksi yg sudah diinspeksi 
    // 'inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.item_temuan', 'inspeksi_mst.bagian', 'inspeksi_mst.area', '', 'inspeksi_mst.user'
    function getDataInspeksiHariIni($table,$table2,$table3,$table4,$where) {
		$this->db->select("
            $table.*,
            $table2.aspek_tem, 
            $table3.deskripsi as bagian,  
            $table4.desk_area as area
        ");
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_temuan='.$table2.'.id_tem', 'left');
		$this->db->join($table3, $table.'.kd_bagian='.$table3.'.kode_bagian', 'left');
		$this->db->join($table4, $table.'.kd_area='.$table4.'.kode_area', 'left');
        $this->db->where($where);
        $this->db->order_by($table.'.tgl_inspeksi', 'DESC');
		return $this->db->get();
	}
    
    // Fungsi untuk mengambil data inspeksi yg sudah diinspeksi 
    // 'inspeksi_trx.temuan_inspeksi', 'inspeksi_mst.item_temuan', 'inspeksi_mst.bagian', 'inspeksi_mst.area', '', 'inspeksi_mst.user'
    function getDataInspeksi($table,$table2,$table3,$table4,$table5,$where) {
		$this->db->select("
            $table.*,
            $table2.aspek_tem, 
            $table3.deskripsi as bagian,  
            $table4.desk_area as area,  
            $table5.nama,  
        ");
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_temuan='.$table2.'.id_tem', 'left');
		$this->db->join($table3, $table.'.kd_bagian='.$table3.'.kode_bagian', 'left');
		$this->db->join($table4, $table.'.kd_area='.$table4.'.kode_area', 'left');
		$this->db->join($table5, $table.'.user_inspektor='.$table5.'.username', 'left');
        $this->db->where($where);
        $this->db->order_by($table.'.tgl_inspeksi', 'DESC');
		return $this->db->get();
	}

    // ambil data temuan inspeksi
    function getDataTemuan($table,$whereUnsur) {
		$this->db->select("*");
		$this->db->from($table);
        $this->db->where($whereUnsur);
        $this->db->order_by($table.'.aspek_tem', 'ASC');
		return $this->db->get();
	}

    // delete temuan inspeksi
    function deleteDataInspeksi($id_temuan) {
        $sql = "insert into inspeksi_tmp.temuan_inspeksi (select * from inspeksi_trx.temuan_inspeksi where id='$id_temuan');
        delete from inspeksi_trx.temuan_inspeksi where id='$id_temuan';";
        return $this->db->query($sql);
    }

    // hapus dan copy data inspeksi ke inspeksi_tmp.inspeksi
    function deleteInspeksi($id) {
        $sql = "insert into inspeksi_tmp.inspeksi (select * from inspeksi_trx.inspeksi where id='$id');
        delete from inspeksi_trx.inspeksi where id='$id';";
        return $this->db->query($sql);
    }

    

}