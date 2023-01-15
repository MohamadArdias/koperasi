<?php

class Pelunasan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pay_model', 'Pay');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pelunasan';

        $NOFAK = $this->input->get('NOFAK');
        $KODE = $this->input->get('KODE');

        $this->data['lunas'] = $this->Pay->pelunasan($NOFAK, $KODE);

        $this->form_validation->set_rules('JML_BAYAR', 'Uang Diterima', 'required');
        $this->form_validation->set_rules('TGL_BAYAR', 'Tanggal Pelunasan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pelunasan/index', $this->data);
        } else {
            $a = $this->input->post('PELUNASAN', true);
            $b = $this->input->post('JML_BAYAR', true);

            $thn = $this->input->post('TAHUN', true);
            $bln = $this->input->post('BULAN', true);

            if ($a == $b) {
                $nofak = $this->input->post('NOFAK', true);

                if (strpos($nofak, 'U') !== false) {
                    $angka = 1;
                } elseif (strpos($nofak, 'N') !== false) {
                    $angka = 3;
                } elseif (strpos($nofak, 'O') !== false) {
                    $angka = 2;
                } elseif (strpos($nofak, 'Z') !== false) {
                    $angka = 7;
                } elseif (strpos($nofak, 'S') !== false) {
                    $angka = 4;
                }

                // echo 'KEU' . $angka;

                // update pinuang
                $pinuang_uang = [
                    'JMLP_ANG' => 0,
                    'PRO_ANG' => 0,
                    'KE_ANG' => 0,
                    'JWKT_ANG' =>  0,
                ];
                $pin_where = [
                    'NOFAK' => $this->input->post('NOFAK', true),
                    'TAHUN' => $this->input->post('TAHUN', true),
                    'BULAN' => $this->input->post('BULAN', true),
                ];
                $this->db->update('pinuang', $pinuang_uang, $pin_where);

                // update pl 
                $pl_uang = array(
                    'KEU' . $angka => 0,
                    'JWK' . $angka => 0,
                    'POKU' . $angka => 0,
                    'SIPOKU' . $angka => 0,
                    'BNGU' . $angka => 0,
                );

                $where_uang = array(
                    'TAHUN' => $thn,
                    'BULAN' => $bln,
                    'KODE_ANG' => $this->input->post('KODE', true),
                );
                $this->db->update('pl', $pl_uang, $where_uang);

                $this->session->set_flashdata('lunasB', 'berhasil');
                redirect('pinsim/pinjaman');
            } else {
                $this->session->set_flashdata('lunasG', 'gagal');
                redirect('pinsim/pinjaman');
            }








            // //     $aku = $this->Anggota->cekAnggotaPin();
            // //     if ($aku != 0) {
            // // //         $this->session->set_flashdata('bayarG', 'salah');
            // //         redirect('Pay');//         $this->Pay->bayar();
            // //         $this->session->set_flashdata('bayarB', 'berhasil');
            // //         redirect('Pay');
            // //     } else {
            // //         $this->session->set_flashdata('bayarG', 'salah');
            // //         redirect('Pay');
            // //     }
        }
    }

    // public function autofill()
    // {
    //     $a = $_GET['KODE'];

    //     $query = $this->Pay->getKodeAnggota($a);

    //     if ($query != null) {
    //         if ($query['STATUS'] == 'TERBAYAR') {
    //             $data = array(
    //                 'nama' => $query['NAMA_ANG'],
    //                 'tagihan' => 0,
    //                 'bayar' => 0,
    //                 'tunggakan' => 0,
    //             );
    //         } else {
    //             $data = array(
    //                 'nama' => $query['NAMA_ANG'],
    //                 'tagihan' => $query['JML_TGHN'],
    //                 'bayar' => $query['JML_BAYAR'],
    //                 'tunggakan' => $query['TUNGGAKAN'],
    //             );
    //         }
    //         echo json_encode($data);
    //     }
    // }
}
