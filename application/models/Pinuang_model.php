<?php

class Pinuang_model extends  CI_Model
{
    public function cek($thn, $bln, $kode)
    {
        $query = $this->db->query("SELECT
        *
    FROM
        pinuang
    WHERE
        pinuang.TAHUN = $thn AND
        pinuang.BULAN = '$bln' AND
        pinuang.NOFAK = '$kode'");
        return $query->num_rows();
    }

    public function tunggakan($THN, $BLN)
    {
        $query = $this->db->query("SELECT
        *
    FROM
        anggota
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
        INNER JOIN
        pl
        ON 
            pl.KODE_ANG = anggota.KODE_ANG
    WHERE
        instan.KODE_INS != 99 AND
        instan.KODE_INS != 98 AND
        instan.KODE_INS != 97 AND
        instan.KODE_INS != 96 AND
        pl.TAHUN = $THN AND
        pl.BULAN = '$BLN'AND
	    pl.POKU6 >= 1
    ORDER BY
        instan.KODE_INS ASC");

        return $query->result_array();
    }

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

    public function editTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $date = date('Y-m-d', strtotime('+' . $b . ' month', strtotime($a)));
        $where = [
            "NOFAK" => $this->input->post('NOFAK', true),
        ];

        $data = [
            "JMLP_ANG" => $this->input->post('JMLP_ANG', true),//
            "TGLT_ANG" => $date,
            "JWKT_ANG" => $this->input->post('JWKT_ANG', true),//
            "PRO_ANG" => $this->input->post('PRO_ANG', true),//
        ];

        $this->db->update('pinuang', $data, $where);
    }

    public function tambahTransaksi()
    {
        $a = $this->input->post('TGLP_ANG');
        $b = $this->input->post('JWKT_ANG');

        $date = date('Y-m-d', strtotime('+' . $b . ' month', strtotime($a)));
        $this->data = [
            "TAHUN" => substr($a, 0, 4),
            "BULAN" => substr($a, 5, 2),
            "NOFAK" => $this->input->post('NOFAK', true),
            "KODE_ANG" => $this->input->post('KODE_ANG', true),
            "JMLP_ANG" => $this->input->post('JMLP_ANG', true),
            "TGLP_ANG" => $this->input->post('TGLP_ANG', true),
            "TGLT_ANG" => $date,
            "JWKT_ANG" => $this->input->post('JWKT_ANG', true),
            "PRO_ANG" => $this->input->post('PRO_ANG', true),
        ];

        $this->db->insert('pinuang', $this->data);
    }

    public function deleteTransaksi($a, $kode)
    {
        // return $this->db->query("UPDATE pinuang SET STATUS_PIN = 'OFF' WHERE pinuang.NOFAK LIKE '%$kode%' AND pinuang.KODE_ANG = '$a'");

        return $this->db->query("DELETE FROM
            pinuang
        WHERE
            pinuang.NOFAK LIKE '%$kode%' AND
            pinuang.KODE_ANG = '$a'");
    }

    public function pinjKantor($THN, $BLN)
    {
        $query = $this->db->query("SELECT
            *
        FROM
            pinuang
            INNER JOIN
            pl
            ON 
                pinuang.KODE_ANG = pl.KODE_ANG
            INNER JOIN
            anggota
            ON 
                anggota.KODE_ANG = pl.KODE_ANG
        WHERE
            pinuang.TAHUN = $THN AND
            pl.TAHUN = $THN AND
            pinuang.BULAN = $BLN AND
            pl.BULAN = $BLN AND
            anggota.KODE_INS <> 96 AND
            anggota.KODE_INS <> 97 AND
            anggota.KODE_INS <> 98 AND
            anggota.KODE_INS <> 99 AND
            pinuang.NOFAK LIKE '%U%'");
        return $query->result_array();
    }

    public function getAllPinjaman($THN, $BLN)
    {
        $query = $this->db->query("SELECT
            *
        FROM
            pinuang
            INNER JOIN
            pl
            ON 
                pinuang.KODE_ANG = pl.KODE_ANG
            INNER JOIN
            anggota
            ON 
                anggota.KODE_ANG = pl.KODE_ANG
        WHERE
            pinuang.TAHUN = $THN AND
            pl.TAHUN = $THN AND
            pinuang.BULAN = $BLN AND
            pl.BULAN = $BLN AND
            anggota.KODE_INS <> 96 AND
            anggota.KODE_INS <> 97 AND
            anggota.KODE_INS <> 98 AND
            anggota.KODE_INS <> 99");
        return $query->result_array();
    }

    // public function getUang($THN, $BLN)
    // {
    //         $query = $this->db->query("SELECT
    //         *
    //     FROM
    //         pinuang
    //         INNER JOIN
    //         pl
    //         ON 
    //             pinuang.KODE_ANG = pl.KODE_ANG
    //         INNER JOIN
    //         anggota
    //         ON 
    //             anggota.KODE_ANG = pl.KODE_ANG
    //     WHERE
    //         pinuang.TAHUN = $THN AND
    //         pl.TAHUN = $THN AND
    //         pinuang.BULAN = $BLN AND
    //         pl.BULAN = $BLN AND
    //         anggota.KODE_INS <> 96 AND
    //         anggota.KODE_INS <> 97 AND
    //         anggota.KODE_INS <> 98 AND
    //         anggota.KODE_INS <> 99 AND
    //         pinuang.NOFAK LIKE '%U%'");
    //     return $query->result_array();
    // }

    // public function getNon($THN, $BLN)
    // {
    //         $query = $this->db->query("SELECT
    //         *
    //     FROM
    //         pinuang
    //         INNER JOIN
    //         pl
    //         ON 
    //             pinuang.KODE_ANG = pl.KODE_ANG
    //         INNER JOIN
    //         anggota
    //         ON 
    //             anggota.KODE_ANG = pl.KODE_ANG
    //     WHERE
    //         pinuang.TAHUN = $THN AND
    //         pl.TAHUN = $THN AND
    //         pinuang.BULAN = $BLN AND
    //         pl.BULAN = $BLN AND
    //         anggota.KODE_INS <> 96 AND
    //         anggota.KODE_INS <> 97 AND
    //         anggota.KODE_INS <> 98 AND
    //         anggota.KODE_INS <> 99 AND
    //         pinuang.NOFAK LIKE '%N%'");
    //         return $query->result_array();
    // }

    // public function getKons($THN, $BLN)
    // {
    //         $query = $this->db->query("SELECT
    //         *
    //     FROM
    //         pinuang
    //         INNER JOIN
    //         pl
    //         ON 
    //             pinuang.KODE_ANG = pl.KODE_ANG
    //         INNER JOIN
    //         anggota
    //         ON 
    //             anggota.KODE_ANG = pl.KODE_ANG
    //     WHERE
    //         pinuang.TAHUN = $THN AND
    //         pl.TAHUN = $THN AND
    //         pinuang.BULAN = $BLN AND
    //         pl.BULAN = $BLN AND
    //         anggota.KODE_INS <> 96 AND
    //         anggota.KODE_INS <> 97 AND
    //         anggota.KODE_INS <> 98 AND
    //         anggota.KODE_INS <> 99 AND
    //         pinuang.NOFAK LIKE '%O%'");
    //         return $query->result_array();
    // }

    // public function getKhusus($THN, $BLN)
    // {
    //         $query = $this->db->query("SELECT
    //         *
    //     FROM
    //         pinuang
    //         INNER JOIN
    //         pl
    //         ON 
    //             pinuang.KODE_ANG = pl.KODE_ANG
    //         INNER JOIN
    //         anggota
    //         ON 
    //             anggota.KODE_ANG = pl.KODE_ANG
    //     WHERE
    //         pinuang.TAHUN = $THN AND
    //         pl.TAHUN = $THN AND
    //         pinuang.BULAN = $BLN AND
    //         pl.BULAN = $BLN AND
    //         anggota.KODE_INS <> 96 AND
    //         anggota.KODE_INS <> 97 AND
    //         anggota.KODE_INS <> 98 AND
    //         anggota.KODE_INS <> 99 AND
    //         pinuang.NOFAK LIKE '%Z%'");
    //         return $query->result_array();
    // }

    // public function getUub($THN, $BLN)
    // {
    //         $query = $this->db->query("SELECT
    //         *
    //     FROM
    //         pinuang
    //         INNER JOIN
    //         pl
    //         ON 
    //             pinuang.KODE_ANG = pl.KODE_ANG
    //         INNER JOIN
    //         anggota
    //         ON 
    //             anggota.KODE_ANG = pl.KODE_ANG
    //     WHERE
    //         pinuang.TAHUN = $THN AND
    //         pl.TAHUN = $THN AND
    //         pinuang.BULAN = $BLN AND
    //         pl.BULAN = $BLN AND
    //         anggota.KODE_INS <> 96 AND
    //         anggota.KODE_INS <> 97 AND
    //         anggota.KODE_INS <> 98 AND
    //         anggota.KODE_INS <> 99 AND
    //         pinuang.NOFAK LIKE '%S%'");
    //         return $query->result_array();
    // }

    public function getPinjaman($THN, $BLN)
    {
        $this->db->select('*');
        $this->db->from('pinuang');
        $this->db->join('pl', 'pl.KODE_ANG = pinuang.KODE_ANG');
        $this->db->join('anggota', 'anggota.KODE_ANG = pinuang.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        // $this->db->where('pinuang.TAHUN', date('Y'));
        // $this->db->where('pinuang.BULAN', date('m'));
        // $this->db->where('pl.TAHUN', date('Y'));
        // $this->db->where('pl.BULAN', date('m'));
        $this->db->where('pinuang.TAHUN', $THN);
        $this->db->where('pinuang.BULAN', $BLN);
        $this->db->where('pl.TAHUN', $THN);
        $this->db->where('pl.BULAN', $BLN);
        // $this->db->where('instan.KODE_INS !=', 99);
        // $this->db->where('instan.KODE_INS', '06');
        $this->db->order_by('instan.KODE_INS', 'ASC');
        return $this->db->get()->result_array();
    }

    public function pinjaman($THN, $BLN)
    {
        // $bln = date('m');
        // $thn = date('Y');

        $query = $this->db->query("SELECT
            *
            -- instan.KODE_INS, 
            -- instan.NAMA_INS,
            -- anggota.NAMA_ANG, 
            -- pinuang.NOFAK, 
            -- pinuang.JWKT_ANG, 
            -- pinuang.TAHUN, 
            -- pinuang.BULAN, 
            -- pl.KEU1, 
            -- pl.POKU1, 
            -- pl.BNGU1, 
            -- pl.KEU2, 
            -- pl.POKU2, 
            -- pl.BNGU2, 
            -- pl.JWK1, 
            -- pl.JWK2, 
            -- pl.KEU3, 
            -- pl.JWK3, 
            -- pl.POKU3, 
            -- pl.BNGU3, 
            -- pl.KEU4, 
            -- pl.JWK4, 
            -- pl.POKU4, 
            -- pl.BNGU4, 
            -- pl.POKU6, 
            -- pl.KEU7, 
            -- pl.JWK7, 
            -- pl.POKU7, 
            -- pl.BNGU7, 
	        -- pl.KODE_ANG, 
	        -- pinuang.JMLP_ANG
        FROM
            pl
            INNER JOIN
            anggota
            ON 
                pl.KODE_ANG = anggota.KODE_ANG
            INNER JOIN
            pinuang
            ON 
                pl.KODE_ANG = pinuang.KODE_ANG AND
                pl.TAHUN = pinuang.TAHUN AND
                pl.BULAN = pinuang.BULAN
            INNER JOIN
            instan
            ON 
                anggota.KODE_INS = instan.KODE_INS
        WHERE
            pinuang.TAHUN = $THN AND
            pinuang.BULAN = '$BLN' AND
            anggota.KODE_INS <> 99 AND
            anggota.KODE_INS <> 98 AND
            anggota.KODE_INS <> 97 AND
            anggota.KODE_INS <> 99");
        return $query->result_array();
    }
}
