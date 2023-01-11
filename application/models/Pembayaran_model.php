<?php

class Pembayaran_model extends  CI_Model
{
    public function getPembayaran()
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('anggota', 'anggota.URUT_ANG = pembayaran.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', '99');
        $this->db->where('instan.KODE_INS !=', '98');
        $this->db->where('instan.KODE_INS !=', '97');
        $this->db->where('instan.KODE_INS !=', '96');
        $this->db->like('TGL_TGHN', date('Y-m'));
        // $this->db->order_by('pembayaran.TGL_TGHN DESC, instan.KODE_INS ASC, anggota.URUT_ANG ASC');
        return $this->db->get()->result_array();
    }

    public function getTunggakan($THN, $BLN)
    {
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->where('TAHUN', $THN);
        $this->db->where('BULAN', $BLN);
        // $this->db->like('TGL_TGHN', date('Y-m', strtotime('-1 month')));
        // $this->db->like('TGL_TGHN', "2022-11");
        return $this->db->get()->result_array();
    }

    public function getTagihan($THN, $BLN)
    {
        // $query = $this->db->query("SELECT
        //     *
        // FROM
        //     pembayaran
        //     INNER JOIN
        //     anggota
        //     ON 
        //         pembayaran.KODE_ANG = anggota.URUT_ANG
        //     INNER JOIN
        //     instan
        //     ON 
        //         anggota.KODE_INS = instan.KODE_INS
        // WHERE
        //     TGL_TGHN IN ((SELECT MAX(TGL_TGHN) FROM pembayaran)) AND
        //     anggota.KODE_INS != 99 AND
        //     anggota.KODE_INS != 98 AND
        //     anggota.KODE_INS != 97 AND
        //     anggota.KODE_INS != 96");

        $query = $this->db->query("SELECT
            *
        FROM
            pembayaran
            INNER JOIN
            anggota
            ON 
                pembayaran.KODE_ANG = anggota.URUT_ANG
            INNER JOIN
            instan
            ON 
                anggota.KODE_INS = instan.KODE_INS
        WHERE
            pembayaran.TAHUN = $THN AND
            pembayaran.BULAN = $BLN AND
            anggota.KODE_INS <> 99 AND
            anggota.KODE_INS <> 98 AND
            anggota.KODE_INS <> 97 AND
            anggota.KODE_INS <> 96");

        return $query->result_array();
    }
}
