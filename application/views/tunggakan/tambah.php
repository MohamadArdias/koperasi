<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php if ($this->session->flashdata('tambahA')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Pembayaran <strong><?= $this->session->flashdata('tambahA'); ?>, <a href="<?= base_url(); ?>index.php/pay/cetak">Cetak</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('tambahB')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Kode anggota <strong><?= $this->session->flashdata('tambahB'); ?></strong>
            </div>
        </div>
    </div>
<?php endif;
$user = $this->session->userdata('identity');
$sesUser = $this->db->get_where('users', ['email' => $user])->row_array();
?>


<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <form action="" method="POST">
                        <div class="form-group row mt-4 mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Kode Anggota</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="KODE" class="form-control" id="KODE" onkeyup="autofill()" autofocus>
                                    <input type="hidden" name="first_name" class="form-control" id="first_name" value="<?= $sesUser['first_name'] ?>" />
                                </div>
                                <small class="form-text text-danger"><?= form_error('KODE'); ?></small>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Periode</label>
                            <div class="col-sm-3">
                                <input type="text" name="TAHUN" class="form-control" id="TAHUN" value="<?= $THN; ?>" readonly>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="BULAN" class="form-control" id="BULAN" value="<?= $BLN; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="hidden" name="DETAIL" class="form-control" id="DETAIL">
                                <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Instansi</label>
                            <div class="col-sm-7">
                                <input type="text" name="NAMA_INS" class="form-control" id="NAMA_INS">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Sisa Tunggakan</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" name="TUNGGAKAN" class="form-control" id="TUNGGAKAN" readonly>
                                </div>
                                <small class="form-text text-danger"><?= form_error('TUNGGAKAN') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Tambah Tunggakan</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" id="TAMBAH" name="TAMBAH" min="1">
                                </div>
                                <small class="form-text text-danger"><?= form_error('TAMBAH') ?></small>
                            </div>
                        </div>
                        <div class="col-sm-7 text-end mt-3 ">
                            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                            <button type="submit" name="edit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h2>Anggota <?= $THN . '-' . $BLN; ?></h2>
                        <table class="table table-borderless datatable">
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                            </tr>
                            <?php
                            $query = $this->db->query("SELECT
                            *
                        FROM
                            pl
                            INNER JOIN
                            anggota
                            ON 
                                pl.KODE_ANG = anggota.KODE_ANG
                        WHERE
                            pl.TAHUN = $THN AND
                            pl.BULAN = $BLN AND
                            pl.KODE_ANG LIKE '%a%' AND
                            pl.POKU6 >= 1")->result_array();

                            foreach ($query as $key) {
                            ?>
                                <tr>
                                    <td><?= $key['KODE_ANG']; ?></td>
                                    <td><?= $key['NAMA_ANG']; ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$this->load->view('templates/footer');
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    function goBack() {
        window.history.back();
    }
    $(function() {
        $("#TGL_BAYAR").datepicker()
        $("#TGL_BAYAR").datepicker("option", "dateFormat", "yy-mm-dd")
    })

    function autofill() {
        var KODE = $('#KODE').val();
        var TAHUN = $('#TAHUN').val();
        var BULAN = $('#BULAN').val();
        $.ajax({
            url: '<?= base_url(); ?>index.php/tunggakan/autofill',
            data: {
                'KODE': KODE,
                'TAHUN': TAHUN,
                'BULAN': BULAN
            },
        }).success(
            function(data) {
                var json = data,
                    obj = JSON.parse(json);
                // $("#TAHUN").val(obj.TAHUN);
                // $("#BULAN").val(obj.BULAN);
                $("#NAMA_ANG").val(obj.nama);
                $("#NAMA_INS").val(obj.instansi);
                $("#TUNGGAKAN").val(obj.tunggakan);
                // var TERIMA = parseInt(JMLP_ANG) - parseInt(TANGGUNGAN);

                // var number_string = obj.tunggakan.toString(),
                //     sisa = number_string.length % 3,
                //     rupiah = number_string.substr(0, sisa),
                //     ribuan = number_string.substr(sisa).match(/\d{3}/g);

                // if (ribuan) {
                //     separator = sisa ? '.' : '';
                //     rupiah += separator + ribuan.join('.');
                // }

                // $("#TUNGGAKAN").val(rupiah);
            }
        );
    }
</script>