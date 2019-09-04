<!DOCTYPE html>
<html>
<head>
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

</head>
<body>
<?php

include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
$mode_form      = isset($_GET['mod']) ? $_GET['mod'] : "";
$id_usulan      = isset($_GET['id']) ? $_GET['id'] : "";
$p_tombol       = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_id_usulan    = isset($_POST['id_usulan']) ? $_POST['id_usulan']:"";
$p_kec_reses   = isset($_POST['kec_reses']) ? $_POST['kec_reses']:"";
$p_id_kecamatan = isset($_POST['kec'])? $_POST['kec']:"";
$p_id_desa      = isset($_POST['nm_desa'])? $_POST['nm_desa']:"";
$p_usulan_kegiatan = isset($_POST['usulan'])? $_POST['usulan']:"";
$p_satuan          = isset($_POST['satuan'])? $_POST['satuan']:"";
$p_vol             = isset($_POST['vol'])? $_POST['vol']:"";
$p_id_bidang       = isset($_POST['id_bidang'])? $_POST['id_bidang']:"";
$p_detail_lokasi   = isset($_POST['detail_lokasi'])? $_POST['detail_lokasi']:"";
$p_latitude        = isset($_POST['latitude'])? $_POST['latitude']:"";
$p_long_latitude   = isset($_POST['long_latitude'])? $_POST['long_latitude']:"";
$p_id_dprd         = isset($_POST['id_dprd'])? $_POST['id_dprd']:"";
$p_status          = isset($_POST['status'])? $_POST['status']:"";
$p_submit          = "TAMBAH";
if ($mode_form == "add") {
  # code...
}
else if ($mode_form=="edit") {
  $q_data_edit = mysql_query("SELECT * FROM t_rekapusulan WHERE id_usulan ='$id_usulan' ");
$a_data_edit       = mysql_fetch_array($q_data_edit);
$p_id_usulan       = $a_data_edit[0];
$p_kec_reses      = $a_data_edit[1];
$p_id_kecamatan    = $a_data_edit[2];
$p_id_desa         = $a_data_edit[3];
$p_usulan_kegiatan = $a_data_edit[4];
$p_satuan          = $a_data_edit[5];
$p_vol             = $a_data_edit[6];
$p_id_bidang       = $a_data_edit[7];
$p_detail_lokasi   = $a_data_edit[8];
$p_latitude        = $a_data_edit[9];
$p_long_latitude   = $a_data_edit[10];
$p_id_dprd         = $a_data_edit[11];
$p_status          = $a_data_edit[12];
$p_submit          = "EDIT";
}

if ($p_tombol == "TAMBAH") {
  $tambahusulan = "INSERT INTO t_rekapusulan (id_usulan, kec__reses, id_kec, id_desa, usulan, vol, satuan, id_bidang, detail_lokasi, latitude, long_latitude, id_dprd, status) VALUES (
                  '',
                  '$p_kec_reses',
                  '$p_id_kecamatan',
                  '$p_id_desa',
                  '$p_usulan_kegiatan',
                  '$p_vol',
                  '$p_satuan',
                  '$p_id_bidang',
                  '$p_detail_lokasi',
                  '$p_latitude',
                  '$p_long_latitude',
                  '$p_id_dprd',
                  '$p_status')";
  $Qtambah = mysql_query($tambahusulan);
  echo $tambahusulan;
  if ($Qtambah) {
    echo '<div id="login-page">
          <div class="container">
            <form action = "6.usulankegiatan.php" class="form-login" method="GET">
            <h2 class="form-login-heading"> BERHASIL </h2>
            
            <div class="login-wrap"> 
            <center><h4> USULAN BERHASIL DI TAMBAHKAN </h4>
            <div> 
            <a href="1_index.php"><img src="image/seru.png" height=147 width=176><br><br></a>
            </div>';
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_index.php">
            </a></center><hr>
            </div>
            </div>';
} else {
        echo '<div id="login-page">
          <div class="container">
            <form  class="form-login" method="post">
            <h2 class="form-login-heading"> USULAN GAGAL </h2>
            <div class="login-wrap"> 
            <center><h4> USULAN GAGAL DI TAMBAHKAN MOHON PERIKSA ISIAN ANDA </h4>
            <div> 
            <a href="6.usulankegiatan.php"><img src="image/seru.png"  height=147 width=176><br><br></a>
            </div>';
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="8.rekapusulan.php">
            </a></center><hr>
            </div>
            </div>';
            }
}
// else if ($p_tombol =="EDIT") {
//   $q_update = mysql_query("UPDATE t_rekapusulan SET 
//                         tahun_reses   = '$p_tahunreses',
//                         id_kec        = '$p_id_kecamatan',
//                         id_desa       = '$p_id_desa',
//                         usulan        = '$p_usulan_kegiatan',
//                         vol           = '$p_vol',
//                         satuan        = '$p_satuan',
//                         id_bidang     = '$p_id_bidang',
//                         detail_lokasi = '$p_detail_lokasi',
//                         latitude      = '$p_latitude',
//                         long_latitude = '$p_long_latitude'
                       
//                         WHERE id_usulan = '$p_id_usulan'");
//   //echo $q_update;
//   if ($q_update) {
//     echo '<div id="login-page">
//           <div class="container">
//             <form action = "6.usulankegiatan.php" class="form-login" method="GET">
//             <h2 class="form-login-heading"> BERHASIL </h2>
            
//             <div class="login-wrap"> 
//             <center><h4> USULAN BERHASIL DI UPDATE </h4>
//             <div> 
//             <a href="1_index.php"><img src="image/seru.png" height=147 width=176><br><br></a>
//             </div>';
//         echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="8_rekapusulan.php">
//             </a></center><hr>
//             </div>
//             </div>';
//   } else {
//     echo '<scritp type="text/javascript">
//        alert("Data Gagal Di Update");
//         </script>';
//   }
// }
?>

  </body>
</html>