<?php
$TAHUN = $this->input->get('TAHUN');
$BULAN = $this->input->get('BULAN');

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

$uang = $printang['POKU1'] + $printang['BNGU1'];
$kons = $printang['POKU2'] + $printang['BNGU2'];
$non = $printang['POKU3'] + $printang['BNGU3'];
$khus = $printang['POKU7'] + $printang['BNGU7'];
$uub = $printang['POKU4'] + $printang['BNGU4'];
$tung = $printang['TUNGGAKAN'];

$data = '
<pre>
            KPRI BANGKIT BERSAMA <br>
Borobudur No. 1A (0333) 424315 BANYUWANGI <br>
                   --o0o-- <br>
============================================<br>
TAGIHAN UNTUK BULAN ' . tanggal_indo2($TAHUN . '-' . $BULAN) . '<br>
No. Anggota : ' . $printang['URUT_ANG'] . '(' . $printang['NAMA_ANG'] . ') <br>
INSTANSI    : ' . $printang['KODE_INS'] . '(' . $printang['NAMA_INS'] . ') <br>
============================================<br>
SIMPANAN WAJIB          : ' . number_format($printang['WAJIB'], 0, ',', '.') . ' <br>';

if ($printang['POKOK'] != 0) {
    $data .= '
SIMPANAN POKOK          : ' . number_format($printang['POKOK'], 0, ',', '.') . ' <br>';
}

if ($printang['POKU1'] != 0) {
    $data .= '
PINJAMAN UANG           : ' . number_format($uang, 0, ',', '.') . '     ke' . $printang['KEU1'] . '<br>';
}

if ($printang['POKU2'] != 0) {
    $data .= '
PINJAMAN KONSUMSI       : ' . number_format($kons, 0, ',', '.') . '     ke' . $printang['KEU2'] . '<br>';
}

if ($printang['POKU3'] != 0) {
    $data .= '
PINJAMAN NON KONSUMSI   : ' . number_format($non, 0, ',', '.') . '     ke' . $printang['KEU3'] . '<br>';
}

if ($printang['POKU4'] != 0) {
    $data .= '
UUB                     : ' . number_format($uub, 0, ',', '.') . '     ke' . $printang['KEU4'] . '<br>';
}

if ($printang['POKU7'] != 0) {
    $data .= '
PINJAMAN KHUSUS         : ' . number_format($khus, 0, ',', '.') . '     ke' . $printang['KEU7'] . '<br>';
}

if ($tung != 0) {
    $data .= '
TUNGGAKAN               : ' . number_format($tung, 0, ',', '.') . '<br>';
}

$ttl = $uang + $kons + $non + $khus + $tung + $printang['WAJIB'] + $printang['POKOK'];

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function terbilang($nilai)
{
    if ($nilai < 0) {
        $hasil = "minus " . trim(penyebut($nilai));
    } else {
        $hasil = trim(penyebut($nilai));
    }
    return $hasil;
}


$data .= '
____________________________________________<br>
JUMLAH                  : ' . number_format($ttl, 0, ',', '.') . ' <br>
============================================<br>
' . terbilang($ttl) . ' rupiah<br><br><br>';

$data .= '
Banyuwangi, 25 ' . tanggal_indo2($TAHUN . '-' . ($BULAN-1)) . '<br>
Pengurus KPRI Bangkit Bersama, <br>
KETUA 1 <br><br><br>
' . $Pengurus['KETUA'] . '

</pre>';

$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama tanggal_indo2($TAHUN . '-' . ($BULAN-1)) .pdf", 'I');
