<?php

// use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Sukarela extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Sukarela';

        $this->data['query'] = $this->Pinsimp->getSukarela();
        $this->load->view('pinsim/sukarela', $this->data);
    }

    public function edit()
    {
        $query = $this->Pinsimp->getSukarela();
        foreach ($query as $key) {
            $a = $this->input->post('name' . $key['KODE_ANG']);
            if ($a == null) {
                $ket = 0;
            }else {
                $ket = $a;
            }

            $sukarela = array(
                'KET' => $ket, //KET = kolom untuk sukarela sekarang
            );

            $where = array(
                'KODE_ANG' => $this->input->post('id'.$key['KODE_ANG']),
                'TAHUN' => date('Y'),
                'BULAN' => date('m'),
            );

            $this->db->update('pinsimp', $sukarela, $where);
        }
        $this->session->set_flashdata('flash', 'diubah');
        redirect('sukarela');
    }
}
