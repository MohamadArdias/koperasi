<?php
class Anggota extends CI_Controller
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
        $this->data['title'] = 'Tabel Anggota';

        $this->data['anggota'] = $this->Anggota->getAnggota();

        $this->load->view('anggota/index', $this->data);
    }

    public function keluar()
    {
        $this->data['title'] = 'Tabel Anggota Keluar';

        $this->load->view('anggota/keluar', $this->data);
    }

    public function berhenti($URUT_ANG)
    {
        $this->data['title'] = 'Detail Data Anggota';
        $this->data['berhenti'] = $this->Anggota->getAnggotaById($URUT_ANG);

        $this->form_validation->set_rules('STATUS', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/berhenti', $this->data);
        } else {
            $this->Anggota->editStatus();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('anggota');
        }

    }

    public function detail($URUT_ANG)
    {
        $this->data['title'] = 'Detail Data Anggota';
        $this->data['anggota'] = $this->Anggota->getAnggotaById($URUT_ANG);
        $this->load->view('anggota/detail', $this->data);
    }

    public function tambah()
    {
        $this->data['title'] = 'Tambah Data Anggota';
        $this->data['instansi'] = $this->Instansi->getAllInstansi();

        // $this->form_validation->set_rules('KODE_ANG', 'kode anggota', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'instansi', 'required');
        // $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        // $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        // $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        // $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');
        // $this->form_validation->set_rules('GOL', 'golongan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/tambah', $this->data);
        } else {
            $id   = $_POST['URUT_ANG'];
    
            $query = $this->db->get_where('anggota', array(//making selection
                'URUT_ANG' => $id
            ));
            $count = $query->num_rows(); //counting result from query

            if ($count === 0) {                
                $this->Anggota->tambahDataAnggota();
                $this->Pinsimp->pinsimpAnggota();
                $this->Keuangan->keuanganAnggota();
                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('Anggota');
            } else {
                $this->session->set_flashdata('addAng', 'KODE ANGGOTA');
                $this->load->view('anggota/tambah', $this->data);
            }
        }
    }

    public function hapus($URUT_ANG)
    {
        $this->Anggota->hapusDataAnggota($URUT_ANG);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('Anggota');
    }

    public function edit($URUT_ANG)
    {
        $this->data['title'] = 'Edit Data Anggota';
        $this->data['anggota'] = $this->Anggota->getAnggotaById($URUT_ANG);
        $this->data['instansi'] = $this->Instansi->getAllInstansi();

        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'kode instansi', 'required');
        // $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        // $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        // $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        // $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        // $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/edit', $this->data);
        } else {
            $this->Anggota->editDataAnggota();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('anggota');
        }
    }
}
