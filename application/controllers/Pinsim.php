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

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keypins', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keypins');
        }

        $this->db->like('NAMA_INS', $data['keyword']);
        $this->db->or_like('KODE_INS', $data['keyword']);
        $this->db->from('keuangan');

        $config['base_url'] = 'http://localhost/koperasi/index.php/pinsim/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 25;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->data['keuangan'] = $this->Keuangan->getKeuangan($config['per_page'], $data['start'], $data['keyword']);

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
