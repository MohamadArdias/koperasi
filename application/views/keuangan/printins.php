<?php
$tahun = $this->input->get('TAHUN');
$bulan = $this->input->get('BULAN');

if ($bulan == '01') {
    $TAHUN = $tahun-1;
    $BULAN = '12';
} else {
    $TAHUN = $tahun;
    $BULAN = $bulan-1;
}

function tanggal_indo3($tanggal)
{
    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split = explode('-', $tanggal);
    // return $split[0] . ' ' . $bulan[ (int)$split[1] ];
    return $bulan[(int)$split[1]] . ' ' . $split[0];
}

function tanggal_indo2($tanggal)
{
    $bulan = array(
        1 =>   'JANUARI',
        'FEBRUARI',
        'MARET',
        'APRIL',
        'MEI',
        'JUNI',
        'JULI',
        'AGUSTUS',
        'SEPTEMBER',
        'OKTOBER',
        'NOVEMBER',
        'DESEMBER'
    );
    $split = explode('-', $tanggal);
    // return $split[0] . ' ' . $bulan[ (int)$split[1] ];
    return $bulan[(int)$split[1]] . ' ' . $split[0];
}

// echo tanggal_indo2($TAHUN.'-'.$BULAN); // 20 Maret 2016
// echo "<br>";



function tanggal_indo($tanggal, $cetak_hari = false)
{
    $hari = array(
        1 =>    'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu',
        'Minggu'
    );

    $bulan = array(
        1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    );
    $split       = explode('-', $tanggal);
    $tgl_indo = $split[2] . ' ' . $bulan[(int)$split[1]] . ' ' . $split[0];

    if ($cetak_hari) {
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;
    }
    return $tgl_indo;
}
// echo tanggal_indo (date("Y-m-d"), true);

// $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set("Asia/Jakarta");

// Hasil: Selasa, 04 April 2020
// echo strftime("%A, %d %B %Y", strtotime('2020-10-05')) . "\n";
// Hasil: Senin, 05 Oktober 2020

$date2 = date("d-M-Y");
$date = strftime("%B %Y");
// $Month = date('M-Y', strtotime('+1 month', strtotime($date)));
$Month = strftime('%B %Y', strtotime('+1 month', strtotime($date2)));
$full = strftime("%A, %d %B %Y");

$pdf = new \TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetTopMargin(5);
$pdf->SetFooterMargin(5);
$pdf->SetLeftMargin(3);

$marginBottom = 3;
$pdf->SetAutoPageBreak(true, $marginBottom);
// $pdf->SetBottomMargin(3);
// $pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pageLayout = array(215, 278);

// $pdf->SetTopMargin(15);
$pdf->AddPage('P', $pageLayout);
// $pdf->SetFont('', '', 20);
// $pdf->Cell(210, 1, "$full", 0, 1, 'R');
// $pdf->Cell(210, 5, "KPRI BANGKIT BERSAMA", 0, 1, 'C');
// $pdf->Cell(210, 5, "Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia", 0, 1, 'C');

$data = '<!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

            <body>
                        <table cellpadding="1">
                            <tr>
                            <th style="font-size: 8px;" width="565" align="right">' . tanggal_indo(date("Y-m-d"), true) . '</th>
                            </tr>
                            <tr>
                            <th style="font-size: 12px;" width="592" align="center">KPRI BANGKIT BERSAMA</th>
                            </tr>
                            <tr>
                            <th style="font-size: 12px;" width="592" align="center">Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia</th>
                            </tr>
                        </table>    ';
                        
$pdf->SetFont('dejavusanscondensed', '', 7);
$data .=
    '
                            <table cellpadding="1">
                                <tr>
                                    <td style="font-size: 10px;">DAFTAR TAGIHAN BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '</td>
                                    <td style="font-size: 10px;" align="right">UNTUK ' . $instansi['KODE_INS'] . '/' . $instansi['NAMA_INS'] . '</td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="1">
                                <thead>
                                    <tr>
                                        <th width="17" align="center" style="font-size:7px; border: 1px solid black; ">No </th>
                                        <th width="140" align="center" style="font-size:7px; border: 1px solid black; " >ANGGOTA</th>
                                        <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >NON KONSUMSI</th>
                                        <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >KONSUMSI</th>
                                        <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >UUB</th>
                                        <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >PINJ. KHUSUS</th>
                                        <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >PINJ. SP</th>
                                        <th width="15" align="center" style="font-size:7px; border: 1px solid black; " >KE</th>
                                        <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >SIM. POKOK</th>
                                        <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >SIM. WAJIB</th>
                                        <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >TUNGGAKAN</th>
                                        <th width="50" align="center" style="font-size:7px; border: 1px solid black; " >TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>';

$i = 1;
$totala = 0;
$totalb = 0;
$totalc = 0;
$totald = 0;
$totale = 0;
$totalf = 0;
$totalg = 0;
$totalj = 0;
$totalt = 0;

