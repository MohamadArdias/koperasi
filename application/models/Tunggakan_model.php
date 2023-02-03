<?php

class Tunggakan_model extends  CI_Model
{
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
            anggota.URUT_ANG = pl.KODE_ANG
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
                pl.KODE_ANG = anggota.URUT_ANG
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
        anggota.URUT_ANG, 
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
            anggota.URUT_ANG = pl.KODE_ANG
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
            anggota.URUT_ANG,
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
                pl.KODE_ANG = anggota.URUT_ANG
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
            anggota.URUT_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        anggota.URUT_ANG = '$KODE_ANG'");
        return $query->row_array();

        // $this->db->select('*');
        // $this->db->from('pl');
        // $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG', 'right');
        // $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        // $this->db->where('anggota.URUT_ANG', $KODE_ANG);
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
                    pl.KODE_ANG = anggota.URUT_ANG
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
}
