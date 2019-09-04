<?php
// include "koneksi/fungsi.php";
require_once '13_regisuseraksi.php';
include "koneksi/koneksi.php";
include "aside.php";
include "head.php";


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
    <!-- <link rel="stylesheet" href="assets/css/bootstrap-select.less"> -->
    <link rel="stylesheet" href="assets/scss/style.css">
    <script src="lib/chart-master/Chart.js"></script>
</head>
  <body>
    <section id="container">
      <section id="main-content">
        <section class="wrapper">
          <h3><i class="fa fa-angle-right">&nbsp User Baru</i> </h3>
          <div class="form-panel">
            <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)">
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Pilih Bidang</label>
                <div class="col-sm-3">
                   <?php 
                   if (isset($_GET["p_id_bidang"]))
                   {
                   cmbDB ("id_bidang", "bidang", "id_bidang", "nama_bidang", $_GET["p_id_bidang"]);
                   }
                   else
                   {
                    cmbDB ("id_bidang", "bidang", "id_bidang", "nama_bidang", $p_id_bidang);
                   }
                   
                    ?>
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
                  <input type="text" class="form-control" name="namauser"  value="<?php echo $p_nama; ?>" placeholder="namauser">
                  <!--?php cInput("name","40", "name", "namaanggota",  $p_nama); ?-->
                </div>
              </div>                
              <div class="form-group">
               <label class="col-sm-2 col-sm-2 control-label">Alamat Email</label>
                <div class="col-sm-3">
                  <input class="form-control " id="cemail" type="email" name="email" value="<?php echo $p_email; ?>"/>
                 <!--?php cInput("email", "20", "email", "email",  $p_email); ?-->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Handphone</label>
                <div class="col-sm-3">
                <input type="text" onkeypress="return hanyaAngka(event) " class="form-control" name="notelp" value="<?php echo $p_notelp; ?>" placeholder = "Handphone" >
                <!--?php cInput("text","notelp", "20","", $p_notelp); ?-->
                </div>
              </div>                
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="username" value="<?php echo $p_username; ?>" placeholder = "username" >
                   <!-- cInput("text", "username", "30","username", $p_username); -->
                  <?php
                  if ((isset($_GET["code"]))&&(($_GET["code"]=="05")||($_GET["code"]=="06")))
                    {
                  ?>
                   <span> <h4> Sudah Ada User Nama</span>
                 <?php } ?>
               </div>
                <!-- <!?php
                 if ((isset($_GET["code"]))&&($_GET["code"]=="07"))
                   {
                ?> -->
                <!-- <div class='sufee-alert alert with-close alert-warning alert-dismissible fade show'>
                <i class='fa fa-exclamation-triangle'></i><span style='font-weight:bold;'> Warning!</span>.
                  Gagal login!.
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
                </button> -->
                <!-- <!?php if ((isset($_GET[$name_error]))):  ?> -->
                <div class="col-md-4 col-xs-11" style="font-size: 1.1em; color: #D83D5A;" >             
                                     
                <!-- <!?php endif ?> -->
                </div>
              <!-- <!?php 
                } else {
                  
                }
                ?> -->
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Password</label>
                <div class="col-sm-3">
                  <input type="password" class="form-control" name="password" value="<?php echo $p_password; ?>" >
                  <!-- <!?php cInput("password","password", "20","password", $p_password); ?> -->
                </div>
              </div>
              <div class="form-group" hidden="">
                <label class="col-sm-2 col-sm-2 control-label">Status</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="status"  value="<?php echo $p_status='N'; ?>">
                </div>
              </div>
              <div class="form-group">
              <!-- <label style="margin-left: 195px"></label> -->
                <div class="col-sm-2">                   
                </div>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-theme" name="kirim_daftar" value="DAFTAR"> DAFTAR </button>
                  <button type="reset" class="btn btn-theme">BATAL</button>
                </div>                  
              </div>                  
            </form>
          </div>
        </section>
      </section>
      <?php include "footer.php" ?>
    </section>
    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>

    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
    <script src="lib/jquery.scrollTo.min.js"></script>
    <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="lib/common-scripts.js"></script>
    <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/date.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="lib/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script src="lib/advanced-form-components.js"></script>
    <script type="text/javascript">
      function validasi(form){
        if (form.nip.value == ""){
          alert("Anda Mengisi NIP Anda!");
          form.nip.focus();
          return (false);
        }    
        if (form.namauser.value == ""){
          alert("Nama Anda Kosong.");
          form.namauser.focus();
          return (false);
        }
        if (form.email.value == ""){
          alert("Email Kosong");
          form.email.focus();
          return (false);
        }
        if (form.notelp.value == ""){
          alert("Masukan No Handphone Anda!");
          form.notelp.focus();
          return (false);
        }
        if (form.username.value == ""){
          alert("Silakan Pilih User Name Anda");
          form.username.focus();
          return (false);
        }
        if (form.password.value == ""){
          alert("Mohon Masukan Password Login Anda!");
          form.password.focus();
          return (false);
        }
         return (true);
       }
    </script>
  </body>
</html>