foreach ($keuangan as $lap) {

    $a = $lap['POKU3'] + $lap['BNGU3'];
    $b = $lap['POKU1'] + $lap['BNGU1'];
    $j = $lap['POKU4'] + $lap['BNGU4'];
    $e = $lap['POKU7'] + $lap['BNGU7'];
    $f = $lap['POKU2'];
    $g = $lap['POKOK'];

    if ($lap['POKU6'] != 0) {
        $t = $lap['POKU6']; //POKU6 = TUNGGAKAN
    } else {
        $t = 0;
    }


    $totala += $a;
    $totalb += $b;
    $totalc += $lap['WAJIB'];
    $totale += $e;
    $totalf += $f;
    $totalg += $g;
    $totalt += $t;
    $totalj += $j;
    $potongan = $a + $b + $e + $f + $g + $t + $j + $lap['WAJIB'];
    $totald += $potongan;

    if ($lap['KEU1'] != 0) {
        $ke = $lap['KEU1'];
    } else {
        $ke = 0;
    }

    $data .= '  <tr>
                                        <td width="17" align="right" style=" border-right: 1px solid black; border-left: 1px solid black; ">' . $i++ . '</td>
                                        <td width="140" style="border-right: 1px solid black; ">' . $lap['KODE_ANG'] . '-' . $lap['NAMA_ANG'] . '</td>
                                        <td width="45" align="right" style="border-right: 1px solid black; ">' . number_format($j, 0, ',', '.') . '</td>
                                        <td width="40" align="right" style="border-right: 1px solid black; ">' . number_format($f, 0, ',', '.') . '</td>
                                        <td width="45" align="right" style="border-right: 1px solid black; ">' . number_format($a, 0, ',', '.') . '</td>
                                        <td width="40" align="right" style="border-right: 1px solid black; ">' . number_format($e, 0, ',', '.') . '</td>
                                        <td width="45" align="right" style="border-right: 1px solid black; ">' . number_format($b, 0, ',', '.') . '</td>
                                        <td width="15" align="right" style="border-right: 1px solid black; ">' . $ke . '</td>
                                        <td width="40" align="right" style="border-right: 1px solid black; ">' . number_format($lap['POKOK'], 0, ',', '.') . '</td>
                                        <td width="45" align="right" style="border-right: 1px solid black; ">' . number_format($lap['WAJIB'], 0, ',', '.') . '</td>
                                        <td width="45" align="right" style="border-right: 1px solid black; ">' . number_format($t, 0, ',', '.') . '</td>
                                        <td width="50" align="right" style="border-right: 1px solid black; ">' . number_format($potongan, 0, ',', '.') . '</td>
                                    </tr>';
    if ((($i-1) % 48) == 0) {
        $data .= '
                                        <tr>
                                            <td style="border-top: 1px solid black; " width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="567" ></td>
                                        </tr>
                                        <tr>
                                            <td width="400"></td> 
                                            <td style="font-size: 9px;" width="500">
                                                <pre><b>Berlanjut ke halaman berikutnya</b>
                                                </pre>
                                            </td>
                                        </tr>
                                        </table>';
        if ($i <= $jumlah) { 

            // $data .= '
            //                             ';

            $pdf->SetTopMargin(5);
            $data .= '
                                        <br pagebreak="true"/>
                                        <table cellpadding="1">
                                            <tr>
                                            <th style="font-size: 8px;" width="565" align="right">' . tanggal_indo(date("Y-m-d"), true) . '</th>
                                            </tr>
                                            <tr>
                                            <th style="font-size: 12px;" width="592" align="center">KPRI BANGKIT BERSAMA</th>
                                            </tr>
                                            <tr>
                                            <th style="font-size: 12px;" width="592" align="center">Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia</th>
                                            </tr>
                                        </table>
                                        <table cellpadding="1">
                                            <tr>
                                                <td style="font-size: 10px;">DAFTAR TAGIHAN BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '</td>
                                                <td style="font-size: 10px;" align="right">UNTUK ' . $instansi['KODE_INS'] . '/' . $instansi['NAMA_INS'] . '</td>
                                            </tr>
                                        </table>
                                        <table cellspacing="0" cellpadding="1">
                                            <thead>
                                                <tr>
                                                    <th width="17" align="center" style="font-size:7px; border: 1px solid black; ">No </th>
                                                    <th width="140" align="center" style="font-size:7px; border: 1px solid black; " >ANGGOTA</th>
                                                    <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >NON KONSUMSI</th>
                                                    <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >KONSUMSI</th>
                                                    <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >UUB</th>
                                                    <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >PINJ. KHUSUS</th>
                                                    <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >PINJ. SP</th>
                                                    <th width="15" align="center" style="font-size:7px; border: 1px solid black; " >KE</th>
                                                    <th width="40" align="center" style="font-size:7px; border: 1px solid black; " >SIM. POKOK</th>
                                                    <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >SIM. WAJIB</th>
                                                    <th width="45" align="center" style="font-size:7px; border: 1px solid black; " >TUNGGAKAN</th>
                                                    <th width="50" align="center" style="font-size:7px; border: 1px solid black; " >TOTAL</th>
                                                </tr>
                                            </thead>
                                        </table>';
        }
        $data .= '<table cellspacing="0" cellpadding="1">';
    }
}
$data .=    '
                                <tr>
                                    <td style="border-right: 1px solid black; border-left: 1px solid black; border-top: 1px solid black;" width="17" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="140"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="45" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="40" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="45" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="40" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="45" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="15" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="40" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="45" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black;" width="45" align="right"></td>
                                    <td style="border-right: 1px solid black; border-top: 1px solid black; " width="50" align="right"></td>
                                </tr>     
                                <tr>
                                    <td style="border-right: 1px solid black; border-left: 1px solid black; border-bottom: 1px solid black;" width="17" align="right"></td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="140">GRAND TOTAL</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="45" align="right">' . number_format($totalj, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="40" align="right">' . number_format($totalf, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="45" align="right">' . number_format($totala, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="40" align="right">' . number_format($totale, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="45" align="right">' . number_format($totalb, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="15" align="right"></td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="40" align="right">' . number_format($totalg, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="45" align="right">' . number_format($totalc, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black;" width="45" align="right">' . number_format($totalt, 0, ',', '.') . '</td>
                                    <td style="border-right: 1px solid black; border-bottom: 1px solid black; " width="50" align="right">' . number_format($totald, 0, ',', '.') . '</td>
                                </tr>                                                                  
                            </table>
                        <br>';
// $pdf->SetFont('', 'B', 7);
// if (($i <= $jumlah) && ($i % 47 === 0 || $i % 46 === 0 || $i % 45 === 0) ) {

if (($i-1 === $jumlah) && ($i % 48 === 46 || $i % 48 === 47 || $i % 48 === 0) ) {

$data .='               <br pagebreak="true"/>                       
                                <div>
                                <table>
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="170">
                                        </td>       
                                        <td width="40"></td> 
                                        <td style="font-size: 9px;" width="170"><pre><br><b>Jumlah Tagihan Rp. ' . number_format($totald, 0, ',', '.') .
'<br>Terbayar       Rp. 0<br>==============================<br>Sisa           Rp. 0 </b><br><br></pre></td>
                                    </tr>        
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="210">
                                        </td>
                                        <td style="font-size: 9px;" align="center" width="170">
                                            Banyuwangi, 25 ' . tanggal_indo3($TAHUN . '-' . $BULAN) . ' <br>
                                            Pengurus KPRI "Bangkit Bersama" <br> 
                                            Kantor Pemkab. Banyuwangi 
                                        </td>
                                    </tr>        
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="90">
                                        </td>
                                        <td style="font-size: 9px;" align="center" width="170">
                                            Bendahara 1 <br><br><br><br>
                                            ' . $pengurus['BENDAH1'] . ' 
                                        </td> 
                                        <td width="80"></td> 
                                        <td style="font-size: 9px;" align="center" width="140">
                                            Ketua 1 <br><br><br><br>
                                            ' . $pengurus['KETUA'] . '
                                        </td>
                                    </tr>        
                                </table>
                                </div>';
} else {
    $data .='               <br>                        
                                <div>
                                <table>
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="150">
                                        </td>       
                                        <td width="40"></td> 
                                        <td style="font-size: 9px;" width="170"><pre><b>Jumlah Tagihan Rp. ' . number_format($totald, 0, ',', '.') .
'<br>Terbayar       Rp. 0<br>==============================<br>Sisa           Rp. 0 </b><br><br></pre></td>
                                    </tr>        
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="210">
                                        </td>
                                        <td style="font-size: 9px;" align="center" width="170">
                                            Banyuwangi, 25 ' . tanggal_indo3($TAHUN . '-' . $BULAN) . ' <br>
                                            Pengurus KPRI "Bangkit Bersama" <br> 
                                            Kantor Pemkab. Banyuwangi 
                                        </td>
                                    </tr>        
                                    <tr>
                                        <td style="font-size: 9px;" align="left" width="90">
                                        </td>
                                        <td style="font-size: 9px;" align="center" width="170">
                                            Bendahara 1 <br><br><br><br>
                                            ' . $pengurus['BENDAH1'] . ' 
                                        </td> 
                                        <td width="70"></td> 
                                        <td style="font-size: 9px;" align="center" width="180">
                                            Ketua 1 <br><br><br><br>
                                            ' . $pengurus['KETUA'] . '
                                        </td>
                                    </tr>        
                                </table>
                                </div>';
}
$data .='               </div>
                </div>            
        </body>
        
        </html>';
$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama ".tanggal_indo2($TAHUN.'-'.$BULAN)." .pdf", 'I');
