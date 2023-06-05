<?php

class aku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Us_model', 'Us');
        // $this->load->model('Instansi_model', 'Instansi');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->view('Aku/index');
    }

    public function edit()
    {
        $query = $this->db->query("SELECT * FROM `testing`")->result_array();

        foreach ($query as $key ) {
            $pl = array(
                'nama' => $this->input->post('name'.$key['id']),
            );
            
            $where = array(
                'id' => $this->input->post('id'.$key['id']),
            );

            $this->db->update('testing', $pl, $where);            
        }
    }
}
