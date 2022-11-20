<?php

class Pengurus_model extends CI_Model
{
    public function getAllPengurus()
    {
        // $this->db->select('*');
        // $this->db->from('Pengurus');
        // return $this->db->get()->result_array();
        return $this->db->get_where('pengurus', ['ID' => 1])->row_array();
    }
    public function GetPengurusKetua()
    {
        $this->db->select('*');
        $this->db->from('pengurus');
        return $this->db->get()->row_array();
    }

    public function editDataPengurus()
    {
        $this->data = [
            "KETUA" => $this->input->post('KETUA', true),
            "WAKIL" => $this->input->post('WAKIL', true),
            "BENDAH1" => $this->input->post('BENDAH1', true),
            "BENDAH2" => $this->input->post('BENDAH2', true),
        ];
        // $this->db->where('ID', 1);
        $this->db->update('pengurus', $this->data);
    }
}
