<?php

class Pay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pay_model', 'Pay');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pembayaran Langsung';

        $this->form_validation->set_rules('KODE', 'Kode anggota', 'required');
        $this->form_validation->set_rules('TGL_BAYAR', 'Tanggal Bayar', 'required');
        $this->form_validation->set_rules('TAGIHAN', 'Tagihan', 'required');
        $this->form_validation->set_rules('JML_BAYAR', 'Bayar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pembayaranLangsung/index', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggotaPin();
            if ($aku != 0) {
                $this->Pay->bayar();
                $this->session->set_flashdata('bayarB', 'berhasil');
                redirect('pay');
            } else {
                $this->session->set_flashdata('bayarG', 'salah');
                redirect('pay');
            }
        }
    }

    public function autofill()
    {
        $a = $_GET['KODE'];

        $query = $this->Pay->getKodeAnggota($a);

        //  echo $this->db->last_query();

        $tahun = $query['TAHUN'];
        $bulan = $query['BULAN'];

        $detail = $this->db->query("SELECT SUM(JML_BAYAR) AS jumlah FROM pembayaran_detail WHERE TAHUN = $tahun and BULAN = '$bulan'")->row();
        //   echo $detail->jumlah;
        // $tagihan = $query['JML_TGHN'] - $detail;

        if ($query != null) {
            $data = array(
                'nama' => $query['NAMA_ANG'],
                // 'tagihan' => $query['JML_TGHN'],
                'tagihan' => $query['JML_TGHN']-$detail->jumlah,
                // 'bayar' => $query['JML_BAYAR'],
                'TAHUN' => $tahun,
                'BULAN' => $bulan,
                'detail' => $detail->jumlah,
                //  'tunggakan' => $query['POKU6'],
            );
            echo json_encode($data);
        }
    }

    public function cetak()
    {
        $this->data['title'] = 'Cetak Pembayaran Langsung';
        $this->data['data'] = $this->Pay->getCetak();

        $this->load->view('pembayaranLangsung/cetak', $this->data);
    }

    
}
