<?php

use Mpdf\Tag\Select;

defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{
    public function import_data($datamasuk)
    {
        $jumlah = count($datamasuk);
        if ($jumlah > 0) {
            $this->db->replace('temp', $datamasuk);
        }
    }

    public function getDataMasuk()
    {
        $this->db->Select('*');
        $this->db->from('temp');
        $this->db->like('TANGGAL', date('Y-m'));
        return $this->db->get()->result_array();
    }
}
