<?php

class Anggota_model extends  CI_Model
{
    public function getAllAnggota()
    {
        return $this->db->get('anggota')->result_array();
    }
    public function getAnggotaById($URUT_ANG)
    {
        return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    }
}
