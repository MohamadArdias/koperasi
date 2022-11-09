<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Import_model extends CI_Model
{
    public function import_data($datamasuk)
    {
        $jumlah = count($datamasuk);
        if ($jumlah > 0) {
            $this->db->replace('pembayaran', $datamasuk);
        }
    }

    public function getDataMasuk()
    {
        return $this->db->get('pembayaran')->result_array();
    }
}
