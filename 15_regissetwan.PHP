<?php
// include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
include "head.php";

$mode_form    = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol     = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display      = "style='display: none'";
$p_noid       = isset($_POST['noid']) ? $_POST['noid'] : "";
$p_id_bidang  = isset($_POST['id_bidang'])? $_POST['id_bidang']:"";
$p_nip        = isset($_POST['nip']) ? $_POST['nip'] : "";
$p_nama       = isset($_POST['namauser']) ? strtoupper($_POST['namauser']) : "";
$p_email      = isset($_POST['email']) ? $_POST['email'] : "";
$p_notelp     = isset($_POST['notelp']) ? $_POST['notelp'] : "";
$p_username   = isset($_POST['username']) ? $_POST['username'] : "";
$p_password   = isset($_POST['password']) ? $_POST['password'] : "";
$p_status     = isset($_POST['status']) ? $_POST['status'] : "";
$p_submit     = "DAFTAR";
?>
<!DOCTYPE html>
<html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>E-Pokir - Registrasi</title>
    <link href="image/dprd.png" rel="icon">
    <link href="img/pemkab.png" rel="apple-touch-icon">
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="lib/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" type="text/css" href="lib/bootstrap-timepicker/compiled/timepicker.css" />
    <link rel=" stylesheet" type="text/css" href="lib/bootstrap-datetimepicker/datertimepicker.css" />
    <link href="lib/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="lib/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="lib/advanced-datatable/css/DT_bootstrap.css" />
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet">
    <script src="lib/chart-master/Chart.js"></script>
</head>
  <body>
    <section id="container">
      <section id="main-content">
        <section class="wrapper">
          <h3><i class="fa fa-angle-right">&nbsp Regis User Setwan</i> </h3>
          <div class="form-panel">
                <form action="15_regissetwanaksi.php" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)">
                  <div class="form-group"<?php echo $display;?>>
                    <label class="col-sm-2 col-sm-2 control-label">NIP</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="noid"  value="<?php echo $p_noid; ?>">
                     <!--  <!?php cInput("text","20", "nip", "nip",  $p_nip); ?> -->
                    </div>
                  </div>                  
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">NIP</label>
                    <div class="col-sm-3">
                      <input type="text" onkeypress="return hanyaAngka(event)"  class="form-control" name="nip"  value="<?php echo $p_nip; ?>">
                     <!--  <!?php cInput("text","20", "nip", "nip",  $p_nip); ?> -->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="namauser"  value="<?php echo $p_nama; ?>">
                      <!--?php cInput("name","40", "name", "namaanggota",  $p_nama); ?-->
                    </div>
                  </div>                
                  <div class="form-group">
                   <label class="col-sm-2 col-sm-2 control-label">Alamat Email</label>
                    <div class="col-sm-3">
                      <input class="form-control " id="cemail" type="email" name="email" value="" required />
                     <!--?php cInput("email", "20", "email", "email",  $p_email); ?-->
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Handphone</label>
                    <div class="col-sm-3">
                    <input type="text" onkeypress="return hanyaAngka(event) " class="form-control" name="notelp" value="<?php echo $p_nip; ?>">
                    <!--?php cInput("text","notelp", "20","", $p_notelp); ?-->
                    </div>
                  </div>                
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                    <div class="col-sm-3">
                      <?php cInput("text", "username", "30","username", $p_username); ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password</label>
                    <div class="col-sm-3">
                      <?php cInput("password","password", "20","password", $p_password); ?>
                    </div>
                  </div>
                  <div class="form-group" hidden="">
                    <label class="col-sm-2 col-sm-2 control-label">Status</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" name="status"  value="<?php echo $p_status='N'; ?>">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-theme" name="kirim_daftar" value="DAFTAR"> DAFTAR </button>
                  <button type="submit" class="btn btn-theme">BATAL</button>
                  </div>                  
                </form>
              </div>
        </section>
      </section>
      <?php include "footer.php"; ?>
    </section>
  </body>
</html>