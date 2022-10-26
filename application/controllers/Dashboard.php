<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title']= 'Dashboard';

        $this->data['aktif'] = $this->Anggota->getAllAnggotaAktif();
        $this->data['tidak'] = $this->Anggota->getAllAnggotaTidakAktif();
        


        $this->load->view('dashboard/index', $this->data);
    }
}