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
include 'head.php';
$u			= isset($_POST['username']) ? $_POST['username'] : NULL;
$p	 		= isset($_POST['password']) ? $_POST['password'] : NULL;
$s      = "Y";

$QLogin = mysql_query("SELECT * FROM t_dprd WHERE username = '$u' AND password = '$p' AND status = '$s' ");
$JLogin	= mysql_num_rows($QLogin);

if ($JLogin == 1) {
 $AUser = mysql_fetch_array($QLogin);
  session_start();
  $_SESSION['id_user']    = $AUser['id_dprd'];
  $_SESSION['username']   = $AUser['username'];
  $_SESSION['namauser']   = $AUser['namaanggota'];
  $_SESSION['foto']       = 'foto/'.$AUser['foto'];
  $_SESSION['level']      = 'DPRD';
  echo '<div id="login-page">
          <div class="container">
            <form  class="form-login" method="post">
            <h2 class="form-login-heading"> BERHASIL! </h2><br><br>
            <div class="login-wrap"> 
            <center><h4> SELAMAT DATANG <br> 
            </h4> <h5> Halo Saudara <b>'; echo strtoupper($AUser["namaanggota"]);  echo "</b> </h5>
            <h5> &nbsp Anda Login Sebagai <b> $_SESSION[level] </b><br> <br> </h5> 
            <div> 
            <a href=''><img src='image/seru.png' height=147 width=176><br><br></a>
            </div>";
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_index.php">
            </a></center><hr>
            </div>
            </div>'; 
  }
  else
  {
   $QLogin1 = mysql_query("SELECT * FROM t_skpd WHERE n_user = '$u' AND p_user = '$p' AND status = '$s' ");
   $JLogin1 = mysql_num_rows($QLogin1); 
   if ($JLogin1 == 1) {
  $AUser1 = mysql_fetch_array($QLogin1);
  session_start();
  $_SESSION['id_user']    = $AUser1['nip'];
  $_SESSION['username']   = $AUser1['n_user'];
  $_SESSION['namauser']   = $AUser1['nama'];
  $_SESSION['level']      = 'SKPD';
  $_SESSION['foto']       = "image/user.PNG";
  echo '<div id="login-page">
          <div class="container">
            <form  class="form-login" method="post">
            <h2 class="form-login-heading"> BERHASIL! </h2>
            <div class="login-wrap"> 
            <center> <h4>SELAMAT DATANG <br>  </h4> 
            <h5> Halo <b>'; echo strtoupper($AUser1["nama"]);  echo "</b> &nbsp</h5>
            <h5> Anda Login Sebagai &nbsp <b> $_SESSION[level] </b>   <br> <br> </h5>
            <div> 
            <a href=''><img src='image/seru.png'  height=147 width=176><br><br></a>
            </div>";
        echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_index.php">
            </a></center><hr>
            </div>
            </div>';
      }
      else
      {
      $QLogin2 = mysql_query("SELECT * FROM t_admverifikasi WHERE n_user = '$u' AND p_user = '$p' AND status = '$s'");
      $JLogin2 = mysql_num_rows($QLogin2);
      if ($JLogin2 == 1) {
        $AUser2 = mysql_fetch_array($QLogin2);
        session_start();
        $_SESSION['id_user']   = $AUser2['nip'];
        $_SESSION['username']  = $AUser2['n_user'];
        $_SESSION['namauser']  = $AUser2['nama'];
        $_SESSION['level']     = 'VERIFIKASI';
        $_SESSION['foto']      = "image/user.PNG";
        echo "<div id='login-page'>
                <div class='container'>
                  <form  class='form-login' method='post'>
                  <h2 class='form-login-heading'> BERHASIL! </h2>
                  <div class='login-wrap'> 
                  <center> <h4> SELAMAT DATANG <br> </h4> 
                  <h5> Halo Saudara &nbsp <b>"; echo strtoupper($AUser2["nama"]);  echo " </h5> </b> 
                  <h5> &nbsp Anda Login Sebagai &nbsp <b>$_SESSION[level] <b>  <br> <br> </h5>
                  <div> 
                  <a href=''><img src='image/seru.png'  height=147 width=176><br><br></a>
                  </div>
                  <input class='btn btn-theme' type='button' value='LANJUTKAN' onclick=location.href='1_index.php'>
                  </a></center><hr>
                  </div>
                  </div>";
      }
      else 
      {
      $QLogin3 = mysql_query("SELECT * FROM t_admsetwan WHERE n_user = '$u' AND p_user = '$p' AND status = '$s'");
      $JLogin3 = mysql_num_rows($QLogin3);
      if ($JLogin3 == 1) {
        $AUser3 = mysql_fetch_array($QLogin3);
        session_start();
        $_SESSION['id_user']   = $AUser3['nip'];
        $_SESSION['username']  = $AUser3['n_user'];
        $_SESSION['namauser']  = $AUser3['nama_admin'];
        $_SESSION['level']     = 'SETWAN';
        $_SESSION['foto']      = "image/user.PNG";
        echo "<div id='login-page'>
                <div class='container'>
                  <form  class='form-login' method='post'>
                  <h2 class='form-login-heading'> BERHASIL! </h2>
                  <div class='login-wrap'> 
                  <center> <h4> SELAMAT DATANG <br></h4> <h5> Halo &nbsp <b>"; echo strtoupper($AUser3["nama"]);  echo " </b> <br> &nbsp Anda Login Sebagai &nbsp <b> $_SESSION[level] </b>  <br> <br> </h5>
                  <div> 
                  <a href=''><img src='image/seru.png'  height=147 width=176><br><br></a>
                  </div>
                  <input class='btn btn-theme' type='button' value='LANJUTKAN' onclick=location.href='1_index.php'>
                  </a></center><hr>
                  </div>
                  </div>";
      }
      else
      {
      $QLogin4 = mysql_query("SELECT * FROM t_superadmin WHERE n_user = '$u' AND p_user = '$p' AND status = '$s'");
      $JLogin4 = mysql_num_rows($QLogin4);
      if ($JLogin4 == 1) {
        $AUser4 = mysql_fetch_array($QLogin4);
        session_start();
        $_SESSION['id_user']   = $AUser4['email'];
        $_SESSION['username']  = $AUser4['n_user'];
        $_SESSION['namauser']  = $AUser4['nama'];
        $_SESSION['level']     = 'SUPERADMIN';
        $_SESSION['foto']      = 'foto/'.$AUser4['foto'];
        echo "<div id='login-page'>
                <div class='container'>
                  <form  class='form-login' method='post'>
                  <h2 class='form-login-heading'> BERHASIL! </h2>
                  <div class='login-wrap'> 
                  <center> <h4> SELAMAT DATANG <br></h4>
                  <h5> Halo &nbsp <b>"; echo strtoupper($AUser4["nama"]);  echo " </b> <br></h5>
                  <h5> &nbsp Anda Login Sebagai <b> $_SESSION[level] </b>  <br> <br> </h5>
                  <div> 
                  <a href=''><img src='image/seru.png'  height=147 width=176><br><br></a>
                  </div>
                  <input class='btn btn-theme' type='button' value='LANJUTKAN' onclick=location.href='1_index.php'>
                  </a></center><hr>
                  </div>
                  </div>";
      }
      else
      {
       header("location:3_login.php?code=05");  
      }
    }
  }
  }    
  }
?>
  </body>
</html>