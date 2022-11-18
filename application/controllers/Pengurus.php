<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengurus_model', 'Pengurus');
    }
    public function index()
    {
        $this->data['title'] = 'Pengurus';
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->load->view('Pengurus/index', $this->data);
    }
    public function edit($id)
    {
        $this->data['title'] = 'Edit Data Pengurus';
        $this->data['KETUA'] = $this->Pengurus->GetPengurusKetua($id);
        // $this->data['WAKIL'] = $this->Pengurus->GetPengurusWakil($id);
        // $this->data['SEKERTARIS'] = $this->Pengurus->GetPengurusSekertaris($id);
        // $this->data['BENDAH1'] = $this->Pengurus->GetPengurusBendah1($id);
        // $this->data['BENDAH2'] = $this->Pengurus->GetPengurusBendah2($id);
        $this->form_validation->set_rules('NAMA', 'KETUA', 'required');



        if ($this->form_validation->run() == FALSE) {
        $this->load->view('Pengurus/edit', $this->data);
        } else {
        $this->Pengurus->editDataPengurus();
        $this->session->set_flashdata('flash', 'diubah');
        redirect('Pengurus');
        }
    }
}
