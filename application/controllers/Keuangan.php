<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

// define('BASEPATH') OR exit('No direct script access allowed');
class Keuangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kirim_model', 'Kirim');
        // $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->model('Keuangan_model', 'keuangan');
        $this->load->library('pdf');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Data Potongan Anggota';
        $this->data['keuangan'] = $this->Kirim->getAllKirim();

        if ($this->input->post('keyword')) {
            $this->data['keuangan'] = $this->Kirim->cariDataKirim();
        }

        $this->load->view('keuangan/index', $this->data);
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_head = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
        ];

        $style_col = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = [
            'alignment' => [
                // 'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $style_row_mid = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ],
            'borders' => [
                'top' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border top dengan garis tipis
                'right' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN],  // Set border right dengan garis tipis
                'bottom' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN], // Set border bottom dengan garis tipis
                'left' => ['borderStyle'  => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN] // Set border left dengan garis tipis
            ]
        ];

        $sheet->setCellValue('A1', 'DAFTAR POTONGAN KOPERASI');
        $sheet->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
        // $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->applyFromArray($style_head);

        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO"); // Set kolom A3 dengan tulisan "NO"
        $sheet->setCellValue('B3', "NAMA ANGGOTA"); // Set kolom B3 dengan tulisan "NIS"
        $sheet->setCellValue('C3', "NO REKENING"); // Set kolom C3 dengan tulisan "NAMA"
        $sheet->setCellValue('D3', "NOMINAL POTONGAN"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E3', "NAMA KOPERASI"); // Set kolom E3 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $keuangan = $this->Kirim->getAllKirim();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($keuangan as $data) { // Lakukan looping pada variabel siswa
            $potongan = $data['WAJIB'] +
                $data['POKU1'] + $data['BNGU1'] +
                $data['POKU2'] + $data['BNGU2'] +
                $data['POKU3'] + $data['BNGU3'] +
                $data['POKU4'] + $data['BNGU4'] +
                $data['POKU5'] + $data['BNGU5'] +
                $data['POKU6'] + $data['BNGU6'] +
                $data['POKU7'] + $data['BNGU7'] +
                $data['POKU8'] + $data['BNGU8'];

            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['NAMA_ANG']);
            $sheet->setCellValue('C' . $numrow, $data['KODE_ANG']);
            $sheet->setCellValue('D' . $numrow, $potongan);
            $sheet->setCellValue('E' . $numrow, 'KPRI "BANGKIT BERSAMA"');

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row_mid);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Data Potongan");
        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="myfile.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function cetakins()
    {
        $this->data['title'] = 'Cetak Per Instansi';
        $this->data['keuangan'] = $this->keuangan->getDistincAllKeuangan();

        if ($this->input->post('keyword')) {
            $this->data['keuangan'] = $this->keuangan->cariDataInstansi();
        }

        $this->load->view('keuangan/cetakins', $this->data);
    }

    public function cetakang()
    {
        $this->load->library('pagination');

        $this->data['title'] = 'Cetak Per Anggota';
        // $this->data['keuangan'] = $this->keuangan->getAllKeuangan();

        $config['base_url'] = 'http://localhost/koperasi/index.php/keuangan/cetakang';
        $config['total_rows'] = $this->keuangan->countAllKeuangan();
        $config['per_page'] = 25;
        $config['num_links'] = 5;

        // styling
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);

        $this->data['keuangan'] = $this->keuangan->getKeuangan($config['per_page'], $data['start']);

        if ($this->input->post('keyword')) {
            $this->data['keuangan'] = $this->keuangan->cariDataKeuangan();
        }

        $this->load->view('keuangan/cetakang', $this->data);
    }


    public function printins($KODE_INS)
    {
        $keuangan = $this->keuangan->getAnggotaWhereKodeins($KODE_INS);

        // $mpdf = new Mpdf(['orientation' => 'L', 'default_font_size' => 9]);
        $date = date("d-M-Y");
        $Month = date("M-Y");
        $full = date("l, d-M-Y H:i:s");

        $pdf = new \TCPDF();
        $pdf->AddPage('L', 'mm', 'A4');
        $pdf->SetFont('', 'B', 10);

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
        <style>
        #table{
            border: 1px solid black;
            border-collapse: collapse;
            
        }
        #table th{
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 10;
        }
        #text-center {
            text-align:center
        }
        #left    { 
            text-align: left
        }
        #table.center {
            margin-left:auto; 
            margin-right:auto;
        }

        #table td {
            border-right: solid 1px black;
        }

        #footer{
            border: 1;
        }

        </style>
            <center>
                <div>                                                          
                    <div>
                        <div>
                            <table>
                                <tr>
                                    <td width="325" height="70">
                                    <b>KPRI BANGKIT BERSAMA <br>
                                    Jl.Borobudur No. 1A (0333) 424315 BANYUWANGI Jawa Timur - Indonesia</b>
                                    </td>
                                    <td width="595"></td>
                                    <td align="right" width="150">
                                    ' . $full . '
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>DAFTAR TAGIHAN BULAN ' . $Month . '</b></td>
                                </tr>
                            </table>
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th style="height:30" width="30" align="center">No </th>
                                        <th width="200" align="center">ANGGOTA</th>
                                        <th align="center" width="90">SIM</th>
                                        <th align="center" width="90">KONSUMSI</th>
                                        <th align="center" width="90">NON KONSUMS</th>
                                        <th align="center" width="90">PINJ. KHUSUS</th>
                                        <th align="center" width="90">PINJ. SP</th>
                                        <th width="30" align="center">KE</th>
                                        <th align="center" width="90">SIM. POKOK</th>
                                        <th align="center" width="90">SIM. WAJIB</th>
                                        <th width="90" align="center">TUNGGAKAN</th>
                                        <th align="center" width="90">TOTAL</th>
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
            $potongan = $lap['WAJIB'] +
                $lap['POKU1'] + $lap['BNGU1'] +
                $lap['POKU2'] + $lap['BNGU2'] +
                $lap['POKU3'] + $lap['BNGU3'] +
                $lap['POKU4'] + $lap['BNGU4'] +
                $lap['POKU5'] + $lap['BNGU5'] +
                $lap['POKU6'] + $lap['BNGU6'] +
                $lap['POKU7'] + $lap['BNGU7'] +
                $lap['POKU8'] + $lap['BNGU8'];

            $totala += $a;
            $totalb += $b;
            $totalc += $lap['WAJIB'];
            $totald += $potongan;

            $data .= '<tr>
                                        <td align="right">' . $i++ . '</td>
                                        <td>' . $lap['NAMA_ANG'] . '</td>
                                        <td align="right"></td>
                                        <td align="right"></td>
                                        <td align="right">' . $a . '</td>
                                        <td align="right"></td>
                                        <td align="right">' . $b . '</td>
                                        <td width="30" align="right">' . $lap['KEU1'] . '</td>
                                        <td align="right"></td>
                                        <td align="right">' . $lap['WAJIB'] . '</td>
                                        <td width="90" align="right"></td>
                                        <td align="right">' . $potongan . '</td>
                                    </tr>';
        }
        $data .=    '</tbody>                                                                   
                            </table>
                        </div>
                        <table id="footer">
                        <tr>
                            <td width="30"></td>
                            <td width="200">TOTAL</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totala . '</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totalb . '</td>
                            <td width="30" align="right"></td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totalc . '</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totald . '</td>
                        </tr>
                        <tr>
                            <td width="30"></td>
                            <td width="200">GRAND TOTAL</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totala . '</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totalb . '</td>
                            <td width="30" align="right"></td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totalc . '</td>
                            <td width="90" align="right"></td>
                            <td width="90" align="right">' . $totald . '</td>
                        </tr>
                        </table>
                        <br>
                        <div>
                            <div>
                                <div>
                                    <table>
                                        <tr>
                                            <td align="justify" width="200">
                                                Jumlah Uang Sebesar RP. <br>
                                                Telah saya terima <br> 
                                                bendahara KP-RI Bangkit Bersama <br><br><br><br><br>
                                                DRA.EC.HJ.ERFIN AGUSTINA,M.SI
                                            </td>
                                            <td width="110"></td>

                                            <td width="1">
                                            <pre>
                                                Jumlah Tagihan  Rp. ' . $totald . '
                                                Terbayar        Rp. <br>
                                                ================================ <br>
                                                Sisa            Rp.
                                            </pre>
                                            </td>
                                            
                                            <td width="90"></td>
                                            <td align="justify" width="200">
                                                Banyuwangi,' . $date . ' <br>
                                                Pengurus KPRI Bangkit Bersama 
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
            </center>
        </body>
        
        </html>';
        $pdf->WriteHTML($data);
        $pdf->Output();
    }
}
