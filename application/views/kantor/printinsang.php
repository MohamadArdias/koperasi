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
foreach ($printang as $key) {

    $a = $key['URUT_ANG'];
    $tahun = $key['TAHUN'];
    $bulan = $key['BULAN'];
    $query = $this->db->query("SELECT SUM(JML_BAYAR) AS bayar FROM kantor_detail WHERE KODE_ANG = '$a' AND TAHUN = $tahun AND BULAN = '$bulan'")->row();

    $bayar = $query->bayar;

    $sp = $key['SIPOKU8'];
    $tb = $key['BNGU8'] * $key['KE_BNGU8'];

    if ($tb > $bayar) {
        $bp = 0;
        $bb = $bayar;
    } else {
        $bp = $bayar - $tb;
        $bb = $tb;
    }

    $i++;

    $data .= '
<pre>
            KPRI BANGKIT BERSAMA <br>
Borobudur No. 1A (0333) 424315 BANYUWANGI <br>
                   --o0o-- <br>
============================================<br>
PINJAMAN KANTOR BULAN ' . tanggal_indo2($tahun . '-' . $bulan) . '<br>
No. Anggota : ' . $key['URUT_ANG'] . '(' . $key['NAMA_ANG'] . ') <br>
INSTANSI    : ' . $key['KODE_INS'] . '(' . $key['NAMA_INS'] . ') <br>
============================================<br>
SISA POKOK            : ' . number_format($sp, 0, ',', '.') . ' <br>
TOTAL BUNGA           : ' . number_format($tb, 0, ',', '.') . ' <br>
BAYAR POKOK           : ' . number_format($bp, 0, ',', '.') . ' <br>
BAYAR BUNGA           : ' . number_format($bb, 0, ',', '.') . ' <br>';

    $data .= '
____________________________________________<br>
TOTAL TAGIHAN         : ' . number_format($sp+$tb, 0, ',', '.') . ' <br>
TERBAYAR              : ' . number_format($bp+$bb, 0, ',', '.') . ' <br>
============================================<br>
' . terbilang($bp+$bb) . ' rupiah<br><br><br>';

    $data .= '
Banyuwangi, 25 ' . tanggal_indo2(date("Y-m")) . '<br>
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
