<?php 
session_start();
include 'koneksi/fungsi.php';
include 'koneksi/koneksi.php';
$nav        = "";
$sesi_umum      = isset($_SESSION['dprd']) ? $_SESSION['dprd'] : NULL;
$sesi_foto      = isset($_SESSION['foto']) ? $_SESSION['foto'] : NULL;

if (!empty($sesi_umum)) {
  $id_daftar    = getValue("t_dprd", "id_dprd", "username", ($_SESSION['dprd']));
}
$p          = isset($_GET['p']) ? $_GET['p'] : "";
if ($p == "") {
  $nav  = "Depan";
  $ambil  = "1_index.php";
} elseif ($p == "") {
  $nav  = "Pendaftaran Baru";
  $ambil  = "";
} elseif ($p == "") {
  $nav  = "Data Pendaftar";
  $ambil  = "$p.php";
} elseif ($p == "daftar_prosedur") {
  $nav  = "";
  $ambil  = "$p.php";
} elseif ($p == "") {
  $nav  = "Statistik Pendaftar";
  $ambil  = "$p.php";

} else if ($p == "logout") {
  session_destroy();
  echo "<meta http-equiv='refresh' content='0; url=index.php'>";
// kecuali di atas...
} else {
  $nav  = "Depan";
  $ambil  = "1_home.php";
}
  ?> 
<html lang="en">
<!-- <body> -->
  <!-- <section id="container"> -->
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
          <?php
          if (isset($_SESSION['username'])) {
             echo '<li><a class="logout" href="1_logout.php?act=keluar">Logout</a></li>';
           } else {
            echo '<li><a class="logout" href="3_login.php">Login</a></li>';
           } ?>
        </ul>
      </div>
    </header>
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <p class="centered"><a href="profile.php">
            <?php 
              if (isset($_SESSION['username'])) {
                echo "<img src='$_SESSION[foto]' class='img-circle' width='80'></a></p>";
           } else {
            echo '<img src="image/user.PNG" class="img-circle" width="80"></a></p>';   
          }
          ?>
          <h5 class="centered">KOMINFO</h5>
          <li class="mt">
            <?php 
              if ($_SESSION != NULL) {
                # code...
              ?>
            <a href="1_index.php">
              <i class="fa fa-dashboard"></i>
              <span>HALAMAN UTAMA</span>
            </a>
          </li>
          <?php
          if ((isset($_SESSION['level'])) & (($_SESSION['level']=='DPRD') OR ($_SESSION['level']== 'SUPERADMIN') OR ($_SESSION['level']=='VERIFIKASI'))) {
          ?>
            <li class="sub-menu">
            <a href="#">
             <i class="fa fa-th"></i>
             <span>KEGIATAN</span>
             </a>
              <ul class="sub">
              
              <li><a href="7_modalreses.php">Input Reses</a></li>
              <li><a href="6_usulankegiatan.php">Input Kegiatan</a></li>
              <li><a href="8_rekapusulan.php">Rekap Usulan</a></li>
              </ul>
            </li>
           <?php } else {} ?>
          <?php
          if ((isset($_SESSION['level'])) & (($_SESSION['level']=='SETWAN') OR ($_SESSION['level']== 'SUPERADMIN') OR ($_SESSION['level']=='VERIFIKASI'))) {
          ?> 
          <li class="sub-menu">
            <a href="">
              <i class="fa fa-book"></i>
              <span>DATA PARTAI</span>
              </a>
              <ul class="sub">
              <li><a href="4_inputdapil.php">Input Dapil</a></li>
              <li><a href="5_inputfraksi.php">Input Partai Pengusung</a></li>
              </ul>
          </li>
          <?php } else {} ?> 
          <li class="sub-menu">
            <a href="#">            
              <i class="fa fa-tasks"></i>
              <span>PROFILE PENGGUNA</span>
            </a>
            <ul class="sub">
              <?php
              if ((isset($_SESSION['level'])) & (($_SESSION['level']=='DPRD') OR ($_SESSION['level']== 'SUPERADMIN') OR ($_SESSION['level']=='VERIFIKASI'))) {
              ?>
              <li><a href="2_profildprd.php">Profil DPRD</a></li>
              <?php } else {} ?>
               <?php
                if ((isset($_SESSION['level'])) & (($_SESSION['level']=='SKPD') OR ($_SESSION['level']== 'SUPERADMIN') OR ($_SESSION['level']=='VERIFIKASI'))) {
                ?>
              <li><a href="13_profileuser.php">Profil User</a></li>
              <?php } else {} ?>
              <?php
              if ((isset($_SESSION['level'])) & (($_SESSION['level']=='SETWAN') OR ($_SESSION['level']== 'SUPERADMIN') OR ($_SESSION['level']=='VERIFIKASI'))) {
              ?>
              <li><a href="15_profilesetwan.php">Profil User</a></li>
              <?php } else {} ?>
             <?php
              if ((isset($_SESSION['level'])) & (($_SESSION['level']=='VERIFIKASI') OR ($_SESSION['level']== 'SUPERADMIN'))) {
              ?>
              <li><a href="14_profileverifikasi.php">Profil Verifikasi</a></li>
              
              <li><a href="14_profileverifikasi.php">Verifikasi Data</a></li>
              <?php } else{} ?>
            </ul> 
          </li>
          <?php } else {} ?>
          
          <li class="sub-menu">
            <a href="#">
              <i class="fa fa-envelope"></i>
              <span>DATA TERBARU</span>
              </a>
              <ul class="sub">
              <li><a href="7_resesdata.php">Data Reses</a></li>
              <li><a href="#">Data </a></li>
              </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class=" fa fa-bar-chart-o"></i>
              <span>DOKUMEN PENDUKUNG</span>
              </a>
            <ul class="sub">
              <li><a href="#">Downlado Absen</a></li>
              <li><a href="#">Upload Absen</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;">
              <i class="fa fa-comments-o"></i>
              <span>Chat Room</span>
              </a>
          </li>
          
        </ul>
      </div>
    </aside>
    </html>