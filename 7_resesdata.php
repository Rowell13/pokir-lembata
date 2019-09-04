<?php 
  include "koneksi/koneksi.php";
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
  $id_reses      = isset($_GET['id']) ? $_GET['id'] : NULL;
  $mode_form            = isset($_GET['mod']) ? $_GET['mod'] : NULL;
  $display        = "style='display: none'";  //default = formnya dihidden
  $p_tombol       = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";     
  $p_id_reses     = isset($_POST['id_reses']) ? $_POST['id_reses'] : NULL;
  $p_nm_reses     = isset($_POST['nm_reses']) ? $_POST['nm_reses'] : NULL;            
  $p_thn_reses    = isset($_POST['thn_reses']) ? $_POST['thn_reses'] : NULL;    
  $p_tgl_reses    = isset($_POST['tgl_reses'])? $_POST['tgl_reses']:NULL;
  $p_kec_reses    = isset($_POST['id_kec'])? $_POST['id_kec']:NULL;
  $p_id_dprd      = isset($_POST['id_dprd'])? $_POST['id_dprd']:NULL;
  $p_status       = isset($_POST['status'])? $_POST['status']: NULL;
  $p_submit       = "DAFTAR";
  $tb_act         = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;
  $id_del          = isset($_GET['id']) ? $_GET['id'] : NULL;

  $p_ttl        = date_create($p_tgl_lahir);
  $p_isi        = date_format($p_ttl, 'Y-m-d');
  if ($tb_act == "Edit") {
    $display = "style='display: none'";
    $q_edit_fraksi = mysql_query("UPDATE t_reses SET id_reses  = '$p_id_reses',
                                                    nama       = '$p_nm_reses',
                                                    tahun      = '$p_thn_reses',
                                                    tgl_reses  = '$p_tgl_reses',
                                                    id_kec     = '$p_kec_reses'
                                                    WHERE user_id = '$p_noid'");
    if ($q_edit_fraksi) {
      echo "<script type='text/javascript'>
            alert('Data berhasil Diubah');
            window.location=('7_resesdata.php')
            </script>";
    } else {
      echo "<script type='text/javascript'>
            alert('Data Gagal Diubah');
            window.location=('7_resesdata.php')
            </script>";    }
  } else if ($tb_act == "Tambah") {
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
    echo $q_tambah_reses;      
    if ($q_masuk) {
     echo "<script type='text/javascript'>
          alert('Reses berhasil Di Tambahkan');
          window.location=('7_resesdata.php')
          </script>";                      
    } else {
      echo "<script type='text/javascript'>
            alert('Data Gagal Di Tambahkan');
            </script>";
          } 
    } else {  
    $display = "style='display: none'";
  }
?>
<!DOCTYPE html>
<html lang="en">
  <body>
    <section id="container">
      <section id="main-content">
        <section class="wrapper"><h3><a href="13_profileuser.php"><i class="fa fa-angle-right">&nbsp Data Reses</i></a></h3>
          <div class="row mb">
            <div class="content-panel">
              <div class="adv-table">               
                <?php
                  echo "<table border='2' class='display table table-bordered' id='hidden-table-info'><tr>              
                  <th width='15%' center='' >Masa Reses</th>
                  <th width='15%'>Nama Reses</th>
                  <th width='15%'>Tanggal Reses</th>
                  <th width='15%'>Kecamatan</th>";
                  if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                   echo"<th width='5%'>Status</th>";
                  } else {
                  }
                  echo "<th width='10%'>Control</th>
                  </tr>";
                  if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                  $q_user  = mysql_query("SELECT * FROM t_reses ") or die (mysql_error());
                  $j_data   = mysql_num_rows($q_user); 
                  } else {
                  $q_user  = mysql_query("SELECT * FROM t_reses WHERE id_dprd = $_SESSION[id_user]") or die (mysql_error());
                  $j_data   = mysql_num_rows($q_user);
                  }
                  if ($j_data == 0) {
                    echo "<tr><td id='tengah' colspan='7'>-- Tidak Ada Data --</td></tr>";
                  } else {      
                    while ($a_user = mysql_fetch_array($q_user)) {
                      echo "<tr>
                            <td>$a_user[1]</td>
                            <td>$a_user[2]</td>
                            <td>$a_user[3]</td>
                            <td>"; echo getkecamatan($a_user[4]); echo "</td>";
                            if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                            echo  "<td>$a_user[6]</td></td>";
                            } else {
                              # code...
                            }  
                            echo "<td>";                     
                            if (($_SESSION['level']=='DPRD')) {
                               echo "<a href='?p=profile&mod=tambah'><i class='fa fa-plus'></i></a>&nbsp ";
                            } else {

                            }                           
                            if (($_SESSION['level']=='SUPERADMIN') OR ($_SESSION['level']==  'VERIFIKASI' )) {
                            echo  " | &nbsp <a href='?p=profile&mod=edit&id=$a_user[0]&show=ubah'><i class='fa fa-pencil'></i></a> &nbsp | &nbsp
                                   <a href='?p=profile&mod=aktif&id=$a_user[0]' class='fa fa-check'></a> &nbsp | &nbsp
                                   <a href='?p=profile&mod=nonaktif&id=$a_user[0]' class='fa fa-minus-square'></a> &nbsp | &nbsp
                                   <a href='?p=profile&mod=del&id=$a_user[0]'><i class='fa fa-trash red Bigger-150' ></i></a></td>";
                            } else {
                              # code...
                            }    
                            "</td>
                            </tr>";        
                    }
                  }
                  echo "</table>";
                  if ($mode_form == "edit") {
                     $display = "";
                     $q_edit_user = mysql_query("SELECT * FROM t_reses WHERE id_reses = '$id_reses'");
                     $a_edit_user = mysql_fetch_array($q_edit_user);
                     $p_noid       = $a_edit_user[0];            
                     $p_nm_reses   = $a_edit_user[1];
                     $p_thn_reses   = $a_edit_user[2];
                     $p_tgl_reses  = $a_edit_user[3];
                     $p_kec_reses  = $a_edit_user[4];                                                   
                     $view = "Edit";            
                  } else if ($mode_form == "tambah") {
                    $display       = "";
                    $p_noid        = "";            
                     $p_nm_reses   = "";
                     $p_thn_reses  = "";
                     $p_tgl_reses  = "";
                     $p_kec_reses  = "";
                    $view           = "Tambah";
                  } 
                  else {
                    $display = "style='display: none'";
                  }
                ?> 
                <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)" <?php echo $display;?>>                
                  <h4 class="mb"><i class="fa fa-angle-right">&nbsp Form Update Data</i> </h4>
                  <div class="form-group" hidden="" > 
                    <label class="col-sm-2 col-sm-2 control-label">ID</label>
                    <div class="col-sm-2">
                      <input type="hidden" name="id_reses" value="<?php echo $p_id_reses; ?>">
                    </div>
                  </div>
                  <div class="form-group"> 
                    <label class="col-sm-2 col-sm-2 control-label">Nama Reses</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" name="nm_reses"  value="<?php echo $p_nm_reses; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 col-sm-2 control-label">Tahun Reses</label>
                    <div class="col-sm-2">
                        <?php cCmbtahun('thn_reses', $p_thn_reses); ?> 
                    </div>
                  </div>                                       
                  <div class="form-group"> 
                    <label class="col-sm-2 col-sm-2 control-label">Tanggal Reses</label>
                    <div class="col-md-3 col-xs-11">
                      <input class="form-control form-control-inline input-medium default-date-picker" size="16" type="text" name ="tgl_reses" value="<?php  echo $p_tgl_reses;?>">     
                    </div>                    
                      <span class="help-block">Pilih Tanggal</span>
                  </div>                
                  <div class="form-group"> 
                    <label class="col-sm-2 col-sm-2 control-label">Kecamatan</label>
                    <div class="col-sm-4">
                      <?php cmbDB('id_kec','kecamatan','id_kec','nama_kec', $p_kec_reses); ?>
                      <input type="hidden" name="id_dprd" value="<?php echo $p_id_dprd = $_SESSION['id_user']; ?>">
                      <input type="hidden" name="status" value="<?php echo $p_status ='Y' ; ?>">
                    </div>
                  </div> <br>
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
          </div>
  		  </section>
      </section>
    </section>
  <script src="show.js"></script>
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
  </body>
</html>
<?php } ?>
 