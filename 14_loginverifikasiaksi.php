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
include 'koneksi/koneksi.php';
include "koneksi/fungsi.php";
$u			= isset($_POST['username']) ? $_POST['username'] : NULL;
$p	 		= isset($_POST['password']) ? $_POST['password'] : NULL;
$s      = isset($_POST['status']) ? $_POST['status'] : NULL;
$foto   = isset($_POST['foto']) ? $_POST['foto'] : NULL;
$nama   = isset($_POST['namauser']) ? $_POST['namauser'] : NULL;
$s      = "Y";

$QLogin2 = mysql_query("SELECT * FROM t_admverifikasi WHERE n_user = '$u' AND p_user = '$p' AND status = '$s'");
$JLogin2 = mysql_num_rows($QLogin2);
if ($JLogin2 !== 1) {
  echo " <script>
  alert('MAAF! Username dan Password Anda Salah atau Belum Diaktifkan oleh Admin! Silakan Hubungi Admin Kominfo Untuk Pengaktifan Akun Anda');
  window.location=('3_login.php')
  </script>";

} else {
  $AUser2 = mysql_fetch_array($QLogin2);
  session_start();
  $_SESSION['idverifikasi']   = $AUser2['id_admin'];
  $_SESSION['userverifikasi']  = $AUser2['n_user'];
  $_SESSION['namaverifikasi'] = $AUser2['nama'];
  echo '<div id="login-page">
          <div class="container">
            <form  class="form-login" method="post">
            <h2 class="form-login-heading"> BERHASIL! </h2>
            <div class="login-wrap"> 
            <center> <h4>SELAMAT DATANG <b> $_SESSION[namaskpd] </b> <br> <br> </h4>
            <div> 
            <a href=""><img src="image/seru.png"  height=147 width=176><br><br></a>
            </div>';
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_index.php">
            </a></center><hr>
            </div>
            </div>';
}
?>
  </body>
</html>