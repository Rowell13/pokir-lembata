<!DOCTYPE html>
<?php 
include "koneksi/koneksi.php";
// include 'koneksi/fungsi.php';
include 'head.php';
include "aside.php";
if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='index.php';</script>";
} else {
$nav        = "";
$ambil      = "1_index.php";
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_namauser      = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
if ($_SESSION['username'] != NULL || !empty($_SESSION['username'])) {
  $p          = isset($_GET['p']) ? $_GET['p'] : "";  
  if ($p == "") {
    $nav  = "Depan";
    $ambil  = "1_index.php";
  } else if ($p == "2_registrasi") {
    $nav  = "Pendaftaran";
    $ambil  = "p.php";
  } else if ($p == "13_pengguna") {
    $nav  = "Data DPRD";
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
    $ambil  = "index.php";
    echo "<meta http-equiv='refresh' content='0; url=store'>";
  
  } else {
    $nav  = "Depan";
    $ambil  = "index.php";
  }
}

$display      = "style='display: none'";
$id_user      = isset($_GET['id']) ? $_GET['id'] : NULL;
$mode_form    = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol     = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_noid       = isset($_POST['noid']) ? $_POST['noid'] : "";
$p_nip        = isset($_POST['nip']) ? $_POST['nip'] : "";
$p_id_bidang  = isset($_POST['bidang']) ? $_POST['bidang'] : "";
$p_email      = isset($_POST['email'])? $_POST['email']:"";
$p_nama       = isset($_POST['u_nama']) ? $_POST['u_nama'] : "";
$p_hp         = isset($_POST['u_hp']) ? $_POST['u_hp'] : "";
$p_username   = isset($_POST['username']) ? $_POST['username'] : "";
$p_password   = isset($_POST['u_pass']) ? $_POST['u_pass'] : "";
$p_submit     = "DAFTAR";
$tb_act       = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
$id_del           = isset($_GET['id']) ? $_GET['id'] : NULL;

if ($tb_act == "Edit") {
          $display = "style='display: none'";
          $q_edit_skpd = mysql_query("UPDATE t_skpd SET id_bidang  = '$p_id_bidang',
                                                          nip        = '$p_nip',
                                                          nama       = '$p_nama',
                                                          email      = '$p_email',
                                                          hp         = '$p_hp',
                                                          n_user     = '$p_username'
                                                          WHERE user_id = '$p_noid'");
          if ($q_edit_skpd) {
            echo "<script type='text/javascript'>
                  alert('Data berhasil Diubah');
                  window.location=('13_profileuser.php')
                  </script>";
          } else {
            echo "<script type='text/javascript'>
                  alert('Data Gagal Diubah');
                  window.location=('13_profileuser.php')
                  </script>";
          }
        } else if ($tb_act == "Ubah") {
      $display = "style='display: none'";
      $q_edit_user = mysql_query("UPDATE t_skpd SET p_user = '$p_password' WHERE user_id = '$p_noid'");
      
      if ($q_edit_user) {
        echo "<script type='text/javascript'>
              alert('Password berhasil Diubah');
              window.location=('13_profileuser.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Password Gagal Diubah');
              window.location=('13_profileuser.php')
              </script>";
      }
    } else  {  
      $display = "style='display: none'";
    }
    if ($mode_form == "aktif") {
    $p_status = 'Y';    
          $q_aktif = mysql_query("UPDATE t_skpd SET status = '$p_status' WHERE user_id = '$id_del' ");    
    if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Diaktifkan');
    window.location=('13_profileuser.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Non Aktifkan') </script>";
    }
  }
  if ($mode_form == "nonaktif") {
    $p_status = 'N';    
          $q_aktif = mysql_query("UPDATE t_skpd SET status = '$p_status' WHERE user_id = '$id_del' ");    
    if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Di Non Aktifkan');
    window.location=('13_profileuser.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Non Aktifkan') </script>";
    }
  } 
  if ($mode_form == "del") {
      //$display = "style='display: none'";
      $q_edit_user = mysql_query("DELETE FROM t_skpd WHERE user_id = '$id_del'");      
      if ($q_edit_user) {
        echo "<script type='text/javascript'>
              alert('Data Berhasil Dihapus');
              window.location=('13_profileuser.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Data Gagal Dihapus');
              window.location=('13_profileuser.php')
              </script>";
      }
    } 
