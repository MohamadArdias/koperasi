<?php

use Mpdf\Tag\Select;

defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{
    public function getDataMasuk()
    {
        $this->db->Select('*');
        $this->db->from('temp');
        $this->db->like('DATE', date('Y-m'));
        return $this->db->get()->result_array();
    }

    public function getTemp()
    {
        $date = date("Y-m");

        $query = $this->db->query("SELECT
            temp.TANGGAL, 
            temp.NOMINAL, 
            anggota.URUT_ANG
        FROM
            anggota
            INNER JOIN
            temp
            ON 
                anggota.REKENING = temp.NO_REKENING
        WHERE
            temp.DATE IN (SELECT MAX(DATE) FROM temp)");

        // $query = $this->db->query("SELECT
        //     temp.TANGGAL, 
        //     anggota.URUT_ANG, 
        //     temp.NOMINAL, 
        //     pembayaran.JML_BAYAR
        // FROM
        //     anggota
        //     INNER JOIN
        //     temp
        //     ON 
        //         anggota.REKENING = temp.NO_REKENING
        //     INNER JOIN
        //     pembayaran
        //     ON 
        //         anggota.URUT_ANG = pembayaran.KODE_ANG
        // WHERE
        //     pembayaran.TGL_TGHN IN ((SELECT MAX(TGL_TGHN) FROM pembayaran )) AND
        //     temp.DATE IN (SELECT MAX(DATE) FROM temp)");
        
        return $query->result_array();
    }
}
