    <?php
    $this->load->view('templates/header');
    $this->load->view('templates/sidebar');
    ?>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #0066ff;
            color: white;
        }
    </style>

    <?php

    // KDOE
    if ($kode == 1) {
        $kd = 'U';
        $bg = 1.5;
    } elseif ($kode == 2) {
        $kd = 'S';
        $bg = 2;
    } elseif ($kode == 3) {
        $kd = 'O';
        $bg = 0;
    } elseif ($kode == 4) {
        $kd = 'N';
        $bg = 2;
    } else {
        $kd = 'Z';
        $bg = 3;
    }

    $hari = date("d");
    $bulan = date("m");
    $tahun = date("y");

    if ($bulan == 1) {
        $a = 'A';
    } elseif ($bulan == 2) {
        $a = 'B';
    } elseif ($bulan == 3) {
        $a = 'C';
    } elseif ($bulan == 4) {
        $a = 'D';
    } elseif ($bulan == 5) {
        $a = 'E';
    } elseif ($bulan == 6) {
        $a = 'F';
    } elseif ($bulan == 7) {
        $a = 'G';
    } elseif ($bulan == 8) {
        $a = 'H';
    } elseif ($bulan == 9) {
        $a = 'I';
    } elseif ($bulan == 10) {
        $a = 'J';
    } elseif ($bulan == 11) {
        $a = 'K';
    } else {
        $a = 'L';
    }

    $faktur = $tahun . $a . $kd . $urutan;


    $user = $this->session->userdata('identity');
    $sesUser = $this->db->get_where('users', ['email' => $user])->row_array();


    ?>

    <?php if ($this->session->flashdata('flashP')) : ?>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    Data Anggota <strong>Berhasil</strong> <?= $this->session->flashdata('flashP'); ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <!-- Sales Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="card-body row mt-4">
                                    <div class="form-group row mb-2">
                                        <label for="nama" class="col-sm-4 text-end control-label col-form-label">Faktur</label>
                                        <input type="hidden" name="id" class="form-control" id="id" value="<?= $sesUser['id'] ?>" />
                                        <input type="hidden" name="first_name" class="form-control" id="first_name" value="<?= $sesUser['first_name'] ?>" />
                                        <input type="hidden" name="KODE" class="form-control" id="KODE" value="<?= $kd ?>" />
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="NOFAK" class="form-control" id="NOFAK" value="<?= $faktur ?>" readonly />
                                                <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('NOFAK'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="nama" class="col-sm-4 text-end control-label col-form-label">Kode Anggota</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="URUT_ANG" class="form-control" id="URUT_ANG" onkeyup="autofill()" autofocus>
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('URUT_ANG'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="NAMA_ANG" class="form-control" id="NAMA_ANG">
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('NAMA_ANG'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="kdins" class="col-sm-4 text-end control-label col-form-label">Tanggungan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" name="TANGGUNGAN" class="form-control" id="TANGGUNGAN" readonly>
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('TANGGUNGAN'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Jumlah</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="JMLP_ANG" name="JMLP_ANG">
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('JMLP_ANG'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Uang Diterima</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="TERIMA" name="TERIMA" readonly>
                                            </div>
                                            <!-- <small class="form-text text-danger"><?= form_error('TERIMA'); ?></small> -->
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="alamat" class="col-sm-4 text-end control-label col-form-label">Bunga</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control" id="PRO_ANG" name="PRO_ANG" value="<?= $bg; ?>" readonly>
                                                <!-- <?= $bg; ?> -->
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('PRO_ANG'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="namains" class="col-sm-4 text-end control-label col-form-label">Jangka Waktu</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm">
                                                <input type="number" name="JWKT_ANG" class="form-control" id="JWKT_ANG" min="1">
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('JWKT_ANG'); ?></small>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="Golongan" class="col-sm-4 text-end control-label col-form-label">Tanggal Mulai</label>
                                        <div class="col-sm-8">
                                            <div class="input-group input-group-sm ">
                                                <input type="text" class="form-control" id="TGLP_ANG" name="TGLP_ANG">
                                            </div>
                                            <small class="form-text text-danger"><?= form_error('TGLP_ANG'); ?></small>
                                        </div>
                                        <div class="col-sm-6 text-end mt-3 ">
                                            <input type="button" class="btn btn-warning" value="Kembali" onclick="goBack()">
                                            <button type="submit" name="edit" class="btn btn-primary">Pinjam</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div><!-- End Sales Card -->
                <?php date('Y-m-d', strtotime('+7 month', strtotime($a))); ?>
                <!-- Revenue Card -->

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
                                $query = $this->db->query("SELECT * FROM anggota WHERE anggota.KODE_INS != 99 AND anggota.KODE_INS != 98 AND anggota.KODE_INS != 97 AND	anggota.KODE_INS != 96")->result_array();

                                foreach ($query as $key) {
                                ?>
                                    <tr>
                                        <td><?= $key['URUT_ANG']; ?></td>
                                        <td><?= $key['NAMA_ANG']; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                </div><!-- End Revenue Card -->
            </div>
        </div>
    </div>

    <?php
    $this->load->view('templates/footer');
    ?>

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script type="text/javascript">
        function goBack() {
            window.history.back();
        }

        $(function() {
            // $("#TGLP_ANG").datepicker({
            //     changeMonth: true,
            //     changeYear: true
            // })
            $("#TGLP_ANG").datepicker()
            $("#TGLT_ANG").datepicker()
            $("#TGLP_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
            $("#TGLT_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
            // $("#TGLK_ANG").datepicker("option", "dateFormat", "yy-mm-dd")
        })

        function autofill() {
            var URUT_ANG = $('#URUT_ANG').val();
            var KODE = $('#KODE').val();
            $.ajax({
                url: '<?= base_url(); ?>index.php/Pinjaman/autofill',
                data: {
                    'URUT_ANG': URUT_ANG,
                    'KODE': KODE
                },
            }).success(
                function(data) {
                    var json = data,
                        obj = JSON.parse(json);
                    $("#NAMA_ANG").val(obj.nama);

                    var jang = obj.jangka;
                    var per = obj.periode;
                    var sis = obj.sisa;
                    var bung = obj.bunga;
                    var tang = (jang - per) * bung;
                    var a = Math.ceil((jang - per) / 5);
                    var Tanggungan = Number(a * bung) + Number(sis);
                    $("#TANGGUNGAN").val(Tanggungan);
                }).fail(function() {
                alert();
            });
        }

        $(document).ready(function() {
            $("#JMLP_ANG, #TANGGUNGAN").keyup(function() {
                var TANGGUNGAN = $("#TANGGUNGAN").val();
                var JMLP_ANG = $("#JMLP_ANG").val();

                var TERIMA = parseInt(JMLP_ANG) - parseInt(TANGGUNGAN);

                var number_string = TERIMA.toString(),
                    sisa = number_string.length % 3,
                    rupiah = number_string.substr(0, sisa),
                    ribuan = number_string.substr(sisa).match(/\d{3}/g);

                if (ribuan) {
                    separator = sisa ? '.' : '';
                    rupiah += separator + ribuan.join('.');
                }

                $("#TERIMA").val(rupiah);
            });
        });
    </script>