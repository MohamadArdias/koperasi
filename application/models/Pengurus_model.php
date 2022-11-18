<?php

class Pengurus_model extends CI_Model
{
    public function getAllPengurus()
    {
        $this->db->select('*');
        $this->db->from('Pengurus');
        return $this->db->get()->result_array();
    }
    public function GetPengurusKetua($id)
    {
        $this->db->select('KETUA');
        $this->db->from('Pengurus');
        $this->db->where('ID', $id);
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
