<?php
$tahun = $this->input->get('TAHUN');
$bulan = $this->input->get('BULAN');

if ($bulan == '01') {
    $TAHUN = $tahun - 1;
    $BULAN = '12';
} else {
    $TAHUN = $tahun;
    $BULAN = $bulan - 1;
}

function tanggal_indo2($tanggal)
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
// $pdf->setPrintFooter(false);
$pdf->SetTopMargin(5);
$pdf->SetFooterMargin(5);
$pdf->SetLeftMargin(1);
// $pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pageLayout = array(215, 278);
$pdf->AddPage('P', $pageLayout);
//$pdf->SetFont('', '', 20);
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
                <div>                                                          
                    <div>
                        <div>
                        <table cellpadding="1">
                            <tr>
                            <th style="font-size: 12px;" width="592" align="right">' . tanggal_indo(date("Y-m-d"), true) . '</th>
                            </tr>
                            <tr>
                            <th style="font-size: 12px;" width="592" align="center">KPRI BANGKIT BERSAMA</th>
                            </tr>
                            <tr>
                            <th style="font-size: 12px;" width="592" align="center">Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia</th>
                            </tr>
                        </table>    ';



$pdf->SetFont('', '', 9);
$data .=
    '
                            <table cellpadding="1">
                                <tr>
                                    <td width="45" align="center" style="font-size:9px; "></td>
                                    <td style="font-size: 10px;">DAFTAR TUNGGAKAN BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '</td>
                                </tr>
                            </table>
                            <table cellspacing="1" cellpadding="1">
                                <thead>
                                    <tr>
                                        <th width="45" align="center" style="font-size:9px; "></th>
                                        <th width="20" align="center" style="font-size:9px; border: 1px solid black; ">No </th>
                                        <th width="180" align="center" style="font-size:9px; border: 1px solid black; " >ANGGOTA</th>
                                        <th width="160" align="center" style="font-size:9px; border: 1px solid black; " >INSTANSI</th>
                                        <th width="70" align="center" style="font-size:9px; border: 1px solid black; " >TUNGGAKAN</th>
                                    </tr>
                                </thead>
                                <tbody>';

$i = 1;

$totalt = 0;

foreach ($tunggakan as $lap) {

    if ($lap['POKU6'] != 0) {
        $t = $lap['POKU6']; //POKU6 = TUNGGAKAN
    } else {
        $t = 0;
    }

    $totalt += $t;


    $data .= '  <tr>
                                        <td width="45" align="center" style="font-size:9px; "></td>
                                        <td width="20" align="right" style=" border-right: 1px solid black; border-left: 1px solid black; ">' . $i++ . '</td>
                                        <td width="180" style="border-right: 1px solid black; ">' . $lap['KODE_ANG'] . '-' . $lap['NAMA_ANG'] . '</td>
                                        <td width="160" style="border-right: 1px solid black; ">' . $lap['KODE_INS'] . '-' . $lap['NAMA_INS'] . '</td>
                                        <td width="70" align="right" style="border-right: 1px solid black; ">' . number_format($t, 0, ',', '.') . '</td>
                                    </tr>';
    if ((($i - 1) % 33) == 0) {
        $data .= '
                                        <tr>
                                            <td width="45" align="center" style="font-size:9px; "></td>
                                            <td style="border-top: 1px solid black; " width="20" ></td>
                                            <td style="border-top: 1px solid black; " width="180" ></td>
                                            <td style="border-top: 1px solid black; " width="160" ></td>
                                            <td style="border-top: 1px solid black; " width="70" ></td>
                                        </tr>
                                        </table>';
        if ($i < $jumlah) {

            $data .= '
                                        <br pagebreak="true"/>';
            $data .= '
                                        <table cellpadding="1">
                                            <tr>
                                            <th style="font-size: 12px;" width="592" align="right">' . tanggal_indo(date("Y-m-d"), true) . '</th>
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
                                                <td width="45" align="center" style="font-size:9px; "></td>
                                                <td style="font-size: 10px;">DAFTAR TUNGGAKAN BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '</td>
                                            </tr>
                                        </table>
                                        <table cellspacing="1" cellpadding="1">
                                            <thead>
                                            <tr>
                                                <th width="45" align="center" style="font-size:9px; "></th>
                                                <th width="20" align="center" style="font-size:9px; border: 1px solid black; ">No </th>
                                                <th width="180" align="center" style="font-size:9px; border: 1px solid black; " >ANGGOTA</th>
                                                <th width="160" align="center" style="font-size:9px; border: 1px solid black; " >INSTANSI</th>
                                                <th width="70" align="center" style="font-size:9px; border: 1px solid black; " >TUNGGAKAN</th>
                                            </tr>
                                            </thead>
                                        </table>';
        }
        $data .= '<table cellspacing="1" cellpadding="1">';
    }
}
$data .=    '           
                                <tbody>
                                <tr>
                                    <td width="45"></td>
                                    <td style="border: 1px solid black; " width="362">GRAND TOTAL</td>
                                    <td style="border: 1px solid black; " width="70" align="right">' . number_format($totalt, 0, ',', '.') . '</td>
                                </tr>
                                </tbody>                                                                   
                            </table>
                        <br>
                        <br>                        
                                <div>
                                    <table>
                                        <tr>
                                            <td align="left" width="170">
                                                Jumlah Uang Sebesar RP. <br>
                                                Telah saya terima <br> 
                                                bendahara KPRI Bangkit Bersama <br><br><br><br><br>
                                                ' . $pengurus['BENDAH1'] . ' 
                                            </td>       
                                            <td width="35"></td> 
                                            <td width="200"><pre>Jumlah Tunggakan Rp. ' . number_format($totalt, 0, ',', '.') .
    '<br>Terbayar         Rp. <br>====================================<br>Sisa             Rp.  </pre></td>
                                            <td width="35"></td>
                                            <td align="left" width="140">
                                                Banyuwangi, 25 ' . tanggal_indo2($TAHUN . '-' . $BULAN) . ' <br>
                                                Pengurus KPRI Bangkit Bersama <br> 
                                                Kantor Pemkab. Banyuwangi <br> 
                                                Ketua 1 <br><br><br><br>
                                                ' . $pengurus['KETUA'] . '
                                            </td>
                                        </tr>        
                                    </table>
                                </div>
                                 
                    </div>
                </div>            
        </body>
        
        </html>';
$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama " . tanggal_indo2($TAHUN . '-' . $BULAN) . " .pdf", 'I');
