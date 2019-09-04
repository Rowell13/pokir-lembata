<?php
//include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
//include "head.php";
require_once '2_registrasiaksi.php';

$mode_form    = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol     = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display      = "style='display: none'";
$p_noid       = isset($_POST['noid']) ? $_POST['noid'] : "";
$p_id_dprd     = isset($_POST['id_dprd']) ? $_POST['id_dprd'] : "";
$p_nama       = isset($_POST['namaanggota']) ? strtoupper($_POST['namaanggota']) : "";
$p_tmp_lahir  = isset($_POST['tmp_lahir']) ? $_POST['tmp_lahir'] : "";  
$p_tgl_lahir  = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";
$p_jk         = isset($_POST['jk']) ? $_POST['jk'] : "";
$p_alamat     = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$p_email      = isset($_POST['email']) ? $_POST['email'] : "";
$p_notelp     = isset($_POST['notelp']) ? $_POST['notelp'] : "";
$p_username   = isset($_POST['username']) ? $_POST['username'] : "";
$p_password   = isset($_POST['password']) ? $_POST['password'] : "";
$p_id_fraksi  = isset($_POST['fraksi']) ? $_POST['fraksi'] : "";
$p_id_dapil   = isset($_POST['dapil']) ? $_POST['dapil'] : "";
$ekstensi_diperbolehkan = array('png','jpg');
$p_image      = isset($_FILES['foto']['name']) ? $_FILES['foto']['name']: NULL;
$x            = explode('.', $p_image);
$ekstensi     = strtolower(end($x));
$ukuran       = isset($_FILES['foto']['size']) ? $_FILES['foto']['size']: NULL;
$file_tmp     = isset($_FILES['foto']['tmp_name']) ?$_FILES['foto']['tmp_name']: NULL;
$p_tgl_daftar = isset($_POST['tgl_daftar']) ? $_POST['tgl_daftar'] : "";
$p_status     = isset($_POST['status']) ? $_POST['status'] : "";
$p_submit     = "DAFTAR";

$p_ttl        = date_create($p_tgl_lahir);
$p_isi        = date_format($p_ttl, 'Y-m-d');

// if ($mode_form == "add") {

// } else if ($mode_form == "edit") {
//   $q_data_edit  = mysql_query("SELECT * FROM t_dprd WHERE id_dprd = '$noid'");
//   $a_data_edit  = mysql_fetch_array($q_data_edit);
//   $noid         = $a_data_edit[0];
//   $p_nama       = $a_data_edit[1];
//   $p_tmp_lahir  = $a_data_edit[2];
//   $p_tgl_lahir  = $a_data_edit[3];
//   $p_jk         = $a_data_edit[4];  
//   $p_alamat     = $a_data_edit[5];
//   $p_email      = $a_data_edit[6];
//   $p_notelp     = $a_data_edit[7];       
//   $p_id_fraksi  = $a_data_edit[9];   
//   $p_id_dapil   = $a_data_edit[10];
//   $p_image      = $a_data_edit [8];
//   $p_username   = $a_data_edit[11];
//   $p_password   = $a_data_edit[12];
//   $p_tgl_daftar = $a_data_edit[13]; 
//   $p_status     = $a_data_edit[14];  
//   $p_submit    = "EDIT";
// }
?>
<!DOCTYPE html>
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
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">
  <script src="lib/chart-master/Chart.js"></script>
