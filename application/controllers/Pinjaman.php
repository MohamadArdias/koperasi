<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
class Pinjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pinuang_model', 'Pinuang');
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->model('Us_model', 'Us');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->data['title'] = 'Pinjaman';
        $this->data['us'] = $this->Us->getTrx();

        $this->load->view('pinjaman/index', $this->data);
    }

    public function form($kode)
    {
        $a = $this->input->post('KODE_ANG', true);
        $bung = $this->input->post('PRO_ANG');


        if ($kode == 1) {
            $this->data['title'] = 'Pinjaman Uang';
            $kd = 'U';
        } elseif ($kode == 4) {
            $this->data['title'] = 'Pinjaman Non-Konsumsi';
            $kd = 'S';
        } elseif ($kode == 2) {
            $this->data['title'] = 'Pinjaman Konsumsi';
            $kd = 'O';
        } elseif ($kode == 3) {
            $this->data['title'] = 'Pinjaman UUB';
            $kd = 'N';
        } elseif ($kode == 7) {
            $this->data['title'] = 'Pinjaman Khusus';
            $kd = 'Z';
        }

        $this->data['urutan'] = $this->Pinuang->getUrut();
        $this->data['kode'] = $kode;

        $min = $this->input->post('TANGGUNGAN');

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('TANGGUNGAN', 'Tanggungan', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required|greater_than[' . $min . ']');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/form', $this->data);
        } else {
            // echo $kode;
            $aku = $this->Anggota->cekAnggota();
            if ($aku != 0) {
                $ku = $this->Anggota->cekFaktur();
                if ($ku == 0) {
                    $this->Pinuang->deleteTransaksi($a, $kd);

                    $tgl = $this->input->post('TGLP_ANG');
                    $where_pl = [
                        "TAHUN" => substr($tgl, 0, 4),
                        "BULAN" => substr($tgl, 5, 2),
                        "KODE_ANG" => $this->input->post('KODE_ANG', true),
                    ];

                    $this->db->update('pl', ['KEU' . $kode => 0], $where_pl);
                    $this->Pinuang->tambahTransaksi();
                    $this->Us->tambahTransaksi();
                    // $this->db->update('pl', $pl_uang, $where_uang);
                    // $this->Keuangan->editPlTransaksi($a, $kode);
                    $this->session->set_flashdata('flashP', 'ditambahkan');
                    redirect('pinjaman');
                } else {
                    $this->session->set_flashdata('nofak', 'sudah digunakan');
                    redirect('pinjaman');
                }
            } else {
                $this->session->set_flashdata('pinggl', 'salah');
                redirect('pinjaman');
            }
        }
    }

    public function print()
    {
        $this->data['title'] = 'Cetak Pinjaman';
        $this->load->view('pinjaman/print', $this->data);
    }

    public function autofill()
    {
        $a = $_GET['KODE_ANG'];
        $b = $_GET['KODE'];

        $query = $this->Anggota->getTanggungan($a, $b);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {
            if ($b == 'U') {
                $jangka = $query['JWK1'];
                $periode = $query['KEU1'];
                $sisa = $query['SIPOKU1'];
                $bunga = $query['BNGU1'];
            } elseif ($b == 'O') {
                $jangka = $query['JWK2'];
                $periode = $query['KEU2'];
                $sisa = $query['SIPOKU2'];
                $bunga = $query['BNGU2'];
            } elseif ($b == 'N') {
                $jangka = $query['JWK3'];
                $periode = $query['KEU3'];
                $sisa = $query['SIPOKU3'];
                $bunga = $query['BNGU3'];
            } elseif ($b == 'Z') {
                $jangka = $query['JWK7'];
                $periode = $query['KEU7'];
                $sisa = $query['SIPOKU7'];
                $bunga = $query['BNGU7'];
            } elseif ($b == 'S') {
                $jangka = $query['JWK4'];
                $periode = $query['KEU4'];
                $sisa = $query['SIPOKU4'];
                $bunga = $query['BNGU4'];
            }
            $data = array(
                'nama' => $query['NAMA_ANG'],
                'jangka' => $jangka,
                'periode' => $periode,
                'sisa' => $sisa,
                'bunga' => $bunga,
                'instansi' => $query['NAMA_INS'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA_ANG'],
                'jangka' => 0,
                'periode' => 0,
                'sisa' => 0,
                'bunga' => 0,                
                'instansi' => $query2['NAMA_INS'],
            );
            echo json_encode($data);
        }
    }

    public function autofill2()
    {
        $a = $_GET['KODE_ANG'];
        $b = $_GET['KODE'];

        $query = $this->Anggota->getTanggungan($a, $b);
        $query2 = $this->Anggota->getNama($a);

        if ($query != null) {

            $data = array(
                'nama' => $query['NAMA_ANG'],
                'sisa' => $query['SIPOKU8'],
                'bunga' => $query['BNGU8'],
                'ke_bunga' => $query['KE_BNGU8'],
                'instansi' => $query['NAMA_INS'],
            );

            echo json_encode($data);
        } else {
            $data = array(
                'nama' => $query2['NAMA_ANG'],
                'sisa' => 0,
                'bunga' => 0,
                'ke_bunga' => 0,
                'instansi' => $query2['NAMA_INS'],
            );
            echo json_encode($data);
        }
    }

    public function kantor()
    {
        $this->data['title'] = 'Pinjaman Kantor';

        $a = $this->input->post('KODE_ANG', true);
        $min = $this->input->post('TANGGUNGAN');

        $this->data['urutan'] = $this->Pinuang->getUrut();

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required|greater_than[' . $min . ']');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');

        $bung = $this->input->post('PRO_ANG');
        $kd = 'R';

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/kantor', $this->data);
        } else {
            $aku = $this->Anggota->cekAnggota();
            $jmlp_ang = $this->input->post('JMLP_ANG', true);

            if ($aku != 0) {
                $ku = $this->Anggota->cekFaktur();
                if ($ku == 0) {
                    $tgl = $this->input->post('TGLP_ANG');

                    $pl = [
                        "KEU8" => 0,
                        "SIPOKU8" => $jmlp_ang,
                        // "KE_BNGU8" => 0,
                    ];
                    $where_pl = [
                        "TAHUN" => substr($tgl, 0, 4),
                        "BULAN" => substr($tgl, 5, 2),
                        "KODE_ANG" => $this->input->post('KODE_ANG', true),
                    ];
                    $this->db->update('pl', $pl, $where_pl);

                    $this->Pinuang->deleteTransaksi($a, $kd);
                    $this->Pinuang->tambahTransaksi();
                    $this->Us->tambahTransaksi();
                    // $this->db->update('pl', $pl_uang, $where_uang);
                    // $this->Keuangan->editPlTransaksi($a, $kode);
                    $this->session->set_flashdata('flashP', 'ditambahkan');
                    redirect('pinjaman');
                } else {
                    $this->session->set_flashdata('nofak', 'sudah digunakan');
                    redirect('pinjaman');
                }
            } else {
                $this->session->set_flashdata('pinggl', 'salah');
                redirect('pinjaman');
            }
        }
    }

    public function edit($NOFAK)
    {
        $this->data['title'] = 'Edit Pinjaman ' . $NOFAK;
        $this->data['edit'] = $this->Us->editPinjaman($NOFAK);

        $this->form_validation->set_rules('id', 'Id', 'required');
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('NOFAK', 'Faktur', 'required');
        $this->form_validation->set_rules('KODE_ANG', 'Kode Anggota', 'required');
        $this->form_validation->set_rules('NAMA_ANG', 'Nama Anggota', 'required');
        $this->form_validation->set_rules('JMLP_ANG', 'Jumlah Pinjaman', 'required');
        $this->form_validation->set_rules('PRO_ANG', 'Bunga', 'required');
        $this->form_validation->set_rules('JWKT_ANG', 'Jangka Waktu', 'required');
        $this->form_validation->set_rules('TGLP_ANG', 'Tanggal Pinjam', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->load->view('pinjaman/formEdit', $this->data);
        } else {
            $this->Pinuang->editTransaksi();
            $this->Us->editTransaksi();
            $this->session->set_flashdata('flashP', 'diubah');
            redirect('pinjaman');
        }
    }

    public function cetakPinjaman()
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
        $sheet->setCellValue('A2', 'DAFTAR PINJAMAN ANGGOTA');
        $sheet->mergeCells('A2:F2');
        $sheet->setCellValue('A3', tanggal_indo2($THN.'-'.$BLN).'-'.$THN);
        $sheet->mergeCells('A3:F3');

        
        // $sheet->getStyle('A1')->getFont()->setBold(true); // Set bold kolom A1
        $sheet->getStyle('A1')->applyFromArray($style_head);
        $sheet->getStyle('A2')->applyFromArray($style_head);
        $sheet->getStyle('A3')->applyFromArray($style_head);

        // Buat header tabel nya pada baris ke 10
        $sheet->setCellValue('A6', "TANGGAL PINJAM"); // Set kolom A6 dengan tulisan "NO"
        $sheet->setCellValue('B6', "FAKTUR"); // Set kolom B6 dengan tulisan "NIS"
        $sheet->setCellValue('C6', "ANGGOTA"); // Set kolom B6 dengan tulisan "NIS"
        $sheet->setCellValue('D6', "INSTANSI"); // Set kolom C6 dengan tulisan "NAMA"
        $sheet->setCellValue('E6', "JUMLAH"); // Set kolom D6 dengan tulisan "JENIS KELAMIN"
        $sheet->setCellValue('F6', "JANGKA"); // Set kolom E6 dengan tulisan "ALAMAT"
        $sheet->setCellValue('G6', "PERIODE"); // Set kolom E6 dengan tulisan "ALAMAT"
        $sheet->setCellValue('H6', "SISA PINJAMAN"); // Set kolom E6 dengan tulisan "ALAMAT"

        // Apply style header yang telah kita buat tadi ke masing-masing kolom header
        $sheet->getStyle('A6')->applyFromArray($style_col);
        $sheet->getStyle('B6')->applyFromArray($style_col);
        $sheet->getStyle('C6')->applyFromArray($style_col);
        $sheet->getStyle('D6')->applyFromArray($style_col);
        $sheet->getStyle('E6')->applyFromArray($style_col);
        $sheet->getStyle('F6')->applyFromArray($style_col);
        $sheet->getStyle('G6')->applyFromArray($style_col);
        $sheet->getStyle('H6')->applyFromArray($style_col);

        // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya

        $keuangan = $this->Pinuang->getPinjaman($THN, $BLN);
        $no = 1; // Untuk penomoran tabel, di awal set dengan 1
        $numrow = 7; // Set baris pertama untuk isi tabel adalah baris ke 4
        foreach ($keuangan as $key) { // Lakukan looping pada variabel siswa
            if (strpos($key['NOFAK'], 'U') !== false) {
                $angka = 1;
            } elseif (strpos($key['NOFAK'], 'N') !== false) {
                $angka = 3;
            } elseif (strpos($key['NOFAK'], 'O') !== false) {
                $angka = 2;
            } elseif (strpos($key['NOFAK'], 'Z') !== false) {
                $angka = 7;
            } elseif (strpos($key['NOFAK'], 'S') !== false) {
                $angka = 4;
            } elseif (strpos($key['NOFAK'], 'R') !== false) {
                $angka = 8;
            }

            $sheet->setCellValue('A' . $numrow, $key['TGLP_ANG']);
            $sheet->setCellValue('B' . $numrow, $key['NOFAK']);
            $sheet->setCellValue('C' . $numrow, $key['KODE_ANG'].'-'.$key['NAMA_ANG']);
            $sheet->setCellValue('D' . $numrow, $key['KODE_INS'].'-'.$key['NAMA_INS']);
            $sheet->setCellValue('E' . $numrow, $key['JMLP_ANG']);
            $sheet->setCellValue('F' . $numrow, $key['JWKT_ANG']);
            $sheet->setCellValue('G' . $numrow, $key['KEU' . $angka]);
            $sheet->setCellValue('H' . $numrow, $key['SIPOKU' . $angka]);

            // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
            $sheet->getStyle('A' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('B' . $numrow)->applyFromArray($style_row_mid);
            $sheet->getStyle('C' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('D' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('E' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('F' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('G' . $numrow)->applyFromArray($style_row);
            $sheet->getStyle('H' . $numrow)->applyFromArray($style_row);

            $no++; // Tambah 1 setiap kali looping
            $numrow++; // Tambah 1 setiap kali looping
        }

        $sheet->getColumnDimension('A')->setWidth(20); // Set width kolom A
        $sheet->getColumnDimension('B')->setWidth(17); // Set width kolom B
        $sheet->getColumnDimension('C')->setWidth(40); // Set width kolom C
        $sheet->getColumnDimension('D')->setWidth(30); // Set width kolom D
        $sheet->getColumnDimension('E')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('F')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('G')->setWidth(15); // Set width kolom E
        $sheet->getColumnDimension('H')->setWidth(17); // Set width kolom E

        // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
        $sheet->getDefaultRowDimension()->setRowHeight(-1);

        // Set judul file excel nya
        $sheet->setTitle("Daftar Pinjaman Anggota");
        // Proses file excel
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Pinjaman ' . tanggal_indo2($THN . '-' . $BLN) . '.xls"');
        header('Cache-Control: max-age=0');

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
        $writer->save('php://output');
    }
}
