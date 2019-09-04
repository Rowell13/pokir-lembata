<?php

//include "koneksi/koneksi.php";  
//include "koneksi/fungsi.php";
include 'head.php';
//include 'header.php';
include "aside.php";

if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='index.php';</script>";
} else {
$nav        = "";
$ambil      = "1_index.php";
// $sesi_id            = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
// $sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
// $sesi_namauser      = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
if ($_SESSION['username'] != NULL || !empty($_SESSION['username'])) {
  $p          = isset($_GET['p']) ? $_GET['p'] : "";  
  if ($p == "") {
    $nav  = "Depan";
    $ambil  = "1_index.php";
  } else if ($p == "2_registrasi") {
    $nav  = "Pendaftaran";
    $ambil  = "p.php";
  } else if ($p == "13_pengguna") {
    $nav  = "Data DPRD";
    $ambil  = "$p.php";
  } else if ($p == "3_login") {
    $nav  = "Login Pengguna";
    $ambil  = "$p.php";
  } else if ($p == "4_inputdapil") {
    $nav  = "Input Dapil";
    $ambil  = "$p.php";
  }else if ($p == "5_inputfraksi") {
    $nav  = "Input Fraksi";
    $ambil  = "$p.php";
  }else if ($p == "6_usulankegiatan") {
    $nav  = "Usulan Kegiatan";
    $ambil  = "$p.php";
  }else if ($p == "8_rekapusulan") {
    $nav  = "Rekap Usulan";
    $ambil  = "$p.php";
  }else if ($p == "10_editanggota") {
    $nav  = "Update Data";
    $ambil  = "$p.php";
  } else if ($p == "logout") {
    session_destroy();
    $nav  = "Depan";
    $ambil  = "index.php";
    echo "<meta http-equiv='refresh' content='0; url=store'>";
  
  } else {
    $nav  = "Depan";
    $ambil  = "index.php";
  }
}
?>
<!DOCTYPE html>
<html>
<body>
  <section id="container">    
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 main-chart">         
            <!-- <div class="form-panel"> -->
              <div class="border-head"><h3>Selamat Datang</h3>
              </div>
                <div class="showback">                  
                    <?php
                    if ($_SESSION != NULL) {
                      echo "
                      <div class='alert alert-success alert-dismissible fade in' role='alert'>
                      <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'><i class='fa fa-remove' style='font-size:14px;'></i></span>
                      </button>
                      <strong><i class='fa fa-info-circle'  style='font-size:20px;'></i> <b>Hi</b></strong>, Saudara <b>$_SESSION[namauser]</b> selamat datang di aplikasi e-Pokir Kabupaten Lembata!          
                      </div>";
                    } else {
                      echo "Anda Belum Login";
                    }
                    ?>           
                  
                </div>
              <!-- </div> -->
              <!-- <div class="form-panel">  -->
              <div class="row mt">                        
                <div class="col-md-4 col-sm-4 mb">
                  <div class="darkblue-panel pn">
                    <div class="darkblue-header">
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
                      <h5>Usulan Pokir</h5>
                    </div>
                    <ul>                  
                        <?php
                        if ((isset($_SESSION['level'])) & ($_SESSION['level']=='SKPD' OR 'VERIFIKASI' OR 'SETWAN')) {
                        ?>
                      <li>
                        <h5 class="btn btn-default" > <a href="8_rekapusulan.php">
                          <i class="fa fa-book"> &nbsp  Data Usulan</i></a>
                        </h5>                      
                      </li>
                        <?php
                        } else {

                        } 
                        ?>
                        <?php
                        if ((isset($_SESSION['level'])) & ($_SESSION['level']=='VERIFIKASI')) {
                        ?>                  
                      <li>
                        <h5 class="btn btn-default" > <a href="11_usulanterkirim.php">
                          <i class="fa fa-book">Usulan Terkirim</i></a>
                        </h5>
                      </li>
                      <?php
                      } else {

                      } 
                      ?>
                      <br>
                      <?php
                      if ((isset($_SESSION['level'])) & ($_SESSION['level']=='DPRD')) {
                      ?>
                      <li>
                        <h5 class="btn btn-default" >
                          <a href="6_usulankegiatan.php">
                          <i class="fa fa-book">Mulai</i>
                          </a>
                        </h5>
                        <?php
                        } else {

                        } 
                        ?>
                      </li>
                    </ul>
                  </div>
                </div>           
              </div>
          </div>
        </div>        
      </section>
    </section>
    <?php include 'footer.php'; ?>
  </section>
</body>
</html>
<?php
}
?>