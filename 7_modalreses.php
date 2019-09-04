<!DOCTYPE html>
<html lang="en">
<?php
include "head.php";
include "aside.php";

if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='1_home.php';</script>";
} else {
$nav        = "";
$ambil      = "1_index.php";
$sesi_iduser        = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
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

$id_reses 	    = isset($_GET['id']) ? $_GET['id'] : NULL;
$mod      	    = isset($_GET['mod']) ? $_GET['mod'] : NULL;
$display        = "style='display: none'";  //default = formnya dihidden
$p_tombol 		  = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";     
$p_id_reses     = isset($_POST['id_reses']) ? $_POST['id_reses'] : NULL;
$p_nm_reses     = isset($_POST['nm_reses']) ? $_POST['nm_reses'] : NULL;            
$p_thn_reses    = isset($_POST['thn_reses']) ? $_POST['thn_reses'] : NULL;    
$p_tgl_reses    = isset($_POST['tgl_reses'])? $_POST['tgl_reses']:NULL;
$p_kec_reses    = isset($_POST['id_kec'])? $_POST['id_kec']:NULL;
$p_id_dprd      = isset($_POST['id_dprd'])? $_POST['id_dprd']:NULL;
$p_status       = isset($_POST['status'])? $_POST['status']: NULL;
$p_submit       = "DAFTAR";

$p_treses = date_create($p_tgl_reses);
$p_isi = date_format($p_treses, 'Y-m-d');

if ($p_tombol == "DAFTAR") {
  	$display = "style='display: none'";     	
 	 $q_tambah_reses = "INSERT INTO t_reses (id_reses, nm_reses, tahun, tgl_reses, id_kec, id_dprd, status) VALUES 
  	('$p_id_reses',
    '$p_nm_reses',
  	'$p_thn_reses', 
  	'$p_isi',
    '$p_kec_reses',
  	'$p_id_dprd', 
  	'$p_status')";
    $q_masuk = mysql_query($q_tambah_reses);
    //echo $q_tambah_reses;
    if ($q_masuk) {
    echo "<script type='text/javascript'>
            alert('Reses berhasil Di Tambahkan');
            window.location=('1_index.php')
            </script>";
    //echo  '<script> <a href="1_index.php" class="btn btn-info" role="button">OK</a> </script>';                      
    } else {
    	echo "<script type='text/javascript'>
            alert('Data Gagal Di Tambahkan');
            </script>";
            header("7_modalreses.php");   
            }     
  }
?>
<script language="javascript">
function validasi(form){
  if (form.thn_reses.value == ""){
    alert("Anda belum mengisikan Masa Reses.");
    form.thn_reses.focus();
    return (false);
  }
     
  if (form.tgl_reses.value == ""){
    alert("Anda belum mengisikan Tanggal Reses.");
    form..focus();
    return (false);
  }
  return (true);
}
</script>
<head>
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
  <div>
    <div class="container">
      <form action="7_resesaksi.php" method="POST" class="form-login" onSubmit="return validasi(this)" >
        <h2 class="form-login-heading">Input Masa Reses</h2>
        <div class="login-wrap">
        	<input type="hidden" name="id_reses" value="<?php echo $p_id_reses; ?>">
          <label> Masa Reses </label>     
          <?php cCmbtahun('thn_reses', $p_thn_reses); ?>
          <br>
          <label> Nama Reses </label>
           <input type="text" class="form-control" name="nm_reses"  value="<?php echo $p_nm_reses; ?>">     
          <!-- <!?php cInput('text','100','name','nm_reses', $p_nm_reses); ?> -->
          <br>
          <label class="cform-login-heading"> Tanggal Reses</label>    <br>              
           <!--?php ccmbTglLahir($p_tgl_reses, $p_tgl_reses, $p_tgl_reses)  ?-->
            <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" name ="tgl_reses" value="<?php  echo $p_tgl_reses;?>">
            <span class="help-block pull-right">Pilih Tanggal</span>
            <br>

            <label> Kecamatan </label>     
            <?php cmbDB('id_kec','kecamatan','id_kec','nama_kec', $p_kec_reses); ?>
            <br>

            <input type="hidden" name="id_dprd" value="<?php echo $p_id_dprd = $_SESSION['id_user']; ?>">
            <input type="hidden" name="status" value="<?php echo $p_status ='Y' ; ?>">           
            <hr>
            <!--button onclic = location.href= "1_index.php" class="btn btn-theme">Tutup</button-->
            <input class="btn btn-theme" type="button" value="Batal" onclick=location.href="1_index.php">
            <button type="submit" class="btn btn-theme pull-right" name = "kirim_daftar" value ="DAFTAR"> Mulai</button>
         </div>        
        </div>         
      </form>
    </div>
  </div>
  <!-- js placed at the end of the document so the pages load faster -->
    <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/login-bg.jpg", {
      speed: 500
    });
  </script>
  <script src="lib/jquery-ui-1.9.2.custom.min.js"></script>
  <script type="text/javascript" src="lib/bootstrap-fileupload/bootstrap-fileupload.js"></script>
  <script type="text/javascript" src="lib/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
  <script src="lib/advanced-form-components.js"></script>
</body>
</html>
<?php } ?>