<?php
class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->data['title'] = 'History Transaksi';

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
        $this->db->or_like('NAMA_ANG', $data['keyword']);
        $this->db->or_like('KODE_ANG', $data['keyword']);
        $this->db->or_like('NOFAK', $data['keyword']);
        $this->db->from('pinuang');

        $config['base_url'] = 'http://localhost/koperasi/index.php/transaksi/index';
        $config['total_rows'] = $this->db->count_all_results();
        $config['per_page'] = 25;
        $config['num_links'] = 5;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->data['dt_transaksi'] = $this->Pinuang->getPinuang($config['per_page'], $data['start'], $data['keyword']);

        $this->load->view('transaksi/index', $this->data);
    }

}
