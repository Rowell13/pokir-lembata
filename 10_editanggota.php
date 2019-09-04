<?php
//include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
//include "head.php";
if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='1_home.php';</script>";
} else {
$nav        = "";
$ambil      = "1_index.php";
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_namauser      = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
if ($_SESSION['username'] != NULL || !empty($_SESSION['username'])) {
  $p = isset($_GET['p']) ? $_GET['p'] : "";  
  if ($p == "") {
    $nav  = "Depan";
    $ambil  = "1_index.php";
  } else if ($p == "2_registrasi") {
    $nav  = "Pendaftaran";
    $ambil  = "p.php";
  } else if ($p == "daftar_data") {
    $nav  = "Data Pendaftar";
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
    $ambil  = "1_home.php";
    echo "<meta http-equiv='refresh' content='0; url=index.php'>";
  
  } else {
    $nav  = "Depan";
    $ambil  = "1_home.php";
  }
}

$mode_form  = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol   = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display    = "style='display: none'";
$id_user      = isset($_GET['id']) ? $_GET['id'] : NULL;
$p_no_ktp     = isset($_POST['no_ktp']) ? $_POST['no_ktp'] : "";
$p_nama       = isset($_POST['namaanggota']) ? strtoupper($_POST['namaanggota']) : "";
$p_tmp_lahir  = isset($_POST['tmp_lahir']) ? $_POST['tmp_lahir'] : "";  
$p_tgl_lahir  = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";
$p_jk         = isset($_POST['jk']) ? $_POST['jk'] : "";
$p_alamat     = isset($_POST['alamat']) ? $_POST['alamat'] : "";
$p_email      = isset($_POST['email']) ? $_POST['email'] : "";
$p_notelp     = isset($_POST['notelp']) ? $_POST['notelp'] : "";
$p_id_fraksi  = isset($_POST['fraksi']) ? $_POST['fraksi'] : "";
$p_id_dapil   = isset($_POST['dapil']) ? $_POST['dapil'] : "";
$ekstensi_diperbolehkan = array('png','jpg');
$p_image        = isset($_FILES['foto']['name']) ? $_FILES['foto']['name']: NULL;
$x            = explode('.', $p_image);
$ekstensi     = strtolower(end($x));
$ukuran       = isset($_FILES['foto']['size']) ? $_FILES['foto']['size']: NULL;
$file_tmp     = isset($_FILES['foto']['tmp_name']) ?$_FILES['foto']['tmp_name']: NULL;
$p_submit     = "EDIT";

$p_ttl = date_create($p_tgl_lahir);
$p_isi = date_format($p_ttl, 'Y-m-d');

  if ($p_tombol == "Edit") { 
             $q_update = mysql_query("UPDATE t_dprd SET namaanggota = '$p_nama',
                                            tempatlahir = '$p_tmp_lahir',
                                            tgl_lahir   = '$p_isi',
                                            jk          = '$p_jk',
                                            alamat      = '$p_alamat',
                                            email       = '$p_email',
                                            notelp      = '$p_notelp',
                                            foto        = '$p_image',
                                            id_fraksi   = '$p_id_fraksi',
                                            id_dapil    = '$p_id_dapil'
                                            WHERE id_dprd= '$p_no_ktp' ");
            if ($q_update) {
             echo "<script type='text/javascript'>
              alert('Password berhasil Diubah');
              window.location=('2_profildprd.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Password Gagal Diubah');
              window.location=('2_profildprd.php')
              </script>";
      }
          }

  if ($mode_form == "edit") {
  $display = "";
  $q_data_edit  = mysql_query("SELECT * FROM t_dprd WHERE id_dprd = '$id_user'") or die (mysql_error());
  $a_data_edit  = mysql_fetch_array($q_data_edit);
  $p_no_ktp     = $a_data_edit[0];
  $p_nama       = $a_data_edit[1];
  $p_tmp_lahir  = $a_data_edit[2];
  $p_tgl_lahir  = $a_data_edit[3];
  $p_jk         = $a_data_edit[4];  
  $p_alamat     = $a_data_edit[5];
  $p_email      = $a_data_edit[6];    
  $p_notelp     = $a_data_edit[7];    
  $p_id_fraksi  = $a_data_edit[9];   
  $p_id_dapil   = $a_data_edit[10];
  $p_image      = $a_data_edit [8];
 
  //$p_submit    = "EDIT";
  $view = "Edit";
}else {
      $display = "style='display: none'";
    } 
    
?>
<!DOCTYPE html>
 <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <title>E-Pokir - Update</title>
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
      <section class="wrapper"><h3><i class="fa fa-angle-right"></i> Form Update Anggota</h3>
        <div class="form-panel"><h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Diri</h4>
          <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)">
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nomor KTP</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" name="no_ktp"  value="<?php echo $id_user; ?>">
                <!--?php cInput("name","40", "name", "no_ktp",  $p_no_ktp); ?-->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
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
                  <span class="input-group-btn add-on">
                    <button class="btn btn-theme" type="button"><i class="fa fa-calendar"></i></button>
                  </span>
                </div>
                <!--$p_tgl_lahir, $p_bln_lahir, $p_thn_lahir; -->
                <span class="help-block">Pilih Tanggal</span>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-md-2 col-xs-11">
                <?php cRadio("jk", "Laki-Laki|Perempuan", "1|2", $p_jk); ?>
              </div>
            </div>
            <div class="form-group">
               <label class="col-sm-2 col-sm-2 control-label">Alamat Rumah</label>
              <div class="col-md-6 col-xs-11">
                <textarea class="form-control "  name="alamat"  required> <?php echo "$p_alamat"; ?></textarea>
                <!--?php cInputtext("alamat",  $p_alamat); ?-->
              </div>
            </div>
            <div class="form-group">
             <label class="col-sm-2 col-sm-2 control-label">Alamat Email</label>
              <div class="col-sm-3">
                <input class="form-control " id="cemail" type="email" name="email" value="<?php echo "$p_email"; ?>" required />
               <!--?php cInput("email", "20", "email", "email",  $p_email); ?-->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">No Telpon Atau Handphone</label>
              <div class="col-sm-2">
              <input type="text" class="form-control" name="notelp" value="<?php echo $p_notelp; ?>">
              <!--?php cInput("text","notelp", "20","", $p_notelp); ?-->
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nama Fraksi</label>
              <div class="col-sm-3">
                <?php cmbDB ("fraksi", "t_fraksi", "id_fraksi", "nama_fraksi", $p_id_fraksi); ?>
                <br>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Nama Dapil</label>
              <div class="col-sm-3">
                <?php cmbDB ("dapil", "t_dapil", "id_dapil", "nama_dapil", $p_id_dapil); ?>
                <br>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-2">Upload Foto</label>
              <div class="col-md-9">
                <div class="fileupload fileupload-new" data-provides="fileupload" >
                  <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                    <img src="foto/<?php echo $p_image; ?>" alt="" />
                  </div>
                 <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;">
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
            <button type="submit" class="btn btn-theme" name="kirim_daftar" value="Edit"> Edit </button>
            <button type="button" onclick=location.href="13_pengguna.php"  class="btn btn-theme">BATAL</button>
          </form>
        </div>
              <!--button data-toggle="modal" class="btn btn-theme" href="rekapusulan.php#myModal" >  </button-->
      </section>
    </section>
    <?php include "footer.php" ?>
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
  <script language="javascript">
    function validasi(form){
      if (form.no_ktp.value == ""){
        alert("Anda Mengisi KTP.");
        form.no_ktp.focus();
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
      if (form.fraksi.value == ""){
      alert("Fraksi Belum Dipilih!");
        form.fraksi.focus();
        return (false);
      }
      if (form.dapil.value == ""){
      alert("Dapil Belum Dipilih!");
        form.dapil.focus();
        return (false);
      }
      // if (form.foto.value == ""){
      // alert("Pilih Foto Anda!");
      //   form.foto.focus();
      //   return (false);
      // }
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
</body>
</html>
<?php } ?>