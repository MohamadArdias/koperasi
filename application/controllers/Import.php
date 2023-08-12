<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Import extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model', 'Import');
        $this->load->model('Pembayaran_model', 'Pembayaran');
    }

    public function index()
    {
        $this->data['title'] = 'Import Bank Jatim';
        $this->data['temp'] = $this->Import->getDataMasuk();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->db->query("DELETE FROM temp");
            $upload_status = $this->uploadDoc();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/imports/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $this->db->query("DELETE FROM temp");
                foreach ($sheet->getRowIterator() as $row) {
                    // $tanggal = $spreadsheet->getActiveSheet()->getcell('A' . $row->getRowIndex());
                    $tanggal = $spreadsheet->getActiveSheet()->getcell('A' . $row->getRowIndex())->getFormattedValue();
                    $norek = $spreadsheet->getActiveSheet()->getcell('B' . $row->getRowIndex());
                    $nama = $spreadsheet->getActiveSheet()->getcell('C' . $row->getRowIndex());
                    $nominal = $spreadsheet->getActiveSheet()->getcell('D' . $row->getRowIndex());
                    $kop = $spreadsheet->getActiveSheet()->getcell('E' . $row->getRowIndex());
                    $data = array(
                        'TANGGAL' => date("Y-m-d", strtotime($tanggal)),
                        'NO_REKENING' => $norek,
                        'NAMA' => $nama,
                        'NOMINAL' => $nominal,
                        'KOP' => $kop,
                        'DATE' => date("Y-m-d"),
                    );
                    //echo  date("Y-m-d", strtotime($tanggal));
                    $this->db->insert('temp', $data);
                    $count_Rows++;
                }
                $this->session->set_flashdata('succes', 'Data Berhasil di Import');
                redirect('Import');
            } else {
                $this->session->set_flashdata('error', 'Data Tidak Terupload');
                redirect('Import');
            }
        } else {
            $this->load->view('import/index', $this->data);
        }
    }

    public function gagal()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->db->query("DELETE FROM temp_gagal");
            $upload_status = $this->uploadDoc();
            if ($upload_status != false) {
                $inputFileName = 'assets/uploads/imports/' . $upload_status;
                $inputTileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
                $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputTileType);
                $spreadsheet = $reader->load($inputFileName);
                $sheet = $spreadsheet->getSheet(0);
                $count_Rows = 0;
                $this->db->query("DELETE FROM temp_gagal");
                foreach ($sheet->getRowIterator() as $row) {
                    // $tanggal = $spreadsheet->getActiveSheet()->getcell('A' . $row->getRowIndex());
                    $tanggal = $spreadsheet->getActiveSheet()->getcell('A' . $row->getRowIndex())->getFormattedValue();
                    $norek = $spreadsheet->getActiveSheet()->getcell('B' . $row->getRowIndex());
                    $nama = $spreadsheet->getActiveSheet()->getcell('C' . $row->getRowIndex());
                    $nominal = $spreadsheet->getActiveSheet()->getcell('D' . $row->getRowIndex());
                    $kop = $spreadsheet->getActiveSheet()->getcell('E' . $row->getRowIndex());

                    $no_rek = str_replace(' ', '', "$norek");

                    $query = $this->db->query("SELECT REKENING FROM anggota WHERE REKENING = $no_rek");       
                    $query = $query->row();

                    if ($query) {
                        $data_rek =  $query->REKENING;
                    }

                    


                    $data = array(
                        'TANGGAL' => date("Y-m-d", strtotime($tanggal)),
                        'NO_REKENING' => $data_rek,
                        'NAMA' => $nama,
                        'NOMINAL' => $nominal,
                        'KOP' => $kop,
                        'DATE' => date("Y-m-d"),
                    );
                    //echo  date("Y-m-d", strtotime($tanggal));
                    $this->db->insert('temp_gagal', $data);
                    $count_Rows++;
                }
                $this->session->set_flashdata('succes', 'Data Berhasil di Import');
                redirect('Import');
            } else {
                $this->session->set_flashdata('error', 'Data Tidak Terupload');
                redirect('Import');
            }
        }
    }

    function uploadDoc()
    {
        $uploadPath = 'assets/uploads/imports/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, TRUE);
        }
        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'xlsx|xls';
        $config['max_size'] = 1000000;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('upload_excel')) {
            $fileData = $this->upload->data();
            return $fileData['file_name'];
        } else {
            return false;
        }
    }

    public function potong()
    {
        $DATE = $this->input->post('GET_POTONG');

        if ($DATE == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = substr($DATE, 0, 4);
            $BLN = substr($DATE, -2);
        }
        
        $bayar = $this->Import->getTemp();

        foreach ($bayar as $key) {

            $inBayar = array(
                'TGL_BAYAR' => $key['TANGGAL'],
                'BAYAR_BANK' => $key['NOMINAL'],
                'VIA_BAYAR' => 'BANK JATIM',
                'STATUS' => 'TERBAYAR',
            );

            $this->db->where('KODE_ANG', $key['KODE_ANG']);
            $this->db->where('TAHUN', $THN);
            $this->db->where('BULAN', $BLN);
            // $this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
            // $this->db->like('pembayaran.TGL_TGHN', date('Y-m', strtotime('-1 month')));
            $this->db->update('pembayaran', $inBayar);

            // $pl = [
            //     'TUNGGAKAN' => 0,
            // ];
            // $where = array(
            //     'TAHUN' => date('Y'),
            //     'BULAN' => date('m'),
            //     'KODE_ANG' => $key['KODE_ANG'],
            // );
            // $this->db->update('pl', $pl, $where);
        }
        $this->session->set_flashdata('succes', 'Data Berhasil di Potong');
        redirect('Import');
    }

    public function cetak()
    {
        function tanggal_indo2($tanggal)
        {
            $bulan = array(
                1 =>   'JANUARI',
                'FEBRUARI',
                'MARET',
                'APRIL',
                'MEI',
                'JUNI',
                'JULI',
                'AGUSTUS',
                'SEPTEMBER',
                'OKTOBER',
                'NOVEMBER',
                'DESEMBER'
            );
            $split = explode('-', $tanggal);
            // return $split[0] . ' ' . $bulan[ (int)$split[1] ];
            return $bulan[(int)$split[1]] . ' ' . $split[0];
        }

        // echo tanggal_indo2($TAHUN.'-'.$BULAN); // 20 Maret 2016

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
        
        $sheet->setCellValue('A1', 'DAFTAR POTONGAN BERHASIL '.tanggal_indo2(date("Y-m")));
        $sheet->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai E1

        $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->applyFromArray($style_head);

        // Buat header tabel nya pada baris ke 3
        $sheet->setCellValue('A3', "NO REK"); // Set kolom A3 dengan tulisan "NO REK"
        $sheet->setCellValue('B3', "NAMA ANGGOTA"); 
        $sheet->setCellValue('C3', "JUMLAH BERHASIL");
        $sheet->setCellValue('D3', "JUMLAH GAGAL");
        $sheet->setCellValue('E3', "TOTAL TUNGGAKAN");
        $sheet->setCellValue('F3', "NAMA INSTANSI");

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A3')->applyFromArray($style_col);
        $sheet->getStyle('B3')->applyFromArray($style_col);
        $sheet->getStyle('C3')->applyFromArray($style_col);
        $sheet->getStyle('D3')->applyFromArray($style_col);
        $sheet->getStyle('E3')->applyFromArray($style_col);
        $sheet->getStyle('F3')->applyFromArray($style_col);

        // $keuangan = $this->Pembayaran->cetakSukses();
        $keuangan = $this->Pembayaran->cetakSuksesGagal();
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 4; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($keuangan as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $data['REKENING']);
            $sheet->setCellValue('B' . $numrow, $data['NAMA_ANG']);
            $sheet->setCellValue('C' . $numrow, $data['Jumlah_berhasil']);
            $sheet->setCellValue('D' . $numrow, $data['Jumlah_gagal']);
            $sheet->setCellValue('E' . $numrow, $data['Total_tunggakan']);
            $sheet->setCellValue('F' . $numrow, $data['NAMA_INS']);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(20); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(30); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(20); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(20); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(20); // Set width kolom C
        $sheet->getColumnDimension('F')->setWidth(30); // Set width kolom C

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Data Potongan");
        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Berhasil ' . tanggal_indo2(date("Y-m")) . '.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
}
