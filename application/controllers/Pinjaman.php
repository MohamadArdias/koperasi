<?php
class Pinjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Us_model', 'Us');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pinjaman';

        $this->load->view('pinjaman/index', $this->data);
    }

    public function form($kode)
    {
        $a = $this->input->post('URUT_ANG', true);

        if ($kode == 1) {
            $this->data['title'] = 'Pinjaman Uang';
        } elseif ($kode == 2) {
            $this->data['title'] = 'Pinjaman SIM';
        } elseif ($kode == 3) {
            $this->data['title'] = 'Pinjaman Konsumsi';
        } elseif ($kode == 4) {
            $this->data['title'] = 'Pinjaman Non-Konsumsi';
        } else {
            $this->data['title'] = 'Pinjaman Khusus';
        }

        $this->data['urutan'] = $this->Pinuang->getUrut();
        $this->data['kode'] = $kode;

        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('TANGGUNGAN', 'Tanggungan', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/form', $this->data);
        } else {
            $this->Pinuang->deleteTransaksi($a);
            $this->Pinuang->tambahTransaksi();
            $this->Us->tambahTransaksi();
            $this->session->set_flashdata('flashP', 'ditambahkan');
            redirect('pinjaman');
        }
    }

    public function print()
    {
        $this->data['title'] = 'Cetak Pinjaman';
        $this->load->view('pinjaman/print', $this->data);
    }

    public function autofill()
    {
        $a = $_GET['URUT_ANG'];
        // $b = $_GET['KD'];

        $query = $this->Anggota->getTanggungan($a);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {
            $data = array(
                'nama' => $query['NAMA'],
                'jangka' => $query['JANGKA'],
                'periode' => $query['PERIODE'],
                'sisa' => $query['SISA'],
                'bunga' => $query['BUNGA'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA'],
                'jangka' => 0,
                'periode' => 0,
                'sisa' => 0,
                'bunga' => 0,
            );
            echo json_encode($data);
        }
    }
}
