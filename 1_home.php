<?php
//session_start();
include "koneksi/koneksi.php";  
//include "koneksi/fungsi.php";
//include 'head.php';
//include 'header.php';
include "aside.php";
//include 'footer.php';

if (isset($_SESSION['username'])) {
   echo "<script>document.location.href='1_index.php';</script>";
}
?> 
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>E-Pokir DPRD</title>
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
  <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
  <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
  <link rel=" stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>

</head>
<body>
  <section id="container">
    <section id="main-content">
      <section class="wrapper">
        <div class="row">
          <div class="col-lg-12 main-chart">              
            <div class="form-panel">
              <div class="border-head"><h3>WELCOME</h3>                           
                <?php
                if ((isset($_GET["code"]))&&($_GET["code"]=="09"))
                {
                ?>
                <div class="showback">
                  <div class="alert alert-warning alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>INFO!</strong> Silakan Hubungi Admin Kominfo Untuk Mengaktifkan Akun Anda                  
                  </div>          
                  <?php
                  }else{}
                  ?>
                </div>
                <div class="showback">
                  <div class="alert alert-success">
                    <label>
                       Selamat Datang di Aplikasi e-Pokir Kabupaten Lembata
                       <br>
                       <br>
                       Aplikasi ini merupakan aplikasi Pokok Pikiran 
                       <br>
                    </label>
                  </div>
                </div>
              </div> 
              <div class="col-md-4 col-sm-3 mb">
                <div class="grey-panel pn donut-chart">
                  <div class="grey-header">
                   <h5>Panduan Pengguna</h5>
                  </div>
                  <div class="form-panel">
                        <label>
                        1. Login kedalam Sistem
                        <br>
                        2. KLik tombol Mulai
                        <br>
                        3. Masukan Pokir Melalui Tombol Usulan
                        <br>
                        4.  Setelah Usulan sudah Selesai dimasukan klik kirim OPD pada menu Laporan
                        </label>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-3 mb">
                <div class="darkblue-panel pn">
                  <div class="darkblue-header">
                      <h5>Rekap Ususlan Pokir</h5>
                  </div>
                    <br>
                    <br>
                   <a  href="1.index.php#">Semua Usulan</a> <br>
                   <a  href="#">Usulan Diterima</a> <br>
                   <a  href="#">Usulan Ditolak</a>
                  </div>
              </div>
              <div class="col-md-4 col-sm-3 mb">
                <div class="green-panel pn">
                  <div class="green-header">
                      <h5>Dokumen</h5>
                  </div>                  
                    <br>
                    <br>
                    <a type= "button" class="sub" href="1.index.php#">Download Absen</a> <br>
                    <a class="sub" href="1.index.php#">Download Berita Acara</a><br>
                    <a class="sub" href="1.index.php#">Upload Dokumen</a>
                </div>
              </div>            
            </div>
          </div>
        </div>           
      </section>
    </section>
    <?php include "footer.php";  ?>
  </section>
</body>
</html>
