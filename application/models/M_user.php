<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    // Fungsi untuk insert data ke database
    function insert($table,$data) {
		return $this->db->insert($table,$data);
	}

    // Fungsi untuk ambil data dari database
    function get($table){
        return $this->db->get($table);
    }

    // fungsi untuk hapus data 
    function delete($table,$where){
        $this->db->where($where);
        return $this->db->delete($table);
    }

    // Fungsi untuk ambil data dari database
    function getDept($table){
        $sql = "SELECT bagian_dept FROM $table GROUP BY bagian_dept";
		return $this->db->query($sql);
    }

    // Ambil data user by ID
    function getUserById($table,$table2,$where){
        $this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_dept='.$table2.'.id_dept');
        $this->db->where($where);
		return $this->db->get();
    }

    // Fungsi untuk ambil data dari database
    function getWhere($table,$where){
        return $this->db->get_where($table,$where);
    }

    function updateData($table,$data,$where){
        $this->db->where($where);
		return $this->db->update($table,$data);
    }

    // Ambil data Audit
    function getAllAudit($table,$table2,$table3,$table4,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_dept_audit='.$table2.'.id_dept');
		$this->db->join($table3, $table.'.kd_atem_audit='.$table3.'.id_aspek');
		$this->db->join($table4, $table.'.kd_tem_audit='.$table4.'.id_pt');
        $this->db->where($where);
		return $this->db->get();
	}

    // Ambil data Audit temuan referensi per bagian
    // 's_trx.tb_referensi', 's_trx.tb_audit', 's_mst.tb_dept', 's_mst.tb_aspek', 's_mst.tb_par_temuan'
    function getRefAudit($table,$table2,$table3,$table4,$table5,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.id_audit='.$table2.'.id_audit');
		$this->db->join($table3, $table2.'.kd_dept_audit='.$table3.'.id_dept');
		$this->db->join($table4, $table2.'.kd_atem_audit='.$table4.'.id_aspek');
		$this->db->join($table5, $table2.'.kd_tem_audit='.$table5.'.id_pt');
        $this->db->where($where);
		return $this->db->get();
	}

    // ambil jumlah referensi audit ke bagian lain
    function getRefOtherNum($dept){
        $sql = "SELECT * FROM s_trx.tb_referensi a JOIN s_trx.tb_audit b ON a.id_audit=b.id_audit
        WHERE b.bagian_dept='$dept' AND a.status_ref='false'";
        return $this->db->query($sql);
    }

    // ambil jumlah referensi audit ke bagian lain
    function getJlhTemNum($dept){
        $sql = "SELECT count(jlh_tem_audit) as total FROM s_trx.tb_audit
        WHERE kd_dept_audit='$dept' AND status='false'";
        return $this->db->query($sql);
    }

    function getAuditPerID($table,$table2,$table3,$table4,$where) {
		$this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.kd_dept_audit='.$table2.'.id_dept');
		$this->db->join($table3, $table.'.kd_atem_audit='.$table3.'.id_aspek');
		$this->db->join($table4, $table.'.kd_tem_audit='.$table4.'.id_pt');
        $this->db->where($where);
		return $this->db->get();
	}

    // AMBIL DATA JADWAL BERDASARKAN BAGIAN TERTENTU
    function getJA($auditee) {
        $sql = "SELECT distinct(section), kd_jadwal, tgl_waktu, auditee, auditor, realisasi, periode, nama FROM s_mst.tb_jadwal a LEFT OUTER JOIN s_mst.tb_user b on
        a.auditor=b.id_user LEFT OUTER JOIN s_mst.tb_dept c on
        a.auditee=c.section WHERE a.auditee='$auditee'";
        return $this->db->query($sql);
	}
	
	// INSERT DATA AUDIT KE TABEL S_LOG>TB_AUDIT
    function insertLogAudit($table,$table2,$id_audit) {
        $sql = "insert into $table (select * from $table2 WHERE id_audit='$id_audit')";
        return $this->db->query($sql);
	}
	
	//AMBIL DATA JADWAL AUDITIE
	// fungsi untuk ambil data jadwal auditor
    function getJadwalAuditor($table,$table2,$where){
        $this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.koor='.$table2.'.id_user');
        $this->db->where($where);
		return $this->db->get();
    }
	
	// get ranking data
    function getRankingData($table,$table2,$where) {
        $this->db->select('*');
		$this->db->from($table);
		$this->db->join($table2, $table.'.dept_ranking='.$table2.'.id_dept');
        $this->db->where($where);
		return $this->db->get();
	}
	
	
	

}