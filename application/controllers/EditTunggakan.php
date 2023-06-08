<?php

// use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EditTunggakan extends CI_Controller
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
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Edit Tunggakan';

        $this->data['query'] = $this->Keuangan->getTunggakan($THN, $BLN);
        $this->load->view('tunggakan/edit', $this->data);
    }

    public function edit()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }
        $query = $this->Keuangan->getTunggakan($THN, $BLN);
        foreach ($query as $key) {

            $a = $this->input->post('name' . $key['KODE_ANG']);

            if ($a == null or $a <= 0) {
                $ket = 0;
            } else {
                $ket = $a;
            }

            echo $ket;
            echo "<br>";

            // $pl = array(
            //     'POKU6' => $ket, //KET = kolom untuk pl sekarang
            // );

            // $where = array(
            //     'KODE_ANG' => $this->input->post('id' . $key['KODE_ANG']),
            //     'TAHUN' => $THN,
            //     'BULAN' => $BLN,
            // );

            // $this->db->update('pl', $pl, $where);
        }
        // $this->session->set_flashdata('flash', 'diubah');
        // redirect('EditTunggakan');
    }
}
