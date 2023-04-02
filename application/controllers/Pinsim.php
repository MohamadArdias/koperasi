<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Pinsim extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Informasi Simpanan Anggota';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['keuangan'] = $this->Pinsimp->getTabungan($THN, $BLN);

        $this->load->view('pinsim/index', $this->data);
    }

    public function cetakPinsim()
    {
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
            return $bulan[(int)$split[1]];
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
        $THN = $this->input->post('TAHUN');
        $BLN = $this->input->post('BULAN');

        setlocale(LC_ALL, 'id-ID', 'id_ID');
        date_default_timezone_set("Asia/Jakarta");

        $sheet->setCellValue('A1', 'KOPERASI BANGKIT BERSAMA KANTOR PEMKAB BWI');
        $sheet->mergeCells('A1:F1'); // Set Merge Cell pada kolom A1 sampai E1
        $sheet->setCellValue('A2', 'DAFTAR SIMPANAN ANGGOTA');
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A3', tanggal_indo2($THN.'-'.$BLN).'-'.$THN);
        $sheet->mergeCells('A3:F3');

        
        // $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->applyFromArray($style_head);
        $sheet->getStyle('A2')->applyFromArray($style_head);
        $sheet->getStyle('A3')->applyFromArray($style_head);

        // Buat header tabel nya pada baris ke 10
        $sheet->setCellValue('A6', "NO"); // Set kolom A6 dengan tulisan "NO"
        $sheet->setCellValue('B6', "ANGGOTA"); // Set kolom B6 dengan tulisan "NIS"
        $sheet->setCellValue('C6', "INSTANSI"); // Set kolom C6 dengan tulisan "NAMA"
        $sheet->setCellValue('D6', "WAJIB AWAL TAHUN"); // Set kolom D6 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('E6', "WAJIB ".$THN); // Set kolom E6 dengan tulisan "ALAMAT"
        $sheet->setCellValue('F6', "TOTAL WAJIB"); // Set kolom E6 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A6')->applyFromArray($style_col);
        $sheet->getStyle('B6')->applyFromArray($style_col);
        $sheet->getStyle('C6')->applyFromArray($style_col);
        $sheet->getStyle('D6')->applyFromArray($style_col);
        $sheet->getStyle('E6')->applyFromArray($style_col);
        $sheet->getStyle('F6')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $keuangan = $this->Pinsimp->getTabungan($THN, $BLN);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($keuangan as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $no);
            $sheet->setCellValue('B' . $numrow, $data['KODE_ANG'].'-'.$data['NAMA_ANG']);
            $sheet->setCellValue('C' . $numrow, $data['KODE_INS'].'-'.$data['NAMA_INS']);
            $sheet->setCellValue('D' . $numrow, $data['TOTWJB']);
            $sheet->setCellValue('E' . $numrow, $data['TWAJIB'] - $data['TOTWJB']);
            $sheet->setCellValue('F' . $numrow, $data['TWAJIB']);

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

        $sheet->getColumnDimension('A')->setWidth(5); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(40); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(30); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(25); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(17); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(20); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Daftar Simpanan Anggota");
        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Simpanan ' . tanggal_indo2($THN . '-' . $BLN) . '.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    // public function cetak($KODE_ANG)
    // {
    //     $this->data['title'] = 'Cetak Anggota';
    //     $this->data['keuangan'] = $this->Keuangan->getKeuanganByKode($KODE_ANG);

    //     $this->load->view('pinsim/cetak', $this->data);
    // }

    public function pinjaman()
    {
        $this->data['title'] = 'Informasi Pinjaman Anggota';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['pinjaman'] = $this->Pinuang->getPinjaman($THN, $BLN);

        $this->load->view('pinsim/pinjaman', $this->data);
    }

    

    public function tunggakan()
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

        $this->data['title'] = 'Tunggakan '.$THN.'-'.$BLN;
        $this->data['tunggakan'] = $this->Pinuang->tunggakan($THN, $BLN);

        $this->load->view('pinsim/tunggakan', $this->data);
    }
}
