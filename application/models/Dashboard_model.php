<?php

class Dashboard_model extends CI_Model
{
    public function getAnggotaAktif()
    {
        return $this->db->get('anggota')->result_array();
    }
}