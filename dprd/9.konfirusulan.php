<!DOCTYPE html>
<?php 
include 'koneksi/koneksi.php';
include 'koneksi/fungsi.php';

$p_tombol      = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display       = "style='display: none'";
$p_id_usulan   = isset($_POST['id_usulan']) ? $_POST['id_usulan'] : "";
$p_id_dprd      = isset($_POST['id_dprd']) ? $_POST['id_dprd'] : "";
$p_status      = isset($_POST['status'])? $_POST['status'] :"";
$p_submit      = "KIRIM";

if ($p_tombol == "KIRIM") {     
        $q_update = mysql_query("UPDATE t_rekapusulan SET status = '$p_status' 
          where id_usulan = '$p_id_usulan' "); // and id_dprd ='$p_id_dprd
        $q_daftar = mysql_query($q_update);
        echo $q_update;
    if ($q_daftar) {
      echo '<script type="text/javascript">
              alert("Data Berhasil DiKirim");
              </script>';
      } else {
        echo '<script type="text/javascript">
              alert("Data Gagal DiTambahkan");
              </script>';
            }
      }
 ?>
<html>
<head>
  <title>Konfirmasi Usulan</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>E Pokir</title>
  <!-- Favicons -->
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
  <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Tampilkan/Sembunyikan Menu"></div>
      </div>
      <a href="1_index.php" class="logo"><b>E<span>POKIR</span></b></a>
      <div class="nav notify-row" id="top_menu">
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <?php echo ' <li><a class="logout" href="1_logout.php">Logout</a></li>'; ?>     
        </ul>
      </div>
    </header> 
    <div class="container">
      <form action ="8_rekapusulan.php" method="post" class="form-login" >
        <h2 class="form-login-heading">Konfirmasi Usulan</h2>
        <div class="login-wrap">
          <h4 class="mb"><i class="fa fa-angle-right"></i> Apa Anda Yakin Akan Mengirim Usulan</h4>
          <span class="help-block pull-right">*) Apabila Usulan Telah Dikirim, Anda tidak dapat melakukan perubahan lagi!!</span>
          <input type="hidden" name="status" value="<?php $p_status = 'Terkirim' ?>">


            <button type="submit" class="btn btn-theme">Tutup</button>
            <button type="submit"  class="btn btn-theme pull-right" name = "kirim_daftar" value ="KIRIM" > mulai</button>
         </div>        
        </div>         
      </form>
    </div>

    <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
  <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>
</section>
</body>
</html>