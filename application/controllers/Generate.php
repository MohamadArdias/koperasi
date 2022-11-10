<?php
class generate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Generate Laporan';
        

        $this->load->view('generate/index', $this->data);
    }
}
