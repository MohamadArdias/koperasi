<?php

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

setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set("Asia/Jakarta");
// $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
$date = strftime("%d %B %Y");
$Month = strftime("%B %Y", strtotime('+1 month'));
$full = date("l, d-M-Y H:i:s");

$pdf = new \TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// $pdf->SetTopMargin(5);
// $pdf->SetFooterMargin(3);
// $pdf->SetLeftMargin(3);
// $pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pageLayout = array(95, 140);
$pdf->AddPage('P', $pageLayout);
$pdf->SetFont('', '', 8);

$data = '
<pre>
            KPRI BANGKIT BERSAMA <br>
Ruko Borobudur No.8 (0333) 424315 BANYUWANGI<br>
            Jawa Timur-Indonesia
                   --o0o-- <br>
============================================<br>
No. Anggota : ' . $print['KODE_ANG'] . '-' . $print['NAMA_ANG'] . ' <br>
INSTANSI    : ' . $print['KODE_INS'] . '-' . $print['NAMA_INS'] . ' <br>
============================================<br><br>
BAYAR POKOK        : ' . number_format($print['POKU'], 0, ',', '.') . ' <br>
BAYAR BUNGA        : ' . number_format($print['BNGU'], 0, ',', '.');

$ttl = $print['POKU']+$print['BNGU'];
$data .= '
____________________________________________<br>
UANG DITERIMA      : ' . number_format($ttl, 0, ',', '.') . ' <br>
============================================<br>';

$data .= '
Banyuwangi, '.date("d").' '. tanggal_indo2 (date("Y-m")) . '<br>
KPRI Bangkit Bersama, <br><br><br><br>
'.$print['CREATED_BY'].'
</pre>';

$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama .pdf", 'I');
