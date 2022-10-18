<?php

use LDAP\Result;

class Pinuang_model extends  CI_Model
{
    // menggunakan DB pinuang

    public function getPinuang($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('NAMA_ANG', $keyword);
            $this->db->or_like('KODE_ANG', $keyword);
            $this->db->or_like('KODE_INS', $keyword);
            $this->db->or_like('NAMA_INS', $keyword);
            $this->db->or_like('NOFAK', $keyword);
        }
        return $this->db->get('pinuang', $limit, $start)->result_array();
    }

    public function getUrut()
    {
        // SELECT MAX(NOFAK) as max_code FROM pinuang WHERE year(TGLP_ANG) = 2021 AND MONTH(TGLP_ANG) = 10

        $hari = date("d");
        $bulan = date("m");
        $tahun = date("Y");

        // $array = array('YEAR(TGLP_ANG)' => $tahun, 'MONTH(TGLP_ANG)' => $bulan);
        $query = $this->db->query("SELECT MAX(MID(NOFAK, 5)) AS MAX_CODE FROM pinuang WHERE year(TGLP_ANG) = $tahun AND MONTH(TGLP_ANG) = $bulan");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->MAX_CODE) + 1;
            $urutan = sprintf("%'.04d", $n);
        }else {
            $urutan = "0001";
        }

        return $urutan;
    }

    public function tambahTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $date = date('Y-m-d', strtotime('+'.$b.' month', strtotime( $a )));
        $this->data = [
            "NOFAK" => $this->input->post('NOFAK', true),
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "JMLP_ANG" => $this->input->post('JMLP_ANG', true),
            "TGLP_ANG" => $this->input->post('TGLP_ANG', true),
            "TGLT_ANG" => $date,
            "JWKT_ANG" => $this->input->post('JWKT_ANG', true),
            "PRO_ANG" => $this->input->post('PRO_ANG', true),
        ];

        $this->db->insert('pinuang', $this->data);
        
    }
}
