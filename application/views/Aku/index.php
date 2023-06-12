<?php 
$query = $this->db->query("SELECT
pembayaran.SISA
FROM
pembayaran
WHERE
pembayaran.TAHUN = 2023 AND
pembayaran.BULAN = 06 AND
pembayaran.KODE_ANG = 4040")->row_array();

echo $query['SISA'];
 ?>