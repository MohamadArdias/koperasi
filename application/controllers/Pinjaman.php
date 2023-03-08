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
        $a = $this->input->post('KODE_ANG', true);
        $bung = $this->input->post('PRO_ANG');


        if ($kode == 1) {
            $this->data['title'] = 'Pinjaman Uang';
            $kd = 'U';
        } elseif ($kode == 2) {
            $this->data['title'] = 'Pinjaman Non-Konsumsi';
            $kd = 'S';
        } elseif ($kode == 3) {
            $this->data['title'] = 'Pinjaman Konsumsi';
            $kd = 'O';
        } elseif ($kode == 4) {
            $this->data['title'] = 'Pinjaman UUB';
            $kd = 'N';
        } else {
            $this->data['title'] = 'Pinjaman Khusus';
            $kd = 'Z';
        }

        $this->data['urutan'] = $this->Pinuang->getUrut();
        $this->data['kode'] = $kode;

        $min = $this->input->post('TANGGUNGAN');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('TANGGUNGAN', 'Tanggungan', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required|greater_than[' . $min . ']');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/form', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggota();
            if ($aku != 0) {
                $ku = $this->Anggota->cekFaktur();
                if ($ku == 0) {
                    $this->Pinuang->deleteTransaksi($a, $kd);

                    $tgl = $this->input->post('TGLP_ANG');
                    $where_pl = [
                        "TAHUN" => substr($tgl, 0, 4),
                        "BULAN" => substr($tgl, 5, 2),
                        "KODE_ANG" => $this->input->post('KODE_ANG', true),
                    ];

                    $this->db->update('pl', ['KEU' . $kode => 0], $where_pl);
                    $this->Pinuang->tambahTransaksi();
                    $this->Us->tambahTransaksi();
                    // $this->db->update('pl', $pl_uang, $where_uang);
                    // $this->Keuangan->editPlTransaksi($a, $kode);
                    $this->session->set_flashdata('flashP', 'ditambahkan');
                    redirect('pinjaman');
                } else {
                    $this->session->set_flashdata('nofak', 'sudah digunakan');
                    redirect('pinjaman');
                }
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
        $a = $_GET['KODE_ANG'];
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
                'instansi' => $query['NAMA_INS'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA'],
                'jangka' => 0,
                'periode' => 0,
                'sisa' => 0,
                'bunga' => 0,                
                'instansi' => $query2['NAMA_INS'],
            );
            echo json_encode($data);
        }
    }

    public function autofill2()
    {
        $a = $_GET['KODE_ANG'];
        $b = $_GET['KODE'];

        $query = $this->Anggota->getTanggungan($a, $b);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {

            $data = array(
                'nama' => $query['NAMA_ANG'],
                'sisa' => $query['SIPOKU8'],
                'bunga' => $query['BNGU8'],
                'ke_bunga' => $query['KE_BNGU8'],
                'instansi' => $query['NAMA_INS'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA_ANG'],
                'sisa' => 0,
                'bunga' => 0,
                'ke_bunga' => 0,
                'instansi' => $query2['NAMA_INS'],
            );
            echo json_encode($data);
        }
    }

    public function kantor()
    {
        $this->data['title'] = 'Pinjaman Kantor';

        $a = $this->input->post('KODE_ANG', true);
        $min = $this->input->post('TANGGUNGAN');

        $this->data['urutan'] = $this->Pinuang->getUrut();

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required|greater_than[' . $min . ']');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        $bung = $this->input->post('PRO_ANG');
        $kd = 'R';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/kantor', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggota();
            $jmlp_ang = $this->input->post('JMLP_ANG', true);

            if ($aku != 0) {
                $ku = $this->Anggota->cekFaktur();
                if ($ku == 0) {
                    $tgl = $this->input->post('TGLP_ANG');

                    $pl = [
                        "KEU8" => 0,
                        "KE_BNGU8" => 0,
                        "SIPOKU8" => $jmlp_ang,
                    ];
                    $where_pl = [
                        "TAHUN" => substr($tgl, 0, 4),
                        "BULAN" => substr($tgl, 5, 2),
                        "KODE_ANG" => $this->input->post('KODE_ANG', true),
                    ];
                    $this->db->update('pl', $pl, $where_pl);

                    $this->Pinuang->deleteTransaksi($a, $kd);
                    $this->Pinuang->tambahTransaksi();
                    $this->Us->tambahTransaksi();
                    // $this->db->update('pl', $pl_uang, $where_uang);
                    // $this->Keuangan->editPlTransaksi($a, $kode);
                    $this->session->set_flashdata('flashP', 'ditambahkan');
                    redirect('pinjaman');
                } else {
                    $this->session->set_flashdata('nofak', 'sudah digunakan');
                    redirect('pinjaman');
                }
            } else {
                $this->session->set_flashdata('pinggl', 'salah');
                redirect('pinjaman');
            }
        }
    }

    public function edit($NOFAK)
    {
        $this->data['title'] = 'Edit Pinjaman ' . $NOFAK;
        $this->data['edit'] = $this->Us->editPinjaman($NOFAK);

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/formEdit', $this->data);
        } else {
            $this->Pinuang->editTransaksi();
            $this->Us->editTransaksi();
            $this->session->set_flashdata('flashP', 'diubah');
            redirect('pinjaman');
        }
    }
}
