<?php 
session_start();
if (isset($_SESSION['pengguna'])) {
  header('location:1_index.php');
}
 ?>
<!DOCTYPE html>
<html lang="en">
<script language="javascript">
  function validasi(form){
    if (form.username.value == ""){
      alert("Anda belum mengisikan Username.");
      form.username.focus();
      return (false);
    }     
    if (form.password.value == ""){
      alert("Anda belum mengisikan Password.");
      form.password.focus();
      return (false);
    }
    return (true);
  }
</script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Login Pokir</title>

  <!-- Favicons -->
  <link href="img/dprd.png" rel="icon">
  <link href="img/pemkab.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <div id="login-page">
    <div class="container">
      <form action="13_loginuseraksi.php" class="form-login" method="POST" onSubmit="return validasi(this)">
        <h2 class="form-login-heading"><img src="image/pemkab.png" style="width:80px;height:60px;"/>Login Pokir SKPD</h2>
        <div style="color: red;margin-bottom: 15px;">      
        </div>
        <div class="login-wrap">
          <input type="text" name="username" class="form-control" placeholder="User Name" autofocus>
          <br>
          <input type="password" name="password" class="form-control" placeholder="Password">
          <label class="checkbox">
            <a data-toggle="modal" href="3.login.php#myModal"> Lupa Password?</a>
            <span class="pull-right">
            <br>
            <br>
            </span>
          </label>
          <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> MASUK </button>
          <hr>
          <div>
            <a href="3.login.php"><button type="button" class="portal" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-user'></i> &nbsp;Login DPRD</button></a>
            <a href="13_loginuser.php"><button type="button" class="sop" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-users'></i> &nbsp;Login SKPD</button></a>
            <a href="14_loginverifikasi.php"><button type="button" class="alur" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-users'></i> &nbsp;Login Verifikasi</button></a>  
          </div>
          <br>
          <div class="registration">
            Tidak Memiliki Akun?<br/> Buat Akun

            <a class="sub" href="2_registrasi.php">
              DPRD
            </a> | 
            <a class="sub" href="13_regisuser.php">
              SKPD
            </a> |
            <a class="sub" href="14_regisverifikasi.php">
              Verifikasi
            </a>
          </div>
        </div>
        <!-- Modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Lupa Password ?</h4>
              </div>
              <div class="modal-body">
                <p>Masukan Alamat Email Untuk Me-Reset Password Anda!</p>
                <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
              </div>
              <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                <button class="btn btn-theme" type="button" onclick=location.href="1_home.php" >Kirim</button>
              </div>
            </div>
          </div>
        </div>
        <!-- End Modal -->
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("", {
      speed: 500
    });
  </script>
</body>

</html>
