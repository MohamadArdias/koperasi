<?php
class Tunggakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tunggakan_model', 'Tunggakan');
        $this->load->model('Pay_model', 'Pay');
        $this->load->model('Kirim_model', 'Kirim');
        // $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->model('Keuangan_model', 'keuangan');
        $this->load->model('Pengurus_model', 'Pengurus');
        $this->load->model('Us_model', 'Us');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function tambah()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Tambah Tunggakan';
        $this->data['THN'] = $THN;
        $this->data['BLN'] = $BLN;

        $this->form_validation->set_rules('KODE', 'Kode anggota', 'required');
        $this->form_validation->set_rules('TUNGGAKAN', 'Tunggakan', 'required');
        $this->form_validation->set_rules('TAMBAH', 'Tambah Tunggakan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('tunggakan/tambah', $this->data);
        } else {
            $aku = $this->Tunggakan->cekAnggotaPin();
            if ($aku != 0) {
                $this->Tunggakan->tambah();
                $this->session->set_flashdata('tambahA', 'berhasil');
                redirect('tunggakan/anggota');
            } else {
                $this->session->set_flashdata('tambahB', 'salah');
                redirect('tunggakan/anggota');
            }
        }
    }

    public function index()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Instansi';
        $this->data['keuangan'] = $this->Tunggakan->getInsTung($THN, $BLN);

        $this->load->view('tunggakan/index', $this->data);
    }

    public function printins($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['keuangan'] = $this->Tunggakan->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['instansi'] = $this->keuangan->getInstansi($KODE_INS);
        $this->data['pengurus'] = $this->keuangan->getPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('tunggakan/printins', $this->data);
    }

    public function printinsang($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['printang'] = $this->Tunggakan->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->data['jumlah'] = $this->Tunggakan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('tunggakan/printinsang', $this->data);
    }

    public function anggota()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Anggota';
        $this->data['keuangan'] = $this->Tunggakan->getAllKeuangan($THN, $BLN);

        $this->load->view('tunggakan/cetakang', $this->data);
    }

    public function printang($KODE_ANG)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        // echo $TAHUN.'-'.$BULAN;

        $this->data['printang'] = $this->Tunggakan->getAnggotaWhereKodeAng($KODE_ANG, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->load->view('tunggakan/printang', $this->data);
    }

    public function cetakAll()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['tunggakan'] = $this->Tunggakan->cetakAll($TAHUN, $BULAN);
        $this->data['pengurus'] = $this->keuangan->getPengurus();
        $this->data['jumlah'] = $this->Tunggakan->jumlahAll($TAHUN, $BULAN);

        $this->load->view('tunggakan/cetakAll', $this->data);
    }

    public function autofill()
    {
        $a = $_GET['KODE'];
        $tahun = $_GET['TAHUN'];
        $bulan = $_GET['BULAN'];

        $query = $this->Tunggakan->getKodeAnggota($a, $tahun, $bulan);

        // $detail = $this->db->query("SELECT SUM(JML_BAYAR) AS jumlah FROM pembayaran_detail WHERE TAHUN = $tahun and BULAN = '$bulan' and KODE_ANG = '$a'")->row();

        if ($query != null) {
            $data = array(
                // 'TAHUN' => $tahun,
                // 'BULAN' => $bulan,
                'nama' => $query['NAMA_ANG'],
                'instansi' => $query['NAMA_INS'],
                'tunggakan' => $query['POKU6'],
            );
            echo json_encode($data);
        }
    }
}
