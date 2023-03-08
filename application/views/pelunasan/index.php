<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card-body">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <?php if ($this->session->flashdata('bayarB')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Pembayaran <strong><?= $this->session->flashdata('bayarB'); ?></strong>
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
    <?php endif; ?>

    <?php
    // SIPOKU
    $nof = substr($lunas['NOFAK'], 3, 1);

    if ($nof == 'U') {
        $sipoku = $lunas['SIPOKU1'];
        $bunga = $lunas['BNGU1'];
        $nama = "Uang";
        $bayar = $sipoku + $bunga;
    } elseif ($nof == 'O') {
        $sipoku = $lunas['SIPOKU2'];
        $bunga = $lunas['BNGU2'];
        $nama = "Konsumsi";
        $bayar = $sipoku;
    } elseif ($nof == 'N') {
        $sipoku = $lunas['SIPOKU3'];
        $bunga = $lunas['BNGU3'];
        $nama = "Non Konsumsi";
        $ke = $lunas['JWKT_ANG'] - $lunas['KEU3'];
        $bayar = $sipoku + ($bunga * $ke);
    } elseif ($nof == 'S') {
        $sipoku = $lunas['SIPOKU4'];
        $bunga = $lunas['BNGU4'];
        $nama = "UUB";
        $bayar = $sipoku + $bunga;
    } else {
        $sipoku = $lunas['SIPOKU7'];
        $bunga = $lunas['BNGU7'];
        $nama = "Khusus";
        $ke = $lunas['JWKT_ANG'] - $lunas['KEU7'];
        $bayar = $sipoku + ($bunga * $ke);
    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-xxl-12 col-md-12">
                    <div class="card info-card sales-card ">
                        <div class="mt-2 col">
                            <h2>Pinajaman <?= $nama; ?> </h2>
                        </div>
                        <form action="" method="POST">
                            <input type="hidden" name="NOFAK" id="NOFAK" value="<?= $lunas['NOFAK']; ?>">
                            <input type="hidden" name="TAHUN" id="TAHUN" value="<?= $lunas['TAHUN']; ?>">
                            <input type="hidden" name="BULAN" id="BULAN" value="<?= $lunas['BULAN']; ?>">

                            <div class="form-group row mt-4 mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Kode Anggota</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <input type="text" name="KODE" class="form-control" id="KODE" value="<?= $lunas['KODE_ANG']; ?>" readonly>
                                    </div>
                                    <small class="form-text text-danger"><?= form_error('KODE_ANG'); ?></small>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Nama</label>
                                <div class="col-sm-7">
                                    <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG" value="<?= $lunas['NAMA_ANG']; ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label for="In" class="col-sm-3 text-end control-label col-form-label">Tanggal Pelunasan</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="TGL_BAYAR" name="TGL_BAYAR">
                                    </div>
                                    <small class="form-text text-danger"><?= form_error('TGL_BAYAR') ?></small>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Jumlah Pinjaman</label>
                                <div class="col-sm-7">
                                    <input type="text" name="JML_PIN" class="form-control" id="JML_PIN" value="<?= number_format($lunas['JMLP_ANG'], 0, ',', '.'); ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Sisa Pokok</label>
                                <div class="col-sm-3">
                                    <input type="text" name="SISA" class="form-control" id="SISA" value="<?= number_format($sipoku, 0, ',', '.') ?>" readonly>
                                </div>
                                <label class="col-sm-1 text-end control-label col-form-label">Bunga</label>
                                <div class="col-sm-3">
                                    <input type="text" name="BUNGA" class="form-control" id="BUNGA" value="<?= number_format($bunga, 0, ',', '.') ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Jumlah Pelunasan</label>
                                <div class="col-sm-7">
                                    <input type="text" name="PELUNASAN2" class="form-control" id="PELUNASAN2" value="<?= number_format($bayar, 0, ',', '.') ?>" readonly>
                                    <input type="hidden" name="PELUNASAN" class="form-control" id="PELUNASAN" value="<?= $bayar ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <label class="col-sm-3 text-end control-label col-form-label">Jumlah Uang Diterima</label>
                                <div class="col-sm-7">
                                    <div class="input-group input-group-sm">
                                        <input type="text" class="form-control" id="JML_BAYAR" name="JML_BAYAR">
                                    </div>
                                    <small class="form-text text-danger"><?= form_error('JML_BAYAR') ?></small>
                                </div>
                            </div>
                            <div class="col-sm-4 text-end mt-3 ">
                                <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                                <button type="submit" name="edit" class="btn btn-primary">Bayar</button>
                            </div>
                        </form>
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

    // function autofill() {
    //     var KODE = $('#KODE').val();
    //     $.ajax({
    //         url: '<?= base_url(); ?>index.php/Pay/autofill',
    //         data: {
    //             'KODE': KODE
    //         },
    //     }).success(
    //         function(data) {
    //             var json = data,
    //                 obj = JSON.parse(json);
    //             $("#NAMA_ANG").val(obj.nama);
    //             var tagihan = obj.tagihan;
    //             // var tunggakan = obj.tunggakan;
    //             var bayar = obj.bayar;
    //             $("#TAGIHAN").val(Number(tagihan) - Number(bayar));
    //         }
    //     );
    // }
</script>