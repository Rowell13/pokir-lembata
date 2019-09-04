<?php 
include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
echo "$_GET[q]";
$desa = "SELECT * FROM desa WHERE id_kec = '$_REQUEST[q]'";
$data = mysql_query($desa);
while ($hasil = mysql_fetch_array($data)) {
	echo "<option value = '$hasil[id_desa]'>$hasil[nama_desa]</option>";
}
 ?>
