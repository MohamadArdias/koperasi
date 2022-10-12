<?php
// $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
        $date = date("d-M-Y");
        $Month = date("M-Y");
        $full = date("l, d-M-Y H:i:s");

        $pdf = new \TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // $pdf->SetTopMargin(5);
        // $pdf->SetFooterMargin(3);
        // $pdf->SetLeftMargin(3);
        // $pdf->SetRightMargin(3);
        // $pdf->AddPage('L', 'mm', 'A4');
        $pdf->AddPage('P', '', 'A3');
        $pdf->SetFont('', '', 11);
        
        $data ='
<pre>
                               KPRI BANGKIT BERSAMA <br>
                    Jl.Borobudur No. 1A (0333) 424315 BANYUWANGI <br>
                                     --o0o-- <br>
        ====================================================================<br>
        TAGIHAN UNTUK BULAN '.$Month.'<br>
        No. Anggota : xxx <br>
        INSTANSI    : XXX <br>
        ====================================================================<br>
        SIMPANAN WAJIB  : XXXX <br>
        ____________________________________________________________________<br>
        JUMLAH          : XXXX <br>
        ====================================================================<br><br><br><br>
        Banyuwangi, '.$date.'<br>
        Pengurus KPRI Bangkit Bersama, <br>
        KETUA 1 <br><br><br>
        Drs A. Kholid Askardar

</pre>                         
                
            ';
        $pdf->WriteHTML($data);
        $pdf->Output("Koperasi Bangkit Bersama $date .pdf", 'I');