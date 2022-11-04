<?php

class Pinuang_model extends  CI_Model
{
    public function getPinuang()
    {
        $this->db->like('NAMA_ANG');
        $this->db->or_like('KODE_ANG');
        $this->db->or_like('KODE_INS');
        $this->db->or_like('NAMA_INS');
        $this->db->or_like('NOFAK');
        return $this->db->get('pinuang')->result_array();
    }

    public function getUrut()
    {
        $hari = date("d");
        $bulan = date("m");
        $tahun = date("Y");

        $query = $this->db->query("SELECT MAX(MID(NOFAK, 5)) AS MAX_CODE FROM pinuang WHERE year(TGLP_ANG) = $tahun AND MONTH(TGLP_ANG) = $bulan");

        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->MAX_CODE) + 1;
            $urutan = sprintf("%'.04d", $n);
        } else {
            $urutan = "0001";
        }
        return $urutan;
    }

    public function tambahTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $date = date('Y-m-d', strtotime('+' . $b . ' month', strtotime($a)));
        $this->data = [
            "NOFAK" => $this->input->post('NOFAK', true),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "JMLP_ANG" => $this->input->post('JMLP_ANG', true),
            "TGLP_ANG" => $this->input->post('TGLP_ANG', true),
            "TGLT_ANG" => $date,
            "JWKT_ANG" => $this->input->post('JWKT_ANG', true),
            "PRO_ANG" => $this->input->post('PRO_ANG', true),
        ];

        $this->db->insert('pinuang', $this->data);
    }

    public function deleteTransaksi($a)
    {
        return $this->db->query("DELETE FROM
            pinuang
        WHERE
            pinuang.NOFAK LIKE '%n%' AND
            pinuang.KODE_ANG = '$a'");
    }

    public function getUang()
    {
        $bln = date('m', strtotime('-1 month'));
        $thn = date('Y', strtotime('-1 month'));

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('anggota.KODE_INS !=', 99);
        $this->db->where('anggota.KODE_INS', 06);
        // $this->db->where('pl.KODE_ANG', 1541);
        $this->db->like('pinuang.NOFAK', 'U');
        return $this->db->get()->result_array();
    }

    public function getNon()
    {
        $bln = date('m', strtotime('-1 month'));
        $thn = date('Y', strtotime('-1 month'));

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('anggota.KODE_INS !=', 99);
        $this->db->where('anggota.KODE_INS', 06);
        // $this->db->where('pl.KODE_ANG', '1275');
        $this->db->like('pinuang.NOFAK', 'N');
        return $this->db->get()->result_array();
    }

    public function getKons()
    {
        $bln = date('m', strtotime('-1 month'));
        $thn = date('Y', strtotime('-1 month'));

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('anggota.KODE_INS !=', 99);
        $this->db->like('pinuang.NOFAK', 'O');
        return $this->db->get()->result_array();
    }
}
