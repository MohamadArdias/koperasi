<?php
class Instansi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->library('pagination');

        $this->data['title'] = 'Instansi';

        $config['base_url'] = 'http://localhost/koperasi/index.php/Instansi/index';
        $config['total_rows'] = $this->Instansi->countAllInstansi();
        $config['per_page'] = 25;
        $config['num_links'] = 2;

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
        $this->data['instansi'] = $this->Instansi->getInstansi($config['per_page'], $data['start']);

        $this->load->view('Instansi/index', $this->data);
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
        $this->data['title'] = 'Ubah data instansi';
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
}
