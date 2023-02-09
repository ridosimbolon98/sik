<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk insert data ke database
    function insertData($table,$data) {
		return $this->db->insert($table,$data);
	}

    // Fungsi untuk ambil data dari database
    function getData($table){
        return $this->db->get($table);
    }

    // fungsi untuk hapus data 
    function deleteData($table,$where){
        $this->db->where($where);
        return $this->db->delete($table);
    }
    
    function updateData($table,$data,$where){
        $this->db->where($where);
		return $this->db->update($table,$data);
    }
    
    // Fungsi untuk ambil data berdasarkan ketentuan tertentu dari database
    function getWhere($table,$where){
        return $this->db->get_where($table, $where);
    }

    // Fungsi untuk ambil data dari database
    function getLog($table){
        $this->db->select('*');
		$this->db->from($table);
        $this->db->order_by($table.'.date', 'DESC');
        return $this->db->get();
    }

    // Fungsi untuk mengambil data users
    function getUsers($table,$table2) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_dept='.$table2.'.id_dept');
        $this->db->order_by($table.'.nama', 'ASC');
		return $this->db->get();
	}
    
    // Fungsi untuk mengambil data area
    function getArea($table) {
		$this->db->select('*');
		$this->db->from($table);
        $this->db->order_by($table.'.desk_area', 'ASC');
		return $this->db->get();
	}
	
    // Fungsi untuk mengambil data jadwal auditor
    function getJadwal($table,$table2,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.id_user='.$table2.'.username');
        $this->db->where($where);
		return $this->db->get();
	}
    
    // mengambil data temuan per area by tahun
    function getTemuanByArea($tahun, $kd_area) {
        $sql = "SELECT a.id, a.tgl_inspeksi, a.shift, d.aspek_tem, e.nama as inspektor, b.deskripsi as nama_bagian, a.kd_area,
        c.desk_area as nama_area, a.unsur, a.poin_min, a.foto_temuan, a.keterangan, a.tanggapan, a.status_tem,
        a.created_at
        from inspeksi_trx.temuan_inspeksi a join inspeksi_mst.bagian b
        on a.kd_bagian=b.kode_bagian
        join inspeksi_mst.area c on a.kd_area=c.kode_area
        join inspeksi_mst.item_temuan d on a.kd_temuan=d.id_tem
        join inspeksi_mst.user e on a.user_inspektor=e.username
        where a.kd_area='$kd_area' and date_part('year', a.tgl_inspeksi)='$tahun'
        order by a.tgl_inspeksi DESC";
        return $this->db->query($sql);
    }

    // mengambil data total poin min per area dan periode
    function getPoinMin($periode, $kd_area) {
        $sql = "SELECT sum(poin_min::bigint) as total_poin from inspeksi_trx.temuan_inspeksi where kd_area='$kd_area' and periode='$periode'";
        return $this->db->query($sql);
    }

    // mengambil data report temuan
    //'inspeksi_trx.report', 'inspeksi_mst.area', 'inspeksi_mst.user'
    function getReportTemuan($table, $table2, $table3, $where) {
        $this->db->select("
            $table.id, $table.poin_min, $table.periode,
            $table2.desk_area,
            $table3.nama
        ");
        $this->db->from($table);
		$this->db->join($table2, $table.'.kode_area='.$table2.'.kode_area');
		$this->db->join($table3, $table.'.eop_by='.$table3.'.username');
        $this->db->where($where);
        $this->db->order_by($table.'.poin_min', 'DESC');
		return $this->db->get();
    }

    // hapus dan copy data jadwal ke inspeksi_tmp.jadwal
    function deleteJadwal($id_jadwal) {
        $sql = "insert into inspeksi_tmp.jadwal (select * from inspeksi_trx.jadwal where id_jadwal='$id_jadwal');
        delete from inspeksi_trx.jadwal where id_jadwal='$id_jadwal';";
        return $this->db->query($sql);
    }
    
    // hapus dan copy data inspeksi ke inspeksi_tmp.inspeksi
    function deleteDataInspeksi($id) {
        $sql = "insert into inspeksi_tmp.inspeksi (select * from inspeksi_trx.inspeksi where id='$id');
        delete from inspeksi_trx.inspeksi where id='$id';";
        return $this->db->query($sql);
    }
    
    // hapus dan copy data jadwal dari inspeksi_tmp.jadwal ke inspeksi_trx.jadwal
    function restoreJadwal($id_jadwal) {
        $sql = "insert into inspeksi_trx.jadwal (select * from inspeksi_tmp.jadwal where id_jadwal='$id_jadwal');
        delete from inspeksi_tmp.jadwal where id_jadwal='$id_jadwal';";
        return $this->db->query($sql);
    }

    // ambil data jumlah temuan per periode
    function getSumTemuanPeriode($periode) {
        $sql = "SELECT count(*) as jml from inspeksi_trx.temuan_inspeksi where periode='$periode'";
        return $this->db->query($sql);
    }

    // ambil jumlah temuan open per tahun
    function getSumTemOpen($tahun) {
        $sql = "SELECT * from inspeksi_trx.temuan_inspeksi where status_tem='f' and date_part('year', tgl_inspeksi)='$tahun'";
        return $this->db->query($sql);
    }
    
    // ambil jumlah temuan new per tahun
    function getSumTemNew($periode) {
        $sql = "SELECT * from inspeksi_trx.temuan_inspeksi where status_tem='f' and periode='$periode'";
        return $this->db->query($sql);
    }
    
    // ambil jumlah temuan belum ditanggapi per tahun
    function getSumTemBlmDtgp($periode) {
        $sql = "SELECT * from inspeksi_trx.temuan_inspeksi where status_tem='f' and tanggapan IS NULL and date_part('year', tgl_inspeksi)='$periode'";
        return $this->db->query($sql);
    }
    
    // ambil jumlah temuan belum ditanggapi per tahun
    function getSumTemClose($periode) {
        $sql = "SELECT * from inspeksi_trx.temuan_inspeksi where status_tem='t' and status_tem='t' and date_part('year', tgl_inspeksi)='$periode'";
        return $this->db->query($sql);
    }
    
    // ambil jumlah temuan belum ditanggapi per tahun
    function getDataInspeksiBerjalan($periode) {
        $sql = "SELECT * from inspeksi_trx.inspeksi where date_part('year', tgl_inspeksi)='$periode'";
        return $this->db->query($sql);
    }
    
    
    /** ========================================================================= */
    // Fungsi untuk hapus seluruh data di tabel ranking
    function truncateRanking($table){
        return $this->db->truncate($table);
    }

    // get user actice session
    public function show_active_users(){
        $sql = "SELECT a.id, TO_TIMESTAMP(a.timestamp) at time zone 'UTC+7' at time zone 'PST+7' as timestamp, a.ip_address, a.data
        from inspeksi_tmp.ci_sessions a";        
        return $this->db->query($sql);
    }

    // delete user actice session
    public function deleteSession($table, $sess_id){
        $sql = "DELETE from inspeksi_tmp.ci_sessions where id<>'$sess_id'";        
        return $this->db->query($sql);
    }

}
