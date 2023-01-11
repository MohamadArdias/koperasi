<?php
class generate2 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->model('Pembayaran_model', 'Pembayaran');
    }

    public function index()
    {
        $this->data['title'] = 'Generate Simpanan';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['simpan'] = $this->Pinsimp->simp($THN, $BLN);

        $this->load->view('generate2/index', $this->data);
    }
    

    public function pinjaman()
    {
        $this->data['title'] = 'Generate Pinjaman';
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['pinjaman'] = $this->Pinuang->pinjaman($THN, $BLN);

        $this->load->view('generate2/pinjaman', $this->data);
    }

    public function tagihan()
    {
        $this->data['title'] = 'Generate Tagihan';
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['tagihan'] = $this->Pembayaran->getTagihan($THN, $BLN);

        $this->load->view('generate2/tagihan', $this->data);
    }

    // public function konsum()
    // {
    //     $this->data['title'] = 'Generate Pinjaman Konsumi';
    //     $this->data['uang'] = $this->Pinuang->getKons();

    //     $this->load->view('generate2/konsum', $this->data);
    // }

    // public function khusus()
    // {
    //     $this->data['title'] = 'Generate Pinjaman Khusus';
    //     $this->data['uang'] = $this->Pinuang->getKhusus();

    //     $this->load->view('generate2/khusus', $this->data);
    // }

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
