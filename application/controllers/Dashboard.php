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

    //public function index()
    //{
    //     $this->rekap;
    //}

    public function index()
    {
        $TAHUN = $this->input->get('TAHUN');




        $this->data['title'] = 'Dashboard';

        $this->data['aktif'] = $this->Anggota->getAllAnggotaAktif();
        $this->data['tidak'] = $this->Anggota->getAllAnggotaTidakAktif();
        $this->data['tunggakan'] = $this->Dashboard->getTotalTunggak();
        $this->data['tung'] = $this->Dashboard->getAnggotaTunggak();
		
        if ($TAHUN == '') {
            $THN = date('Y');
        } else {
            $THN = $TAHUN;
        }

        $this->data['data'] = $this->Us->getUs($THN);

        $this->load->view('dashboard/index', $this->data);
    }
	public function histori($URUT_ANG)
	{
		$this->data['title'] = 'Histori Pembayaran';
		$this->data['anggota'] = $this->Dashboard->getHistori($URUT_ANG);
		$this->load->view('dashboard/histori', $this->data);
	}
}
