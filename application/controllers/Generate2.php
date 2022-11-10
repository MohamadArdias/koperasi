<?php
class generate extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Generate Laporan Simpanan';
        $this->data['simpan'] = $this->Pinsimp->getAllSimp();

        $this->load->view('generate/index', $this->data);
    }

    public function uang()
    {
        $this->data['title'] = 'Generate Pinjaman Uang';
        $this->data['uang'] = $this->Pinuang->getUang();

        $this->load->view('generate/uang', $this->data);
    }

    public function nonkonsum()
    {
        $this->data['title'] = 'Generate Pinjaman Non-Konsumi';
        $this->data['uang'] = $this->Pinuang->getNon();

        $this->load->view('generate/nonkonsum', $this->data);
    }

    public function konsum()
    {
        $this->data['title'] = 'Generate Pinjaman Konsumi';
        $this->data['uang'] = $this->Pinuang->getKons();

        $this->load->view('generate/konsum', $this->data);
    }

    public function khusus()
    {
        $this->data['title'] = 'Generate Pinjaman Khusus';
        $this->data['uang'] = $this->Pinuang->getKhusus();

        $this->load->view('generate/khusus', $this->data);
    }

    // public function tambah()
    // {
    //     if (isset($_POST['KODE_ANG'])) {
    //         $KODE_ANG        = $_POST['KODE_ANG'];
    //         $JML_ANG    = count($KODE_ANG);

    //         $data = [
    //             "KODE_ANG" => $_POST['KODE_ANG'],
    //             "NAMA_ANG" => $_POST['NAMA_ANG'],
    //             "TOTWJB" => $_POST['TOTWJB'],
    //             "TOTPOK" => $_POST['TOTPOK'],
    //             "TWAJIB" => $_POST['TWAJIB'],
    //             "TPOKOK" => $_POST['TPOKOK'],
    //         ];

    //         // $this->db->insert('anggota', $this->data);

    //         // echo $JML_ANG;
    //         // var_dump($data);

    //         for ($i = 0; $i < $JML_ANG; $i++) {

    //             $this->db->insert('pinsimp', $data[]);

    //             // $this->db->query("insert into pinsimp('KODE_ANG','NAMA_ANG','TOTWJB','TOTPOK','TWAJIB','TPOKOK') 
    //             // values('KODE_ANG[$i]','NAMA_ANG[$i]','TOTWJB[$i]','TOTPOK[$i]','TWAJIB[$i]','TPOKOK[$i]')");
    //         }
    //         // echo "good";
    //     }
    // }
}
