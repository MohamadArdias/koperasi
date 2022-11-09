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
    public function edit($JABATAN)
    {
        $this->data['title'] = 'Edit Data Pengurus';
        $this->data['Pengurus'] = $this->Pengurus->GetPengurusbyJabatan($JABATAN);
        // $this->form_validation->set_rules('NAMA', 'Nama Pengurus', 'required');



        // if ($this->form_validation->run() == FALSE) {
        $this->load->view('Pengurus/edit', $this->data);
        // } else {
        // $this->Pengurus->editDataPengurus();
        // $this->session->set_flashdata('flash', 'diubah');
        // redirect('Pengurus');
        // }
    }
}
