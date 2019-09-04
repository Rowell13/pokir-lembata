<?php
include "koneksi/koneksi.php";
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
   $q_user = "INSERT INTO t_skpd (user_id, id_bidang, nip, nama, email, hp, n_user, p_user, status) VALUES  
                            ('$p_noid','$p_id_bidang','$p_nip','$p_nama','$p_email', '$p_notelp','$p_username','$p_password', '$p_status')";
        $q_daftar = mysql_query($q_user);
        // echo $q_user;
    if ($q_daftar) {
      echo '
      <script type="text/javascript">
      alert("Akun Berhasil Di Daftarkan");
      window.location=("1_home.php?code=09")
      </script>';
    } else {
      echo '<script> alert("Data Gagal di daftarkan mohon periksa kembali isian anda")</script>';
    }
  } if ($p_submit == "EDIT_USER") {
        $q_edit = "UPDATE t_skpd SET id_bidang   = '$p_id_bidang', 
                                       nip       = '$p_nip', 
                                       nama      = '$p_nama', 
                                       email     = '$p_email', 
                                       hp        = '$p_notelp', 
                                       u_nama    = '$p_username', 
                                       u_password= '$p_password',
                                       status    = '$p_status'
                                  WHERE user_id  = '$p_noid'";
        $q_ubah = mysql_query($q_edit);
        if ($q_ubah) {
          echo '
          <script type="text/javascript">
          alert-success("Akun Berhasil Di Daftarkan")
          window.location=("14_cuser.php")
          </script>';
        } else {
          echo '<script> alert("Data Gagal di daftarkan mohon periksa kembali isian anda")</script>';
        }
      }
    }
?>