<?php
include "koneksi/fungsi.php";
include "head.php";
session_start();
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
$p_noid     = isset($_POST['noid']) ? $_POST['noid'] : "";
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
              move_uploaded_file($file_tmp, 'foto/'.$p_image);
              echo '<div id="login-page">
              <div class="container">
              <form action = "10_editanggota.php" class="form-login" method="GET">
              <h2 class="form-login-heading"> BERHASIL </h2>        
              <div class="login-wrap"> 
              <center><h4> DATA BERHASIL DI DI PERBAHARUI </h4>
              <div> 
              <a href="1_home.php"><img src="image/seru.png" height=147 width=176><br><br></a>
              </div>';
              echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="11_pengguna.php">
              </a></center><hr>
              </div>
              </div>';
            } else {
              echo '<script> alert("Data Gagal di daftarkan mohon periksa kembali isian anda")</script>
                    window.location=("13_pengguna.php")';              
            }
          }
       
 }   
?>