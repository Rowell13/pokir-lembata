<!DOCTYPE html>
<?php 
include "koneksi/koneksi.php";  
//include "koneksi/fungsi.php";
include 'head.php';
include "aside.php";
if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='index.php';</script>";
} else {
$nav        = "";
$ambil      = "1_home.php";
$sesi_id            = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_nama          = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
$sesi_foto          = isset($_SESSION['foto']) ? $_SESSION['foto'] : NULL;
if ($_SESSION != NULL || !empty($_SESSION)) {
  $p          = isset($_GET['p']) ? $_GET['p'] : "";  
  if ($p == "") {
    $nav  = "Depan";
    $ambil  = "1_index.php";
  } elseif ($p == "2_registrasi") {
    $nav  = "Pendaftaran";
    $ambil  = "p.php";
  } elseif ($p == "daftar_data") {
    $nav  = "Data Pendaftar";
    $ambil  = "$p.php";
  } elseif ($p == "3_login") {
    $nav  = "Login Pengguna";
    $ambil  = "$p.php";
  } elseif ($p == "4_inputdapil") {
    $nav  = "Input Dapil";
    $ambil  = "$p.php";
  }elseif ($p == "5_inputfraksi") {
    $nav  = "Input Fraksi";
    $ambil  = "$p.php";
  }elseif ($p == "6_usulankegiatan") {
    $nav  = "Usulan Kegiatan";
    $ambil  = "$p.php";
  }elseif ($p == "8_rekapusulan") {
    $nav  = "Rekap Usulan";
    $ambil  = "$p.php";
  }elseif ($p == "10_editanggota") {
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
$display      = "style='display: none'";
$mode_form    = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol     = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$id_user      = isset($_GET['id']) ? $_GET['id'] : NULL;
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
$tb_act       = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
$p_ttl        = date_create($p_tgl_lahir);
$p_isi        = date_format($p_ttl, 'Y-m-d');

if ($tb_act == "Edit") {
		$display = "style='display: none'";
	 	move_uploaded_file($file_tmp, 'foto/'.$p_image);		
	  	$q_update = mysql_query("UPDATE t_dprd SET namaanggota = '$p_nama',
                                            tempatlahir = '$p_tmp_lahir',
                                            tgl_lahir   = '$p_isi',
                                            jk          = '$p_jk',
                                            alamat      = '$p_alamat',
                                            email       = '$p_email',
                                            notelp      = '$p_notelp',                            
                                            id_fraksi   = '$p_id_fraksi',
                                            id_dapil    = '$p_id_dapil'
                                            WHERE id_dprd= '$p_id_dprd' ");
	    echo $q_update;
	    if ($q_update) {
	    	 //move_uploaded_file($file_tmp, 'foto/'.$p_image);
	    	 echo "<script type='text/javascript'>
              alert('Data berhasil Diubah');
              window.location=('2_profildprd.php')
              </script>";
      	} else {
      		echo "<script type='text/javascript'>
              alert('Data Gagal Diubah');
              window.location=('2_profildprd.php')
              </script>";
        }	  
	} else if ($tb_act == "Ubah") {
      $display = "style='display: none'";
      $q_edit_pass = mysql_query("UPDATE t_dprd SET password = '$p_password' WHERE id_dprd= '$p_id_dprd'");
      //echo $q_edit_pass;
      if ($q_edit_pass) {
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
    } else if ($tb_act == "Ganti") {
    	move_uploaded_file($file_tmp, 'foto/'.$p_image);
    	$display = "style='display: none'";
      $q_ganti_foto = mysql_query("UPDATE t_dprd SET foto = '$p_image' WHERE id_dprd= '$p_id_dprd'");
      //echo $q_edit_pass;
      if ($q_ganti_foto) {
      	move_uploaded_file($file_tmp, 'foto/'.$p_image);
        echo "<script type='text/javascript'>
              alert('Foto berhasil Diganti');
              window.location=('2_profildprd.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Foto Gagal Diganti');
              window.location=('2_profildprd.php')
              </script>";
      }
    }  else {  
      $display = "style='display: none'";
    }  
?>
<html>
<body>
 <!--  <head>
    <link rel="stylesheet" href="style.css">
  </head> -->
<section id="container">
	<section id="main-content">
    <section class="wrapper"><h3><a href="2_profildprd.php"><i class="fa fa-angle-right">&nbsp Data Profil  </i></a> </h3>
      <div class="row mt">
          <div class="form-panel">        
          <?php
          echo "<table border='2' class='table table-hover'><tr>
          <th class='center' width='10%'>NO KTP</th>
          <th width='20%' center='' >Nama</th>
          <th width='15%'>Email</th>
          <th width='10%'>No. HP</th>
          <th width='10%'>foto</th>
          <th width='10%'>Fraksi</th>
          <th width='5%'>Dapil</th>
          <th width='13%'>User Name</th>
          <th width='17%'>Control</th>
          </tr>";
          if ((isset($_SESSION['level'])) & ($_SESSION['level']=='SUPERADMIN')) {
          $q_user  = mysql_query("SELECT * FROM t_dprd") or die (mysql_error());
          $j_data   = mysql_num_rows($q_user); 
          } else {
          $q_user  = mysql_query("SELECT * FROM t_dprd WHERE id_dprd = $_SESSION[id_user]") or die (mysql_error());
          $j_data   = mysql_num_rows($q_user);
          }
          if ($j_data == 0) {
            echo "<tr><td id='tengah' colspan='6'>-- Tidak Ada Data --</td></tr>";
          } else {      
            while ($a_user = mysql_fetch_array($q_user)) {
              echo "<tr>
                    <td>$a_user[0]</td>
                    <td>$a_user[1]</td>
                    <td>$a_user[6]</td>
                    <td>$a_user[7]</td>
                    <td><img style=width:150px;height:100px; src='foto/$a_user[8]'></td>
                   	<td class='center hidden-phone'>"; echo getfraksi($a_user[9]); echo "</td>
                   	<td center=''>"; echo getdapil($a_user[10]); echo "</td>
                    <td>$a_user[12]</td>
                    <td>
                    <a href='?p=profile&mod=ganti&id=$a_user[0]&show=foto'><i class='fa fa-file'></i></a> |
                    <a href='?p=profile&mod=edit&id=$a_user[0]&show=ubah'><i class='fa fa-pencil'></i></a>|
                    <a href='?p=profile&mod=ubah&id=$a_user[0]&show=pass'><i class='fa fa-user'></i></a> 
                    </td>
                    </tr>";        
            }
          }
        
          echo "</table>";
          if ($mode_form == "edit") {
			  $display = "";
			  $q_data_edit  = mysql_query("SELECT * FROM t_dprd WHERE id_dprd = '$id_user'") or die (mysql_error());
			  $a_data_edit  = mysql_fetch_array($q_data_edit);
			  $p_id_dprd    = $a_data_edit[0];
			  $p_nama       = $a_data_edit[1];
			  $p_tmp_lahir  = $a_data_edit[2];
			  $p_tgl_lahir  = $a_data_edit[3];
			  $p_jk         = $a_data_edit[4];  
			  $p_alamat     = $a_data_edit[5];
			  $p_email      = $a_data_edit[6];    
			  $p_notelp     = $a_data_edit[7];    
			  $p_id_fraksi  = $a_data_edit[9];   
			  $p_id_dapil   = $a_data_edit[10];
			  $p_image      = $a_data_edit[8];
			  $p_username   = $a_data_edit[11];
			  $p_password   = $a_data_edit[12];
			  $p_tgl_daftar = $a_data_edit[13]; 
			  $p_status     = $a_data_edit[14];
  			  $view = "Edit";
  			}  else if ($mode_form == "ubah") {
  				$display        = "";
  				$p_password     = "";
  				$view           = "Ubah";
  			} else if ($mode_form == "ganti") {
  				$display        = "";
  				$p_image      	= "";
  				$view           = "Ganti";
  			} else {
  				$display = "style='display: none'";
  			} 
          ?>         
            <?php if ((isset($_GET["show"]))&&($_GET["show"]=="ubah"))
            {
            ?>
             <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>> <h4 class="mb"><i class="fa fa-angle-right">&nbsp Form Update Data</i> </h4>            
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nomor KTP</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="id_dprd"  value="<?php echo $p_id_dprd; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Lengkap</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="namaanggota"  value="<?php echo $p_nama; ?>">
                  </div>
                </div>
                <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Tempat Lahir</label>
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
                  </div>
                </div>
                <div class="form-group">
                 <label class="col-sm-2 col-sm-2 control-label">Alamat Email</label>
                  <div class="col-sm-3">
                    <input class="form-control " id="cemail" type="email" name="email" value="<?php echo "$p_email"; ?>" required />
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">No Telpon Atau Handphone</label>
                  <div class="col-sm-2">
                  <input type="text" class="form-control" name="notelp" value="<?php echo $p_notelp; ?>">
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
              <label class="col-sm-2 col-sm-2 control-label">User Name</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="username" value="<?php echo $p_username; ?>" >
              </div>
            </div>
            <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>"> 
          </form>
          <?php
            }
            else if ((isset($_GET["show"]))&&($_GET["show"]=="foto"))
            { 
            ?>
        <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>> <h4 class="mb"><i class="fa fa-angle-right">&nbsp Ganti Foto</i> </h4>
        	<div class="form-group" hidden="" > 
              <label class="col-sm-2 col-sm-2 control-label">ID</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="id_dprd" readonly value="<?php echo $id_user;?>" >
              </div>
            </div>
          	<div class="form-group"> <label class="control-label col-md-2">Ganti Foto</label>
      			<div class="col-md-9">
      				<div class="fileupload fileupload-new" data-provides="fileupload" >
      					<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
      					 <img src="foto/<?php echo $p_image; ?>" alt="" />
      					</div>
      					<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
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
                	<span></span>
              	</div>
            </div>
            <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>"> 
		</form> 
            <?php
            }
            else if ((isset($_GET["show"]))&&($_GET["show"]=="pass"))
            { 
            ?>
             <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>> <h4 class="mb"><i class="fa fa-angle-right">&nbsp Ganti Password</i> </h4>
             <div class="form-group" hidden="" > 
              <label class="col-sm-2 col-sm-2 control-label">ID</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="id_dprd" readonly value="<?php echo $id_user;?>" >
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
            <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>"> 
            </form> 
            <?php
            }else{}
            ?>    
      </div>
  </div>
		</section>
	</section>
	<!-- <!?php include 'footer.php'; ?> -->
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