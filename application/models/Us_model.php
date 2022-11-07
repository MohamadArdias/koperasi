<?php

class Us_model extends  CI_Model
{
    public function tambahTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $kode = $this->input->post('URUT_ANG', true);
        $nama = $this->input->post('NAMA_ANG', true);

        // $date = date('Y-m-d', strtotime('+' . $b . ' month', strtotime($a)));
        $this->data = [
            "NOFAK" => $this->input->post('NOFAK', true),
            "TANGGAL" => $this->input->post('TGLP_ANG', true),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "JUMLAH" => $this->input->post('JMLP_ANG', true),
            "PRO" => $this->input->post('PRO_ANG', true),
            "jangka" => $this->input->post('JWKT_ANG', true),
            "KET" => "PEMBERIAN PINJAMAN PADA $kode/$nama"
        ];

        $this->db->insert('us', $this->data);
    }

    public function getUs()
    {
        // SELECT TGLP_ANG,SUM(JMLP_ANG) FROM pinuang GROUP BY TGLP_ANG
        $data =  $this->db->query("SELECT TANGGAL, SUM(JUMLAH) AS HASIL FROM us GROUP BY TANGGAL");
        return $data->result_array();
        // $this->db->select('*');
        // $this->db->from('us');
        // $this->db->where('KODE_INS', '06');
        // return $this->db->get()->result_array();
    }

    public function getTgl()
    {
        $data = $this->db->query("SELECT TGLP_ANG AS TANGGAL FROM pinuang GROUP BY TGLP_ANG");
        return $data->result_array();
    }
}
