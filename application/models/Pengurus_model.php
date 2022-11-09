<?php

class Pengurus_model extends CI_Model
{
    public function getAllPengurus()
    {
        return $this->db->get('Pengurus')->result_array();
    }
    public function GetPengurusbyJabatan($JABATAN)
    {
        $this->db->select('*');
        $this->db->from('pengurus');
        $this->db->where('JABATAN', $JABATAN);
        return $this->db->get()->row_array();
    }
    public function editDataPengurus()
    {
        $this->data = [
            "NAMA" => $this->input->post('NAMA', true),
        ];

        $this->db->where('JABATAN', $this->input->post('JABATAN'));
        $this->db->update('pengurus', $this->data);
    }
}
