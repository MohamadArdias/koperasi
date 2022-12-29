<?php

class Us_model extends  CI_Model
{
    public function getGenerate()
    {
        return $this->db->query("SELECT MAX(TANGGAL) AS tanggal FROM us")->row();
    }
    
    public function tambahTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $kode = $this->input->post('URUT_ANG', true);
        $nama = $this->input->post('NAMA_ANG', true);

        // $date = date('Y-m-d', strtotime('+' . $b . ' month', strtotime($a)));
        $this->data = [
            "IDUSER" => $this->input->post('id', true),
            "IDNAMA" => $this->input->post('first_name', true),
            "NOFAK" => $this->input->post('NOFAK', true),
            "TANGGAL" => $this->input->post('TGLP_ANG', true),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "JUMLAH" => $this->input->post('JMLP_ANG', true),
            "PRO" => $this->input->post('PRO_ANG', true),
            "jangka" => $this->input->post('JWKT_ANG', true),
            "DATE" => date('Y-m-d'),
            "TIME" => date("H:i:s"),
            "KET" => "PEMBERIAN PINJAMAN PADA $kode/$nama"
        ];

        $this->db->insert('us', $this->data);
    }

    public function getUs($thn)
    {
        // SELECT TGLP_ANG,SUM(JMLP_ANG) FROM pinuang GROUP BY TGLP_ANG
        // $data =  $this->db->query("SELECT TANGGAL, SUM(JUMLAH) AS HASIL FROM us GROUP BY TANGGAL");
        $data =  $this->db->query("SELECT SUM(JUMLAH) AS HASIL,	MONTH(TANGGAL) AS TANGGAL FROM	us WHERE YEAR(TANGGAL) = $thn GROUP BY MONTH(TANGGAL)");
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

    public function getTrx()
    {
    //     $query = $this->db->query("SELECT
    //     *
    // FROM
    //     anggota
    //     INNER JOIN
    //     instan
    //     ON 
    //         anggota.KODE_INS = instan.KODE_INS
    //     INNER JOIN
    //     us
    //     ON 
    //         us.KODE_ANG = anggota.URUT_ANG
    // ORDER BY
    //     us.TANGGAL DESC");
        $query = $this->db->query("SELECT
            *
        FROM
            anggota
            INNER JOIN
            instan
            ON 
                anggota.KODE_INS = instan.KODE_INS
            INNER JOIN
            us
            ON 
                us.KODE_ANG = anggota.URUT_ANG
        ORDER BY
            us.TANGGAL DESC");
        return $query->result_array();
    }
}
