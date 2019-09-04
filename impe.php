<!DOCTYPE html>
<?php
include "koneksi/fungsi.php";
include "header.php";
include "aside.php";

$mode_form  = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$display        = "style='display: none'";
$p_no       = isset($_POST['nom']) ? $_POST['nom'] : "";
$p_impe       = isset($_POST['impe']) ? $_POST['impe'] : "";
$p_thn_lahir  = isset($_POST['thn_lahir']) ? $_POST['thn_lahir'] : "";  
$p_bln_lahir  = isset($_POST['bln_lahir']) ? $_POST['bln_lahir'] : "";  
$p_tgl_lahir  = isset($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : "";  


if ($p_tombol == "DAFTAR") {

        $q_tambah_datadiri = "INSERT INTO imple VALUES (
             '$p_no',
			 '$p_impe')";
        $q_daftar = mysql_query($q_tambah_datadiri);
        echo $q_tambah_datadiri;
    if ($q_daftar) {
      echo '<script type="text/javascript">
              alert("Data berhasil Di Tambahkan");
               </script>';
      } else {
        echo '<script type="text/javascript">
              alert("Data Gagal Di Tambahkan");
              </script>';
              header("1_home.php");
      }
    }
?>
<script language="javascript">
function validasi(form){
  if (form.nom.value == ""){
    alert("Anda belum mengisikan nomor.");
    form.nom.focus();
    return (false);
  }
     
  if (form.impe.value == ""){
    alert("Anda belum mengisikan Tanggal Reses.");
    form.impe.focus();
    return (false);
  }
  return (true);
}
</script>
<body>
  <section id="container">
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Form Registrasi Anggota</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
            <div class="form-panel">
              <h4 class="mb"><i class="fa fa-angle-right"></i> Form Data Diri</h4>
              <form action="impe.php" method="post" class="form-horizontal style-form" onSubmit="return validasi(this);">
                  <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">nomor</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="nom"  value="<?php echo $p_no; ?>">
                    <!--?php cInput("name","40", "name", "no_ktp",  $p_no_ktp); ?-->
                  </div>
				  </div>
				  <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">nama</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="impe"  value="<?php echo $p_impe; ?>">
                    <?php cCmbTglLahir("d","m","y") ?>
                  </div>
                
                </div>
                </div-->
                <button type="submit" class="btn btn-theme" name="kirim_daftar" value="DAFTAR"> DAFTAR </button>

                <button type="submit" class="btn btn-theme">BATAL</button>
              </form>
            </div>
      </div>
    </div>
  </div>
       </section>
      <!-- /wrapper -->
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

</body>

</html>
