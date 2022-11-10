<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Import extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Import_model');
    }



    public function index()
    {
        $this->data['title'] = 'Import Bank Jatim';
        $this->data['temp'] = $this->Import_model->getDataMasuk();
        $this->load->view('import/index', $this->data);
    }

    public function uploaddata()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();
            $reader->setShouldFormatDates(true);
            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $datamasuk = array(
                            'TANGGAL'            => $row->getCellAtIndex(0),
                            'NO_REKENING'        => $row->getCellAtIndex(1),
                            'NAMA'               => $row->getCellAtIndex(2),
                            'NOMINAL'            => $row->getCellAtIndex(3),
                            'KOP'                => $row->getCellAtIndex(4),
                        );
                        $this->Import_model->import_data($datamasuk);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect('import');
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
}
