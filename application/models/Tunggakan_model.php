<?php

class Tunggakan_model extends  CI_Model
{
    public function tambah()
    {
        $TUNGGAKAN = $this->input->post('TUNGGAKAN', true);
        $TAMBAH = $this->input->post('TAMBAH', true);

        $inTambah = [
            'POKU6' => $TUNGGAKAN + $TAMBAH,
        ];

        $this->db->where('KODE_ANG', $this->input->post('KODE'));
        $this->db->where('TAHUN', $this->input->post('TAHUN'));
        $this->db->where('BULAN', $this->input->post('BULAN'));
        $this->db->update('pl', $inTambah);
    }

    public function cekAnggotaPin()
    {
        $a = $this->input->post('KODE', true);
        $tahun = $this->input->post('TAHUN', true);
        $bulan = $this->input->post('BULAN', true);

        $query = $this->db->query("SELECT
        *
        FROM
            pl
            INNER JOIN
            anggota
            ON 
                pl.KODE_ANG = anggota.KODE_ANG
        WHERE
        pl.TAHUN = $tahun AND
        pl.BULAN = $bulan AND
        pl.KODE_ANG LIKE '%a%' AND
        pl.KODE_ANG = '$a' AND
        pl.POKU6 >= 1");
        return $query->num_rows();
    }

    public function getKodeAnggota($a, $tahun, $bulan)
    {
        $query = $this->db->query("SELECT
        *
        FROM
            pl
            INNER JOIN
            anggota
            ON 
                pl.KODE_ANG = anggota.KODE_ANG
        WHERE
        pl.TAHUN = $tahun AND
        pl.BULAN = $bulan AND
        pl.KODE_ANG LIKE '%a%' AND
        pl.KODE_ANG = '$a' AND
        pl.POKU6 >= 1");

        return $query->row_array();
    }
    public function jumlahAnggota($KODE_INS, $TAHUN, $BULAN)
    {
        // $thn = date("Y");
        // $bln = date("m");

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
            anggota.KODE_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        instan.KODE_INS = '$KODE_INS' AND
        pl.POKU6 >= 1");

        return $query->num_rows();
    }

    public function getInsTung($THN, $BLN)
    {
        $query = $this->db->query("SELECT DISTINCT
            instan.KODE_INS, 
            instan.NAMA_INS, 
            pl.TAHUN, 
            pl.BULAN
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
            instan.KODE_INS <> 99 AND
            instan.KODE_INS <> 98 AND
            instan.KODE_INS <> 97 AND
            instan.KODE_INS <> 96 AND
            pl.TAHUN = $THN AND
            pl.BULAN = '$BLN' AND
            pl.POKU6 >= 1
        ORDER BY
        instan.KODE_INS ASC");

        return $query->result_array();
    }

    public function getIns($KODE_INS, $TAHUN, $BULAN)
    {
        $query = $this->db->query("SELECT
        anggota.KODE_ANG, 
        anggota.NAMA_ANG, 
        instan.KODE_INS, 
        instan.NAMA_INS, 
        pl.TAHUN, 
        pl.BULAN, 
        pl.POKU6
        FROM
        anggota
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
        INNER JOIN
        pl
        ON 
            anggota.KODE_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        instan.KODE_INS = '$KODE_INS' AND
        pl.POKU6 >= 1");
        return $query->result_array();
    }

    public function getAllKeuangan($THN, $BLN)
    {
        $query = $this->db->query("SELECT 
            anggota.KODE_ANG,
            anggota.NAMA_ANG,
            instan.KODE_INS, 
            instan.NAMA_INS, 
            pl.TAHUN, 
            pl.BULAN,
            pl.POKU6
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
            instan.KODE_INS <> 99 AND
            instan.KODE_INS <> 98 AND
            instan.KODE_INS <> 97 AND
            instan.KODE_INS <> 96 AND
            pl.TAHUN = $THN AND
            pl.BULAN = '$BLN' AND
            pl.POKU6 >= 1
        ORDER BY
            instan.KODE_INS ASC");

        return $query->result_array();
    }

    public function getAnggotaWhereKodeAng($KODE_ANG, $TAHUN, $BULAN)
    {
        // $thn = date("Y");
        // $bln = date("m");

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
            anggota.KODE_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        anggota.KODE_ANG = '$KODE_ANG'");
        return $query->row_array();

        // $this->db->select('*');
        // $this->db->from('pl');
        // $this->db->join('anggota', 'anggota.KODE_ANG = pl.KODE_ANG', 'right');
        // $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        // $this->db->where('anggota.KODE_ANG', $KODE_ANG);
        // $this->db->where('TAHUN', date('Y'));
        // $this->db->where('BULAN', date('m'));
        // return  $this->db->get()->row_array();
    }

    public function cetakAll($THN, $BLN)
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
                instan.KODE_INS <> 99 AND
                instan.KODE_INS <> 98 AND
                instan.KODE_INS <> 97 AND
                instan.KODE_INS <> 96 AND
                pl.TAHUN = $THN AND
                pl.BULAN = '$BLN' AND
                pl.POKU6 >= 1
            ORDER BY
            instan.KODE_INS ASC");

        return $query->result_array();
    }

    public function jumlahAll($THN, $BLN)
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
                instan.KODE_INS <> 99 AND
                instan.KODE_INS <> 98 AND
                instan.KODE_INS <> 97 AND
                instan.KODE_INS <> 96 AND
                pl.TAHUN = $THN AND
                pl.BULAN = '$BLN' AND
                pl.POKU6 >= 1
            ORDER BY
            instan.KODE_INS ASC");

        return $query->row_array();
    }

    public function getEditIns($kodeIns)
    {
        $query = $this->db->query("SELECT
                *
            FROM
                koperasi.instan
            WHERE
                koperasi.instan.KODE_INS = '$kodeIns'");
        return $query->row_array();
    }

    public function getTunggakanByIns($kodeIns, $tahun, $bulan)
    {
        $query = $this->db->query("SELECT
        *
    FROM
        instan
        INNER JOIN
        anggota
        ON 
            instan.KODE_INS = anggota.KODE_INS
        INNER JOIN
        pl
        ON 
            anggota.KODE_ANG = pl.KODE_ANG
    WHERE
        anggota.KODE_INS = '$kodeIns' AND
        pl.TAHUN = $tahun AND
        pl.BULAN = '$bulan'
        ORDER BY
        instan.KODE_INS ASC, 
        anggota.KODE_ANG ASC")->result_array();

        return $query;
    }
}
