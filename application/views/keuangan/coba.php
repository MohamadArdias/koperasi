<?php
setlocale(LC_ALL, 'id-ID', 'id_ID');
date_default_timezone_set("Asia/Jakarta");
// $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
$date = strftime("%d %B %Y");
$Month = strftime("%B %Y", strtotime('+1 month'));
$full = date("l, d-M-Y H:i:s");

$pdf = new \TCPDF();
// $pdf->SetTopMargin(5);
// $pdf->SetFooterMargin(3);
// $pdf->SetLeftMargin(3);
// $pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pageLayout = array(95, 140);
$pdf->AddPage('P', $pageLayout);
$pdf->SetFont('', '', 8);
$data = 'halo';
// $pdf->AddPage('P', '', 'A3');
$data = ' ';
$i = 1;
foreach  ($printang as $key ) {
$i++;
$uang = $key['POKU1'] + $key['BNGU1'];
$kons = $key['POKU2'] + $key['BNGU2'];
$non = $key['POKU3'] + $key['BNGU3'];
$khus = $key['POKU7'] + $key['BNGU7'];
$tung = $key['TUNGGAKAN'];

$data .= '
<pre>
            KPRI BANGKIT BERSAMA <br>
Borobudur No. 1A (0333) 424315 BANYUWANGI <br>
                   --o0o-- <br>
============================================<br>
TAGIHAN UNTUK BULAN ' . $Month . '<br>
No. Anggota : ' . $key['URUT_ANG'] . '(' . $key['NAMA_ANG'] . ') <br>
INSTANSI    : ' . $key['KODE_INS'] . '(' . $key['NAMA_INS'] . ') <br>
============================================<br>
SIMPANAN WAJIB          : ' . number_format($key['WAJIB'], 0, ',', '.') . ' <br>';

if ($key['POKOK'] != 0) {
    $data .= '
SIMPANAN POKOK          : ' . number_format($key['POKOK'], 0, ',', '.') . ' <br>';
}

if ($key['POKU1'] != 0) {
    $data .= '
PINJAMAN UANG           : ' . number_format($uang, 0, ',', '.') . '     ke ' . $key['KEU1'] . '<br>';
}

if ($key['POKU2'] != 0) {
    $data .= '
PINJAMAN KONSUMSI       : ' . number_format($kons, 0, ',', '.') . '     ke ' . $key['KEU2'] . '<br>';
}

if ($key['POKU3'] != 0) {
    $data .= '
PINJAMAN NON KONSUMSI   : ' . number_format($non, 0, ',', '.') . '     ke ' . $key['KEU3'] . '<br>';
}

if ($key['POKU7'] != 0) {
    $data .= '
PINJAMAN KHUSUS         : ' . number_format($khus, 0, ',', '.') . '     ke ' . $key['KEU7'] . '<br>';
}

if ($tung != 0) {
    $data .= '
TUNGGAKAN               : ' . number_format($tung, 0, ',', '.') . '<br>';
}

$ttl = $uang + $kons + $non + $khus + $tung + $key['WAJIB'] + $key['POKOK'];

// function penyebut($nilai)
// {
//     $nilai = abs($nilai);
//     $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
//     $temp = "";
//     if ($nilai < 12) {
//         $temp = " " . $huruf[$nilai];
//     } else if ($nilai < 20) {
//         $temp = penyebut($nilai - 10) . " belas";
//     } else if ($nilai < 100) {
//         $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
//     } else if ($nilai < 200) {
//         $temp = " seratus" . penyebut($nilai - 100);
//     } else if ($nilai < 1000) {
//         $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
//     } else if ($nilai < 2000) {
//         $temp = " seribu" . penyebut($nilai - 1000);
//     } else if ($nilai < 1000000) {
//         $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
//     } else if ($nilai < 1000000000) {
//         $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
//     } else if ($nilai < 1000000000000) {
//         $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
//     } else if ($nilai < 1000000000000000) {
//         $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
//     }
//     return $temp;
// }

// function terbilang($nilai)
// {
//     if ($nilai < 0) {
//         $hasil = "minus " . trim(penyebut($nilai));
//     } else {
//         $hasil = trim(penyebut($nilai));
//     }
//     return $hasil;
// }


$data .= '
____________________________________________<br>
JUMLAH                  : ' . number_format($ttl, 0, ',', '.') . ' <br>
============================================<br>
' .$ttl . ' rupiah<br><br><br>';

$data .= '
Banyuwangi, ' . $date . '<br>
Pengurus KPRI Bangkit Bersama, <br>
KETUA 1 <br><br><br>
' . $Pengurus['KETUA'] . '

</pre>';
if ($i <= $jumlah) {
    $data .= '<br pagebreak="true"/>';
}
// $pdf->lastPage();
}

$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama $date .pdf", 'I');
