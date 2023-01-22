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
        $this->load->model('Pengurus_model', 'Pengurus');
        $this->load->library('pdf');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Data Potongan Anggota';
        $this->data['keuangan'] = $this->Kirim->getAllKirim($THN, $BLN);


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

        $style_sub = [
            'font' => ['bold' => true], // Set font nya jadi bold
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT, // Set text jadi ditengah secara horizontal (center)
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
        setlocale(LC_ALL, 'id-ID', 'id_ID');
        date_default_timezone_set("Asia/Jakarta");

        $sheet->setCellValue('A1', 'DAFTAR POTONGAN KOPERASI');
        $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A4', 'NAMA');
        $sheet->setCellValue('C4', 'KOPERASI BANGKIT BERSAMA KANTOR PEMKAB BWI');
        $sheet->mergeCells('A4:B4'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A5', 'BULAN');
        $sheet->setCellValue('C5', strftime('%B', strtotime('+1 month')));
        $sheet->mergeCells('A5:B5'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A6', 'TAHUN');
        $sheet->setCellValue('C6', date('Y'));
        $sheet->mergeCells('A6:B6'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A7', 'NO REK KOPERASI');
        $sheet->mergeCells('A7:B7'); // Set Merge Cell pada kolom A1 sampai E1
        // $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->applyFromArray($style_head);
        $sheet->getStyle('A4')->applyFromArray($style_sub);
        $sheet->getStyle('C4')->applyFromArray($style_sub);
        $sheet->getStyle('A5')->applyFromArray($style_sub);
        $sheet->getStyle('C5')->applyFromArray($style_sub);
        $sheet->getStyle('A6')->applyFromArray($style_sub);
        $sheet->getStyle('C6')->applyFromArray($style_sub);
        $sheet->getStyle('A7')->applyFromArray($style_sub);
        $sheet->getStyle('C7')->applyFromArray($style_sub);

        // Buat header tabel nya pada baris ke 10
        $sheet->setCellValue('A10', "NO"); // Set kolom A10 dengan tulisan "NO"
        $sheet->setCellValue('B10', "NAMA ANGGOTA"); // Set kolom B10 dengan tulisan "NIS"
        $sheet->setCellValue('C10', "NO REKENING"); // Set kolom C10 dengan tulisan "NAMA"
        $sheet->setCellValue('D10', "NOMINAL POTONGAN"); // Set kolom D10 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E10', "NAMA KOPERASI"); // Set kolom E10 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F10', "NAMA KOPERASI"); // Set kolom E10 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A10')->applyFromArray($style_col);
        $sheet->getStyle('B10')->applyFromArray($style_col);
        $sheet->getStyle('C10')->applyFromArray($style_col);
        $sheet->getStyle('D10')->applyFromArray($style_col);
        $sheet->getStyle('E10')->applyFromArray($style_col);
        $sheet->getStyle('F10')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $THN = $this->input->post('TAHUN');
        $BLN = $this->input->post('BULAN');

        $keuangan = $this->Kirim->getAllKirim($THN, $BLN);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 11; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($keuangan as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['NAMA_ANG']);
            $sheet->setCellValue('C' . $numrow, $data['REKENING']);
            $sheet->setCellValue('D' . $numrow, $data['JML_TGHN']);
            $sheet->setCellValue('E' . $numrow, 'KPRI "BANGKIT BERSAMA"');
            $sheet->setCellValue('F' . $numrow, $data['NAMA_INS']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(25); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(30); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom E

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
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Instansi';
        $this->data['keuangan'] = $this->keuangan->getDistincAllKeuangan($THN, $BLN);

        $this->load->view('keuangan/cetakins', $this->data);
    }

    public function printins($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['keuangan'] = $this->keuangan->getAnggotaWhereKodeins($KODE_INS, $TAHUN, $BULAN);
        $this->data['instansi'] = $this->keuangan->getInstansi($KODE_INS);
        $this->data['pengurus'] = $this->keuangan->getPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);
        
        $this->load->view('keuangan/printins', $this->data);

    }

    public function printinsang($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['printang'] = $this->keuangan->printInsAng($KODE_INS, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggota($KODE_INS, $TAHUN, $BULAN);
        
        $this->load->view('keuangan/coba', $this->data);
    }

    public function cetakang()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Cetak Per Anggota';
        $this->data['keuangan'] = $this->keuangan->getAllKeuangan($THN, $BLN);

        $this->load->view('keuangan/cetakang', $this->data);
    }

    public function printang($KODE_ANG)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['printang'] = $this->keuangan->getAnggotaWhereKodeAng($KODE_ANG, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->load->view('keuangan/printang', $this->data);
    }


    public function gen_tag($BULAN, $TAHUN)
    {
        $ANG = $this->db->query('select * from anggota limit 10')->result();


        foreach ($ANG as $row) {
            echo $BULAN . '-' . $TAHUN . '-' . $row->NAMA_ANG . '-</br>';
        }
    }
}
