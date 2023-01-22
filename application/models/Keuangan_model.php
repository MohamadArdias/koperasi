<?php

class Keuangan_model extends  CI_Model
{
    public function histo($URUT_ANG)
    {
        // $query = $this->db->query("SELECT
        //     *
        // FROM
        //     anggota
        //     INNER JOIN
        //     instan
        //     ON 
        //         anggota.KODE_INS = instan.KODE_INS
        //     INNER JOIN
        //     pl
        //     ON 
        //         pl.KODE_ANG = anggota.URUT_ANG
        //     INNER JOIN
        //     pembayaran
        //     ON 
        //         pl.KODE_ANG = pembayaran.KODE_ANG
        // WHERE
        //     anggota.URUT_ANG = $URUT_ANG AND
        //     pl.TAHUN = pembayaran.TAHUN AND
        //     pl.BULAN = pembayaran.BULAN ");
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
                anggota.URUT_ANG = pl.KODE_ANG
            LEFT JOIN
            pembayaran
            ON 
                pl.KODE_ANG = pembayaran.KODE_ANG AND
                pl.TAHUN = pembayaran.TAHUN_byr AND
                pl.BULAN = pembayaran.BULAN_byr
        WHERE
            pl.KODE_ANG = $URUT_ANG");
        
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
        return $query->result_array();
    }

    public function getAllKeuangan()
    {
        $this->db->select('*');
        $this->db->from('pl');
        $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        $this->db->where('instan.KODE_INS !=', 99);
        $this->db->where('instan.KODE_INS !=', 98);
        $this->db->where('instan.KODE_INS !=', 97);
        $this->db->where('instan.KODE_INS !=', 96);
        $this->db->where('TAHUN', date('Y'));
        $this->db->where('BULAN', date('m'));
        $this->db->order_by('anggota.KODE_INS', 'ASC');
        return  $this->db->get()->result_array();
    }

