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

    // public function index()
    // {
    //     $simpan = $this->Pinsimp->getAllSimp();
    //     $uang = $this->Pinuang->getUang();
    //     $non = $this->Pinuang->getNon();
    //     $kons = $this->Pinuang->getKons();
    //     $khus = $this->Pinuang->getKhusus();
    //     $pembayaran = $this->Keuangan->inPembayaran();
    //     $tunggakan = $this->Pembayaran->getTunggakan();

    //     foreach ($simpan as $key) {
    //             // pinsimp
    //             if (date('m') == 11) {
    //                 $totwjb = $key['TWAJIB'] + 100000;
    //                 $totpok = $key['TPOKOK'];
    //             } else {
    //                 $totwjb = $key['TOTWJB'];
    //                 $totpok = $key['TOTPOK'];
    //             }

    //             if ($key['TPOKOK'] == 0) {
    //                 $pokok = 50000;
    //             } else {
    //                 $pokok = 0;
    //             }

    //             $pinsimp = array(
    //                 'TAHUN' => date('Y', strtotime('+1 month')),
    //                 'BULAN' => date('m', strtotime('+1 month')),
    //                 'KODE_ANG' => $key['KODE_ANG'],
    //                 'TOTWJB' => $totwjb,
    //                 'TOTPOK' => 50000,                 
    //             );
    //             $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //             $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //             $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //             $this->db->delete('pinsimp');
    //             $this->db->insert('pinsimp', $pinsimp);

    //             // pl
    //             $pl = array(
    //                 'TAHUN' => date('Y', strtotime('+1 month')),
    //                 'BULAN' => date('m', strtotime('+1 month')),
    //                 'KODE_ANG' => $key['KODE_ANG'],
    //                 'WAJIB' => 100000,
    //                 'TPOKOK' => 50000,
    //                 'TWAJIB' => $key['TWAJIB'] + 100000,
    //                 'POKOK' => $pokok,
    //             );
    //             $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //             $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //             $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //             $this->db->delete('pl');
    //             $this->db->insert('pl', $pl);
    //     }

    //     foreach ($uang as $key) {

    //         if ($key['KEU1'] == $key['JWKT_ANG']) {
    //             $STATUS = 'LUNAS';
    //         } else {
    //             $STATUS = 'BELUM LUNAS';
    //         }

    //         if ($STATUS == 'LUNAS') {
    //             $JMLP_ANG = 0;
    //             $PRO_ANG = 0;
    //             $KE_ANG = 0;
    //             $KEU1 = 0;
    //             $POKU1 = 0;
    //             $SIPOKU1 = 0;
    //             $JWKT_ANG = 0;
    //             $BNGU1 = 0;
    //             // $CICILAN = 0;
    //         } else {
    //             $JMLP_ANG = $key['JMLP_ANG'];
    //             $PRO_ANG = $key['PRO_ANG'];
    //             $KEU1 = $key['KEU1'] + 1;
    //             $JWKT_ANG = $key['JWKT_ANG'];


    //             if (date('m') == 11) {
    //                 $KE_ANG = $KEU1;
    //             } else {
    //                 $KE_ANG = $key['KE_ANG'];
    //             }

    //             if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
    //                 $POKU1 = 0;
    //             } else {
    //                 $POKU1 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU1']                                
    //             }
    //             $SIPOKU1 = $JMLP_ANG - ($POKU1 * $KEU1); //$key['SIPOKU1']-$key['POKU1'] //$key['SIPOKU1']-$POKU1;
    //             $BNGU1 = $JMLP_ANG * ($PRO_ANG / 100);
    //             $CICILAN = $JMLP_ANG - $SIPOKU1;
    //         }

    //         $pinuang_uang = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'NOFAK' => $key['NOFAK'],
    //             'KODE_ANG' => $key['KODE_ANG'],
    //             'TGLP_ANG' => $key['TGLP_ANG'],
    //             'TGLT_ANG' => $key['TGLT_ANG'],
    //             'JMLP_ANG' => $JMLP_ANG,
    //             'PRO_ANG' => $PRO_ANG,
    //             'KE_ANG' => $KE_ANG,
    //             'JWKT_ANG' =>  $JWKT_ANG,
    //         );
    //         // delete pinunag
    //         $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //         $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //         $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //         $this->db->where('NOFAK', $key['NOFAK']);
    //         $this->db->delete('pinuang');
    //         // insert pinuang 
    //         $this->db->insert('pinuang', $pinuang_uang);

    //         $pl_uang = array(
    //             'KEU1' => $KEU1,
    //             'JWK1' => $JWKT_ANG,
    //             'POKU1' => round($POKU1),
    //             'SIPOKU1' => round($SIPOKU1),
    //             'BNGU1' => $BNGU1,
    //         );
    //         // update pl 
    //         $where_uang = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'KODE_ANG' => $key['KODE_ANG'],
    //         );
    //         $this->db->update('pl', $pl_uang, $where_uang);
    //     }

    //     foreach ($non as $key) {

    //         if ($key['KEU3'] == $key['JWKT_ANG']) {
    //             $STATUS = 'LUNAS';
    //         } else {
    //             $STATUS = 'BELUM LUNAS';
    //         }

    //         if ($STATUS == 'LUNAS') {
    //             $JMLP_ANG = 0;
    //             $PRO_ANG = 0;
    //             $KE_ANG = 0;
    //             $KEU3 = 0;
    //             $POKU3 = 0;
    //             $SIPOKU3 = 0;
    //             $JWKT_ANG = 0;
    //             $BNGU3 = 0;
    //             // $CICILAN = 0;
    //         } else {
    //             $JMLP_ANG = $key['JMLP_ANG'];
    //             $PRO_ANG = $key['PRO_ANG'];
    //             $KEU3 = $key['KEU3'] + 1;
    //             $JWKT_ANG = $key['JWKT_ANG'];


    //             if (date('m') == 11) {
    //                 $KE_ANG = $KEU3;
    //             } else {
    //                 $KE_ANG = $key['KE_ANG'];
    //             }

    //             if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
    //                 $POKU3 = 0;
    //             } else {
    //                 $POKU3 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU3']                                
    //             }
    //             $SIPOKU3 = $JMLP_ANG - ($POKU3 * $KEU3); //$key['SIPOKU3']-$key['POKU3'] //$key['SIPOKU3']-$POKU3;
    //             $BNGU3 = $JMLP_ANG * ($PRO_ANG / 100);
    //             $CICILAN = $JMLP_ANG - $SIPOKU3;
    //         }

    //         $pinuang_non = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'NOFAK' => $key['NOFAK'],
    //             'KODE_ANG' => $key['KODE_ANG'],
    //             'TGLP_ANG' => $key['TGLP_ANG'],
    //             'TGLT_ANG' => $key['TGLT_ANG'],
    //             'JMLP_ANG' => $JMLP_ANG,
    //             'PRO_ANG' => $PRO_ANG,
    //             'KE_ANG' => $KE_ANG,
    //             'JWKT_ANG' =>  $JWKT_ANG,
    //         );
    //         // delete pinunag
    //         $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //         $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //         $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //         $this->db->where('NOFAK', $key['NOFAK']);
    //         $this->db->delete('pinuang');
    //         // insert pinuang 
    //         $this->db->insert('pinuang', $pinuang_non);

    //         $pl_non = array(
    //             'KEU3' => $KEU3,
    //             'JWK3' => $JWKT_ANG,
    //             'POKU3' => round($POKU3),
    //             'SIPOKU3' => round($SIPOKU3),
    //             'BNGU3' => $BNGU3,
    //         );
    //         // update pl 
    //         $where_non = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'KODE_ANG' => $key['KODE_ANG'],
    //         );
    //         $this->db->update('pl', $pl_non, $where_non);
    //     }

    //     foreach ($khus as $key) {

    //         if ($key['KEU7'] == $key['JWKT_ANG']) {
    //             $STATUS = 'LUNAS';
    //         } else {
    //             $STATUS = 'BELUM LUNAS';
    //         }

    //         if ($STATUS == 'LUNAS') {
    //             $JMLP_ANG = 0;
    //             $PRO_ANG = 0;
    //             $KE_ANG = 0;
    //             $KEU7 = 0;
    //             $POKU7 = 0;
    //             $SIPOKU7 = 0;
    //             $JWKT_ANG = 0;
    //             $BNGU7 = 0;
    //             // $CICILAN = 0;
    //         } else {
    //             $JMLP_ANG = $key['JMLP_ANG'];
    //             $PRO_ANG = $key['PRO_ANG'];
    //             $KEU7 = $key['KEU7'] + 1;
    //             $JWKT_ANG = $key['JWKT_ANG'];


    //             if (date('m') == 11) {
    //                 $KE_ANG = $KEU7;
    //             } else {
    //                 $KE_ANG = $key['KE_ANG'];
    //             }

    //             if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
    //                 $POKU7 = 0;
    //             } else {
    //                 $POKU7 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU7']                                
    //             }
    //             $SIPOKU7 = $JMLP_ANG - ($POKU7 * $KEU7); //$key['SIPOKU7']-$key['POKU7'] //$key['SIPOKU7']-$POKU7;
    //             $BNGU7 = $JMLP_ANG * ($PRO_ANG / 100);
    //             // $CICILAN = $JMLP_ANG - $SIPOKU7;
    //         }

    //         $pinuang_khusus = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'NOFAK' => $key['NOFAK'],
    //             'KODE_ANG' => $key['KODE_ANG'],
    //             'TGLP_ANG' => $key['TGLP_ANG'],
    //             'TGLT_ANG' => $key['TGLT_ANG'],
    //             'JMLP_ANG' => $JMLP_ANG,
    //             'PRO_ANG' => $PRO_ANG,
    //             'KE_ANG' => $KE_ANG,
    //             'JWKT_ANG' =>  $JWKT_ANG,
    //         );
    //         // delete pinunag
    //         $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //         $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //         $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //         $this->db->where('NOFAK', $key['NOFAK']);
    //         $this->db->delete('pinuang');
    //         // insert pinuang 
    //         $this->db->insert('pinuang', $pinuang_khusus);

    //         $pl_khusus = array(
    //             'KEU7' => $KEU7,
    //             'JWK7' => $JWKT_ANG,
    //             'POKU7' => round($POKU7),
    //             'SIPOKU7' => round($SIPOKU7),
    //             'BNGU7' => $BNGU7,
    //         );
    //         // update pl 
    //         $where_khusus = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'KODE_ANG' => $key['KODE_ANG'],
    //         );
    //         $this->db->update('pl', $pl_khusus, $where_khusus);
    //     }

    //     foreach ($kons as $key) {

    //         if ($key['KEU2'] == $key['JWKT_ANG']) {
    //             $STATUS = 'LUNAS';
    //         } else {
    //             $STATUS = 'BELUM LUNAS';
    //         }

    //         if ($STATUS == 'LUNAS') {
    //             $JMLP_ANG = 0;
    //             $PRO_ANG = 0;
    //             $KE_ANG = 0;
    //             $KEU2 = 0;
    //             $POKU2 = 0;
    //             $SIPOKU2 = 0;
    //             $JWKT_ANG = 0;
    //             $BNGU2 = 0;
    //             // $CICILAN = 0;
    //         } else {
    //             $JMLP_ANG = $key['JMLP_ANG'];
    //             $PRO_ANG = $key['PRO_ANG'];
    //             $KEU2 = $key['KEU2'] + 1;
    //             $JWKT_ANG = $key['JWKT_ANG'];


    //             if (date('m') == 11) {
    //                 $KE_ANG = $KEU2;
    //             } else {
    //                 $KE_ANG = $key['KE_ANG'];
    //             }

    //             if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
    //                 $POKU2 = 0;
    //             } else {
    //                 $POKU2 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU2']                                
    //             }
    //             $SIPOKU2 = $JMLP_ANG - ($POKU2 * $KEU2); //$key['SIPOKU2']-$key['POKU2'] //$key['SIPOKU2']-$POKU2;
    //             $BNGU2 = $JMLP_ANG * ($PRO_ANG / 100);
    //             // $CICILAN = $JMLP_ANG - $SIPOKU2;
    //         }

    //         $pinuang_kons = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'NOFAK' => $key['NOFAK'],
    //             'KODE_ANG' => $key['KODE_ANG'],
    //             'TGLP_ANG' => $key['TGLP_ANG'],
    //             'TGLT_ANG' => $key['TGLT_ANG'],
    //             'JMLP_ANG' => $JMLP_ANG,
    //             'PRO_ANG' => $PRO_ANG,
    //             'KE_ANG' => $KE_ANG,
    //             'JWKT_ANG' =>  $JWKT_ANG,
    //         );
    //         // delete pinunag
    //         $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //         $this->db->where('TAHUN', date('Y', strtotime('+1 month')));
    //         $this->db->where('BULAN', date('m', strtotime('+1 month')));
    //         $this->db->where('NOFAK', $key['NOFAK']);
    //         $this->db->delete('pinuang');
    //         // insert pinuang 
    //         $this->db->insert('pinuang', $pinuang_kons);

    //         $pl_khusus = array(
    //             'KEU2' => $KEU2,
    //             'JWK2' => $JWKT_ANG,
    //             'POKU2' => round($POKU2),
    //             'SIPOKU2' => round($SIPOKU2),
    //             'BNGU2' => $BNGU2,
    //         );
    //         // update pl 
    //         $where_kons = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'KODE_ANG' => $key['KODE_ANG'],
    //         );
    //         $this->db->update('pl', $pl_khusus, $where_kons);
    //     }

    //     foreach ($tunggakan as $key) {

    //         if ($key['STATUS'] == 'BELUM TERBAYAR') {
    //             $tunggakan = $key['JML_TGHN'];
    //         } elseif ($key['STATUS'] == 'SEBAGIAN') {
    //             $tunggakan = $key['JML_TGHN'] - $key['JML_BAYAR'];
    //         } else {
    //             $tunggakan = 0;
    //         }

    //         $tung = array(
    //             'TUNGGAKAN' => $tunggakan,
    //         );

    //         // update pl 
    //         $where_tung = array(
    //             'TAHUN' => date('Y', strtotime('+1 month')),
    //             'BULAN' => date('m', strtotime('+1 month')),
    //             'KODE_ANG' => $key['KODE_ANG'],
    //         );

    //         $this->db->update('pl', $tung, $where_tung);
    //     }

    //     foreach ($pembayaran as $key) {

    //         $a = $key['POKU3'] + $key['BNGU3']
    //             + $key['POKU1'] + $key['BNGU1']
    //             + $key['POKU7'] + $key['BNGU7']
    //             + $key['POKU2'] + $key['WAJIB']
    //             + $key['POKOK'] + $key['TUNGGAKAN'];

    //         $bayar = array(
    //             'KODE_ANG' => $key['KODE_ANG'],
    //             'TGL_TGHN' => date('Y-m-d'),
    //             'JML_TGHN' => $a,
    //             'STATUS' => 'BELUM TERBAYAR',
    //         );

    //         $this->db->where('KODE_ANG', $key['KODE_ANG']);
    //         $this->db->like('TGL_TGHN', date('Y-m'));
    //         $this->db->delete('pembayaran');
    //         // insert pembayaran

    //         $this->db->insert('pembayaran', $bayar);
    //     }

    //     $this->session->set_flashdata('genta', 'Berhasil');
    //     redirect('generate');
    // }

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

            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->delete('pinsimp');
            $this->db->insert('pinsimp', $pinsimp);

            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->delete('pl');
            $this->db->insert('pl', $pl);
        }
        $this->session->set_flashdata('simpanGen', 'Berhasil');
        redirect('generate2?TAHUN='.$thn.'&&BULAN='.$bln);

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

        $uang = $this->Pinuang->getUang($THN, $BLN);
        $non = $this->Pinuang->getNon($THN, $BLN);
        $kons = $this->Pinuang->getKons($THN, $BLN);
        $khus = $this->Pinuang->getKhusus($THN, $BLN);
        $uub = $this->Pinuang->getUub($THN, $BLN);

        foreach ($uang as $key) {

            // echo $key['JMLP_ANG'].'<BR>';
            // echo "halo";
            if ($key['KEU1'] == $key['JWKT_ANG']) {
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
                $KEU1 = $key['KEU1'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU1;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU1 = 0;
                } else {
                    $POKU1 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU1']                                
                }
                $SIPOKU1 = $JMLP_ANG - ($POKU1 * $KEU1); //$key['SIPOKU1']-$key['POKU1'] //$key['SIPOKU1']-$POKU1;
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
            // delete pinunag
            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->where('NOFAK', $key['NOFAK']);
            $this->db->delete('pinuang');
            // insert pinuang 
            $this->db->insert('pinuang', $pinuang_uang);

            $pl_uang = array(
                'KEU1' => $KEU1,
                'JWK1' => $JWKT_ANG,
                'POKU1' => round($POKU1),
                'SIPOKU1' => round($SIPOKU1),
                'BNGU1' => $BNGU1,
            );
            // update pl 
            $where_uang = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_uang, $where_uang);
        }

        foreach ($non as $key) {

            if ($key['KEU3'] == $key['JWKT_ANG']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $KEU3 = 0;
                $POKU3 = 0;
                $SIPOKU3 = 0;
                $JWKT_ANG = 0;
                $BNGU3 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU3 = $key['KEU3'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU3;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU3 = 0;
                } else {
                    $POKU3 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU3']                                
                }
                $SIPOKU3 = $JMLP_ANG - ($POKU3 * $KEU3); //$key['SIPOKU3']-$key['POKU3'] //$key['SIPOKU3']-$POKU3;
                $BNGU3 = $JMLP_ANG * ($PRO_ANG / 100);
                $CICILAN = $JMLP_ANG - $SIPOKU3;
            }

            $pinuang_non = array(
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
            // delete pinunag
            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->where('NOFAK', $key['NOFAK']);
            $this->db->delete('pinuang');
            // insert pinuang 
            $this->db->insert('pinuang', $pinuang_non);

            $pl_non = array(
                'KEU3' => $KEU3,
                'JWK3' => $JWKT_ANG,
                'POKU3' => round($POKU3),
                'SIPOKU3' => round($SIPOKU3),
                'BNGU3' => $BNGU3,
            );
            // update pl 
            $where_non = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_non, $where_non);
        }

        foreach ($khus as $key) {

            if ($key['KEU7'] == $key['JWKT_ANG']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $KEU7 = 0;
                $POKU7 = 0;
                $SIPOKU7 = 0;
                $JWKT_ANG = 0;
                $BNGU7 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU7 = $key['KEU7'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU7;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU7 = 0;
                } else {
                    $POKU7 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU7']                                
                }
                $SIPOKU7 = $JMLP_ANG - ($POKU7 * $KEU7); //$key['SIPOKU7']-$key['POKU7'] //$key['SIPOKU7']-$POKU7;
                $BNGU7 = $JMLP_ANG * ($PRO_ANG / 100);
                // $CICILAN = $JMLP_ANG - $SIPOKU7;
            }

            $pinuang_khusus = array(
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
            // delete pinunag
            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->where('NOFAK', $key['NOFAK']);
            $this->db->delete('pinuang');
            // insert pinuang 
            $this->db->insert('pinuang', $pinuang_khusus);

            $pl_khusus = array(
                'KEU7' => $KEU7,
                'JWK7' => $JWKT_ANG,
                'POKU7' => round($POKU7),
                'SIPOKU7' => round($SIPOKU7),
                'BNGU7' => $BNGU7,
            );
            // update pl 
            $where_khusus = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_khusus, $where_khusus);
        }

        foreach ($kons as $key) {

            if ($key['KEU2'] == $key['JWKT_ANG']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $KEU2 = 0;
                $POKU2 = 0;
                $SIPOKU2 = 0;
                $JWKT_ANG = 0;
                $BNGU2 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU2 = $key['KEU2'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU2;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU2 = 0;
                } else {
                    $POKU2 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU2']                                
                }
                $SIPOKU2 = $JMLP_ANG - ($POKU2 * $KEU2); //$key['SIPOKU2']-$key['POKU2'] //$key['SIPOKU2']-$POKU2;
                $BNGU2 = $JMLP_ANG * ($PRO_ANG / 100);
                // $CICILAN = $JMLP_ANG - $SIPOKU2;
            }

            $pinuang_kons = array(
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
            // delete pinunag
            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->where('NOFAK', $key['NOFAK']);
            $this->db->delete('pinuang');
            // insert pinuang 
            $this->db->insert('pinuang', $pinuang_kons);

            $pl_khusus = array(
                'KEU2' => $KEU2,
                'JWK2' => $JWKT_ANG,
                'POKU2' => round($POKU2),
                'SIPOKU2' => round($SIPOKU2),
                'BNGU2' => $BNGU2,
            );
            // update pl 
            $where_kons = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_khusus, $where_kons);
        }

        foreach ($uub as $key) {

            if ($key['KEU4'] == $key['JWKT_ANG']) {
                $STATUS = 'LUNAS';
            } else {
                $STATUS = 'BELUM LUNAS';
            }

            if ($STATUS == 'LUNAS') {
                $JMLP_ANG = 0;
                $PRO_ANG = 0;
                $KE_ANG = 0;
                $KEU4 = 0;
                $POKU4 = 0;
                $SIPOKU4 = 0;
                $JWKT_ANG = 0;
                $BNGU4 = 0;
                // $CICILAN = 0;
            } else {
                $JMLP_ANG = $key['JMLP_ANG'];
                $PRO_ANG = $key['PRO_ANG'];
                $KEU4 = $key['KEU4'] + 1;
                $JWKT_ANG = $key['JWKT_ANG'];


                if ($bln == 12) {
                    $KE_ANG = $KEU4;
                } else {
                    $KE_ANG = $key['KE_ANG'];
                }

                if ($JMLP_ANG == 0 || $JWKT_ANG == 0) {
                    $POKU4 = 0;
                } else {
                    $POKU4 = $JMLP_ANG / $JWKT_ANG; //apakah seLisih sedikit pengaruh atau tidak? jika tidak = $key['POKU4']                                
                }
                $SIPOKU4 = $JMLP_ANG - ($POKU4 * $KEU4); //$key['SIPOKU4']-$key['POKU4'] //$key['SIPOKU4']-$POKU4;
                $BNGU4 = $JMLP_ANG * ($PRO_ANG / 100);
                // $CICILAN = $JMLP_ANG - $SIPOKU4;
            }

            $pinuang_kons = array(
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
            // delete pinunag
            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            $this->db->where('NOFAK', $key['NOFAK']);
            $this->db->delete('pinuang');
            // insert pinuang 
            $this->db->insert('pinuang', $pinuang_kons);

            $pl_khusus = array(
                'KEU4' => $KEU4,
                'JWK2' => $JWKT_ANG,
                'POKU4' => round($POKU4),
                'SIPOKU4' => round($SIPOKU4),
                'BNGU4' => $BNGU4,
            );
            // update pl 
            $where_kons = array(
                'TAHUN' => $thn,
                'BULAN' => $bln,
                'KODE_ANG' => $key['KODE_ANG'],
            );
            $this->db->update('pl', $pl_khusus, $where_kons);
        }

        $this->session->set_flashdata('pinjamGen', 'Berhasil');
        redirect('generate2/pinjaman?TAHUN='.$thn.'&&BULAN='.$bln);

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

            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $thn);
            $this->db->where('BULAN', $bln);
            // $this->db->like('TGL_TGHN', $thn.'-'.$bln);
            $this->db->delete('pembayaran');
            // insert pembayaran

            $this->db->insert('pembayaran', $bayar);
        }

        $this->session->set_flashdata('pembayaranGen', 'Berhasil');
        redirect('generate2/tagihan?TAHUN='.$thn.'&&BULAN='.$bln);
    }
}
