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
        $this->data['keuangan'] = $this->Pinsimp->getTabungan();

        $this->load->view('pinsim/index', $this->data);
    }

    public function cetak($KODE_ANG)
    {
        $this->data['title'] = 'Cetak Anggota';
        $this->data['keuangan'] = $this->Keuangan->getKeuanganByKode($KODE_ANG);

        $this->load->view('pinsim/cetak', $this->data);
    }

    public function pinjaman()
    {
        $this->data['title'] = 'Informasi Pinjaman Anggota';
        $this->data['pinjaman'] = $this->Pinuang->getPinjaman();

        $this->load->view('pinsim/pinjaman', $this->data);
    }
}
