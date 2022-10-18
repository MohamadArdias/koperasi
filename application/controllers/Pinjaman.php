<?php
class Pinjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pinjaman';

        $this->load->view('pinjaman/index', $this->data);
    }

    public function form($kode)
    {
        $this->data['title'] = 'Pinjaman';
        $this->data['urutan'] = $this->Pinuang->getUrut();
        $this->data['kode'] = $kode;
        $this->data['anggota'] = $this->Anggota->getAllAnggota();
        // $this->data['tanggungan'] = $this->Anggota->getTanggungan();

        
        
        $this->form_validation->set_rules('FAKTUR', 'Faktur', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/form', $this->data);
        } else {
            $this->Pinuang->tambahTransaksi();
            $this->session->set_flashdata('flash', 'ditambahkan');
            redirect('pinjaman');
        }
    }

    public function tampil()
    {
        $URUT_ANG = $_POST['URUT_ANG'];
        // $KD = $_POST['KD'];
    
        $s = "SELECT NAMA_ANG AS nama_anggota FROM anggota WHERE URUT_ANG='$URUT_ANG'";
        $res = $this->db->query($s)->row_array();

        echo json_encode($res);
    }

    public function autofill()
    {
        if (isset($_GET['term'])) {
            $result = $this->Anggota->cariDataAnggota($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $key ) {
                    $arr_result[] = $key -> KODE_ANG;
                    echo json_encode($arr_result); 
                }
            }
        }
    }
}