?>
<html>
<body>
 <!--  <head>
    <link rel="stylesheet" href="style.css">
  </head> -->
<section id="container">
	<section id="main-content">
    <section class="wrapper"><h3><a href="13_profileuser.php"><i class="fa fa-angle-right">&nbsp Profil</i></a></h3>
        <div class="row mb">
          <div class="content-panel">           
            <div class="adv-table">
          <!-- <div class="form-panel"> -->        
              <?php
              echo "<table border='2' class='display table table-bordered' id='hidden-table-info'><tr>
              <th class='center' width='10%'>NIP</th>
              <th width='15%' center='' >Nama</th>
              <th width='15%'>Email</th>
              <th width='15%'>No. HP</th>
              <th width='15%'>User Name</th>";
              if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
               echo"<th width='5%'>Status</th>";
              } else {
              }
              echo "<th width='15%'>Control</th>
              </tr>";
              if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
              $q_user  = mysql_query("SELECT * FROM t_skpd ") or die (mysql_error());
              $j_data   = mysql_num_rows($q_user); 
              } else {
              $q_user  = mysql_query("SELECT * FROM t_skpd WHERE user_id = $_SESSION[id_user]") or die (mysql_error());
              $j_data   = mysql_num_rows($q_user);
              }
              if ($j_data == 0) {
                echo "<tr><td id='tengah' colspan='7'>-- Tidak Ada Data --</td></tr>";
              } else {      
                while ($a_user = mysql_fetch_array($q_user)) {
                  echo "<tr>
                        <td>$a_user[2]</td>
                        <td>$a_user[3]</td>
                        <td>$a_user[4]</td>
                        <td>$a_user[5]</td>
                        <td>$a_user[7]</td>";
                        if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                        echo "<td>$a_user[8]</td>";
                      }else {

                      }
                        echo "<td>
                        <a href='?p=profile&mod=edit&id=$a_user[0]&show=ubah'><i class='fa fa-pencil'></i></a> &nbsp | &nbsp
                        <a href='?p=profile&mod=ubah&id=$a_user[0]&show=pass'><i class='fa fa-user'></i></a>&nbsp | &nbsp ";
                        if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                        echo  "<a href='?p=profile&mod=aktif&id=$a_user[0]' class='fa fa-check'></a> &nbsp | &nbsp
                               <a href='?p=profile&mod=nonaktif&id=$a_user[0]' class='fa fa-minus-square'></a> &nbsp | &nbsp
                               <a href='?p=profile&mod=del&id=$a_user[0]'><i class='fa fa-trash red Bigger-150' ></i></a></td>";
                        } else {
                          # code...
                        }    
                        "</td>
                        </tr>";        
                }
              }
              echo "</table> 
              </div>
            </div>
          </div>";

              if ($mode_form == "edit") {
                 $display = "";
                 $q_edit_user = mysql_query("SELECT * FROM t_skpd WHERE user_id = '$id_user'");
                 $a_edit_user = mysql_fetch_array($q_edit_user);
                 $p_noid       = $a_edit_user[0];            
                 $p_id_bidang  = $a_edit_user[1];
                 $p_nip        = $a_edit_user[2];
                 $p_nama       = $a_edit_user[3];
                 $p_email      = $a_edit_user[4];
                 $p_hp         = $a_edit_user[5]; 
                 $p_username   = $a_edit_user[6]; 
                 $p_password   = $a_edit_user[7];              
                 $view = "Edit";            
              } else if ($mode_form == "ubah") {
                $display        = "";
                $p_password     = "";
                $view           = "Ubah";
              } 
              else {
                $display = "style='display: none'";
              }
              ?>         
                <?php if ((isset($_GET["show"]))&&($_GET["show"]=="ubah"))
                {
                ?>             

            <div class="row mt">
              <div class="content-panel">
                <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>>                
                    <h4 class="mb"><i class="fa fa-angle-right">&nbsp Form Update Data</i> </h4>
                    <div class="form-group" hidden="" > 
                      <label class="col-sm-2 col-sm-2 control-label">ID</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="noid" readonly value="<?php echo $id_user;?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 col-sm-2 control-label">Bidang</label>
                      <div class="col-sm-3">
                         <?php cmbDB("bidang", "bidang", "id_bidang", "nama_bidang", $p_id_bidang); ?>
                      </div>
                    </div>
                    <div class="form-group"> 
                      <label class="col-sm-2 col-sm-2 control-label">NIP</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="nip" value="<?php echo $p_nip; ?>" >
                      </div>
                    </div>
                    <div class="form-group"> 
                      <label class="col-sm-2 col-sm-2 control-label">Nama</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="u_nama" value="<?php echo $p_nama; ?>" >
                      </div>
                    </div>
                    <div class="form-group"> 
                      <label class="col-sm-2 col-sm-2 control-label">Email</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="email" value="<?php echo $p_email; ?>" >
                      </div>
                    </div>
                    <div class="form-group"> 
                      <label class="col-sm-2 col-sm-2 control-label">HP</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="u_hp" value="<?php echo $p_hp; ?>" >
                      </div>
                    </div>
                    <div class="form-group"> 
                      <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                      <div class="col-sm-2">
                        <input type="text" class="form-control" name="username" value="<?php echo $p_username; ?>" >
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2">                   
                      </div>
                      <div class="col-sm-10">
                        <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>">
                      </div>                  
                    </div>                 
                </form>
              </div>
            </div>
              <?php
              }
              else if ((isset($_GET["show"]))&&($_GET["show"]=="pass"))
              { 
              ?>
          <div class="row mt">  
            <div class="content-panel">
              <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>> 
                <h4 class="mb"><i class="fa fa-angle-right">&nbsp Ganti Password</i> </h4>
                
                  <div class="form-group" hidden="" > 
                  <label class="col-sm-2 col-sm-2 control-label">ID</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="noid" readonly value="<?php echo $id_user;?>" >
                  </div>
                  </div>           
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Password Baru</label>
                    <div class="col-sm-3">
                      <input type="password" id="pswd2" class="form-control" name="u_pass" placeholder="Masukan Password Baru"  value="<?php echo $p_password; ?>"  > 
                      <span id="ps" class="input-group-btn add-on">
                        <button onclick="tampil()" id="tombol" value="Hidden" class="btn btn-default" type="button">
                          <i id="icon" class="fa fa-eye-slash"> </i>
                        </button>
                      </span>
                    </div>
                  </div>
                  <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>">                  
              </form>
            </div>
          </div>
              <?php
              }else{}
              ?> 
		</section>
	</section>
	<?php include 'footer.php'; ?>
