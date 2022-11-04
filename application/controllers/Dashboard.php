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
        // UANG
        $this->data['SPjanuari'] =  $this->Dashboard->SPjanuari();
        $this->data['SPfebruari'] =  $this->Dashboard->SPfebruari();
        $this->data['SPmaret'] =  $this->Dashboard->SPmaret();
        $this->data['SPapril'] =  $this->Dashboard->SPapril();
        $this->data['SPmei'] =  $this->Dashboard->SPmei();
        $this->data['SPjuni'] =  $this->Dashboard->SPjuni();
        $this->data['SPjuli'] =  $this->Dashboard->SPjuli();
        $this->data['SPagustus'] =  $this->Dashboard->SPagustus();
        $this->data['SPseptember'] =  $this->Dashboard->SPseptember();
        $this->data['SPoktober'] =  $this->Dashboard->SPoktober();
        $this->data['SPnovember'] =  $this->Dashboard->SPnovember();
        $this->data['SPdesember'] =  $this->Dashboard->SPdesember();
        // KONSUMSI
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
        // NONKONSUMSI
        $this->data['NKjanuari'] = $this->Dashboard->Nkjanuari();
        $this->data['NKfebruari'] = $this->Dashboard->Nkfebruari();
        $this->data['NKmaret'] = $this->Dashboard->Nkmaret();
        $this->data['NKapril'] = $this->Dashboard->Nkapril();
        $this->data['NKmei'] = $this->Dashboard->Nkmei();
        $this->data['NKjuni'] = $this->Dashboard->Nkjuni();
        $this->data['NKjuli'] = $this->Dashboard->Nkjuli();
        $this->data['NKagustus'] = $this->Dashboard->Nkagustus();
        $this->data['NKseptember'] = $this->Dashboard->Nkseptember();
        $this->data['NKoktober'] = $this->Dashboard->Nkoktober();
        $this->data['NKnovember'] = $this->Dashboard->Nknovember();
        $this->data['NKdesember'] = $this->Dashboard->Nkdesember();
        // PIBJAMA KHUSUS
        $this->data['PKjanuari'] =  $this->Dashboard->PKjanuari();
        $this->data['PKfebruari'] =  $this->Dashboard->PKfebruari();
        $this->data['PKmaret'] =  $this->Dashboard->PKmaret();
        $this->data['PKapril'] =  $this->Dashboard->PKapril();
        $this->data['PKmei'] =  $this->Dashboard->PKmei();
        $this->data['PKjuni'] =  $this->Dashboard->PKjuni();;
        $this->data['PKjuli'] =  $this->Dashboard->PKjuli();
        $this->data['PKagustus'] =  $this->Dashboard->PKagustus();
        $this->data['PKseptember'] =  $this->Dashboard->PKseptember();
        $this->data['PKoktober'] =  $this->Dashboard->PKoktober();
        $this->data['PKnovember'] =  $this->Dashboard->PKnovember();
        $this->data['PKdesember'] =  $this->Dashboard->PKdesember();
        $this->load->view('dashboard/index', $this->data);
    }
}
