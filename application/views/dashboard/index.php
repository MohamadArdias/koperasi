<?php
$this->load->view('templates/header');
$this->load->view('templates/sidebar');
?>
<div class="card mb-3">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="https://radarbanyuwangi.jawapos.com/wp-content/uploads/2022/06/Logo-Koperasi-1.jpg" class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <form action="" method="POST">
                    <center>
                        <h5 class="card-title"> Selamat Datang di Website <br> Koperasi Bangkit Bersama</h5>
                    </center>
                    <center>
                        <!-- <table>
                            <tr>
                                <td class="text-center"><label>Masukan Kode Instansi</label></td>
                                <td class="text-center"><label>Masukan Kode Anggota</label></td>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control" name="keyword"></td>
                                <td><input type="text" class="form-control"></td>
                            </tr>
                            <tr>
                                <td class="text-center"><button class="btn btn-primary" type="submit">Cetak Perinstansi</button></td>
                                <td class="text-center"><button class="btn btn-primary" type="submit">Cetak Perorang</button></td>
                            </tr>
                        </table> -->
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
$this->load->view('templates/footer');
?>