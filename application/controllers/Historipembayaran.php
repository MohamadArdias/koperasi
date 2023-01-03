<?php

class Historipembayaran extends CI_Controller
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
	$this->data['title'] = 'Histori Pembayaran';

    $this->data['anggota'] = $this->Anggota->getAnggota();

    $this->load->view('historipembayaran/index', $this->data);
}
public function histori($URUT_ANG)
	{
		
		$this->data['title'] = 'Histori Pembayaran';
		$this->data['anggota'] = $this->Dashboard->getHistori($URUT_ANG);
		$this->load->view('dashboard/histori', $this->data);
	}
}