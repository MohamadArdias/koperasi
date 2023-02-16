<?php

class Us_model extends  CI_Model
{
    public function editPinjaman($NOFAK)
    {
        $query = $this->db->query("SELECT
        *
    FROM
        us
        INNER JOIN
        pinuang
        ON 
            us.NOFAK = pinuang.NOFAK
        INNER JOIN
        anggota
        ON 
            pinuang.KODE_ANG = anggota.URUT_ANG
    WHERE
        us.NOFAK = '$NOFAK'");
        return $query->row_array();
    }

    public function getPrint($URUT_ANG)
    {
        $NOFAK = $this->input->get('NOFAK');
        $TGL = $this->input->get('TGL');

        $query = $this->db->query("SELECT
            instan.KODE_INS, 
            instan.NAMA_INS, 
            anggota.URUT_ANG, 
            anggota.NAMA_ANG, 
            us.TANGGAL, 
            us.JUMLAH, 
            us.PRO, 
            us.JANGKA
        FROM
            anggota
            INNER JOIN
            us
            ON 
                anggota.URUT_ANG = us.KODE_ANG
            INNER JOIN
            instan
            ON 
                instan.KODE_INS = anggota.KODE_INS
        WHERE
            us.KODE_ANG = $URUT_ANG AND
            us.NOFAK = '$NOFAK' AND
            us.TANGGAL = '$TGL'");
        
        return $query->row_array();
    }
    public function getGenerate()
    {
        return $this->db->query("SELECT MAX(TANGGAL) AS tanggal FROM us")->row();
    }
    
    public function editTransaksi()
    {
        $where = [
            "NOFAK" => $this->input->post('NOFAK', true),
        ];
        $data = [
            "IDUSER" => $this->input->post('id', true),
            "IDNAMA" => $this->input->post('first_name', true),
            "TANGGAL" => $this->input->post('TGLP_ANG', true),
            "JUMLAH" => $this->input->post('JMLP_ANG', true),
            "PRO" => $this->input->post('PRO_ANG', true),
            "jangka" => $this->input->post('JWKT_ANG', true),
            "DATE" => date('Y-m-d'),
            "TIME" => date("H:i:s"),
        ];

        $this->db->update('us', $data, $where);
    }

    public function tambahTransaksi()
    {
        // $a = $this->input->post('TGLP_ANG');
        // $b = $this->input->post('JWKT_ANG');

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
        $data =  $this->db->query("SELECT SUM(JUMLAH) AS HASIL,	MONTH(TANGGAL) AS TANGGAL FROM	us WHERE YEAR(TANGGAL) = $thn GROUP BY MONTH(TANGGAL) ORDER BY MONTH(TANGGAL)");
        return $data->result_array();
        // $this->db->select('*');
        // $this->db->from('us');
        // $this->db->where('KODE_INS', '06');
        // return $this->db->get()->result_array();
        $this->db->query("CREATE INDEX idx_anggota ON anggota (URUT_ANG, REKENING, KODE_INS);
        CREATE INDEX idx_instan ON instan (KODE_INS, NAMA_INS);
        CREATE INDEX idx_pembayaran ON pembayaran (KODE_ANG, TGL_TGHN, JML_TGHN, JML_BAYAR);
        CREATE INDEX idx_pinsimp ON pinsimp (KODE_ANG, TAHUN, BULAN, TOTWJB, TOTPOK, TOTREL);
        CREATE INDEX idx_pinuang ON pinuang (KODE_ANG, TAHUN, BULAN, NOFAK, JMLP_ANG, PRO_ANG, KE_ANG, JWKT_ANG);
        CREATE INDEX idx_us ON us (KODE_ANG, NOFAK, JUMLAH, PRO, JANGKA, IDUSER);
        CREATE INDEX idx_pl ON pl (KODE_ANG, TAHUN, BULAN, WAJIB, TPOKOK, TWAJIB, RELA, POKU1, SIPOKU1, BNGU1, POKU2, SIPOKU2, BNGU2, POKU3, SIPOKU3, BNGU3, POKU4, SIPOKU4, BNGU4, POKU7, SIPOKU7, BNGU7, POKU6);
        ");
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
