<?php 
class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model');
        $this->load->library('form_validation');
    }
    
    public function index()
    {
        $this->load->view('Anggota/index');
    }
}
