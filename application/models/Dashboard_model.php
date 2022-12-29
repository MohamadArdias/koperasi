<?php

class Dashboard_model extends CI_Model
{
    public function getTotalTunggak()
    {
        $thn = date('Y');
        $bln = date('m');
        // $this->db->select('*');
        $this->db->select_sum('TUNGGAKAN', 'jumlah');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('anggota.KODE_INS !=', '99');
        $this->db->where('anggota.KODE_INS !=', '98');
        $this->db->where('anggota.KODE_INS !=', '97');
        $this->db->where('anggota.KODE_INS !=', '96');
        return $this->db->get()->row();

    }
    public function getAnggotaTunggak()
    {
        $thn = date('Y');
        $bln = date('m');
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pl.TUNGGAKAN !=', 'NULL');
        $this->db->where('anggota.KODE_INS !=', '99');
        $this->db->where('anggota.KODE_INS !=', '98');
        $this->db->where('anggota.KODE_INS !=', '97');
        $this->db->where('anggota.KODE_INS !=', '96');
        $this->db->order_by('anggota.KODE_INS', 'ASC');
        return $this->db->get()->result_array();
    }
}