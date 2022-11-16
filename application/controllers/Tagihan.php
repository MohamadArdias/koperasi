<?php
class tagihan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pembayaran_model', 'Pembayaran');
        $this->load->model('Kirim_model', 'Kirim');
    }

    public function index()
    {
        $this->data['title'] = 'Daftar Tagihan';
        $this->data['tagihan'] = $this->Kirim->getTagihan();

        $this->load->view('tagihan/index', $this->data);
    }
}
