<?php

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->data['title']= 'Dashboard';
        $this->load->view('dashboard/index', $this->data);
    }
}