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
    $id_reses       = isset($_GET['id']) ? $_GET['id'] : NULL;
    $mod            = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $display        = "style='display: none'";  //default = formnya dihidden
    $p_tombol       = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";     
    $p_id_reses     = isset($_POST['id_reses']) ? $_POST['id_reses'] : NULL;  
    $p_nm_reses     = isset($_POST['nm_reses']) ? $_POST['nm_reses'] : NULL;      
    $p_thn_reses    = isset($_POST['thn_reses']) ? $_POST['thn_reses'] : NULL;    
    $p_tgl_reses    = isset($_POST['tgl_reses'])? $_POST['tgl_reses']:NULL;
    $p_kec_reses    = isset($_POST['kec_reses'])? $_POST['kec_reses']:NULL;
    $p_id_dprd      = isset($_POST['id_dprd'])? $_POST['id_dprd']:NULL;
    $p_status       = isset($_POST['status'])? $_POST['status']: NULL;
    $p_submit       = "DAFTAR";
    $p_treses = date_create($p_tgl_reses);
    $p_isi    = date_format($p_treses, 'Y-m-d');
    
    if ($p_tombol == "DAFTAR") {
        $display = "style='display: none'";       
       $q_tambah_reses = "INSERT INTO t_reses (id_reses, nm_reses, tahun, tgl_reses, kec_reses, id_dprd, status) VALUES 
        ('', 
        '$p_thn_reses', 
        '$p_nm_reses',
        '$p_isi',
        '$p_kec_reses',
        '$p_id_dprd', 
        '$p_status')";
  $q_masuk = mysql_query($q_tambah_reses);
  if ($q_masuk) {
  echo '<div id="login-page">
          <div class="container">
            <form  class="form-login" method="post">
            <h2 class="form-login-heading"> SELAMAT DATANG </h2>            
            <div class="login-wrap"> 
            <center><h4> RESES BERHASIL DI TAMBAHKAN </h4>
            <div> 
            <a href="6.usulankegiatan.php"><img src="image/seru.png"  height=147 width=176><br><br></a>
            </div>';
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="6.usulankegiatan.php">
            </a></center><hr>
            </div>
            </div>';
} else {
        echo '<script type="text/javascript">
              alert("Data Gagal Di Tambahkan")
              window.location=("7.modalreses.php")
              </script>';       
       }   
     }
?>

  </body>
</html>