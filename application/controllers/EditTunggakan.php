<?php

// use PhpOffice\PhpSpreadsheet\Spreadsheet;

class EditTunggakan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_model', 'Anggota');
        $this->load->model('Instansi_model', 'Instansi');
        $this->load->model('Pinsimp_model', 'Pinsimp');
        $this->load->model('Tunggakan_model', 'Tunggakan');
        $this->load->model('Keuangan_model', 'Keuangan');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        if ($TAHUN == '' and $BULAN == '') {
            $THN = date('Y');
            $BLN = date('m');
        } else {
            $THN = $TAHUN;
            $BLN = $BULAN;
        }

        $this->data['title'] = 'Edit Tunggakan';

        $this->data['query'] = $this->Keuangan->getTunggakan($THN, $BLN);
        $this->load->view('tunggakan/edit', $this->data);
    }

    public function edit()
    {
        $THN = $this->input->post('TAHUN');
        $BLN = $this->input->post('BULAN');

        $query = $this->Keuangan->getTunggakan($THN, $BLN);
        foreach ($query as $key) {

            $a = $this->input->post('name' . $key['KODE_ANG']);

            if ($a == null or $a <= 0) {
                $ket = 0;
            } else {
                $ket = $a;
            }

            $pl = array(
                'POKU6' => $ket, //KET = kolom untuk pl sekarang
            );

            $where = array(
                'KODE_ANG' => $this->input->post('id' . $key['KODE_ANG']),
                'TAHUN' => $THN,
                'BULAN' => $BLN,
            );

            $this->db->update('pl', $pl, $where);
        }
        // $this->session->set_flashdata('flash', 'diubah');
        ?>
        <script>
            // Menutup jendela saat ini setelah proses edit selesai
            window.close();
        </script>
        <?php

    }

    public function editIns($kodeIns)
    {
        $tahun = $this->input->get('TAHUN');
        $bulan = $this->input->get('BULAN');

        // Array nama-nama bulan dalam bahasa Indonesia
        $nama_bulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        );

        // Membuat tanggal dalam format Indonesia
        $tanggal_indonesia = $nama_bulan[(int)$bulan] . ' ' . $tahun;

        // Output tanggal dalam format Indonesia
        // echo "Tanggal: " . $tanggal_indonesia;


        $data = $this->Tunggakan->getEditIns($kodeIns);
        $this->data['title'] = 'Edit Tunggakan '.$data['NAMA_INS'].' Bulan '.$tanggal_indonesia;

        $this->data['query'] = $this->Tunggakan->getTunggakanByIns($kodeIns, $tahun, $bulan);
        $this->load->view('tunggakan/editByIns', $this->data);
    }
}
