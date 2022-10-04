<?php
class Pinsim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->data['title'] = 'Informasi Simpanan dan Pinjaman Anggota';

        $this->load->library('pagination');

        $config['base_url'] = 'http://localhost/koperasi/index.php/pinsim/index';
        $config['total_rows'] = $this->Keuangan->countAllKeuangan();
        $config['per_page'] = 50;
        $config['num_links'] = 5;

        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->data['keuangan'] = $this->Keuangan->getKeuangan($config['per_page'], $data['start']);

        if ($this->input->post('keyword')) {
            $this->data['keuangan'] = $this->Keuangan->cariDataKeuangan();
        }


        $this->load->view('pinsim/index', $this->data);
    }

    public function cetak($KODE_ANG)
    {
        $this->data['title'] = 'Cetak Anggota';
        $this->data['keuangan'] = $this->Keuangan->getKeuanganByKode($KODE_ANG);

        $this->load->view('pinsim/cetak', $this->data);
    }

    // public function detail($URUT_ANG)
    // {
    //     $this->data['title'] = 'Detail Data Anggota';
    //     $this->data['anggota'] = $this->Anggota->getAnggotaById($URUT_ANG);
    //     $this->load->view('Anggota/detail', $this->data);
    // }

    // public function tambah()
    // {
    //     $this->data['title'] = 'Tambah Data Anggota';
    //     $this->form_validation->set_rules('KODE_ANG', 'kode anggota', 'required');
    //     $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
    //     $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
    //     $this->form_validation->set_rules('KODE_INS', 'kode instansi', 'required');
    //     $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
    //     $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
    //     $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
    //     $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
    //     $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');
    //     $this->form_validation->set_rules('GOL', 'golongan', 'required');


    //     if ($this->form_validation->run() == FALSE) {
    //         $this->load->view('Anggota/tambah', $this->data);
    //     } else {
    //         $this->Anggota->tambahDataAnggota();
    //         $this->session->set_flashdata('flash', 'ditambahkan');
    //         redirect('Anggota');
    //     }
    // }

    // public function hapus($URUT_ANG)
    // {
    //     $this->Anggota->hapusDataAnggota($URUT_ANG);
    //     $this->session->set_flashdata('flash', 'dihapus');
    //     redirect('Anggota');
    // }


}
