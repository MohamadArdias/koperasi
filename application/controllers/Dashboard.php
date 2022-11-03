<?php

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Dashboard_model', 'Dashboard');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Dashboard';

        $this->data['aktif'] = $this->Anggota->getAllAnggotaAktif();
        $this->data['tidak'] = $this->Anggota->getAllAnggotaTidakAktif();
        $this->data['bunga'] = $this->Dashboard->getBunga();
        $this->data['tung'] = $this->Dashboard->getAnggotaTunggak('');
        $this->data['SPjanuari'] =  $this->Dashboard->SPjanuari();
        $this->data['SPfebruari'] =  $this->Dashboard->SPfebruari();
        $this->data['SPmaret'] =  $this->Dashboard->SPmaret();
        $this->data['SPapril'] =  $this->Dashboard->SPapril();
        $this->data['SPmei'] =  $this->Dashboard->SPmei();
        $this->data['SPjuni'] =  $this->Dashboard->SPjuni();
        $this->data['SPjuli'] =  $this->Dashboard->SPjuli();
        $this->data['SPagustus'] =  $this->Dashboard->SPagustus();
        $this->load->view('dashboard/index', $this->data);
    }
}
