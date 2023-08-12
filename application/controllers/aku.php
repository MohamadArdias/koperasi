<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

class aku extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Us_model', 'Us');
        // $this->load->model('Instansi_model', 'Instansi');
        $this->load->library('form_validation');
        $this->load->library('pdf');
    }

    public function index()
    {
        $query = $this->db->query("SELECT * FROM simp_0 WHERE KODE_ANG = '1762' LIMIT 1")->num_rows();

        echo $query;
    }

    public function edit()
    {
        $query = $this->db->query("SELECT * FROM `testing`")->result_array();

        foreach ($query as $key ) {
            $pl = array(
                'nama' => $this->input->post('name'.$key['id']),
            );
            
            $where = array(
                'id' => $this->input->post('id'.$key['id']),
            );

            $this->db->update('testing', $pl, $where);            
        }
    }

    public function rekening()
    {
        $no_rek = str_replace(' ', '', "0022067222");

        $query = $this->db->query("SELECT REKENING FROM anggota WHERE REKENING = $no_rek");       
        $query = $query->row();

        echo $query->REKENING;
            
            // foreach ($query as $key) {
            //     echo "No Rekening: ". $key['REKENING'];
            // }
            

        // // Query untuk mencari data berdasarkan nomor rekening
        // $sql = "SELECT * FROM anggota WHERE REKENING = '$no_rek'";

        // $result = mysqli_query($conn, $sql);

        // if (mysqli_num_rows($result) > 0) {
        //     // Tampilkan data yang ditemukan
        //     while ($row = mysqli_fetch_assoc($result)) {
        //         echo "No Rekening: " . $row['NO_REK'] . "<br>";
        //         // Tampilkan kolom-kolom data lainnya...
        //     }
        // } else {
        //     echo "Data tidak ditemukan.";
        // }
    }
}
