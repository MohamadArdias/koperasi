<?php
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
        $this->form_validation->set_rules('TAGIHAN', 'Tagihan', 'required');
        $this->form_validation->set_rules('JML_BAYAR', 'Bayar', 'required');
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

        $detail = $this->db->query("SELECT SUM(JML_BAYAR) AS jumlah FROM kantor_detail WHERE TAHUN = $tahun and BULAN = '$bulan' and KODE_ANG = '$a'")->row();
        //   echo $detail->jumlah;
        // $tagihan = $query['JML_TGHN'] - $detail;
        $bayar = ($query['KE_BNGU8']*$query['BNGU8'])-$detail->jumlah;

        if ($bayar < 0) {
            $total_bayar = 0;
        } else {
            $total_bayar = $bayar;
        }

        if ($query != null) {
            $data = array(                
                'TAHUN' => $tahun,
                'BULAN' => $bulan,
                'nama' => $query['NAMA_ANG'],
                'instansi' => $query['NAMA_INS'],
                'BUNGA' => $query['KE_BNGU8']*$query['BNGU8'],
                'TTL_BUNGA' => $total_bayar,
                'tagihan' => $query['SIPOKU8']+($query['KE_BNGU8']*$query['BNGU8'])-$detail->jumlah,
                // 'tagihan' => 6666,
                // 'tagihan' => $detail->jumlah,
                'detail' => $detail->jumlah,
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

    public function instansi()
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

        $this->data['title'] = 'Cetak Per Instansi';
        $this->data['keuangan'] = $this->Pay->getInsKantor($THN, $BLN);

        $this->load->view('kantor/instansi', $this->data);
    }

    public function printins($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['keuangan'] = $this->Pay->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['instansi'] = $this->keuangan->getInstansi($KODE_INS);
        $this->data['pengurus'] = $this->keuangan->getPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggotaKantor($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('kantor/printins', $this->data);
    }

    public function printinsang($KODE_INS)
    {
        $TAHUN = $this->input->get('TAHUN');
        $BULAN = $this->input->get('BULAN');

        $this->data['printang'] = $this->Pay->getIns($KODE_INS, $TAHUN, $BULAN);
        $this->data['Pengurus'] = $this->Pengurus->getAllPengurus();
        $this->data['jumlah'] = $this->keuangan->jumlahAnggotaKantor($KODE_INS, $TAHUN, $BULAN);

        $this->load->view('kantor/printinsang', $this->data);
    }
}