</head>
<body>
<section id="container">
  <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Form Registrasi Anggota</h3>
          <div class="form-panel"><h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Diri</h4>
            <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)">
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Nomor KTP</label>
                <div class="col-sm-5">
                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="id_dprd"  value="<?php echo $p_id_dprd; ?>">
                    <!--?php cInput("name","40", "name", "id_dprd",  $p_id_dprd); ?-->
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
                <div class="col-sm-5">
                  <input type="text" class="form-control" name="namaanggota"  value="<?php echo $p_nama; ?>">
                    <!--?php cInput("name","40", "name", "namaanggota",  $p_nama); ?-->
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Tempat Lahir</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="tmp_lahir" value="<?php echo $p_tmp_lahir; ?>">
                </div>
                <div class="col-md-3 col-xs-11">
                  <div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date="01-01-2001" class="input-append date dpYears">
                    <input type="text" readonly="" name ="tgl_lahir" value="<?php echo $p_tgl_lahir;   ?>" size="16" class="form-control">
                    <span class="input-group-btn add-on"><button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button></span>
                  </div>
                    <!--$p_tgl_lahir, $p_bln_lahir, $p_thn_lahir; -->
                    <span class="help-block">Pilih Tanggal</span>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
                <div class="col-md-2 col-xs-11">
                  <?php cRadio("jk", "Laki-Laki|Perempuan", "1|2", $p_jk); ?>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Alamat Rumah</label>
                <div class="col-md-6 col-xs-11">
                    <textarea class="form-control "  name="alamat" required> <?php echo "$p_alamat"; ?> </textarea>
                    <!--?php cInputtext("alamat",  $p_alamat); ?-->
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Alamat Email</label>
                <div class="col-sm-3">
                  <input class="form-control " id="cemail" type="email" name="email" value="<?php echo "$p_email"; ?>" required />
                  <!--?php cInput("email", "20", "email", "email",  $p_email); ?-->
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">No Telpon Atau Handphone</label>
                <div class="col-sm-2">
                  <input type="text" onkeypress="return hanyaAngka(event) " class="form-control" name="notelp" value="<?php echo $p_notelp; ?>">
                  <!--?php cInput("text","notelp", "20","", $p_notelp); ?-->
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Nama Fraksi</label>
                <div class="col-sm-3">
                  <?php cmbDB ("fraksi", "t_fraksi", "id_fraksi", "nama_fraksi", $p_id_fraksi); ?>
                  <br>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">Nama Dapil</label>
                <div class="col-sm-3">
                  <?php cmbDB ("dapil", "t_dapil", "id_dapil", "nama_dapil", $p_id_dapil); ?>
                  <br>
                </div>
                <input type="hidden" name="tgl_daftar" value="<?php echo $p_tgl_daftar = date('Y-m-d'); ?>">
                <input type="hidden" name="status" value="<?php echo $p_status = "N"; ?>">
              </div>
              <div class="form-group"><label class="control-label col-md-2">Upload Foto</label>
                <div class="col-md-9">
                  <div class="fileupload fileupload-new" data-provides="fileupload" >
                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"><img src="/image/user.jpg" alt="" />
                    </div>
                    <div>
                      <span class="btn btn-theme02 btn-file">
                        <span class="fileupload-new"><i class="fa fa-paperclip"></i> Pilih Foto</span>
                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Ganti Foto </span>
                        <input type="file" class="default" name ="foto" value = "<?php echo $p_image; ?>" />
                      </span>
                      <a href="2_Registrasi.php#" class="btn btn-theme04 fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Hapus Foto</a>
                    </div>
                  </div>
                  <span class="label label-info">NOTE!</span>
                </div>
              </div>
              <div class="form-group"><label class="col-sm-2 col-sm-2 control-label">User Name</label>
                <div class="col-sm-3">
                  <?php cInput("text", "username", "30","username", $p_username); ?>                  
                </div>
              </div>
              <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
              <div class="col-sm-3">
                <input type="password" id="pswd2" class="form-control" name="password" placeholder="Masukan Password Baru"  value="<?php echo $p_password; ?>"  > 
                <span id="ps" class="input-group-btn add-on">
                  <button onclick="tampil()" id="tombol" value="Hidden" class="btn btn-default" type="button">
                    <i id="icon" class="fa fa-eye-slash"> </i>
                  </button>
                </span>
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
    <!-- <!?php include "footer.php" ?> -->
  </section>
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
        if (form.id_dprd.value == ""){
          alert("Anda Mengisi KTP.");
          form.id_dprd.focus();
          return (false);
        }    
        if (form.namaanggota.value == ""){
          alert("Nama Anda Kosong.");
          form.namaanggota.focus();
          return (false);
        }
        if (form.tmp_lahir.value == ""){
          alert("Tempat Lahir Anda Kosing!");
          form.tmp_lahir.focus();
          return (false);
        }
        if (form.tgl_lahir.value == ""){
          alert("Isi Tanggal Lahir Anda!");
          form.tgl_lahir.focus();
          return (false);
        }
        if (form.jk.value == ""){
          alert("Jenis Kelamin Belum Dipilih");
          form.jk.focus();
          return (false);
        }
        if (form.alamat.value == ""){
          alert("Alamat Belum Di Isi!");
          form.alamat.focus();
          return (false);
        }
        if (form.email.value == ""){
        alert("Isi Email Anda!");
          form.email.focus();
          return (false);
        }
        if (form.notelp.value == ""){
        alert("No Telpon Belum di Isi!");
          form.notelp.focus();
          return (false);
        }
        if (form.fraksi.value == "--"){
        alert("Fraksi Belum Dipilih!");
          form.fraksi.focus();
          return (false);
        }
        if (form.dapil.value == "--"){
        alert("Dapil Belum Dipilih!");
          form.dapil.focus();
          return (false);
        }
        if (form.foto.value == ""){
        alert("Pilih Foto Anda!");
          form.foto.focus();
          return (false);
        }
        if (form.username.value == ""){
        alert("User Name Kosong!");
          form.username.focus();
          return (false);
        }
        if (form.password.value == ""){
        alert("Password Kosong!");
          form.password.focus();
          return (false);
        }
         return (true);
       }
    </script>
    <script type="text/javascript">
      function tampil() {
      if (document.getElementById("tombol").value=="Hidden") {
        document.getElementById("pswd2").type="text";
        document.getElementById("tombol").value="show";
        document.getElementById("icon").className="fa fa-eye";
        document.getElementById("pswd2").style="width: 280px;";
        //document.getElementById("icon").style="position:absolute;";
        document.getElementById("ps").style="position:relative;";      

      } else if (document.getElementById("tombol").value=="show") {
        document.getElementById("pswd2").type="password";
        document.getElementById("tombol").value="Hidden";
        document.getElementById("icon").className="fa fa-eye-slash";
         document.getElementById("pswd2").style="width: 280px;";
         //document.getElementById("icon").style="position:absolute;";
         document.getElementById("ps").style="position:relative;";
        }
      }

      // funtion tampilpassword()
      // {
      //   document.getElementById('tunjuk').Hidden=false;
      //   document.getElementById('rubah').Hidden=true;
      // }
      // funtion tampilubah()
      // {
      //   document.getElementById('tunjuk').Hidden=true;
      //   document.getElementById('rubah').Hidden=false;
      // }
    </script>
</body>
</html>