<?php
class Tunggakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tunggakan_model', 'Tunggakan');
        $this->load->model('Pay_model', 'Pay');
        $this->load->model('Kirim_model', 'Kirim');
        // $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->model('Keuangan_model', 'keuangan');
        $this->load->model('Pengurus_model', 'Pengurus');
        $this->load->model('Us_model', 'Us');
        $this->load->library('pdf');
    }

    public function index()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Instansi';
        $this->data['keuangan'] = $this->Tunggakan->getInsTung($THN, $BLN);

        $this->load->view('tunggakan/index', $this->data);
    }

    public function printins($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['keuangan'] = $this->Tunggakan->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['instansi'] = $this->keuangan->getInstansi($KODE_INS);
        $this->data['pengurus'] = $this->keuangan->getPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('tunggakan/printins', $this->data);
    }

    public function printinsang($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['printang'] = $this->Tunggakan->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->data['jumlah'] = $this->Tunggakan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('tunggakan/printinsang', $this->data);
    }

    public function anggota()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Anggota';
        $this->data['keuangan'] = $this->Tunggakan->getAllKeuangan($THN, $BLN);

        $this->load->view('tunggakan/cetakang', $this->data);
    }

    public function printang($KODE_ANG)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        // echo $TAHUN.'-'.$BULAN;

        $this->data['printang'] = $this->Tunggakan->getAnggotaWhereKodeAng($KODE_ANG, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->load->view('tunggakan/printang', $this->data);
    }

    public function cetakAll()
    {
        $DATE = $this->input->get('GETEX');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }

        $this->data['jumlah'] = $this->Tunggakan->cetakAll($THN, $BLN);

        $this->load->view('tunggakan/cetakAll', $this->data);
    }
}
