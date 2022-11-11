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
        // $this->data['kodeanggota'] = $this->Pay->getKodeAnggota();;
        $this->load->view('PembayaranLangsung/index', $this->data);
    }

    public function autofill2()
    {
        $a = $_GET['KODE'];

        $query = $this->Pay->getKodeAnggota($a);

        if ($query != null) {
            $data = array(
                'nama' => $query['NAMA_ANG'],
                'tagihan' => $query['JML_TGHN'],
            );

            echo json_encode($data);
        }
    }
}
