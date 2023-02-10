<?php

class Keuangan_model extends  CI_Model
{
    public function histo($URUT_ANG)
    {
        $query = $this->db->query("SELECT
            pl.*,
            pembayaran.JML_BAYAR,
            pembayaran.BAYAR_BANK,
            pembayaran.VIA_BAYAR,
            pembayaran.JML_TGHN
        FROM
            instan
            INNER JOIN
            anggota
            ON 
                instan.KODE_INS = anggota.KODE_INS
            INNER JOIN
            pl
            ON 
                anggota.URUT_ANG = pl.KODE_ANG
            LEFT JOIN
            pembayaran
            ON 
                pl.KODE_ANG = pembayaran.KODE_ANG AND
                pl.TAHUN = pembayaran.TAHUN AND
                pl.BULAN = pembayaran.BULAN
        WHERE
            pl.KODE_ANG = $URUT_ANG 
        ORDER BY
            pl.TAHUN DESC, 
            pl.BULAN DESC");

        return $query->result_array();
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
            anggota.URUT_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        anggota.KODE_INS = '$KODE_INS'");

        return $query->num_rows();
    }

    public function printInsAng($KODE_INS, $TAHUN, $BULAN)
    {
        // $thn = date("Y");
        // $bln = date("m");

        $query = $this->db->query("SELECT
        anggota.NAMA_ANG, 
        instan.NAMA_INS, 
        anggota.URUT_ANG, 
        pl.POKOK, 
        pl.POKU6, 
        pl.WAJIB, 
        pl.KEU1, 
        pl.POKU1, 
        pl.BNGU1, 
        instan.KODE_INS, 
        pl.KEU2, 
        pl.POKU2, 
        pl.BNGU2, 
        pl.KEU3, 
        pl.POKU3, 
        pl.BNGU3, 
        pl.KEU4, 
        pl.POKU4, 
        pl.BNGU4, 
        pl.KEU7, 
        pl.POKU7, 
        pl.BNGU7
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
        anggota.KODE_INS = '$KODE_INS'");
        return $query->result_array();
    }

    public function getAllKeuangan($THN, $BLN)
    {
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', 99);
        $this->db->where('instan.KODE_INS !=', 98);
        $this->db->where('instan.KODE_INS !=', 97);
        $this->db->where('instan.KODE_INS !=', 96);
        $this->db->where('TAHUN', $THN);
        $this->db->where('BULAN', $BLN);
        $this->db->order_by('anggota.KODE_INS', 'ASC');
        return  $this->db->get()->result_array();
    }

    public function getDistincAllKeuangan($THN, $BLN)
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
            anggota.URUT_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $THN AND
        pl.BULAN = $BLN
        ORDER BY
	    instan.KODE_INS ASC");
        return $query->result_array();
    }

    public function getAnggotaWhereKodeins($KODE_INS, $TAHUN, $BULAN)
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
            anggota.URUT_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        instan.KODE_INS = '$KODE_INS' AND
        pl.BULAN = $BULAN");

        return $query->result_array();
    }

    public function getAnggotaWhereKodeAng($KODE_ANG, $TAHUN, $BULAN)
    {
        // $thn = date("Y");
        // $bln = date("m");

        $query = $this->db->query("SELECT
        anggota.NAMA_ANG, 
        instan.NAMA_INS, 
        anggota.URUT_ANG, 
        pl.POKOK, 
        pl.POKU6, 
        pl.WAJIB, 
        pl.KEU1, 
        pl.POKU1, 
        pl.BNGU1, 
        instan.KODE_INS, 
        pl.KEU2, 
        pl.POKU2, 
        pl.BNGU2, 
        pl.KEU3, 
        pl.POKU3, 
        pl.BNGU3, 
        pl.KEU4, 
        pl.POKU4, 
        pl.BNGU4, 
        pl.KEU7, 
        pl.POKU7, 
        pl.BNGU7
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

    public function getInstansi($KODE_INS)
    {
        return $this->db->get_where('instan', ['KODE_INS' => $KODE_INS])->row_array();
    }

    public function inPembayaran($THN, $BLN)
    {
        $query = $this->db->query("SELECT
            *
        FROM
            anggota
            INNER JOIN
            pl
            ON 
                anggota.URUT_ANG = pl.KODE_ANG
        WHERE
            pl.TAHUN = $THN AND
            pl.BULAN = $BLN AND
            anggota.KODE_INS <> 96 AND
            anggota.KODE_INS <> 97 AND
            anggota.KODE_INS <> 98 AND
            anggota.KODE_INS <> 99");
        return $query->result_array();
    }

    public function keuanganAnggota()
    {
        $this->data = [
            "TAHUN" => date('Y'),
            "BULAN" => date('m'),
            "KODE_ANG" => $this->input->post('URUT_ANG', true),
            "POKOK" => 0,
            "WAJIB" => 0,
            "TPOKOK" => 0,
            "TWAJIB" => 0,
            "RELA" => 0,
        ];
        $this->db->insert('pl', $this->data);
    }

    public function getPengurus()
    {
        return $this->db->get_where('pengurus', ['ID' => 1])->row_array();
    }
}
