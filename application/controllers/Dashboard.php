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
        $this->data['Kjanuari'] = $this->Dashboard->Kjanuari();
        $this->data['Kfebruari'] = $this->Dashboard->Kfebruari();
        $this->data['Kmaret'] = $this->Dashboard->Kmaret();
        $this->data['Kapril'] = $this->Dashboard->Kapril();
        $this->data['Kmei'] = $this->Dashboard->Kmei();
        $this->data['Kjuni'] = $this->Dashboard->Kjuni();
        $this->data['Kjuli'] = $this->Dashboard->Kjuli();
        $this->data['Kagustus'] = $this->Dashboard->Kagustus();
        $this->data['Kseptember'] = $this->Dashboard->Kseptember();
        $this->data['Koktober'] = $this->Dashboard->Koktober();
        $this->data['Knovember'] = $this->Dashboard->Knovember();
        $this->data['Kdesember'] = $this->Dashboard->Kdesember();
        $this->data['NKjanuari'] = $this->Dashboard->NKjanuari();
        $this->data['NKfebruari'] = $this->Dashboard->NKfebruari();
        $this->data['NKmaret'] = $this->Dashboard->NKmaret();
        $this->data['NKapril'] = $this->Dashboard->NKapril();
        $this->data['NKmei'] = $this->Dashboard->NKmei();
        $this->data['NKjuni'] = $this->Dashboard->NKjuni();
        $this->data['NKjuli'] = $this->Dashboard->NKjuli();
        $this->data['NKagustus'] = $this->Dashboard->NKagustus();
        $this->data['NKseptember'] = $this->Dashboard->NKseptember();
        $this->data['NKoktober'] = $this->Dashboard->NKoktober();
        $this->data['NKnovember'] = $this->Dashboard->NKnovember();
        $this->data['NKdesember'] = $this->Dashboard->NKdesember();
        $this->load->view('dashboard/index', $this->data);
    }
}
