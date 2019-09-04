<?php
//include "koneksi/fungsi.php";
include "head.php";
include 'koneksi/koneksi.php';

$mode_form    = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol     = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display      = "style='display: none'";
$p_noid       = isset($_POST['noid']) ? $_POST['noid'] : "";
$p_id_dprd    = isset($_POST['id_dprd']) ? $_POST['id_dprd'] : "";
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
$p_image        = isset($_FILES['foto']['name']) ? $_FILES['foto']['name']: NULL;
$x            = explode('.', $p_image);
$ekstensi     = strtolower(end($x));
$ukuran       = isset($_FILES['foto']['size']) ? $_FILES['foto']['size']: NULL;
$file_tmp     = isset($_FILES['foto']['tmp_name']) ?$_FILES['foto']['tmp_name']: NULL;
$p_tgl_daftar = isset($_POST['tgl_daftar']) ? $_POST['tgl_daftar'] : "";
$p_status     = isset($_POST['status']) ? $_POST['status'] : "";
$p_submit     = "DAFTAR";

$p_ttl = date_create($p_tgl_lahir);
$p_isi = date_format($p_ttl, 'Y-m-d');
$pj_tgl_lahir = substr($p_tgl_lahir, 0,2);
$pj_bln_lahir = substr($p_tgl_lahir, 4,2);
$pj_thn_lahir = substr($p_tgl_lahir, 7,4);
$ttl_gabung = $pj_thn_lahir."-".$pj_bln_lahir."-".$pj_tgl_lahir;

if ($p_tombol == "DAFTAR") {
  $p_nama = filter_input(INPUT_POST, 'namauser', FILTER_SANITIZE_STRING);
  $p_username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
  // enkripsi password
  //$p_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
  $p_email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

  $cek_user = "SELECT * FROM t_skpd WHERE n_user ='$p_username'";
  $cek_benar = mysql_query($cek_user);
  $cek_ada = mysql_num_rows($cek_benar);

  $cek_user1 = "SELECT * FROM t_admverifikasi WHERE n_user ='$p_username'";
  $cek_benar1 = mysql_query($cek_user1);
  $cek_ada1 = mysql_num_rows($cek_benar1);

  $cek_user2 = "SELECT * FROM t_admsetwan WHERE n_user ='$p_username'";
  $cek_benar2 = mysql_query($cek_user2);
  $cek_ada2 = mysql_num_rows($cek_benar2);

  $cek_user3 = "SELECT * FROM t_dprd WHERE username ='$p_username'";
  $cek_benar3 = mysql_query($cek_user3);
  $cek_ada3 = mysql_num_rows($cek_benar3);

  if (($cek_ada>0) OR ($cek_ada1>0)OR($cek_ada2>0) OR ($cek_ada3 >0)) {
   header("location:3_login.php?code=09");
  } else {
    $q_tambah_datadiri = "INSERT INTO t_dprd (id_dprd, namaanggota, tempatlahir, tgl_lahir, jk, alamat, email, notelp, foto, id_fraksi, id_dapil, username, password, tgldaftar, status)VALUES (
       '$p_id_dprd',
       '$p_nama',
       '$p_tmp_lahir',
       '$p_isi',
       '$p_jk',
       '$p_alamat',
       '$p_email',
       '$p_notelp',
       '$p_image',
       '$p_id_fraksi',
       '$p_id_dapil',
       '$p_username',
       '$p_password',
       '$p_tgl_daftar',
       '$p_status')";
        $q_daftar = mysql_query($q_tambah_datadiri);
        echo $q_tambah_datadiri;
        if ($q_daftar) {
        move_uploaded_file($file_tmp, 'foto/'.$p_image);
        echo '<div id="login-page">
            <div class="container">
              <form action = "2_registrasi.php" class="form-login" method="GET">
              <h2 class="form-login-heading"> BERHASIL </h2>
              
              <div class="login-wrap"> 
              <center><h4> DATA BERHASIL DI DAFTARKAN </h4>
              <div> 
              <a href="1_home.php"><img src="image/seru.png" height=147 width=176><br><br></a>
              </div>';
          echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_home.php">
              </a></center><hr>
              </div>
              </div>';
              } else {
                echo '<script> alert("Data Gagal di daftarkan mohon periksa kembali isian anda")</script>';
              }
            }
            if ($p_submit == "EDIT") {
             $q_update = mysql_query("UPDATE t_dprd SET namaanggota = '$p_nama',
                                            tempatlahir = '$p_tmp_lahir',
                                            tgl_lahir   = '$p_tgl_lahir',
                                            jk          = '$p_jk',
                                            alamat      = '$p_alamat',
                                            email       = '$p_email',
                                            notelp      = '$p_notelp',
                                            foto        = '$p_image',
                                            id_fraksi   = '$p_id_fraksi',
                                            id_dapil    = '$p_id_dapil',
                                            username    = '$p_username',
                                            password    = '$p_password',
                                            tgl_daftar  = '$p_tgl_daftar',
                                            status      = '$p_status',
                                            WHERE id_dprd= '$p_id_dprd' ");
              if ($q_update) {
                move_uploaded_file($file_tmp, 'foto/'.$p_image);
                echo '<div id="login-page">
                <div class="container">
                <form action = "2_registrasi.php" class="form-login" method="GET">
                <h2 class="form-login-heading"> BERHASIL </h2>        
                <div class="login-wrap"> 
                <center><h4> DATA BERHASIL DI DI PERBAHARUI </h4>
                <div> 
                <a href="1_home.php"><img src="image/seru.png" height=147 width=176><br><br></a>
                </div>';
                echo '<input class="btn btn-theme" type="button" value="LANJUTKAN" onclick=location.href="1_home.php">
                </a></center><hr>
                </div>
                </div>';
              } else {
                echo '<script> alert("Data Gagal di daftarkan mohon periksa kembali isian anda")</script>
               window.location(2_registrasi.php)';
                echo '<div class="alert alert-success"><b>Well done!</b> You successfully read this important alert message.</div>';
              }
          }
        }
?>