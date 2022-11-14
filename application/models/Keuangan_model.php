<?php

class Keuangan_model extends  CI_Model
{
    public function getAllKeuangan()
    {
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', 99);
        $this->db->where('TAHUN', date('Y'));
        $this->db->where('BULAN', date('m'));
        return  $this->db->get()->result_array();
    }

    public function getDistincAllKeuangan()
    {       
        $this->db->distinct();
        $this->db->select('anggota.KODE_INS, instan.NAMA_INS');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', '99');
        $this->db->where('pl.TAHUN', date('Y'));
        $this->db->where('pl.BULAN', date('m'));
        return  $this->db->get()->result_array();
    }

    // public function getKeuangan($limit, $start, $keyword = null)
    // {
    //     if ($keyword) {
    //         $this->db->like('NAMA_ANG', $keyword);
    //         $this->db->or_like('KODE_ANG', $keyword);
    //         $this->db->or_like('KODE_INS', $keyword);
    //         $this->db->or_like('NAMA_INS', $keyword);
    //     }
    //     return $this->db->get('pl', $limit, $start)->result_array();
    // }

    // public function countAllKeuangan()
    // {
    //     return $this->db->get('pl')->num_rows();
    // }

    // public function cariDataKeuangan()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('NAMA_ANG', $keyword);
    //     $this->db->or_like('KODE_ANG', $keyword);
    //     $this->db->or_like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     return $this->db->get('pl')->result_array();
    // }

    // public function getKeuanganByKode($KODE_ANG)
    // {
    //     return $this->db->get_where('pl', ['KODE_ANG' => $KODE_ANG])->row_array();
    // }

    // public function cariDataInstansi()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     return $this->db->get('instan')->result_array();
    // }

    public function getAnggotaWhereKodeins($KODE_INS)
    {
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('instan.KODE_INS', $KODE_INS);
        $this->db->where('TAHUN', date('Y'));
        $this->db->where('BULAN', date('m'));
        return  $this->db->get()->result_array();
    }

    public function getInstansi($KODE_INS)
    {
        return $this->db->get_where('instan', ['KODE_INS' => $KODE_INS])->row_array();
    }

    public function inPembayaran()
    {
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        // $this->db->join('pembayaran', 'pembayaran.KODE_ANG = pl.KODE_ANG', 'right');
        // $this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
        $this->db->where('pl.TAHUN', date('Y'));
        // $this->db->where('pl.BULAN', date('m'));
        $this->db->where('pl.BULAN', date('m')+1);
        $this->db->where('anggota.KODE_INS !=', '99');
        $this->db->where('anggota.KODE_INS', '06');
        return $this->db->get()->result_array();
    }

    public function keuanganAnggota()
    {
        $this->data = [            
            "TAHUN" => date('Y'),
            "BULAN" => date('m'),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),            
            "POKOK" => 0,
            "WAJIB" => 0,
            "TPOKOK" => 0,
            "TWAJIB" => 0,
            "RELA" => 0,
        ];
        $this->db->insert('pl', $this->data);
    }
}
