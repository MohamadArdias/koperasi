<?php

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
}
