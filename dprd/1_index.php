<?php
session_start();
include "koneksi/koneksi.php";  
include "koneksi/fungsi.php";
include 'head.php';
include "aside.php";
include 'footer.php';
$nav        = "";
$ambil        = "home.php";
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;

// session_start();
// if ($_SESSION != NULL || !empty($_SESSION)) {


//   $p          = isset($_GET['p']) ? $_GET['p'] : "";
  
//   if ($p == "") {
//     $nav  = "Depan";
//     $ambil  = "1_index.php";
//   } elseif ($p == "2_registrasi") {
//     $nav  = "Pendaftaran";
//     $ambil  = "p.php";
//   } elseif ($p == "daftar_data") {
//     $nav  = "Data Pendaftar";
//     $ambil  = "$p.php";
//   } elseif ($p == "3.login") {
//     $nav  = "Login Pengguna";
//     $ambil  = "$p.php";
//   } elseif ($p == "4.inputdapil") {
//     $nav  = "Input Dapil";
//     $ambil  = "$p.php";
//   }elseif ($p == "5.inputfraksi") {
//     $nav  = "Input Fraksi";
//     $ambil  = "$p.php";
//   }elseif ($p == "6.usulankegiatan") {
//     $nav  = "Usulan Kegiatan";
//     $ambil  = "$p.php";
//   }elseif ($p == "8.rekapusulan") {
//     $nav  = "Rekap Usulan";
//     $ambil  = "$p.php";
//   }elseif ($p == "10_editanggota") {
//     $nav  = "Update Data";
//     $ambil  = "$p.php";
//   } else if ($p == "logout") {
//     session_destroy();
//     $nav  = "Depan";
//     $ambil  = "home.php";
//     echo "<meta http-equiv='refresh' content='0; url=index.php'>";
  
//   } else {
//     $nav  = "Depan";
//     $ambil  = "1_index.php";
//   }
// } 

// if (isset($_SESSION["auth"]))
//    {   
//    session_start();
//    if  ($_SESSION["auth"]>3 || $_SESSION["auth"]==3)
//           {
//         $_SESSION["auth"]=4;
//         header("location:../403-forbidden.php");
//         }else{}
//   }
//   else
//   {
//   session_start();
//   session_destroy();
//   }
// if (isset($_SESSION["code"]))
//     {
//   session_start();
//   }
//   else{}
  

// if (isset($_COOKIE["nama"]) && isset($_COOKIE["pasw"])){
//   $nm = $_COOKIE["nama"];
//   $pw = $_COOKIE["pasw"];
// } else {
//   $nm = "";
//   $pw = "";
// }

?>
<!DOCTYPE html>
<html>
<?php include "head.php"; ?>
<body>
    <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Tampilkan/Sembunyikan Menu"></div>
      </div>
      <a href="1_index.php" class="logo"><b>E<span>POKIR</span></b></a>
      <div class="nav notify-row" id="top_menu">
       <ul class="nav top-menu">         
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/infokom.png" width="35" height="35">
              </a>            
          </li>       
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/ntt.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/pemkab.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
        </ul>      
      </div>  
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <?php echo ' <li><a class="logout" href="1_logout.php">Logout</a></li>'; ?>
        </ul>
      </div>
    </header>
    <section id="main-content">
      <section class="wrapper">         
            <div class="form-panel">
              <div class="border-head">
              <h3>Selamat Datang</h3>
            </div>
                  <label>
            <?php
              echo "
              <div class='alert alert-success alert-dismissible fade in' role='alert'>
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'><i class='fa fa-remove' style='font-size:14px;'></i></span>
              </button>
              <strong><i class='fa fa-info-circle'  style='font-size:20px;'></i> <b>Sucess Login</b></strong>, Saudara <b>$_SESSION[username] </b> selamat datang di aplikasi e-Pokir Kabupaten Lembata!.
              </div>";
            ?>
             <br>
             <?php echo "$_SESSION[username]";
               ?>
              </label>
              </div>
              <div class="col-md-4 col-sm-4 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                    <a href="8_rekapusulan.php"> <h5>Lihat Kamus Pokok Pikiran</h5></a>
                  </div>
                </div>
                <!-- /grey-panel -->
              </div>
              <!-- /col-md-4-->
              <div class="col-md-4 col-sm-4 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                    <h5>Jumlah Usulan</h5>
                  </div>
                </div>
              </div>

              <div class="col-md-4 col-sm-4 mb">
                <div class="green-panel pn">
                  <div class="green-header">
                    <h5>Input Usulan Pokir</h5>
                  </div>
                  <div class="chart mt">
                    <!--<div class="sparkline" data-type="line" data-resize="true" data-height="75" data-width="90%" data-line-width="1" data-line-color="#fff" data-spot-color="#fff" data-fill-color="" data-highlight-line-color="#fff" data-spot-radius="4" data-data="[200,135,667,333,526,996,564,123,890,464,655]"></div> -->
                  </div>
                  <br>
                  <br>
                  <br>
                  <h5 class="btn btn-theme" > <a href="6.usulankegiatan.php">Mulai</a> </h5>
                </div>
              </div>
          <div class="col-lg-3 ds">
           <div id="calendar" class="mb">
              <div class="panel green-panel no-margin">
                <div class="panel-body">
                  <div id="date-popover" class="popover top" style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                    <div class="arrow"></div>
                    <h3 class="popover-title" style="disadding: none;"></h3>
                    <div id="date-popover-content" class="popover-content"></div>
                  </div>
                  <div id="my-calendar"></div>
                </div>
              </div>
            </div>
        </div>
      </section>
    </section>
    
</section>
</body>
</html>