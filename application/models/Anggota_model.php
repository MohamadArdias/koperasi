<?php

class Anggota_model extends  CI_Model
{
    // public function getAllAnggota()
    // {
    //     return $this->db->get('anggota')->result_array();
    // }

    public function editStatus()
    {
        $this->data = [
            "KODE_INS" => $this->input->post('STATUS', true),
            "TGLK_ANG" => $this->input->post('TGLK_ANG', true),
        ];

        $this->db->where('URUT_ANG', $this->input->post('URUT_ANG'));
        $this->db->update('anggota', $this->data);
    }

    public function berhenti($URUT_ANG)
    {
        return $this->db->get('anggota');
    }

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

    public function getAllAnggotaAktif()
    {
        // return $this->db->get('instan')->result_array();
        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->where('KODE_INS !=', '99');
        $this->db->where('KODE_INS !=', '98');
        $this->db->where('KODE_INS !=', '97');
        $this->db->where('KODE_INS !=', '96');
        return  $this->db->get()->num_rows();
    }

    public function getAllAnggotaTidakAktif()
    {
        $query = $this->db->query("SELECT
            *
        FROM
            anggota
        WHERE
            anggota.KODE_INS = 99 OR
            anggota.KODE_INS = 98 OR
            anggota.KODE_INS = 97 OR
            anggota.KODE_INS = 96");
        
        return  $query->num_rows();
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

    public function getAnggota()
    {
        $query = $this->db->query("SELECT
        *
    FROM
        anggota
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
    WHERE
        instan.KODE_INS != 99 AND
        instan.KODE_INS != 98 AND
        instan.KODE_INS != 97 AND
        instan.KODE_INS != 96
    ORDER BY
	    instan.KODE_INS ASC");
        return $query->result_array();
        // $this->db->select("*");
        // $this->db->from('anggota');
        // $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        // // $this->db->where('anggota.KODE_INS !=', '99');
        // $this->db->order_by('instan.KODE_INS', 'ASC');
        // return $this->db->get()->result_array();
    }
    
    // public function getAnggota($limit, $start, $keyword = null)
    // {
    //     if ($keyword) {
    //         $this->db->select("anggota.URUT_ANG AS URUT_ANG");
    //         $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
    //         $this->db->select("anggota.KODE_INS AS KODE_INS");
    //         $this->db->select("instan.NAMA_INS AS NAMA_INS");
    //         $this->db->from('anggota');
    //         $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
    //         $this->db->where('anggota.KODE_INS !=', '99');
    //         $this->db->like('anggota.NAMA_ANG', $keyword);
    //         $this->db->or_like('anggota.URUT_ANG', $keyword);
    //         $this->db->or_like('instan.NAMA_INS', $keyword);
    //     } else {
    //         $this->db->select("anggota.URUT_ANG AS URUT_ANG");
    //         $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
    //         $this->db->select("anggota.KODE_INS AS KODE_INS");
    //         $this->db->select("instan.NAMA_INS AS NAMA_INS");
    //         $this->db->from('anggota');
    //         $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
    //         $this->db->where('anggota.KODE_INS !=', '99');
    //     }
    //     return $this->db->get('', $limit, $start)->result_array();
    // }

    // public function getAnggota2($keyword = null)
    // {
    //     if ($keyword) {
    //         $this->db->select("anggota.URUT_ANG AS URUT_ANG");
    //         $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
    //         $this->db->select("anggota.KODE_INS AS KODE_INS");
    //         $this->db->select("instan.NAMA_INS AS NAMA_INS");
    //         $this->db->from('anggota');
    //         $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
    //         $this->db->where('anggota.KODE_INS !=', '99');
    //         $this->db->like('anggota.NAMA_ANG', $keyword);
    //         $this->db->or_like('anggota.URUT_ANG', $keyword);
    //         $this->db->or_like('instan.NAMA_INS', $keyword);
    //     } else {
    //         $this->db->select("anggota.URUT_ANG AS URUT_ANG");
    //         $this->db->select("anggota.NAMA_ANG AS NAMA_ANG");
    //         $this->db->select("anggota.KODE_INS AS KODE_INS");
    //         $this->db->select("instan.NAMA_INS AS NAMA_INS");
    //         $this->db->from('anggota');
    //         $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
    //         $this->db->where('anggota.KODE_INS !=', '99');
    //     }

    //     return $this->db->get()->num_rows();
    // }


    public function tambahDataAnggota()
    {
        $this->data = [            
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "REKENING" => $this->input->post('REKENING', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),            
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
			"TELP_ANG" => $this->input->post('TELP_ANG', true),
            "TGLM_ANG" => $this->input->post('TGLM_ANG', true),
            "NIK" => $this->input->post('NIK', true),
            "GOL" => 'KPRI',
        ];

        $this->db->insert('anggota', $this->data);

        $this->pembayaran = [
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "TAHUN" => date("Y"),
            "BULAN" => date("m"),
        ];

        $this->db->insert('pembayaran', $this->Pembayaran);
    }

    public function hapusDataAnggota($URUT_ANG)
    {
        $this->db->delete('anggota', ['URUT_ANG' => $URUT_ANG]);
    }

    public function getAnggotaByUrut($URUT_ANG)
    {
        return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    }

    public function editDataAnggota()
    {
        $this->data = [
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "REKENING" => $this->input->post('REKENING', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
            "TELP_ANG" => $this->input->post('TELP_ANG', true),
            "NIK" => $this->input->post('NIK', true),
        ];

        $this->db->where('URUT_ANG', $this->input->post('URUT_ANG'));
        $this->db->update('anggota', $this->data);
    }

    public function getNama($a)
    {
        $query = $this->db->query("SELECT NAMA_ANG AS NAMA FROM anggota WHERE URUT_ANG='$a'");
        return $query->row_array();
    }

    public function getTanggungan($a, $b)
    {
        $tahun = date("Y");
        $bulan = date("m");

        $sql = $this->db->query("SELECT 
        *
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
        WHERE 
        anggota.URUT_ANG = '$a' AND 
        pl.TAHUN = $tahun AND
        pl.BULAN = $bulan AND
        pinuang.TAHUN = $tahun AND
        pinuang.BULAN = $bulan AND
        pinuang.NOFAK LIKE '%$b%' 
        ");

        return $sql->row_array();
    }

    public function cekAnggota()
    {
        $URUT_ANG = $this->input->post('URUT_ANG', true);
        return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->num_rows();
    }

    public function cekAnggotaPin()
    {
        $URUT_ANG = $this->input->post('KODE', true);
        $query = $this->db->query("SELECT
            *
        FROM
            anggota
            INNER JOIN
            pembayaran
            ON 
                anggota.URUT_ANG = pembayaran.KODE_ANG
        WHERE
            anggota.URUT_ANG = $URUT_ANG");
        return $query->num_rows();
    }
}
