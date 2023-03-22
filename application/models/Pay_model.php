<?php

class Pay_model extends CI_Model
{
    public function getIns($KODE_INS, $TAHUN, $BULAN)
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
            anggota.KODE_ANG = pl.KODE_ANG
        WHERE
        pl.TAHUN = $TAHUN AND
        pl.BULAN = $BULAN AND
        instan.KODE_INS = '$KODE_INS' AND
        pl.SIPOKU8 >= 1");
        return $query->result_array();
    }

    public function getInsKantor($THN, $BLN)
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
            pl.SIPOKU8 >= 1
        ORDER BY
        instan.KODE_INS ASC");

        return $query->result_array();
    }

    public function getPrintKantor($KODE_ANG)
    {
        $time = $this->input->get('time');

        $query = $this->db->query("SELECT
        *
    FROM
        instan
        INNER JOIN
        anggota
        ON 
            instan.KODE_INS = anggota.KODE_INS
        INNER JOIN
        kantor_detail
        ON 
            anggota.KODE_ANG = kantor_detail.KODE_ANG
    WHERE
        anggota.KODE_ANG = '$KODE_ANG' AND
        kantor_detail.CREATED = '$time'");

        return $query->row_array();
    }

    public function getKantor($a)
    {
        $tahun = date("Y");
        $bulan = date("m");

        $query = $this->db->query("SELECT
        *
    FROM
        anggota
        INNER JOIN
        pl
        ON 
            anggota.KODE_ANG = pl.KODE_ANG
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
    WHERE
        anggota.KODE_ANG = '$a' AND
        pl.TAHUN = $tahun AND
        pl.BULAN = $bulan");

        return $query->row_array();
    }

    public function getPrint($KODE_ANG)
    {
        $time = $this->input->get('time');

        $query = $this->db->query("SELECT
            *
        FROM
            instan
            INNER JOIN
            anggota
            ON 
                instan.KODE_INS = anggota.KODE_INS
            INNER JOIN
            pembayaran_detail
            ON 
                anggota.KODE_ANG = pembayaran_detail.KODE_ANG
        WHERE
            anggota.KODE_ANG = $KODE_ANG AND
            pembayaran_detail.CREATED = '$time'");

        return $query->row_array();
    }

    public function getCetak()
    {
        $query = $this->db->query("SELECT
            pembayaran_detail.TAHUN, 
            pembayaran_detail.BULAN, 
            anggota.KODE_ANG, 
            anggota.NAMA_ANG, 
            instan.KODE_INS, 
            instan.NAMA_INS, 
            pembayaran_detail.JML_TGHN, 
            pembayaran_detail.TGL_BAYAR, 
            pembayaran_detail.JML_BAYAR, 
            pembayaran_detail.VIA_BAYAR, 
            pembayaran_detail.CREATED, 
	        pembayaran_detail.CREATED_BY
        FROM
            instan
            INNER JOIN
            anggota
            ON 
                instan.KODE_INS = anggota.KODE_INS
            INNER JOIN
            pembayaran_detail
            ON 
                anggota.KODE_ANG = pembayaran_detail.KODE_ANG
        ORDER BY
            pembayaran_detail.CREATED DESC");
        return $query->result_array();
    }

    public function getCetakKantor()
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
        kantor_detail
        ON 
            anggota.KODE_ANG = kantor_detail.KODE_ANG
    ORDER BY
        kantor_detail.CREATED DESC");
        return $query->result_array();
    }

    public function getKodeAnggota($a)
    {
        // $date = date("Y-m");
        // $date = date('Y-m', strtotime('-1 month'));
        $tahun = date("Y");
        $bulan = date("m");
        
        $query = $this->db->query("SELECT
        *
    FROM
        anggota
        INNER JOIN
        pembayaran
        ON 
            anggota.KODE_ANG = pembayaran.KODE_ANG
        INNER JOIN
        instan
        ON 
            anggota.KODE_INS = instan.KODE_INS
        WHERE
            pembayaran.KODE_ANG = $a AND
            pembayaran.TAHUN = $tahun AND
	        pembayaran.BULAN = '$bulan'
            -- pembayaran.TGL_TGHN IN (SELECT MAX(TGL_TGHN) FROM pembayaran)
            ");

        return $query->row_array();
    }

    public function pelunasan($NOFAK, $KODE)
    {
        $query = $this->db->query("SELECT
            *
        FROM
            pinuang
            INNER JOIN
            pl
            ON
                pinuang.KODE_ANG = pl.KODE_ANG AND
                pinuang.TAHUN = pl.TAHUN AND
                pinuang.BULAN = pl.BULAN
            INNER JOIN
            anggota
            ON
                pl.KODE_ANG = anggota.KODE_ANG
            INNER JOIN
            pembayaran
            ON
                pl.KODE_ANG = pembayaran.KODE_ANG AND
                pl.TAHUN = pembayaran.TAHUN AND
                pl.BULAN = pembayaran.BULAN
        WHERE
        pinuang.NOFAK = '$NOFAK' AND
        pembayaran.TGL_TGHN IN (SELECT MAX(TGL_TGHN) FROM pembayaran WHERE KODE_ANG = '$KODE')");

        return $query->row_array();
    }

    public function bayar()
    {
        $TAHUN = $this->input->post('TAHUN', true);
        $BULAN = $this->input->post('BULAN', true);
        $jml_tghn = $this->input->post('TAGIHAN', true);
        $jml_bayar = $this->input->post('JML_BAYAR', true);
        $DETAIL = $this->input->post('DETAIL');

        if ($jml_bayar == $jml_tghn) {
            $status = 'TERBAYAR';
            $tunggakan = 0;
            $sisa = 0;
        } elseif ($jml_bayar > $jml_tghn) {
            $status = 'TERBAYAR';
            $tunggakan = 0;
            $sisa = $jml_bayar - $jml_tghn;
        } else {
            $status = 'SEBAGIAN';
            $tunggakan = $jml_tghn - $jml_bayar;
            $sisa = 0;
        }

        $inBayar = [
            'TGL_BAYAR' => date('Y-m-d'),
            'JML_BAYAR' => $jml_bayar + $DETAIL,
            'VIA_BAYAR' => 'BAYAR LANGSUNG',
            'STATUS' => $status,
            'SISA' => $sisa
            // 'TUNGGAKAN' => $tunggakan,
        ];
        $this->db->where('KODE_ANG', $this->input->post('KODE'));
        $this->db->where('TAHUN', $this->input->post('TAHUN'));
        $this->db->where('BULAN', $this->input->post('BULAN'));
        //$this->db->like('pembayaran.TGL_TGHN', date('Y-m', strtotime('-1 month')));
        //$this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
        $this->db->update('pembayaran', $inBayar);

        $indetail = [
            'BULAN' => $this->input->post('BULAN'),
            'TAHUN' => $this->input->post('TAHUN'),
            'KODE_ANG' => $this->input->post('KODE'),
            'JML_TGHN' => $this->input->post('TAGIHAN'),
            'TGL_BAYAR' => date('Y-m-d'),
            'JML_BAYAR' => $jml_bayar,
            'VIA_BAYAR' => 'BAYAR LANGSUNG',
            'STATUS' => $status,
            'CREATED_BY' => $this->input->post('first_name'),
            'SISA' => $sisa
            // 'TUNGGAKAN' => $tunggakan,
        ];


        $this->db->insert('pembayaran_detail', $indetail);



        // $pl = [
        //     'POKU6' => $tunggakan,
        // ];
        // $where = array(
        //     'TAHUN' => date('Y'),
        //     'BULAN' => date('m'),
        //     'KODE_ANG' => $this->input->post('KODE', true),
        // );
        // $this->db->update('pl', $pl, $where);
    }

    public function bayarKantor()
    {
        $TAHUN = $this->input->post('TAHUN', true);
        $BULAN = $this->input->post('BULAN', true);
        $TGL_BAYAR = $this->input->post('TGL_BAYAR', true);
        $JUM_POKOK = $this->input->post('JUM_POKOK', true);
        $JUM_BUNGA = $this->input->post('JUM_BUNGA', true);
        $POKOK = $this->input->post('POKOK', true);
        $BUNGA = $this->input->post('BUNGA', true);
        $DETAIL_POKU = $this->input->post('DETAIL_POKU');
        $DETAIL_BNGU = $this->input->post('DETAIL_BNGU');
        // $poku = ($jml_bayar+$DETAIL)-$BUNGA;

        $pl = [
            'POKU8' => ($POKOK + $DETAIL_POKU),
            'BNGU8' => ($BUNGA + $DETAIL_BNGU),
        ];

        $where = array(
            'TAHUN' => $TAHUN,
            'BULAN' => $BULAN,
            'KODE_ANG' => $this->input->post('KODE', true),
        );
        $this->db->update('pl', $pl, $where);



        $detail_kantor = [
            'TAHUN' => $this->input->post('TAHUN'),
            'BULAN' => $this->input->post('BULAN'),
            'KODE_ANG' => $this->input->post('KODE'),
            'TGL_BAYAR' => $TGL_BAYAR,
            'POKU' => $POKOK,
            'SIPOKU' => $JUM_POKOK,
            'BNGU' => $BUNGA,
            'SIBNGU' => $JUM_BUNGA,
            'CREATED_BY' => $this->input->post('first_name'),
        ];


        $this->db->insert('kantor_detail', $detail_kantor);
    }
}
