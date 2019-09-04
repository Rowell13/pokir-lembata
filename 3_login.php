<?php
include "koneksi/koneksi.php";
session_start();
session_destroy();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Pokir Kabupaten Lembata</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="images/icone.png">

    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
<style>
  .alur
  {
  background: #25b00e;
  border:1px solid #157a04;
  color:#ffffff;
  height:40px;
  }
  .alur:hover
  {
  background: #37da1c;
  border:1px solid #25b00e;
  color:#ffffff;
  height:40px;
  }
  .sop
  {
  background: #e89505;
  border:1px solid #b97704;
  color:#ffffff;
  height:40px;
  }
  .sop:hover
  {
  background: #f7ae2f;
  border:1px solid #e89505;
  color:#ffffff;
  height:40px;
  }
  .portal
  {
  background: #ce0b1d;
  border:1px solid #a30a19;
  color:#ffffff;
  height:40px;
  }
  .portal:hover
  {
  background: #f51c31;
  border:1px solid #bc0a1b;
  color:#ffffff;
  height:40px;
  }  
  
  .kirim
  {
  background: #055d6b;
  border:1px solid #07333a;
  color:#ffffff;
  height:45px;
  width:100%;
  }
  .kirim:hover
  {
  background: #158fa2;
  border:1px solid #0f6a79;
  color:#ffffff;
  height:45px;
  } 
</style>
</head>
<body style="background:url(image/pattern1.jpg)">
    <div class="sufee-login d-flex align-content-center flex-wrap" >
      <div class="container"  style="width:400px;border-radius:10px;">
        <div class="login-content">
          <div class="login-logo">
            <a href="index.php">
                <img class="align-content" src="image/infokom.png" alt="">
            </a>
          </div>
          <div class="form-group" style="margin-top:-10px;padding-top:15px;padding-bottom:15px;padding-left:35px;font-family:arial narrow;font-size:16px;color:#ffffff;background:#3d8daf;border-radius:5px 5px 0px 0px;">
                <i class='fa fa-unlock'></i> &nbsp;LOGIN PENGGUNA
          </div>          
          <div class="login-form tambahan" style="margin-top:-18px;border-radius:0px 0px 5px 5px;border:5px solid #ffffff;">
          <form method="post" action="3_loginaksi.php" onSubmit="return validasi(this)">
          <?php
          if ((isset($_GET["code"]))&&(($_GET["code"]=="05")||($_GET["code"]=="06")))
             {
          ?>
          <div class='sufee-alert alert with-close alert-warning alert-dismissible fade show'>
              <i class='fa fa-exclamation-triangle'></i><span style='font-weight:bold;'> Warning!</span>.
                  Gagal login!.
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
                </button>
                </div>
                <?php
                }     
                else if ((isset($_GET["code"]))&&($_GET["code"]=="09"))
                   {
                ?>
                <div class='sufee-alert alert with-close alert-info alert-dismissible fade show'>
                  <i class='fa fa-info-circle'></i><span style='font-weight:bold;'> Info!</span>.
                  User Nama Sudah Terdaftar Silahkan login!.
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                  <span aria-hidden='true'>&times;</span>
                  </button>
                </div>          
                <?php
                }else{}
                ?>
          
                <div class="form-group" style="margin-top:-10px;">
                    <label style="text-transform:none;">Username</label>
                    <input type="text" name="username" class="form-control" placeholder="Username" />
                </div>
                <div class="form-group" style="margin-top:-10px;">
                    <label style="text-transform:none;">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Password"/>
                </div>
                <button type="submit" class="kirim" style="border-radius:5px;margin-top:-3px;font-family:arial narrow;font-size:16px;"><i class="fa fa-sign-in"></i> &nbsp;Login</button>
                <div class="register-link" style="margin-top:8px;">
                <p style="font-size:16px;text-align:center;"><i class='fa fa-users'></i> Register  <br>
                <a class="sub" href="2_registrasi.php"> DPRD </a> | 
                <a class="sub" href="13_regisuser.php"> OPD </a> | 
                <a class="sub" href="15_regissetwan.php">SETWAN</a> | 
                <a class="sub" href="14_regisverifikasi.php">VERIFIKASI</a></p>
    <!-- <a href="index.php"><button type="button" class="portal" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-desktop'></i> &nbsp;Portal</button></a>
                <a href="#"><button type="button" class="sop" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-download'></i> &nbsp;SOP</button></a>    
                <a href="#"><button type="button" class="alur" style="width:32.2%;border-radius:5px;margin-top:-5px;font-family:arial narrow;font-size:16px;"><i class='fa fa-book'></i> &nbsp;ALUR</button></a>   -->  
                </div>
        </form>
      </div>
    </div>
  </div>
</div>
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
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
</body>
</html>
