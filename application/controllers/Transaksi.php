<?php
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'History Transaksi';
        $this->data['dt_transaksi'] = $this->Pinuang->getPinuang();

        $this->load->view('transaksi/index', $this->data);
    }
}
