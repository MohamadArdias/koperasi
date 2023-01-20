<?php
class Kirim_model extends CI_model
{
    // public function getAllKirim()
    // {
    //     $this->db->select('*');
    //     $this->db->from('pl');
    //     $this->db->join('instan', 'instan.KODE_INS = pl.KODE_INS');
    //     $this->db->where('pl.KODE_INS !=', '99');
    //     $this->db->where('TAHUN', (date("Y"))); //untuk sementara (date("Y"))
    //     $this->db->where('BULAN', (date("m"))); //untuk sementara (date("m"))
    //     return  $this->db->get()->result_array();
    // }
    public function getTagihan()
    {
        $query = $this->db->query("SELECT * 
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
        TGL_TGHN IN ((SELECT MAX(TGL_TGHN) FROM pembayaran))");
        return $query->result_array();
    }
    
    public function getAllKirim($THN, $BLN)
    {
        // $query = $this->db->query("SELECT *
        // FROM
        // pembayaran
        // INNER JOIN
        // anggota
        // ON 
        //     pembayaran.KODE_ANG = anggota.URUT_ANG
        // INNER JOIN
        // instan
        // ON 
        //     anggota.KODE_INS = instan.KODE_INS
        // WHERE
        // TGL_TGHN IN ((SELECT MAX(TGL_TGHN) FROM pembayaran)) AND
        // anggota.REKENING > 1
        // ORDER BY
	    // instan.KODE_INS ASC, 
	    // anggota.URUT_ANG ASC");
        // return $query->result_array();

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
            anggota.REKENING > 1 AND
            pembayaran.TAHUN = $THN AND
            pembayaran.BULAN = '$BLN'
        ORDER BY
            instan.KODE_INS ASC, 
            anggota.URUT_ANG ASC");
        return $query->result_array();        
    }    

    public function cariDataKirim()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('NAMA_ANG', $keyword);
        $this->db->or_like('KODE_ANG', $keyword);
        $this->db->or_like('KODE_INS', $keyword);
        $this->db->or_like('NAMA_INS', $keyword);
        return $this->db->get('keuangan')->result_array();
    }

    public function cariDataInstansi()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('KODE_INS', $keyword);
        $this->db->or_like('NAMA_INS', $keyword);
        return $this->db->get('instan')->result_array();
    }
}
