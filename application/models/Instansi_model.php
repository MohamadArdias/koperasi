<?php

class Instansi_model extends  CI_Model
{
    public function getAllInstansi()
    {
        $this->db->select('*');
        $this->db->from('instan');
        $this->db->where('KODE_INS !=', '99');
        return  $this->db->get()->result_array();
    }

    // public function cariDataInstansi()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     $this->db->or_like('ALM_INS', $keyword);
    //     $this->db->or_like('TLP_INS', $keyword);
    //     return $this->db->get('instan')->result_array();
    // }

    public function getInstansi($limit, $start, $keyword = null)
    {
        if ($keyword) {
            $this->db->like('KODE_INS', $keyword);
            $this->db->or_like('NAMA_INS', $keyword);
        }
        return $this->db->get('instan', $limit, $start)->result_array();
    }

    // public function countAllInstansi()
    // {
    //     return $this->db->get('instan')->num_rows();
    // }

    public function tambahDataInstansi()
    {
        $data = [
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "NAMA_INS" => $this->input->post('NAMA_INS', true),
            "ALM_INS" => $this->input->post('ALM_INS', true),
            "TLP_INS" => $this->input->post('TLP_INS', true),
        ];

        $this->db->insert('instan', $data);
    }

    public function hapusDataInstansi($KODE_INS)
    {
        $this->db->delete('instan', ['KODE_INS' => $KODE_INS]);
    }

    public function getInstansiByKode($KODE_INS)
    {
        return $this->db->get_where('instan', ['KODE_INS' => $KODE_INS])->row_array();
    }

    public function editDataInstansi()
    {
        $this->data = [
            "KODE_INS" => $this->input->post('KODE_INS', true),
            "NAMA_INS" => $this->input->post('NAMA_INS', true),
            "ALM_INS" => $this->input->post('ALM_INS', true),
            "TLP_INS" => $this->input->post('TLP_INS', true),
        ];

        $this->db->where('KODE_INS', $this->input->post('KODE_INS'));
        $this->db->update('instan', $this->data);
    }

    // public function getAnggotaWhereKodeins($KODE_INS)
    // {
    //     // return $this->db->get_where('keuangan', ['KODE_INS' => $KODE_INS])->row_array();
    //     // ['kode' => $KODE_INS];
    //     // $this->db->get('instan')
    //     // $gg='03';

    //     $this->db->select('*');
    //     $this->db->from('keuangan');
    //     $this->db->where('KODE_INS', $KODE_INS);
    //     return  $this->db->get()->result_array();
    // }
}
