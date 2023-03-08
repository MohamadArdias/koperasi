<?php

class Dashboard_model extends CI_Model
{
    public function getTotalTunggak()
    {
        $thn = date('Y');
        $bln = date('m');
        // $this->db->select('*');
        $this->db->select_sum('POKU6', 'jumlah');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.KODE_ANG = pl.KODE_ANG');
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
        $this->db->join('anggota', 'anggota.KODE_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pl.POKU6 >=', 1);
        $this->db->where('anggota.KODE_INS !=', '99');
        $this->db->where('anggota.KODE_INS !=', '98');
        $this->db->where('anggota.KODE_INS !=', '97');
        $this->db->where('anggota.KODE_INS !=', '96');
        $this->db->order_by('anggota.KODE_INS', 'ASC');
        return $this->db->get()->result_array();
    }
	public function getHistori($KODE_ANG)
	{
		$query = $this->db->query("SELECT
	*
FROM
	pl
	INNER JOIN
	pembayaran
	ON 
		pl.KODE_ANG = pembayaran.KODE_ANG AND
		pl.TAHUN = pembayaran.TAHUN AND
		pl.BULAN = pembayaran.BULAN
	INNER JOIN
	anggota
	ON 
		pl.KODE_ANG = anggota.KODE_ANG
	INNER JOIN
	instan
	ON 
		anggota.KODE_INS = instan.KODE_INS
WHERE
	pl.KODE_ANG = $KODE_ANG");
	
	return $query->result_array();	
	}
}