</section>
<script src="show.js"></script>
<script type="text/javascript">
  var masukanpass = document.getElementById('pswd'),
      chk  = document.getElementById('chk'),
      label = document.getElementById('showhide');
     chk.onclick = function () {
      if(chk.checked) {
           masukanpass.setAttribute('type', 'text');
           label.textContent = 'Hide Passowrd';
       } else {
           masukanpass.setAttribute('type', 'password');
           label.textContent = 'Show Passowrd';
       } 
     }

// proses 2
var input = document.getElementById('pswd3'),
    icon1 = document.getElementById('icon2');
    tombol=document.getElementById('tombol1')

   icon1.onclick = function () {
     if(input.className == 'form-control') {
        input.setAttribute('type', 'text');
        icon1.className = 'fa fa-eye';
        tombol.setAttribute('value','Show')
        //input.className = '';
     } else {
        input.setAttribute('type', 'password');
        icon1.className = 'fa fa-eye-slash';
        tombol.setAttribute('value','Hidden')
        input.className = 'form-control';
    }

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
<script language="javascript">
  function validasi(form){
    if (form.u_pass.value == ""){
      alert("Anda belum mengisikan Password.");
      form.u_pass.focus();
      return (false);
    }   
    return (true);
  }
</script>
</body>
</html>
<?php } ?>
 