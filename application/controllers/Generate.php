<?php
class generate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model', 'Pembayaran');
    }

    public function index()
    {
        $this->data['title'] = 'Generate Tagihan';
        $this->data['pembayaran'] = $this->Pembayaran->getPembayaran();

        $this->load->view('generate/index', $this->data);
    }
}
