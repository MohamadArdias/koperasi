<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php if ($this->session->flashdata('bayarB')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Pembayaran <strong><?= $this->session->flashdata('bayarB'); ?>, <a href="<?= base_url(); ?>index.php/kantor/cetak">Cetak</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('bayarG')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Kode anggota <strong><?= $this->session->flashdata('bayarG'); ?></strong>
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
                                <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Nama</label>
                            <div class="col-sm-7">
                                <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG">
                                <input type="hidden" name="DETAIL" class="form-control" id="DETAIL">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Instansi</label>
                            <div class="col-sm-7">
                                <input type="text" name="KODE_INS" class="form-control" id="KODE_INS">
                                <input type="hidden" name="DETAIL" class="form-control" id="DETAIL">
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Periode</label>
                            <div class="col-sm-3">
                                <input type="text" name="TAHUN" class="form-control" id="TAHUN" readonly>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="BULAN" class="form-control" id="BULAN" readonly>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label for="In" class="col-sm-4 text-end control-label col-form-label">Tanggal</label>
                            <div class="col-sm-7">
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" id="TGL_BAYAR" name="TGL_BAYAR">
                                </div>
                                <small class="form-text text-danger"><?= form_error('TGL_BAYAR') ?></small>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Bunga</label>
                            <div class="col-sm-3 input-group input-group-sm" >
                                <input type="text" name="BUNGA" class="form-control" id="BUNGA" readonly>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <i class="input-group-text">Rp.</i>
                                    <input type="number" name="BUNGA" class="form-control" id="BUNGA" min="1" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-2">
                            <label class="col-sm-4 text-end control-label col-form-label">Pokok</label>
                            <div class="col-sm-3 input-group input-group-sm" >
                                <input type="text" name="POKOK" class="form-control" id="POKOK" readonly>
                            </div>
                            <div class="col-sm-4">
                                <div class="input-group input-group-sm">
                                    <i class="input-group-text">Rp.</i>
                                    <input type="number" name="POKOK" class="form-control" id="POKOK" min="1" >
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 text-end mt-3 ">
                            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                            <button type="submit" name="edit" class="btn btn-primary">Bayar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h2>Anggota</h2>
                        <table class="table table-borderless datatable">
                            <tr>
                                <th>Kode</th>
                                <th>Anggota</th>
                            </tr>
                            <?php
                            $thn = date("Y");
                            $bln = date("m");
                            $query = $this->db->query("SELECT
                            anggota.KODE_ANG, 
                            anggota.NAMA_ANG
                        FROM
                            anggota
                            INNER JOIN
                            pinuang
                            ON 
                                anggota.KODE_ANG = pinuang.KODE_ANG
                        WHERE
                            pinuang.NOFAK LIKE '%R%' AND
                            pinuang.TAHUN = $thn AND
                            pinuang.BULAN = '$bln'")->result_array();

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
        $.ajax({
            url: '<?= base_url(); ?>index.php/kantor/autofill',
            data: {
                'KODE': KODE
            },
        }).success(
            function(data) {
                var json = data,
                    obj = JSON.parse(json);
                $("#KODE_INS").val(obj.instansi);
                $("#NAMA_ANG").val(obj.nama);
                $("#TAGIHAN").val(obj.tagihan);
                $("#TAHUN").val(obj.TAHUN);
                $("#BULAN").val(obj.BULAN);
                $("#DETAIL").val(obj.detail);
                $("#TTL_BUNGA").val(obj.TTL_BUNGA);
                $("#BUNGA").val(obj.BUNGA);

                // var number_string = obj.TTL_BUNGA.toString(),
                //     sisa = number_string.length % 3,
                //     rupiah = number_string.substr(0, sisa),
                //     ribuan = number_string.substr(sisa).match(/\d{3}/g);

                // if (ribuan) {
                //     separator = sisa ? '.' : '';
                //     rupiah += separator + ribuan.join('.');
                // }

                // $("#TTL_BUNGA").val(rupiah);
            }
        );
    }
</script>