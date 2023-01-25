<?php



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
Borobudur No. 1A (0333) 424315 BANYUWANGI <br>
                   --o0o-- <br>
============================================<br>
No. Anggota : ' . $print['URUT_ANG'] . '(' . $print['NAMA_ANG'] . ') <br>
INSTANSI    : ' . $print['KODE_INS'] . '(' . $print['NAMA_INS'] . ') <br>
============================================<br>
JUMLAH TAGIHAN        : ' . number_format($print['JML_TGHN'], 0, ',', '.') . ' <br>
JUMLAH BAYAR          : ' . number_format($print['JML_BAYAR'], 0, ',', '.') . ' <br>';

$ttl = $print['JML_TGHN']-$print['JML_BAYAR'];
$data .= '
____________________________________________<br>
SISA                  : ' . number_format($ttl, 0, ',', '.') . ' <br>
============================================<br>';

$data .= '
Banyuwangi, 25 ' . $date . '<br>
KPRI Bangkit Bersama, <br>
</pre>';

$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama .pdf", 'I');