    public function getDistincAllKeuangan($THN, $BLN)
    {
        // $this->db->distinct();
        // $this->db->select('anggota.KODE_INS, instan.NAMA_INS');
        // $this->db->from('pl');
        // $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        // $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS');
        // $this->db->where('instan.KODE_INS !=', '99');
        // $this->db->where('pl.TAHUN', date('Y'));
        // $this->db->where('pl.BULAN', date('m'));
        // return  $this->db->get()->result_array();

        // $thn = date("Y");
        // $bln = date("m");
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

    // public function getKeuangan($limit, $start, $keyword = null)
    // {
    //     if ($keyword) {
    //         $this->db->like('NAMA_ANG', $keyword);
    //         $this->db->or_like('KODE_ANG', $keyword);
    //         $this->db->or_like('KODE_INS', $keyword);
    //         $this->db->or_like('NAMA_INS', $keyword);
    //     }
    //     return $this->db->get('pl', $limit, $start)->result_array();
    // }

    // public function countAllKeuangan()
    // {
    //     return $this->db->get('pl')->num_rows();
    // }

    // public function cariDataKeuangan()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('NAMA_ANG', $keyword);
    //     $this->db->or_like('KODE_ANG', $keyword);
    //     $this->db->or_like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     return $this->db->get('pl')->result_array();
    // }

    // public function getKeuanganByKode($KODE_ANG)
    // {
    //     return $this->db->get_where('pl', ['KODE_ANG' => $KODE_ANG])->row_array();
    // }

    // public function cariDataInstansi()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('KODE_INS', $keyword);
    //     $this->db->or_like('NAMA_INS', $keyword);
    //     return $this->db->get('instan')->result_array();
    // }

    public function getAnggotaWhereKodeins($KODE_INS, $TAHUN, $BULAN)
    {
        // $this->db->select('*');
        // $this->db->from('pl');
        // $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG', 'right');
        // $this->db->join('instan', 'instan.KODE_INS = anggota.KODE_INS', 'right');
        // $this->db->where('instan.KODE_INS', $KODE_INS);
        // $this->db->where('TAHUN', date('Y'));
        // $this->db->where('BULAN', date('m'));
        // return  $this->db->get()->result_array();
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
        instan.KODE_INS = '$KODE_INS' AND
        pl.BULAN = $BULAN");

        return $query->result_array();
    }

    public function getAnggotaWhereKodeAng($KODE_ANG)
    {
        $thn = date("Y");
        $bln = date("m");

        $query = $this->db->query("SELECT
        anggota.NAMA_ANG, 
        instan.NAMA_INS, 
        anggota.URUT_ANG, 
        pl.POKOK, 
        pl.TUNGGAKAN, 
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
        pl.TAHUN = $thn AND
        pl.BULAN = $bln AND
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


        // $this->db->select('*');
        // $this->db->from('pl');
        // $this->db->join('anggota', 'anggota.URUT_ANG = pl.KODE_ANG');
        // // $this->db->join('pembayaran', 'pembayaran.KODE_ANG = pl.KODE_ANG', 'right');
        // // $this->db->like('pembayaran.TGL_TGHN', date('Y-m', strtotime('-1 month')));
        // // $this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
        // // $this->db->where('pl.TAHUN', date('Y'));
        // // $this->db->where('pl.BULAN', date('m'));
        // $this->db->where('pl.TAHUN', date('Y', strtotime('+1 month')));
        // $this->db->where('pl.BULAN', date('m', strtotime('+1 month')));
        // $this->db->where('anggota.KODE_INS !=', 99);
        // $this->db->where('anggota.KODE_INS !=', 98);
        // $this->db->where('anggota.KODE_INS !=', 97);
        // $this->db->where('anggota.KODE_INS !=', 96);
        // // $this->db->where('anggota.KODE_INS', '06');
        // return $this->db->get()->result_array();
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

    // public function showTunggakan()
    // {
    //     $thn = date('Y', strtotime('+1 month'));
    //     $bln = date('m', strtotime('+1 month'));
    //     $blnTghn = date('Y-m');
    //     $this->db->query("SELECT
    //     *
    //     FROM
    //     pl
    //     INNER JOIN
    //     pembayaran
    //     ON 
    //         pl.KODE_ANG = pembayaran.KODE_ANG
    //     WHERE
    //     pl.TAHUN = $thn AND
    //     pl.BULAN = $bln AND
    //     pembayaran.TGL_TGHN LIKE '%$blnTghn%'");
    //     return $this->db->get()->result_array();
    // }

    // public function editPlTransaksi($a, $kode)
    // {
    //     if ($kode == 1) {
    //         $pl_uang = array(
    //             'KEU1' => $this->input->post('URUT_ANG', true),
    //             'JWK1' => $this->input->post('URUT_ANG', true),
    //             'POKU1' => round($this->input->post('URUT_ANG', true)),
    //             'SIPOKU1' => round($this->input->post('URUT_ANG', true)),
    //             'BNGU1' => $this->input->post('URUT_ANG', true),
    //         );
    //     } elseif ($kode == 2) {
    //         $pl_uang = array(
    //             'KEU4' => $this->input->post('URUT_ANG', true),
    //             'JWK4' => $this->input->post('URUT_ANG', true),
    //             'POKU4' => round($this->input->post('URUT_ANG', true)),
    //             'SIPOKU4' => round($this->input->post('URUT_ANG', true)),
    //             'BNGU4' => $this->input->post('URUT_ANG', true),
    //         );
    //     } elseif ($kode == 3) {
    //         $pl_uang = array(
    //             'KEU2' => $this->input->post('URUT_ANG', true),
    //             'JWK2' => $this->input->post('URUT_ANG', true),
    //             'POKU2' => round($this->input->post('URUT_ANG', true)),
    //             'SIPOKU2' => round($this->input->post('URUT_ANG', true)),
    //             'BNGU2' => $this->input->post('URUT_ANG', true),
    //         );
    //     } elseif ($kode == 4) {
    //         $pl_uang = array(
    //             'KEU3' => $this->input->post('URUT_ANG', true),
    //             'JWK3' => $this->input->post('URUT_ANG', true),
    //             'POKU3' => round($this->input->post('URUT_ANG', true)),
    //             'SIPOKU3' => round($this->input->post('URUT_ANG', true)),
    //             'BNGU3' => $this->input->post('URUT_ANG', true),
    //         );
    //     } else {
    //         $pl_uang = array(
    //             'KEU7' => $this->input->post('URUT_ANG', true),
    //             'JWK7' => $this->input->post('URUT_ANG', true),
    //             'POKU7' => round($this->input->post('URUT_ANG', true)),
    //             'SIPOKU7' => round($this->input->post('URUT_ANG', true)),
    //             'BNGU7' => $this->input->post('URUT_ANG', true),
    //         );
    //     }

    //     // $pl_uang = array(
    //     //     'KEU1' => $this->input->post('URUT_ANG', true),
    //     //     'JWK1' => $this->input->post('URUT_ANG', true),
    //     //     'POKU1' => round($this->input->post('URUT_ANG', true)),
    //     //     'SIPOKU1' => round($this->input->post('URUT_ANG', true)),
    //     //     'BNGU1' => $this->input->post('URUT_ANG', true),
    //     // );
    //     // update pl 
    //     $where_uang = array(
    //         'TAHUN' => date('Y'),
    //         'BULAN' => date('m'),
    //         'KODE_ANG' => $this->input->post('URUT_ANG', true),
    //     );
    //     $this->db->update('pl', $pl_uang, $where_uang);
    // }
}
