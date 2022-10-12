<?php
class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->model('Keuangan_model', 'keuangan'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->library('pagination');

        $this->data['title'] = 'Instansi';

        // ambil data keyword
        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyins', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyins');
        }

        $this->db->like('NAMA_INS', $data['keyword']);
        $this->db->or_like('KODE_INS', $data['keyword']);
        $this->db->from('instan');

        $config['base_url'] = 'http://localhost/koperasi/index.php/instansi/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 10;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $this->data['instansi'] = $this->Instansi->getInstansi($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('instansi/index', $this->data);
    }

    public function tambah()
    {
        $this->data['title'] = 'Tambah Data Instansi';

        $this->form_validation->set_rules('KODE_INS', 'Kode Instansi', 'required');
        $this->form_validation->set_rules('NAMA_INS', 'Nama Instansi', 'required');
        $this->form_validation->set_rules('ALM_INS', 'Alamat Instansi');
        $this->form_validation->set_rules('TLP_INS', 'Nomor Telepon');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('instansi/tambah', $this->data);
        } else {
            $this->Instansi->tambahDataInstansi();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('instansi');
        }
    }

    public function edit($KODE_INS)
    {
        $this->data['title'] = 'Edit Data Instansi';
        $this->data['instansi'] = $this->Instansi->getInstansiByKode($KODE_INS);

        $this->form_validation->set_rules('KODE_INS', 'Kode Instansi', 'required');
        $this->form_validation->set_rules('NAMA_INS', 'Nama Instansi', 'required');
        $this->form_validation->set_rules('ALM_INS', 'Alamat Instansi');
        $this->form_validation->set_rules('TLP_INS', 'Nomor Telepon');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('instansi/edit', $this->data);
        } else {
            $this->Instansi->editDataInstansi();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('instansi');
        }
    }

    public function hapus($KODE_INS)
    {
        $this->Instansi->hapusDataInstansi($KODE_INS);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('instansi');
    }

    public function cetak($KODE_INS)
    {
        $this->data['title'] = 'Cetak Per Instansi';

        $this->data['keuangan'] = $this->Instansi->getAnggotaWhereKodeins($KODE_INS);

        $this->load->view('instansi/cetak', $this->data);
    }
}
