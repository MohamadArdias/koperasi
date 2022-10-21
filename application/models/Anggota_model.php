<?php

class Anggota_model extends  CI_Model
{
    // public function getAllAnggota()
    // {
    //     return $this->db->get('anggota')->result_array();
    // }

    public function getAllAnggota($a)
    {
        return $this->db->query("SELECT anggota.NAMA_ANG AS aga FROM anggota WHERE URUT_ANG = '$a'")->row_array();
        // return  $this->db->get($query)->row_array();

        // $this->db->select('anggota.NAMA_ANG');
        // $this->db->from('anggota');
        // // $this->db->where('KODE_INS !=', '99');
        // $this->db->where('URUT_ANG', $a);
        // return  $this->db->get()->row_array();
    }

    // public function cariDataAnggota()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('NAMA_ANG', $keyword);
    //     $this->db->or_like('URUT_ANG', $keyword);
    //     $this->db->or_like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     return $this->db->get('anggota')->result_array();
    // }

    public function cariDataAnggota($title)
    {
        $this->db->like('KODE_ANG', $title);
        $this->db->order_by('KODE_ANG', 'ASC');
        $this->db->limit(10);
        return $this->db->get('anggota')->result();
    }

    public function getAnggotaById($URUT_ANG)
    {
        // return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();

        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('URUT_ANG', $URUT_ANG);
        return $this->db->get()->row_array();
    }

    // public function countAllAnggota()
    // {
    //     return $this->db->get('anggota')->num_rows();
    // }

    public function getAnggota($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->select("anggota.URUT_ANG AS URUT_ANG");
            $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
            $this->db->select("anggota.KODE_INS AS KODE_INS");
            $this->db->select("instan.NAMA_INS AS NAMA_INS");
            $this->db->from('anggota');
            $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
            $this->db->where('anggota.KODE_INS !=', '99');
            $this->db->like('anggota.NAMA_ANG', $keyword);
            $this->db->or_like('anggota.URUT_ANG', $keyword);
            $this->db->or_like('instan.NAMA_INS', $keyword);
        } else {
            $this->db->select("anggota.URUT_ANG AS URUT_ANG");
            $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
            $this->db->select("anggota.KODE_INS AS KODE_INS");
            $this->db->select("instan.NAMA_INS AS NAMA_INS");
            $this->db->from('anggota');
            $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
            $this->db->where('anggota.KODE_INS !=', '99');
        }
        return $this->db->get('', $limit, $start)->result_array();
    }

    public function getAnggota2($keyword = null)
    {
        if ($keyword) {
            $this->db->select("anggota.URUT_ANG AS URUT_ANG");
            $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
            $this->db->select("anggota.KODE_INS AS KODE_INS");
            $this->db->select("instan.NAMA_INS AS NAMA_INS");
            $this->db->from('anggota');
            $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
            $this->db->where('anggota.KODE_INS !=', '99');
            $this->db->like('anggota.NAMA_ANG', $keyword);
            $this->db->or_like('anggota.URUT_ANG', $keyword);
            $this->db->or_like('instan.NAMA_INS', $keyword);
        } else {
            $this->db->select("anggota.URUT_ANG AS URUT_ANG");
            $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
            $this->db->select("anggota.KODE_INS AS KODE_INS");
            $this->db->select("instan.NAMA_INS AS NAMA_INS");
            $this->db->from('anggota');
            $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
            $this->db->where('anggota.KODE_INS !=', '99');
        }

        return $this->db->get()->num_rows();
    }


    public function tambahDataAnggota()
    {
        $this->data = [
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "NAMA_INS" => $this->input->post('NAMA_INS', true),
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
            "TGLM_ANG" => $this->input->post('TGLM_ANG', true),
            "TGLK_ANG" => $this->input->post('TGLK_ANG', true),
            "GOL" => $this->input->post('GOL', true),
        ];

        $this->db->insert('anggota', $this->data);
    }

    public function hapusDataAnggota($URUT_ANG)
    {
        $this->db->delete('anggota', ['URUT_ANG' => $URUT_ANG]);
    }

    // public function getAnggotaByUrut($URUT_ANG)
    // {
    //     return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    //     return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    // }

    public function editDataAnggota()
    {
        $this->data = [
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
            "TGLM_ANG" => $this->input->post('TGLM_ANG', true),
            "TGLK_ANG" => $this->input->post('TGLK_ANG', true),
            "GOL" => $this->input->post('GOL', true),
        ];

        $this->db->where('URUT_ANG', $this->input->post('URUT_ANG'));
        $this->db->update('anggota', $this->data);
    }

    public function getNama($a)
    {
        $query = $this->db->query("SELECT NAMA_ANG AS NAMA FROM anggota WHERE URUT_ANG='$a'");
        return $query->row_array();
    }

    public function getTanggungan($a)
    {
        $tahun = date("Y");
        $bulan = date("m");

        $sql = $this->db->query("SELECT 
        pinuang.NOFAK AS FAKTUR,
        anggota.NAMA_ANG AS NAMA, 
        pinuang.JWKT_ANG AS JANGKA,
        pl.KEU3 AS PERIODE, 
        pl.SIPOKU3 AS SISA, 
        pl.BNGU3 AS BUNGA
        FROM 
        anggota 
        LEFT JOIN 
        pinuang 
        ON 
        anggota.URUT_ANG = pinuang.KODE_ANG  
        LEFT JOIN
	    pl
	    ON 
		anggota.URUT_ANG = pl.KODE_ANG
        WHERE anggota.URUT_ANG = '$a' AND 
        pl.TAHUN = $tahun AND
        pl.BULAN = $bulan AND
        pinuang.NOFAK LIKE '%n%' 
        ");

        return $sql->row_array();
    }
}
