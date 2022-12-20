<?php
class Pinjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->model('Us_model', 'Us');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pinjaman';
        $this->data['us'] = $this->Us->getTrx();

        $this->load->view('pinjaman/index', $this->data);
    }

    public function form($kode)
    {
        $a = $this->input->post('URUT_ANG', true);

        if ($kode == 1) {
            $this->data['title'] = 'Pinjaman Uang';
            $kd = 'U';
        } elseif ($kode == 2) {
            $this->data['title'] = 'Pinjaman UUB';
            $kd = 'S';
        } elseif ($kode == 3) {
            $this->data['title'] = 'Pinjaman Konsumsi';
            $kd = 'O';
        } elseif ($kode == 4) {
            $this->data['title'] = 'Pinjaman Non-Konsumsi';
            $kd = 'N';
        } else {
            $this->data['title'] = 'Pinjaman Khusus';
            $kd = 'Z';
        }

        $this->data['urutan'] = $this->Pinuang->getUrut();
        $this->data['kode'] = $kode;


        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('TANGGUNGAN', 'Tanggungan', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        $bung = $this->input->post('PRO_ANG');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/form', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggota();

            if ($aku != 0) {
                $this->Pinuang->deleteTransaksi($a, $kd);
                $this->Pinuang->tambahTransaksi();
                $this->Us->tambahTransaksi();
                // $this->Keuangan->editPlTransaksi($a, $kode);
                $this->session->set_flashdata('flashP', 'ditambahkan');
                redirect('pinjaman');
            } else {
                $this->session->set_flashdata('pinggl', 'salah');
                redirect('pinjaman');
            }
        }
    }

    public function print()
    {
        $this->data['title'] = 'Cetak Pinjaman';
        $this->load->view('pinjaman/print', $this->data);
    }

    public function autofill()
    {
        $a = $_GET['URUT_ANG'];
        $b = $_GET['KODE'];

        $query = $this->Anggota->getTanggungan($a, $b);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {
            if ($b == 'U') {
                $jangka = $query['JWK1'];
                $periode = $query['KEU1'];
                $sisa = $query['SIPOKU1'];
                $bunga = $query['BNGU1'];
            } elseif ($b == 'O') {
                $jangka = $query['JWK2'];
                $periode = $query['KEU2'];
                $sisa = $query['SIPOKU2'];
                $bunga = $query['BNGU2'];
            } elseif ($b == 'N') {
                $jangka = $query['JWK3'];
                $periode = $query['KEU3'];
                $sisa = $query['SIPOKU3'];
                $bunga = $query['BNGU3'];
            } elseif ($b == 'Z') {
                $jangka = $query['JWK7'];
                $periode = $query['KEU7'];
                $sisa = $query['SIPOKU7'];
                $bunga = $query['BNGU7'];
            } elseif ($b == 'S') {
                $jangka = $query['JWK4'];
                $periode = $query['KEU4'];
                $sisa = $query['SIPOKU4'];
                $bunga = $query['BNGU4'];
            }
            $data = array(
                'nama' => $query['NAMA_ANG'],
                'jangka' => $jangka,
                'periode' => $periode,
                'sisa' => $sisa,
                'bunga' => $bunga,
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA'],
                'jangka' => 0,
                'periode' => 0,
                'sisa' => 0,
                'bunga' => 0,
            );
            echo json_encode($data);
        }
    }

    public function off($NOFAK)
    {
        $this->db->query("UPDATE us SET STATUS_US = 'OFF' WHERE NOFAK = '$NOFAK'");
        $this->db->query("UPDATE pinuang SET STATUS_PIN = 'OFF' WHERE NOFAK = '$NOFAK'");
        // $this->db->delete('us', ['KODE_ANG' => $KODE_ANG]);
        // $this->session->set_flashdata('flash', 'dihapus');
        redirect('pinjaman');
    }
}
