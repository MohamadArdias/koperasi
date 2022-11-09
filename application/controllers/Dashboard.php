<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Dashboard_model', 'Dashboard');
        $this->load->model('Us_model', 'Us');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Dashboard';

        $this->data['aktif'] = $this->Anggota->getAllAnggotaAktif();
        $this->data['tidak'] = $this->Anggota->getAllAnggotaTidakAktif();
        $this->data['bunga'] = $this->Dashboard->getBunga();
        $this->data['tung'] = $this->Dashboard->getAnggotaTunggak();

        $this->data['data'] = $this->Us->getUs();

        $this->load->view('dashboard/index', $this->data);
    }
}
