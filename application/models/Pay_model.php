<?php

class Pay_model extends CI_Model
{
    public function getKodeAnggota($a)
    {
        $this->db->select('*');
        $this->db->from('anggota');
        $this->db->join('pembayaran', 'pembayaran.KODE_ANG = anggota.URUT_ANG');
        $this->db->join('pl', 'pl.KODE_ANG = pembayaran.KODE_ANG');
        // $this->db->like('TGL_TGHN', date('Y-m'));
        $this->db->like('TGL_TGHN', date('Y-m', strtotime('-1 month')));
        $this->db->where('pl.TAHUN', date('Y'));
        $this->db->where('pl.BULAN', date('m'));
        $this->db->where('pembayaran.KODE_ANG', $a);
        return $this->db->get()->row_array();
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
            pl.KODE_ANG = anggota.URUT_ANG
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
        $jml_tghn = $this->input->post('TAGIHAN', true);
        $jml_bayar = $this->input->post('JML_BAYAR', true);

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
            'JML_BAYAR' => $jml_bayar,
            'VIA_BAYAR' => 'BAYAR LANGSUNG',
            'STATUS' => $status,
            'SISA' => $sisa
            // 'TUNGGAKAN' => $tunggakan,
        ];
        $this->db->where('KODE_ANG', $this->input->post('KODE'));
        $this->db->like('pembayaran.TGL_TGHN', date('Y-m', strtotime('-1 month')));
        // $this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
        $this->db->update('pembayaran', $inBayar);

        $pl = [
            'TUNGGAKAN' => $tunggakan,
        ];
        $where = array(
            'TAHUN' => date('Y'),
            'BULAN' => date('m'),
            'KODE_ANG' => $this->input->post('KODE', true),
        );
        $this->db->update('pl', $pl, $where);
    }
}
