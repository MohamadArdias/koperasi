<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
class Import extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model', 'Import');
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
        $bayar = $this->Import->getTemp();

        foreach ($bayar as $key) {

            $inBayar = array(
                'TGL_BAYAR' => $key['TANGGAL'],
                'JML_BAYAR' => $key['NOMINAL'],
                'VIA_BAYAR' => 'BANK JATIM',
                'STATUS' => 'TERBAYAR',
                'SISA' => 0,
            );

            $this->db->where('KODE_ANG', $key['URUT_ANG']);
            $this->db->like('pembayaran.TGL_TGHN', date('Y-m'));
            // $this->db->like('pembayaran.TGL_TGHN', date('Y-m', strtotime('-1 month')));
            $this->db->update('pembayaran', $inBayar);

            $pl = [
                'TUNGGAKAN' => 0,
            ];
            $where = array(
                'TAHUN' => date('Y'),
                'BULAN' => date('m'),
                'KODE_ANG' => $key['URUT_ANG'],
            );
            $this->db->update('pl', $pl, $where);
        }
    }
}
