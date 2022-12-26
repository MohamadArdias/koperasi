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
        // $this->db->select('*');
        // $this->db->from('temp');
        // $this->db->join('anggota', 'anggota.REKENING = temp.NO_REKENING');;
        // $this->db->like('temp.DATE', date('Y-m'));
        // return $this->db->get()->result_array();

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
            temp.DATE LIKE '%2022-12%'");
        
        return $query->result_array();
    }
}
