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
// $pdf->SetTopMargin(5);
// $pdf->SetFooterMargin(3);
$pdf->SetLeftMargin(3);
$pdf->SetRightMargin(3);
// $pdf->AddPage('L', 'mm', 'A4');
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pageLayout = array(95, 140);
$pdf->AddPage('P', $pageLayout);
$pdf->SetFont('', 'B', 9);
// $data = 'halo';
// $pdf->AddPage('P', '', 'A3');
$data = ' ';

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

$i = 1;
foreach  ($printang as $key ) {
$uang = $key['POKU1'] + $key['BNGU1'];
$kons = $key['POKU2'] + $key['BNGU2'];
$uub = $key['POKU3'] + $key['BNGU3'];
$non = $key['POKU4'] + $key['BNGU4'];
$khus = $key['POKU7'] + $key['BNGU7'];
$tung = $key['POKU6']; //POKU6 = TUNGGAKAN
$i++;

$data .= '
<pre>
            KPRI BANGKIT BERSAMA <br>
 Ruko Borobudur No.8 (0333) 424315 BANYUWANGI<br>
                   --o0o-- <br>
==============================================<br>
TAGIHAN UNTUK BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '<br>
No. Anggota : ' . $key['KODE_ANG'] . '(' . $key['NAMA_ANG'] . ') <br>
INSTANSI    : ' . $key['KODE_INS'] . '(' . $key['NAMA_INS'] . ') <br>
==============================================<br>
SIMPANAN WAJIB        : ' . number_format($key['WAJIB'], 0, ',', '.') . ' <br>';

if ($key['POKOK'] != 0) {
    $data .= '
SIMPANAN POKOK        : ' . number_format($key['POKOK'], 0, ',', '.') . ' <br>';
}

if ($key['POKU1'] != 0) {
    $data .= '
PINJAMAN UANG         : ' . number_format($uang, 0, ',', '.') . '     ke ' . $key['KEU1'] . '<br>';
}

if ($key['POKU2'] != 0) {
    $data .= '
PINJAMAN KONSUMSI     : ' . number_format($kons, 0, ',', '.') . '     ke ' . $key['KEU2'] . '<br>';
}

if ($key['POKU3'] != 0) {
    $data .= '
PINJAMAN UUB          : ' . number_format($uub, 0, ',', '.') . '     ke ' . $key['KEU3'] . '<br>';
}

if ($key['POKU4'] != 0) {
    $data .= '
PINJAMAN NON KONSUMSI : ' . number_format($non, 0, ',', '.') . '     ke ' . $key['KEU4'] . '<br>';
}

if ($key['POKU7'] != 0) {
    $data .= '
PINJAMAN KHUSUS       : ' . number_format($khus, 0, ',', '.') . '     ke ' . $key['KEU7'] . '<br>';
}

if ($tung != 0) {
    $data .= '
TUNGGAKAN             : ' . number_format($tung, 0, ',', '.') . '<br>';
}

$ttl = $uang + $kons + $non + $khus + $uub + $tung + $key['WAJIB'] + $key['POKOK'];

$data .= '
______________________________________________<br>
JUMLAH                : ' . number_format($ttl, 0, ',', '.') . ' <br>
==============================================<br>
' .terbilang($ttl). ' rupiah<br><br><br>';

$data .= '
Banyuwangi, 25 ' . tanggal_indo2($TAHUN . '-' . $BULAN) . '<br>
Pengurus KPRI Bangkit Bersama, <br>
KETUA 1 <br><br><br>
' . $Pengurus['KETUA'] . '
</pre>';
if ($i <= $jumlah) {
    $data .= '<br pagebreak="true"/>';
}
// $data .= '<br pagebreak="true"/>';
$pdf->lastPage();
}

$pdf->WriteHTML($data);
$pdf->Output("Koperasi Bangkit Bersama tanggal_indo2($TAHUN . '-' . $BULAN) .pdf", 'I');