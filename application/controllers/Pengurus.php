<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pengurus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pengurus_model', 'Pengurus');
        $this->load->library('form_validation');
    }
    public function index()
    {
        $this->data['title'] = 'Pengurus';
        $this->data['pengurus'] = $this->Pengurus->getAllPengurus();
        // $d = $this->Pengurus->getAllPengurus();
        $this->load->view('pengurus/index', $this->data);
    }
    public function edit()
    {
        $this->data['title'] = 'Edit Data Pengurus';
        $this->data['pengurus'] = $this->Pengurus->getAllPengurus();

        $this->form_validation->set_rules('KETUA', 'nomor urut anggota', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pengurus/edit', $this->data);
        } else {
            $this->Pengurus->editDataPengurus();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('Pengurus');
        }
    }
}
