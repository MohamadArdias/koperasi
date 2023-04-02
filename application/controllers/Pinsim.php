<?php
class Pinsim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Informasi Simpanan Anggota';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['keuangan'] = $this->Pinsimp->getTabungan($THN, $BLN);

        $this->load->view('pinsim/index', $this->data);
    }

    public function cetakPinsim()
    {
        $DATE = $this->input->get('GEN_SIMP');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }

        echo $BLN;
    }

    // public function cetak($KODE_ANG)
    // {
    //     $this->data['title'] = 'Cetak Anggota';
    //     $this->data['keuangan'] = $this->Keuangan->getKeuanganByKode($KODE_ANG);

    //     $this->load->view('pinsim/cetak', $this->data);
    // }

    public function pinjaman()
    {
        $this->data['title'] = 'Informasi Pinjaman Anggota';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['pinjaman'] = $this->Pinuang->getPinjaman($THN, $BLN);

        $this->load->view('pinsim/pinjaman', $this->data);
    }

    public function tunggakan()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Tunggakan '.$THN.'-'.$BLN;
        $this->data['tunggakan'] = $this->Pinuang->tunggakan($THN, $BLN);

        $this->load->view('pinsim/tunggakan', $this->data);
    }
}
