<?php

class Anggota_model extends  CI_Model
{
    public function getAllAnggota()
    {
        return $this->db->get('anggota')->result_array();
    }

    public function cariDataAnggota()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('NAMA_ANG', $keyword);
        $this->db->or_like('URUT_ANG', $keyword);
        $this->db->or_like('KODE_INS', $keyword);
        $this->db->or_like('NAMA_INS', $keyword);
        return $this->db->get('anggota')->result_array();
    }

    public function getAnggotaById($URUT_ANG)
    {
        return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    }

    public function countAllAnggota()
    {
        return $this->db->get('anggota')->num_rows();
    }

    public function getAnggota($limit, $start)
    {
        return $this->db->get('anggota', $limit, $start)->result_array();
    }

    public function tambahDataAnggota()
    {
        $this->data = [
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "NAMA_INS" => $this->input->post('NAMA_INS', true),
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
            "TGLM_ANG" => $this->input->post('TGLM_ANG', true),
            "TGLK_ANG" => $this->input->post('TGLK_ANG', true),
            "GOL" => $this->input->post('GOL', true),
        ];

        $this->db->insert('anggota', $this->data);
    }

    public function hapusDataAnggota($URUT_ANG)
    {
        $this->db->delete('anggota', ['URUT_ANG' => $URUT_ANG]);
    }

    public function getAnggotaByUrut($URUT_ANG)
    {
        return $this->db->get_where('anggota', ['URUT_ANG' => $URUT_ANG])->row_array();
    }

    public function editDataAnggota()
    {
        $this->data = [
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "URUT_ANG" => $this->input->post('URUT_ANG', true),
            "NAMA_ANG" => $this->input->post('NAMA_ANG', true),
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "NAMA_INS" => $this->input->post('NAMA_INS', true),
            "TLHR_ANG" => $this->input->post('TLHR_ANG', true),
            "ALM_ANG" => $this->input->post('ALM_ANG', true),
            "TGLM_ANG" => $this->input->post('TGLM_ANG', true),
            "TGLK_ANG" => $this->input->post('TGLK_ANG', true),
            "GOL" => $this->input->post('GOL', true),
        ];

        $this->db->where('URUT_ANG', $this->input->post('URUT_ANG'));
        $this->db->update('anggota', $this->data);
    }
}
