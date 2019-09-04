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
$sesi_id            = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_nama          = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
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

if ($tb_act == "Edit") {
          $display = "style='display: none'";
          $q_edit_fraksi = mysql_query("UPDATE t_admsetwan SET 
                                                          nip        = '$p_nip',
                                                          nama_admin = '$p_nama',
                                                          email      = '$p_email',
                                                          hp         = '$p_hp',
                                                          n_user     = '$p_username'
                                                          WHERE user_id = '$p_noid'");
          if ($q_edit_fraksi) {
            echo "<script type='text/javascript'>
                  alert('Data berhasil Diubah');
                  window.location=('profile.php')
                  </script>";
          } else {
            echo "<script type='text/javascript'>
                  alert('Data Gagal Diubah');
                  window.location=('profile.php')
                  </script>";
          }
        } else if ($tb_act == "Ubah") {
      $display = "style='display: none'";
      $q_edit_user = mysql_query("UPDATE t_admsetwan SET p_user = '$p_password' WHERE user_id = '$p_noid'");
      
      if ($q_edit_user) {
        echo "<script type='text/javascript'>
              alert('Password berhasil Diubah');
              window.location=('15_profilesetwan.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Password Gagal Diubah');
              window.location=('15_profilesetwan.php')
              </script>";
      }
    } else  {  
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
    <section class="wrapper"><h3><a href="13_profiluser.php"><i class="fa fa-angle-right">&nbsp Profil Anda</i></a></h3>
      <div class="row mb">
          <div class="content-panel">
            <div class="adv-table">
            <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
            <thead> 
            <tr>
            <th class='center' width='10%'>NIP</th>
            <th width='20%' center='' >Nama</th>
            <th width='15%'>Email</th>
            <th width='15%'>No. HP</th>
            <th width='20%'>User Name</th>
            <th width='15%'>Control</th>
            </tr>
            </thead>
        <tbody>
          <?php
          $q_user  = mysql_query("SELECT * FROM t_admsetwan WHERE id_admsetwan = $_SESSION[id_user]") or die (mysql_error());
          $j_data   = mysql_num_rows($q_user);
          if ($j_data == 0) {
            echo "<tbody><tr><td id='tengah' colspan='6'>-- Tidak Ada Data --</td></tr></tbody>";
          } else {      
            while ($a_user = mysql_fetch_array($q_user)) {
              echo "<tr>
                    <td>$a_user[1]</td>
                    <td>$a_user[2]</td>
                    <td>$a_user[3]</td>
                    <td>$a_user[4]</td>
                    <td>$a_user[6]</td>
                    <td>
                    <a href='?p=profile&mod=edit&id=$a_user[0]&show=ubah'><i class='fa fa-pencil'></i></a>|
                    <a href='?p=profile&mod=ubah&id=$a_user[0]&show=pass'><i class='fa fa-user'></i></a>
                    </td>
                    </tr>";        
            }
          }
          ?>          
          </tbody>
          </table>"

          <?php 
          if ($mode_form == "edit") {
             $display = "";
             $q_edit_user = mysql_query("SELECT * FROM t_admsetwan WHERE id_admsetwan = '$id_user'");
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
             <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>> <h4 class="mb"><i class="fa fa-angle-right">&nbsp Form Update Data</i> </h4>
            <div class="form-group" hidden="" > 
              <label class="col-sm-2 col-sm-2 control-label">ID</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="noid" readonly value="<?php echo $id_user;?>" >
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
                  <!-- <label style="margin-left: 195px"></label> -->
                  <div class="col-sm-2">
                   
                  </div>
                  <div class="col-sm-10">
                   <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>">
                  </div>                  
                </div>
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
            <div class="form-group">
                  <!-- <label style="margin-left: 195px"></label> -->
              <div class="col-sm-2">                   
              </div>
              <div class="col-sm-10">
                <input type="submit" name="tb_act" class="btn btn-theme" value="<?php echo $view; ?>">
              </div>                  
            </div>
            </form> 
            <?php
            }else{}
            ?> 
                   
                
      </div>
    </div>
  </div>
		</section>
	</section>
	<!-- <!?php include 'footer.php'; ?> -->
</section>
<script src="show.js"></script>
  <script src="lib/jquery/jquery.min.js"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script class="include" type="text/javascript" src="lib/jquery.dcjqaccordion.2.7.js"></script>
  <script src="lib/jquery.scrollTo.min.js"></script>
  <script src="lib/jquery.nicescroll.js" type="text/javascript"></script>
  <script type="text/javascript" language="javascript" src="lib/advanced-datatable/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="lib/advanced-datatable/js/DT_bootstrap.js"></script>
  <!--common script for all pages-->
  <script src="lib/common-scripts.js"></script>
  <!--script for this page-->
  <script type="text/javascript">
    /* Formating function for row details */
    function fnFormatDetails(oTable, nTr) {
      var aData = oTable.fnGetData(nTr);
      var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
      sOut += '<tr><td>Di Input Oleh:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      // sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      // sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
      sOut += '</table>';

      return sOut;
    }

    $(document).ready(function() {
      /*
       * Insert a 'details' column to the table
       */
      var nCloneTh = document.createElement('th');
      var nCloneTd = document.createElement('td');
      nCloneTd.innerHTML = '<img src="lib/advanced-datatable/images/details_open.png">';
      nCloneTd.className = "center";

      $('#hidden-table-info thead tr').each(function() {
        this.insertBefore(nCloneTh, this.childNodes[0]);
      });

      $('#hidden-table-info tbody tr').each(function() {
        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
      });

      /*
       * Initialse DataTables, with no sorting on the 'details' column
       */
      var oTable = $('#hidden-table-info').dataTable({
        "aoColumnDefs": [{
          "bSortable": false,
          "aTargets": [0]
        }],
        "aaSorting": [
          [1, 'asc']
        ]
      });

      /* Add event listener for opening and closing details
       * Note that the indicator for showing which row is open is not controlled by DataTables,
       * rather it is done here
       */
      $('#hidden-table-info tbody td img').live('click', function() {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr)) {
          /* This row is already open - close it */
          this.src = "lib/advanced-datatable/media/images/details_open.png";
          oTable.fnClose(nTr);
        } else {
          /* Open this row */
          this.src = "lib/advanced-datatable/images/details_close.png";
          oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
        }
      });
    });
  </script>
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
 