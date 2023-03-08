<?php

ini_set('default_socket_timeout', 6000);
class Genta extends CI_Controller
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

    public function simpan()
    {
        $DATE = $this->input->get('GEN_SIMP');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }

        if ($BLN > 8) {
            if ($BLN == 12) {
                $thn = $THN + 1;
                $bln = '01';
            } else {
                $thn = $THN;
                $bln = $BLN + 1;
            }
        } else {
            $thn = $THN;
            $bln = "0" . ($BLN + 1);
        }

        $simpan = $this->Pinsimp->getAllSimp($THN, $BLN);

        // echo $thn."-".$bln."<br>";
        // echo "halo";

        foreach ($simpan as $key) {
            // pinsimp
            if ($bln == 12) {
                $totwjb = $key['TWAJIB'] + 100000;
                $totpok = $key['TPOKOK'];
                // $trela = $key['TOTREL']+$key['RELA'];
            } else {
                $totwjb = $key['TOTWJB'];
                $totpok = $key['TOTPOK'];
                // $trela = $key['TOTREL'];
            }

            if ($key['TPOKOK'] == 0) {
                $pokok = 50000;
            } else {
                $pokok = 0;
            }

            // $rela = (TOTWJB+TOTREL)*0.00371;
            // $rela = round(($key['TOTREL']+$key['TOTWJB'])*0.00371);

            if ($key['KODE_INS'] != 53) {
                $pinsimp = array(
                    'TAHUN' => $thn,
                    'BULAN' => $bln,
                    'KODE_ANG' => $key['KODE_ANG'],
                    'TOTWJB' => $totwjb,
                    'TOTPOK' => 50000,
                    'TOTREL' => $key['TOTREL'],
                    'KET' => $key['KET'],
                );

                // pl
                $pl = array(
                    'TAHUN' => $thn,
                    'BULAN' => $bln,
                    'KODE_ANG' => $key['KODE_ANG'],
                    'WAJIB' => 100000,
                    'TPOKOK' => 50000,
                    'TWAJIB' => $key['TWAJIB'] + 100000,
                    'POKOK' => $pokok,
                );
            } else {
                $pinsimp = array(
                    'TAHUN' => $thn,
                    'BULAN' => $bln,
                    'KODE_ANG' => $key['KODE_ANG'],
                    'TOTWJB' => $key['TWAJIB'],
                    'TOTPOK' => $key['TOTPOK'],
                    'TOTREL' => $key['TOTREL'],
                    'KET' => $key['KET'],
                );

                // pl
                $pl = array(
                    'TAHUN' => $thn,
                    'BULAN' => $bln,
                    'KODE_ANG' => $key['KODE_ANG'],
                    'WAJIB' => $key['WAJIB'],
                    'TPOKOK' => $key['TPOKOK'],
                    'TWAJIB' => $key['TWAJIB'],
                    'POKOK' => $key['POKOK'],
                );
            }

            $where = [
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG']
            ];

            $kode = $key['KODE_ANG'];

            $cek_pinsim = $this->Pinsimp->cek($thn, $bln, $kode);

            if ($cek_pinsim < 1) {
                $this->db->insert('pinsimp', $pinsimp);
                $this->db->insert('pl', $pl);
            } else {
                $this->db->update('pinsimp', $pinsimp, $where);
                $this->db->update('pl', $pl, $where);
            }            

            // $this->db->where('KODE_ANG', $key['KODE_ANG']);
            // $this->db->where('TAHUN', $thn);
            // $this->db->where('BULAN', $bln);
            // $this->db->delete('pinsimp');
            // $this->db->insert('pinsimp', $pinsimp);

            // $this->db->where('KODE_ANG', $key['KODE_ANG']);
            // $this->db->where('TAHUN', $thn);
            // $this->db->where('BULAN', $bln);
            // $this->db->delete('pl');
            // $this->db->insert('pl', $pl);
        }
        $this->session->set_flashdata('simpanGen', 'Berhasil');
        redirect('generate2?TAHUN=' . $thn . '&&BULAN=' . $bln);
    }

    public function pinjaman()
    {
        $DATE = $this->input->get('GEN_SIMP');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }

        if ($BLN > 8) {
            if ($BLN == 12) {
                $thn = $THN + 1;
                $bln = '01';
            } else {
                $thn = $THN;
                $bln = $BLN + 1;
            }
        } else {
            $thn = $THN;
            $bln = "0" . ($BLN + 1);
        }

        // echo $thn.'+'.$bln;
        // echo "halo2";
        $pinjaman = $this->Pinuang->getAllPinjaman($THN, $BLN);

        foreach ($pinjaman as $key) {

            if (strpos($key['NOFAK'], 'U') !== false) {
                $angka = 1;
            } elseif (strpos($key['NOFAK'], 'N') !== false) {
                $angka = 3;
            } elseif (strpos($key['NOFAK'], 'O') !== false) {
                $angka = 2;
            } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                $angka = 7;
            } elseif (strpos($key['NOFAK'], 'S') !== false) {
                $angka = 4;
            }

            if ($key['KEU' . $angka] == $key['JWKT_ANG']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $KEU1 = 0;
                $POKU1 = 0;
                $SIPOKU1 = 0;
                $JWKT_ANG = 0;
                $BNGU1 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU1 = $key['KEU' . $angka] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU1;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU1 = 0;
                } else {
                    $POKU1 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU'.$angka]                                
                }
                $SIPOKU1 = $JMLP_ANG - ($POKU1 * $KEU1); //$key['SIPOKU'.$angka]-$key['POKU'.$angka] //$key['SIPOKU'.$angka]-$POKU1;
                $BNGU1 = $JMLP_ANG * ($PRO_ANG / 100);
                $CICILAN = $JMLP_ANG - $SIPOKU1;
            }

            $pinuang_uang = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'NOFAK' => $key['NOFAK'],
                'KODE_ANG' => $key['KODE_ANG'],
                'TGLP_ANG' => $key['TGLP_ANG'],
                'TGLT_ANG' => $key['TGLT_ANG'],
                'JMLP_ANG' => $JMLP_ANG,
                'PRO_ANG' => $PRO_ANG,
                'KE_ANG' => $KE_ANG,
                'JWKT_ANG' =>  $JWKT_ANG,
            );

            $kode = $key['NOFAK'];
            $cek_pinsim = $this->Pinuang->cek($thn, $bln, $kode);

            $where = [
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'NOFAK' => $key['NOFAK']
            ];

            if ($cek_pinsim < 1) {
                $this->db->insert('pinuang', $pinuang_uang);
            } else {
                $this->db->update('pinuang', $pinuang_uang, $where);
            }   

            // // delete pinunag
            // $this->db->where('KODE_ANG', $key['KODE_ANG']);
            // $this->db->where('TAHUN', $thn);
            // $this->db->where('BULAN', $bln);
            // $this->db->where('NOFAK', $key['NOFAK']);
            // $this->db->delete('pinuang');
            // // insert pinuang 
            // $this->db->insert('pinuang', $pinuang_uang);

            $pl_uang = array(
                'KEU' . $angka => $KEU1,
                'JWK' . $angka => $JWKT_ANG,
                'POKU' . $angka => round($POKU1),
                'SIPOKU' . $angka => round($SIPOKU1),
                'BNGU' . $angka => $BNGU1,
            );
            // update pl 
            $where_uang = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_uang, $where_uang);
        }

        $kantor = $this->Pinuang->pinjKantor($THN, $BLN);

        foreach ($kantor as $key) {
            if ($key['POKU8'] == $key['SIPOKU8']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $JWKT_ANG = 0;
                $KEU1 = 0;
                $POKU1 = 0;
                $SIPOKU1 = 0;
                $KE_BNGU1 = 0;
                $BNGU1 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU1 = $key['KEU8'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU1;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                $POKU1 = 0;
                $SIPOKU1 = $key['SIPOKU8']-$key['POKU8'];

                if ($key['POKU8'] == 0) {
                    $KE_BNGU1 = $key['KE_BNGU8']+1;                    
                }else {
                    $KE_BNGU1 = 1;
                }

                $byr_bunga = $key['KE_BNGU8']*$key['BNGU8'];
                $byr_pokok = $key['JML_BAYAR']+$key['BAYAR_BANK'];

                if ($byr_pokok<$byr_bunga) {
                    $BNGU1 = $key['BNGU8'];
                }else {
                    $BNGU1 = $key['SIPOKU8'] * ($PRO_ANG / 100);                    
                }



                // $CICILAN = $JMLP_ANG - $SIPOKU1;
            }

            $pinuang_uang = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'NOFAK' => $key['NOFAK'],
                'KODE_ANG' => $key['KODE_ANG'],
                'TGLP_ANG' => $key['TGLP_ANG'],
                'TGLT_ANG' => $key['TGLT_ANG'],
                'JMLP_ANG' => $JMLP_ANG,
                'PRO_ANG' => $PRO_ANG,
                'KE_ANG' => $KE_ANG,
                'JWKT_ANG' =>  $JWKT_ANG,
            );

            $kode = $key['NOFAK'];
            $cek_pinsim = $this->Pinuang->cek($thn, $bln, $kode);

            $where = [
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'NOFAK' => $key['NOFAK']
            ];

            if ($cek_pinsim < 1) {
                $this->db->insert('pinuang', $pinuang_uang);
            } else {
                $this->db->update('pinuang', $pinuang_uang, $where);
            }   



            // // delete pinunag
            // $this->db->where('KODE_ANG', $key['KODE_ANG']);
            // $this->db->where('TAHUN', $thn);
            // $this->db->where('BULAN', $bln);
            // $this->db->where('NOFAK', $key['NOFAK']);
            // $this->db->delete('pinuang');
            // // insert pinuang 
            // $this->db->insert('pinuang', $pinuang_uang);

            $pl_uang = array(
                'KEU8' => $KEU1,
                'JWK8' => $JWKT_ANG,
                'POKU8' => round($POKU1),
                'SIPOKU8' => round($SIPOKU1),
                'BNGU8' => $BNGU1,
                'KE_BNGU8' => $KE_BNGU1,
            );
            // update pl 
            $where_uang = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_uang, $where_uang);
        }

        $this->session->set_flashdata('pinjamGen', 'Berhasil');
        redirect('generate2/pinjaman?TAHUN=' . $thn . '&&BULAN=' . $bln);
    }

    public function pembayaran()
    {
        $DATE = $this->input->get('GEN_SIMP');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }

        if ($BLN > 8) {
            if ($BLN == 12) {
                $thn = $THN + 1;
                $bln = '01';
            } else {
                $thn = $THN;
                $bln = $BLN + 1;
            }
        } else {
            $thn = $THN;
            $bln = "0" . ($BLN + 1);
        }

        $pembayaran = $this->Keuangan->inPembayaran($thn, $bln);
        $tunggakan = $this->Pembayaran->getTunggakan($THN, $BLN);
        foreach ($tunggakan as $key) {

            if ($key['JML_BAYAR'] < $key['JML_TGHN']) {
                $tunggakan = $key['JML_TGHN'] - $key['JML_BAYAR'];
            } else {
                $tunggakan = 0;
            }

            $tung = array(
                'POKU6' => $tunggakan,
            );

            // update pl 
            $where_tung = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );

            $this->db->update('pl', $tung, $where_tung);
        }

        foreach ($pembayaran as $key) {

            $a = $key['POKU3'] + $key['BNGU3']
                + $key['POKU4'] + $key['BNGU4']
                + $key['POKU1'] + $key['BNGU1']
                + $key['POKU7'] + $key['BNGU7']
                + $key['POKU2'] + $key['WAJIB']
                + $key['POKOK'] + $key['POKU6'];  // POKU6 adalah tunggakan

            $bayar = array(
                'KODE_ANG' => $key['KODE_ANG'],
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'TGL_TGHN' => date('Y-m-d'),
                'JML_TGHN' => $a,
                'STATUS' => 'BELUM TERBAYAR',
            );

            $kode = $key['KODE_ANG'];
            $cek_pinsim = $this->Pembayaran->cek($thn, $bln, $kode);

            $where = [
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG']
            ];

            if ($cek_pinsim < 1) {
                $this->db->insert('pembayaran', $bayar);
            } else {
                $this->db->update('pembayaran', $bayar, $where);
            }   

            // $this->db->where('KODE_ANG', $key['KODE_ANG']);
            // $this->db->where('TAHUN', $thn);
            // $this->db->where('BULAN', $bln);
            // // $this->db->like('TGL_TGHN', $thn.'-'.$bln);
            // $this->db->delete('pembayaran');
            // // insert pembayaran

            // $this->db->insert('pembayaran', $bayar);
        }

        $this->session->set_flashdata('pembayaranGen', 'Berhasil');
        redirect('generate2/tagihan?TAHUN=' . $thn . '&&BULAN=' . $bln);
    }

    // public function cek()
    // {
    //     $thn = 2023;
    //     $bln = '03';
    //     $kode = '1541';
    //     $cek_pinsim = $this->Pinsimp->cek($thn, $bln, $kode);

    //     echo 'ada :'.$cek_pinsim;
    // }
}
