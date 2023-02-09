<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->library('form_validation');
    }

    public function histori($URUT_ANG)
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

        $aku = $this->db->query("SELECT * FROM anggota INNER JOIN instan ON anggota.KODE_INS = instan.KODE_INS WHERE anggota.URUT_ANG = $URUT_ANG")->row_array();

        $sheet->setCellValue('A1', "NAMA");
        $sheet->setCellValue('B1', ': ' . $aku['URUT_ANG'] . '/' . $aku['NAMA_ANG']);
        $sheet->setCellValue('A2', "INSTANSI");
        $sheet->setCellValue('B2', ': ' . $aku['KODE_INS'] . '/' . $aku['NAMA_INS']);

        // Buat header tabel nya pada baris ke 10
        $sheet->setCellValue('A4', "TANGGAL"); // Set kolom A10 dengan tulisan "NO"
        // $sheet->setCellValue('B4', "UUB"); // Set kolom B10 dengan tulisan "NIS"
        $sheet->setCellValue('B4', "Konsumsi"); // Set kolom C10 dengan tulisan "NAMA"
        $sheet->mergeCells('B4:C4');
        $sheet->setCellValue('D4', "SP"); // Set kolom D10 dengan tulisan "JENIS KELAMIN"
        $sheet->mergeCells('D4:E4');
        $sheet->setCellValue('F4', "NON"); 
        $sheet->mergeCells('F4:G4');
        $sheet->setCellValue('H4', "KHUSUS"); 
        $sheet->mergeCells('H4:I4');
        $sheet->setCellValue('J4', "UUB"); 
        $sheet->mergeCells('J4:K4');
        // $sheet->setCellValue('F4', "Khusus"); 
        $sheet->setCellValue('L4', "Wajib"); 
        $sheet->setCellValue('M4', "Tagihan"); 
        $sheet->setCellValue('N4', "Tunggakan"); 
        $sheet->setCellValue('O4', "Total"); 
        $sheet->setCellValue('P4', "Terbayar"); 


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A4')->applyFromArray($style_col);
        $sheet->getStyle('B4')->applyFromArray($style_col);
        $sheet->getStyle('C4')->applyFromArray($style_col);
        $sheet->getStyle('D4')->applyFromArray($style_col);
        $sheet->getStyle('E4')->applyFromArray($style_col);
        $sheet->getStyle('F4')->applyFromArray($style_col);
        $sheet->getStyle('G4')->applyFromArray($style_col);
        $sheet->getStyle('H4')->applyFromArray($style_col);
        $sheet->getStyle('I4')->applyFromArray($style_col);
        $sheet->getStyle('J4')->applyFromArray($style_col);
        $sheet->getStyle('K4')->applyFromArray($style_col);
        $sheet->getStyle('L4')->applyFromArray($style_col);
        $sheet->getStyle('M4')->applyFromArray($style_col);
        $sheet->getStyle('N4')->applyFromArray($style_col);
        $sheet->getStyle('O4')->applyFromArray($style_col);
        $sheet->getStyle('P4')->applyFromArray($style_col);
        // $sheet->getStyle('I4')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $histori = $this->Keuangan->histo($URUT_ANG);
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($histori as $data) { // Lakukan looping pada variabel siswa
            $uang = $data['POKU1'] + $data['BNGU1'];
            $kons = $data['POKU2'] + $data['BNGU2'];
            $non = $data['POKU3'] + $data['BNGU3'];
            $khus = $data['POKU7'] + $data['BNGU7'];
            $uub = $data['POKU4'] + $data['BNGU4'];
            // $tagihan = $uang+$kons+$non+$khus+$uub+$data['WAJIB'];
            $tagihan = $uang+$kons+$non+$khus+$uub+$data['WAJIB'];
            $tung = $data['POKU6'];

            $sheet->setCellValue('A' . $numrow, $data['TAHUN'].'-'.$data['BULAN']);
            // $sheet->setCellValue('B' . $numrow, $uub.' (X'.$data['KEU4'].')');
            $sheet->setCellValue('B' . $numrow, $data['KEU2']);
            $sheet->setCellValue('C' . $numrow, $kons);
            $sheet->setCellValue('D' . $numrow, $data['KEU1']);
            $sheet->setCellValue('E' . $numrow, $uang);
            $sheet->setCellValue('F' . $numrow, $data['KEU3']);
            $sheet->setCellValue('G' . $numrow, $non);
            $sheet->setCellValue('H' . $numrow, $data['KEU7']);
            $sheet->setCellValue('I' . $numrow, $khus);
            $sheet->setCellValue('J' . $numrow, $data['KEU4']);
            $sheet->setCellValue('K' . $numrow, $uub);
            // $sheet->setCellValue('F' . $numrow, $khus.' (X'.$data['KEU7'].')');
            $sheet->setCellValue('L' . $numrow, $data['WAJIB']);
            $sheet->setCellValue('M' . $numrow, $tagihan);
            $sheet->setCellValue('N' . $numrow, $tung);
            $sheet->setCellValue('O' . $numrow, $tagihan+$tung);
            $sheet->setCellValue('P' . $numrow, $data['JML_BAYAR']+$data['BAYAR_BANK']);

            // $thn = $data['TAHUN'];
            // $bln = $data['BULAN'];
            // $kd = $data['URUT_ANG'];

            // $didi = $this->db->query("SELECT pembayaran.JML_BAYAR AS hal FROM pembayaran WHERE TGL_TGHN LIKE '%$thn-$bln%' AND pembayaran.KODE_ANG = $kd")->row_array();
                

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('J' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('K' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('L' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('M' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('N' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('O' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('P' . $numrow)->applyFromArray($style_row);
            // $sheet->getStyle('I' . $numrow)->applyFromArray($style_row);

            // $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(5); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(12); // Set width kolom B
        $sheet->getColumnDimension('D')->setWidth(5); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('H')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('I')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('J')->setWidth(5); // Set width kolom E
        $sheet->getColumnDimension('K')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('L')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('M')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('N')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('O')->setWidth(12); // Set width kolom E
        $sheet->getColumnDimension('P')->setWidth(12); // Set width kolom E
        // $sheet->getColumnDimension('I')->setAutoSize(true); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Data Potongan");

        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$aku['NAMA_ANG'].'.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    public function histori2($URUT_ANG)
    {
        $query = $this->db->query("SELECT * FROM anggota WHERE URUT_ANG = $URUT_ANG")->row_array();
        $this->data['get'] = $this->db->query("SELECT * FROM anggota WHERE URUT_ANG = $URUT_ANG")->row_array();

        $this->data['title'] = 'Histori '.$query['NAMA_ANG'];
		// $this->data['anggota'] = $this->Dashboard->getHistori($URUT_ANG);
        $this->data['anggota'] = $this->Keuangan->histo($URUT_ANG);
		$this->load->view('dashboard/histori', $this->data);
    }

    public function contoh()
    {
        $this->load->view('anggota/contoh');
    }

    public function index()
    {
        $this->data['title'] = 'Tabel Anggota';

        $this->data['anggota'] = $this->Anggota->getAnggota();

        $this->load->view('anggota/index', $this->data);
    }

    public function keluar()
    {
        $this->data['title'] = 'Tabel Anggota Keluar';

        $this->load->view('anggota/keluar', $this->data);
    }

    public function berhenti($URUT_ANG)
    {
        $this->data['title'] = 'Detail Data Anggota';
        $this->data['berhenti'] = $this->Anggota->getAnggotaById($URUT_ANG);

        $this->form_validation->set_rules('STATUS', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/berhenti', $this->data);
        } else {
            $this->Anggota->editStatus();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('anggota');
        }
    }

    public function detail($URUT_ANG)
    {
        $this->data['title'] = 'Detail Data Anggota';
        $this->data['anggota'] = $this->Anggota->getAnggotaById($URUT_ANG);
        $this->load->view('anggota/detail', $this->data);
    }

    public function tambah()
    {
        $this->data['title'] = 'Tambah Data Anggota';
        $this->data['instansi'] = $this->Instansi->getAllInstansi();

        // $this->form_validation->set_rules('KODE_ANG', 'kode anggota', 'required');
        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'instansi', 'required');
        // $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        // $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        // $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        // $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');
        // $this->form_validation->set_rules('GOL', 'golongan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/tambah', $this->data);
        } else {
            $id   = $_POST['URUT_ANG'];

            $query = $this->db->get_where('anggota', array( //making selection
                'URUT_ANG' => $id
            ));
            $count = $query->num_rows(); //counting result from query

            if ($count === 0) {
                $this->Anggota->tambahDataAnggota();
                $this->Pinsimp->pinsimpAnggota();
                $this->Keuangan->keuanganAnggota();
                $this->session->set_flashdata('flash', 'ditambahkan');
                redirect('Anggota');
            } else {
                $this->session->set_flashdata('addAng', 'KODE ANGGOTA');
                $this->load->view('anggota/tambah', $this->data);
            }
        }
    }

    public function hapus($URUT_ANG)
    {
        $this->Anggota->hapusDataAnggota($URUT_ANG);
        $this->session->set_flashdata('flash', 'dihapus');
        redirect('Anggota');
    }

    public function edit($URUT_ANG)
    {
        $this->data['title'] = 'Edit Data Anggota';
        $this->data['anggota'] = $this->Anggota->getAnggotaById($URUT_ANG);
        $this->data['instansi'] = $this->Instansi->getAllInstansi();

        $this->form_validation->set_rules('URUT_ANG', 'nomor urut anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'nama anggota', 'required');
        $this->form_validation->set_rules('KODE_INS', 'kode instansi', 'required');
        // $this->form_validation->set_rules('NAMA_INS', 'nama instansi', 'required');
        // $this->form_validation->set_rules('ALM_ANG', 'alamat', 'required');
        // $this->form_validation->set_rules('TLHR_ANG', 'tanggal lahir', 'required');
        // $this->form_validation->set_rules('TGLM_ANG', 'tanggal masuk', 'required');
        // $this->form_validation->set_rules('TGLK_ANG', 'tanggal keluar', 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('anggota/edit', $this->data);
        } else {
            $this->Anggota->editDataAnggota();
            $this->session->set_flashdata('flash', 'diubah');
            redirect('anggota');
        }
    }
}
