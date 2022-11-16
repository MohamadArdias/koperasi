<?php

class Pay extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pay_model', 'Pay');
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
            $this->load->view('PembayaranLangsung/index', $this->data);
        } else {
            $this->Pay->bayar();
            $this->session->set_flashdata('bayar', 'berhasil');
            redirect('Pay');
        }
    }

    public function autofill()
    {
        $a = $_GET['KODE'];

        $query = $this->Pay->getKodeAnggota($a);

        if ($query != null) {
            if ($query['STATUS'] == 'TERBAYAR') {
                $data = array(
                    'nama' => $query['NAMA_ANG'],
                    'tagihan' => 0,
                    'bayar' => 0,
                    'tunggakan' => 0,
                );
            } else {
                $data = array(
                    'nama' => $query['NAMA_ANG'],
                    'tagihan' => $query['JML_TGHN'],
                    'bayar' => $query['JML_BAYAR'],
                    'tunggakan' => $query['TUNGGAKAN'],
                );
            }
            echo json_encode($data);
        }
    }
}
