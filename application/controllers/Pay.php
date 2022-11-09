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
        $this->data['kodeanggota'] = $this->Pay->getKodeAnggota();;
        $this->load->view('PembayaranLangsung/index', $this->data);
    }

    public function autofill()
    {
        $a = $_GET['URUT_ANG'];
        $b = $_GET['KODE'];

        $query = $this->Anggota->getTanggungan($a, $b);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {
            $data = array(
                'nama' => $query['NAMA'],
                'jangka' => $query['JANGKA'],
                'periode' => $query['PERIODE'],
                'sisa' => $query['SISA'],
                'bunga' => $query['BUNGA'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA'],
                'jangka' => 0,
                'periode' => 0,
                'sisa' => 0,
                'bunga' => 0,
            );
            echo json_encode($data);
        }
    }
}
