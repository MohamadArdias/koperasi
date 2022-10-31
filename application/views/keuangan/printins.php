<?php
// $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
setlocale(LC_ALL, 'id-ID', 'id_ID');

// Hasil: Selasa, 04 April 2020
// echo strftime("%A, %d %B %Y", strtotime('2020-10-05')) . "\n";
// Hasil: Senin, 05 Oktober 2020

$date2 = date("d-M-Y");
$date = strftime("%d %B %Y");
// $Month = date('M-Y', strtotime('+1 month', strtotime($date)));
$Month = strftime('%B %Y', strtotime('+1 month', strtotime($date2)));
$full = strftime("%A, %d %B %Y");

$pdf = new \TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetTopMargin(5);
$pdf->SetFooterMargin(3);
// $pdf->SetLeftMargin(3);
// $pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pdf->AddPage('L', '', 'A3');
$pdf->SetFont('', '', 11);
$pdf->Cell(275, 1, "$full", 0, 1, 'R');
$pdf->Cell(277, 5, "KPRI BANGKIT BERSAMA", 0, 1, 'C');
$pdf->Cell(277, 5, "Jl.Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia", 0, 1, 'C');

$pdf->SetFont('', '', 8);
$data =
    '<!DOCTYPE html>
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
                        <>
                            <table cellpadding="5">
                                <tr>
                                    <td><b>DAFTAR TAGIHAN BULAN ' . $Month . '</b></td>
                                    <td align="right"><b>UNTUK ' . $instansi['KODE_INS'] . '/' . $instansi['NAMA_INS'] . '</b></td>
                                </tr>
                            </table>
                            <table cellspacing="0" cellpadding="3">
                                <thead>
                                    <tr>
                                        <th width="20" align="center" style="border: 1px solid black; ">No </th>
                                        <th width="150" align="center" style="border: 1px solid black; " >ANGGOTA</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >SIM</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >KONSUMSI</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >NON KONSUMSI</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >PINJ. KHUSUS</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >PINJ. SP</th>
                                        <th width="20" align="center" style="border: 1px solid black; " >KE</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >SIM. POKOK</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >SIM. WAJIB</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >TUNGGAKAN</th>
                                        <th width="65" align="center" style="border: 1px solid black; " >TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>';

$i = 1;
$totala = 0;
$totalb = 0;
$totalc = 0;
$totald = 0;
foreach ($keuangan as $lap) {
    $a = $lap['POKU3'] + $lap['BNGU3'];
    $b = $lap['POKU1'] + $lap['BNGU1'];
    $c = $lap['POKU7'] + $lap['BNGU7'];

    $totala += $a;
    $totalb += $b;
    $totalc += $lap['WAJIB'];
    $potongan = $a + $b + $c + $lap['WAJIB'];
    $totald += $potongan;


    $data .= '  <tr>
                                        <td width="20" align="right" style=" border-right: 1px solid black; border-left: 1px solid black; ">' . $i++ . '</td>
                                        <td width="150" style="border-right: 1px solid black; ">' . $lap['KODE_ANG'] . '-' . $lap['NAMA_ANG'] . '</td>
                                        <td width="65" align="right" style="border-right: 1px solid black; "></td>
                                        <td width="65" align="right" style="border-right: 1px solid black; "></td>
                                        <td width="65" align="right" style="border-right: 1px solid black; ">' . number_format($a, 0, ',', '.') . '</td>
                                        <td width="65" align="right" style="border-right: 1px solid black; ">' . number_format($c, 0, ',', '.') . '</td>
                                        <td width="65" align="right" style="border-right: 1px solid black; ">' . number_format($b, 0, ',', '.') . '</td>
                                        <td width="20" align="right" style="border-right: 1px solid black; ">' . $lap['KEU1'] . '</td>
                                        <td width="65" align="right" style="border-right: 1px solid black; "></td>
                                        <td width="65" align="right" style="border-right: 1px solid black; ">' . number_format($lap['WAJIB'], 0, ',', '.') . '</td>
                                        <td width="65" align="right" style="border-right: 1px solid black; "></td>
                                        <td width="65" align="right" style="border-right: 1px solid black; ">' . number_format($potongan, 0, ',', '.') . '</td>
                                    </tr>';
}
$data .=    '           <tr>
                                    <td style="border-top: 1px solid black; border-left: 1px solid black; " width="20" align="right"></td>
                                    <td style="border-top: 1px solid black; " width="150">TOTAL</td>
                                    <td style="border-top: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-top: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-top: 1px solid black; " width="65" align="right">' . number_format($totala, 0, ',', '.') . '</td>
                                    <td style="border-top: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-top: 1px solid black; " width="65" align="right">' . number_format($totalb, 0, ',', '.') . '</td>
                                    <td style="border-top: 1px solid black; " width="20" align="right">' . $lap['KEU1'] . '</td>
                                    <td style="border-top: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-top: 1px solid black; " width="65" align="right">' . number_format($totalc, 0, ',', '.') . '</td>
                                    <td style="border-top: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-top: 1px solid black; border-right: 1px solid black; " width="65" align="right">' . number_format($totald, 0, ',', '.') . '</td>
                                </tr>
                                <tr>
                                    <td style="border-bottom: 1px solid black; border-left: 1px solid black; " width="20" align="right"></td>
                                    <td style="border-bottom: 1px solid black; " width="150">GRAND TOTAL</td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right">' . number_format($totala, 0, ',', '.') . '</td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right">' . number_format($totalb, 0, ',', '.') . '</td>
                                    <td style="border-bottom: 1px solid black; " width="20" align="right">' . $lap['KEU1'] . '</td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right">' . number_format($totalc, 0, ',', '.') . '</td>
                                    <td style="border-bottom: 1px solid black; " width="65" align="right"></td>
                                    <td style="border-bottom: 1px solid black; border-right: 1px solid black; " width="65" align="right">' . number_format($totald, 0, ',', '.') . '</td>
                                </tr>
                                </tbody>                                                                   
                            </table>
                        <br>
                        <div>
                            <div>
                                <div>
                                    <table>
                                        <tr>
                                            <td align="left" width="150">
                                                Jumlah Uang Sebesar RP. <br>
                                                Telah saya terima <br> 
                                                bendahara KP-RI Bangkit Bersama <br><br><br><br><br>
                                                DRA.EC.HJ.ERFIN AGUSTINA,M.SI
                                            </td>       
                                            <td width="125"></td> 
                                            <td><pre>Jumlah Tagihan Rp. ' . $totald .
    '<br>Terbayar       Rp. 0<br>==========================<br>Sisa           Rp. 0 </pre></td>
                                            <td width="125"></td>
                                            <td align="left" width="150">
                                                Banyuwangi, ' . $date . ' <br>
                                                Pengurus KPRI Bangkit Bersama <br> 
                                                Kantor Pemkab. Banyuwangi <br> 
                                                Ketua 1 <br><br><br><br>
                                                DRS A. Kholid Askandar
                                            </td>
                                        </tr>        
                                    </table>
                                </div>
                            </div>
                        </div>        
                    </div>
                </div>            
        </body>
        
        </html>';
$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama $date .pdf", 'I');
