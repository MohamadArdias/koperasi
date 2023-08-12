<?php
$pdf = new \TCPDF();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetTopMargin(1);
$pdf->SetFooterMargin(15);
$pdf->SetLeftMargin(3);

$pdf->AddPage();

$data = '
        <body>            
            
                    <table cellpadding="1">
                        <tr>
                            <th style="font-size: 8px;" width="565" align="right"></th>
                        </tr>
                        <tr>
                            <th style="font-size: 12px;" width="592" align="center">KPRI BANGKIT BERSAMA</th>
                        </tr>
                        <tr>
                            <th style="font-size: 12px;" width="592" align="center">Ruko Borobudur No. 8 (0333) 424315 BANYUWANGI Jawa Timur - Indonesia</th>
                        </tr>
                    </table>
                </div>
            </div>
        </body>
        </html>';

$pdf->WriteHTML($data);

$pdf->Output('example.pdf', 'I');
