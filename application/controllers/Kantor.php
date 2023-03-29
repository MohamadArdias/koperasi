<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;

class Kantor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Tunggakan_model', 'Tunggakan');
        $this->load->model('Pay_model', 'Pay');
        $this->load->model('Kirim_model', 'Kirim');
        // $this->load->model('Instansi_model', 'Instansi'); //'Instansi' adalah alias dari 'Instansi_model'
        $this->load->model('Keuangan_model', 'keuangan');
        $this->load->model('Pengurus_model', 'Pengurus');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Us_model', 'Us');
        $this->load->library('pdf');        
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pembayaran Kantor';

        $this->form_validation->set_rules('KODE', 'Kode anggota', 'required');
        $this->form_validation->set_rules('TGL_BAYAR', 'Tanggal Bayar', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('kantor/index', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggotaKan();
            if ($aku != 0) {
                $this->Pay->bayarKantor();  //tinggal bayarnya
                $this->session->set_flashdata('bayarB', 'berhasil');
                redirect('kantor');
            } else {
                $this->session->set_flashdata('bayarG', 'salah');
                redirect('kantor');
            }
        }
    }

    public function autofill()
    {
        $a = $_GET['KODE'];

        $query = $this->Pay->getKantor($a);

        //  echo $this->db->last_query();

        $tahun = $query['TAHUN'];
        $bulan = $query['BULAN'];

        $detail = $this->db->query("SELECT SUM(POKU) AS POKU, SUM(BNGU) AS BNGU FROM kantor_detail WHERE TAHUN = $tahun and BULAN = '$bulan' and KODE_ANG = '$a'")->row();
        // //   echo $detail->jumlah;
        // // $tagihan = $query['JML_TGHN'] - $detail;
        // $bayar = ($query['KE_BNGU8']*$query['BNGU8'])-$detail->jumlah;

        // if ($bayar < 0) {
        //     $total_bayar = 0;
        // } else {
        //     $total_bayar = $bayar;
        // }

        if ($query != null) {
            $data = array(                
                'TAHUN' => $tahun,
                'BULAN' => $bulan,
                'nama' => $query['NAMA_ANG'],
                'instansi' => $query['NAMA_INS'],
                // 'BUNGA' => $query['KE_BNGU8']*$query['BNGU8'],
                'bunga' => $query['SIBNGU8']-$query['BNGU8'],
                'pokok' => $query['SIPOKU8']-$query['POKU8'],
                // 'TTL_BUNGA' => $total_bayar,
                // 'tagihan' => $query['SIPOKU8']+($query['KE_BNGU8']*$query['BNGU8'])-$detail->jumlah,
                // 'tagihan' => 6666,
                // 'tagihan' => $detail->jumlah,
                'detail_poku' => $detail->POKU,
                'detail_bngu' => $detail->BNGU,
            );
            echo json_encode($data);
        }
    }

    public function cetak()
    {
        $this->data['title'] = 'Cetak Pembayaran Kantor';
        $this->data['data'] = $this->Pay->getCetakKantor();

        $this->load->view('kantor/cetak', $this->data);
    }

    public function print($KODE_ANG)
    {
        $this->data['print'] = $this->Pay->getPrintKantor($KODE_ANG);

        $this->load->view('kantor/print', $this->data);
    }

    public function pinjaman()
    {
        $this->data['title'] = 'Informasi Pinjaman Kantor';

        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' AND $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['pinjaman'] = $this->Pay->getPinjaman($THN, $BLN);

        $this->load->view('kantor/pinjaman', $this->data);
    }

    public function daftar($KODE_ANG)
    {
        $query = $this->db->query("SELECT * FROM anggota WHERE KODE_ANG = $KODE_ANG")->row_array();
        $this->data['title'] = 'Histori '.$query['NAMA_ANG'];

        $this->data['get'] = $this->db->query("SELECT * FROM anggota WHERE KODE_ANG = $KODE_ANG")->row_array();
		// $this->data['anggota'] = $this->Dashboard->getHistori($KODE_ANG);
        $this->data['anggota'] = $this->Pay->histo($KODE_ANG);
		$this->load->view('kantor/histori', $this->data);
    }

    public function histori($KODE_ANG)
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

        $aku = $this->db->query("SELECT * FROM anggota INNER JOIN instan ON anggota.KODE_INS = instan.KODE_INS WHERE anggota.KODE_ANG = $KODE_ANG")->row_array();

        $sheet->setCellValue('A1', "NAMA");
        $sheet->setCellValue('B1', ': ' . $aku['KODE_ANG'] . '/' . $aku['NAMA_ANG']);
        $sheet->setCellValue('A2', "INSTANSI");
        $sheet->setCellValue('B2', ': ' . $aku['KODE_INS'] . '/' . $aku['NAMA_INS']);

        // Buat header tabel nya pada baris ke 10
        $sheet->setCellValue('A4', "TANGGAL");
        $sheet->setCellValue('B4', "PERIODE");
        $sheet->setCellValue('C4', "SISA POKOK");
        $sheet->setCellValue('D4', "SISA BUNGA"); 
        $sheet->setCellValue('E4', "TOTAL TAGIHAN"); 
        $sheet->setCellValue('F4', "BAYAR POKOK"); 
        $sheet->setCellValue('G4', "BAYAR BUNGA"); 


        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A4')->applyFromArray($style_col);
        $sheet->getStyle('B4')->applyFromArray($style_col);
        $sheet->getStyle('C4')->applyFromArray($style_col);
        $sheet->getStyle('D4')->applyFromArray($style_col);
        $sheet->getStyle('E4')->applyFromArray($style_col);
        $sheet->getStyle('F4')->applyFromArray($style_col);
        $sheet->getStyle('G4')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
        $histori = $this->Pay->histo2($KODE_ANG);
        // $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 5; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($histori as $data) { // Lakukan looping pada variabel siswa
            $sheet->setCellValue('A' . $numrow, $data['TAHUN'].'-'.$data['BULAN']);
            // $sheet->setCellValue('B' . $numrow, $uub.' (X'.$data['KEU4'].')');
            $sheet->setCellValue('B' . $numrow, $data['KEU8']);
            $sheet->setCellValue('C' . $numrow, $data['SIPOKU8']);
            $sheet->setCellValue('D' . $numrow, $data['SIBNGU8']);
            $sheet->setCellValue('E' . $numrow, $data['SIPOKU8']+$data['SIBNGU8']);
            $sheet->setCellValue('F' . $numrow, $data['POKU8']);
            $sheet->setCellValue('G' . $numrow, $data['BNGU8']);


            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);

            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setAutoSize(true); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(9); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(12); // Set width kolom B
        $sheet->getColumnDimension('D')->setWidth(12); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(15); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Pinjaman Kantor");

        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$aku['NAMA_ANG'].'.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }

    // public function instansi()
    // {
    //     $TAHUN = $this->input->get('TAHUN');
    //     $BULAN = $this->input->get('BULAN');

    //     if ($TAHUN == '' and $BULAN == '') {
    //         $THN = date('Y');
    //         $BLN = date('m');
    //     } else {
    //         $THN = $TAHUN;
    //         $BLN = $BULAN;
    //     }

    //     $this->data['title'] = 'Cetak Per Instansi';
    //     $this->data['keuangan'] = $this->Pay->getInsKantor($THN, $BLN);

    //     $this->load->view('kantor/instansi', $this->data);
    // }

    // public function printins($KODE_INS)
    // {
    //     $TAHUN = $this->input->get('TAHUN');
    //     $BULAN = $this->input->get('BULAN');

    //     $this->data['keuangan'] = $this->Pay->getIns($KODE_INS, $TAHUN, $BULAN);
    //     $this->data['instansi'] = $this->keuangan->getInstansi($KODE_INS);
    //     $this->data['pengurus'] = $this->keuangan->getPengurus();
    //     $this->data['jumlah'] = $this->keuangan->jumlahAnggotaKantor($KODE_INS, $TAHUN, $BULAN);

    //     $this->load->view('kantor/printins', $this->data);
    // }

    // public function printinsang($KODE_INS)
    // {
    //     $TAHUN = $this->input->get('TAHUN');
    //     $BULAN = $this->input->get('BULAN');

    //     $this->data['printang'] = $this->Pay->getIns($KODE_INS, $TAHUN, $BULAN);
    //     $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
    //     $this->data['jumlah'] = $this->keuangan->jumlahAnggotaKantor($KODE_INS, $TAHUN, $BULAN);

    //     $this->load->view('kantor/printinsang', $this->data);
    // }
}
