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
}
