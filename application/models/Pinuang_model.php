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
            "TAHUN" => date('Y'),
            "BULAN" => date('m'),
            "NOFAK" => $this->input->post('NOFAK', true),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "JMLP_ANG" => $this->input->post('JMLP_ANG', true),
            "TGLP_ANG" => $this->input->post('TGLP_ANG', true),
            "TGLT_ANG" => $date,
            "JWKT_ANG" => $this->input->post('JWKT_ANG', true),
            "PRO_ANG" => $this->input->post('PRO_ANG', true),
            "STATUS_PIN" => 'WAIT',
        ];

        $this->db->insert('pinuang', $this->data);
    }

    public function deleteTransaksi($a, $kode)
    {
        return $this->db->query("UPDATE pinuang SET STATUS_PIN = 'OFF' WHERE pinuang.NOFAK LIKE '%$kode%' AND pinuang.KODE_ANG = '$a'");

        // return $this->db->query("DELETE FROM
        //     pinuang
        // WHERE
        //     pinuang.NOFAK LIKE '%$kode%' AND
        //     pinuang.KODE_ANG = '$a'");
    }

    public function getUang()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        $bln = date('m');
        $thn = date('Y');

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('pinuang.STATUS_PIN !=', 'OFF');
        $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS', '06');
        // $this->db->where('pl.KODE_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '4040');
        // $this->db->where('pl.KODE_ANG', 1541);
        $this->db->like('pinuang.NOFAK', 'U');
        return $this->db->get()->result_array();
    }

    public function getNon()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        $bln = date('m');
        $thn = date('Y');

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('pinuang.STATUS_PIN !=', 'OFF');
        $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS', '06');
        // $this->db->where('pl.KODE_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '1541');
        // $this->db->where('pl.KODE_ANG', '1275');
        $this->db->like('pinuang.NOFAK', 'N');
        return $this->db->get()->result_array();
    }

    public function getKons()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        $bln = date('m');
        $thn = date('Y');

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('pinuang.STATUS_PIN !=', 'OFF');
        $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS', '06');
        // $this->db->where('pl.KODE_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '1541');
        $this->db->like('pinuang.NOFAK', 'O');
        return $this->db->get()->result_array();
    }

    public function getKhusus()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        $bln = date('m');
        $thn = date('Y');;

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('pinuang.STATUS_PIN !=', 'OFF');
        $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS', '06');
        // $this->db->where('pl.KODE_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '4040');
        $this->db->like('pinuang.NOFAK', 'Z');
        // $this->db->order_by('NOFAK', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getUub()
    {
        // $bln = date('m', strtotime('-1 month'));
        // $thn = date('Y', strtotime('-1 month'));
        $bln = date('m');
        $thn = date('Y');;

        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('pinuang', 'pinuang.KODE_ANG = pl.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG', 'right');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        $this->db->where('pl.TAHUN', $thn);
        $this->db->where('pl.BULAN', $bln);
        $this->db->where('pinuang.TAHUN', $thn);
        $this->db->where('pinuang.BULAN', $bln);
        $this->db->where('pinuang.STATUS_PIN !=', 'OFF');
        $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS', '06');
        // $this->db->where('pl.KODE_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '1541');
        // $this->db->where('anggota.URUT_ANG', '4040');
        $this->db->like('pinuang.NOFAK', 'S');
        // $this->db->order_by('NOFAK', 'ASC');
        return $this->db->get()->result_array();
    }

    public function getPinjaman()
    {
        $this->db->select('*');
        $this->db->from('pinuang');
        $this->db->join('pl', 'pl.KODE_ANG = pinuang.KODE_ANG');
        $this->db->join('anggota', 'anggota.URUT_ANG = pinuang.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('pinuang.TAHUN', date('Y'));
        $this->db->where('pinuang.BULAN', date('m'));
        $this->db->where('pl.TAHUN', date('Y'));
        $this->db->where('pl.BULAN', date('m'));
        $this->db->where('instan.KODE_INS !=', 99);
        // $this->db->where('instan.KODE_INS', '06');
        $this->db->order_by('anggota.URUT_ANG', 'ASC');
        return $this->db->get()->result_array();
    }

    public function pinjaman()
    {
        $query = $this->db->query("SELECT
        *
    FROM
        pl
        INNER JOIN
        anggota
        ON 
            pl.KODE_ANG = anggota.URUT_ANG
        INNER JOIN
        pinuang
        ON 
            pl.KODE_ANG = pinuang.KODE_ANG
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
    WHERE
        pl.TAHUN = (SELECT MAX(TAHUN) FROM pl) AND
        pl.BULAN = (SELECT MAX(BULAN) FROM pl) AND
        pinuang.TAHUN = (SELECT MAX(TAHUN) FROM pinuang) AND
        pinuang.BULAN = (SELECT MAX(BULAN) FROM pinuang) AND
        anggota.KODE_INS <> 99");
        return $query->result_array();
    }
}
