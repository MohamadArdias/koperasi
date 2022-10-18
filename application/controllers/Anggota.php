<?php
class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->library('pagination');

        $this->data['title'] = 'Tabel Anggota';

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyang', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyang');
        }

        $this->db->like('NAMA_ANG', $data['keyword']);
        $this->db->or_like('KODE_ANG', $data['keyword']);
        $this->db->or_like('NAMA_INS', $data['keyword']);
        $this->db->or_like('KODE_INS', $data['keyword']);
        $this->db->from('anggota');

        $config['base_url'] = 'http://localhost/koperasi/index.php/anggota/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;
        $config['num_links'] = 5;

        

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->data['anggota'] = $this->Anggota->getAnggota($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('anggota/index', $this->data);
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
        // $this->form_validation->set_rules('KODE_ANG', 'kode anggota', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'kode instansi', 'required');
        $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        // $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        // $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        // $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        // $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');
        $this->form_validation->set_rules('GOL', 'golongan', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/tambah', $this->data);
        } else {
            $this->Anggota->tambahDataAnggota();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('Anggota');
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
        $this->data['anggota'] = $this->Anggota->getAnggotaByUrut($URUT_ANG);
        $this->form_validation->set_rules('KODE_ANG', 'kode anggota', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'kode instansi', 'required');
        $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');
        $this->form_validation->set_rules('GOL', 'golongan', 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/edit', $this->data);
        } else {
            $this->Anggota->editDataAnggota();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('Anggota');
        }
    }
}
