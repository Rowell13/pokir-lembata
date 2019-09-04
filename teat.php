<!DOCTYPE html>
<?php
include "koneksi/fungsi.php";

$p_tombol 	  = isset($_POST["kirim_daftar"]) ? $_POST["kirim_daftar"] : "";
$display      = "style='display: none'";
$p_no_ktp     = isset($_POST["no_ktp"]);
$p_nama       = isset($_POST["namaanggota"]) ? strtoupper($_POST["namaanggota"]) : "";
$p_tmp_lahir  = isset($_POST["tmp_lahir"]) ? $_POST["tmp_lahir"] : "";
$p_jk         = isset($_POST['jk']) ? $_POST['jk'] : "";
$p_alamat     = isset($_POST["alamat"]) ? $_POST["alamat"] : "";
$p_email      = isset($_POST["email"]) ? $_POST["email"] : "";
$p_notelp     = isset($_POST["notelp"]) ? $_POST["notelp"] : "";
$p_username   = isset($_POST["username"]) ? $_POST["username"] : "";
$p_password   = isset($_POST["password"]) ? $_POST["password"] : "";
$p_id_fraksi  = isset($_POST["fraksi"]) ? $_POST["fraksi"] : "";
$p_id_dapil   = isset($_POST["dapil"]) ? $_POST["dapil"] : "";
$p_tgl_daftar = isset($_POST["tgl_daftar"]) ? $_POST["tgl_daftar"] : "";
$p_status     = isset($_POST["status"]) ? $_POST["status"] : "";
$p_submit     = "DAFTAR";

 if ($p_tombol == "Tambah") {
          $q_tambah_datadiri = "INSERT INTO t_datadiridprd VALUES (
               '$p_no_ktp',
               '$p_nama',
               '$p_tmp_lahir', 
               '$p_jk',
               '$p_alamat',
               '$p_email',
               '$p_notelp',
               '$p_id_fraksi',
               '$p_id_dapil',       
               '$p_username',
               '$p_password',
               '$p_tgl_daftar',
               '$p_status')";
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
        } 
      }
?>
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
              <form class="form-horizontal style-form" method="post">
                  <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nomor KTP</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="no_ktp"  value="<?php echo $p_no_ktp; ?>">
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
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Tempat Lahir</label>
                  <div class="col-md-3 col-xs-11">
                    <input type="text" class="form-control" name="tmp_lahir" value="<?php echo $p_tmp_lahir; ?>">
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
                    <textarea class="form-control "  name="alamat" value= "<?php echo "$p_alamat"; ?>"> </textarea>
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
                     <!--?php cCmbDapil($p_id_dapil); ?-->
                     <?php cmbDB ("dapil", "t_dapil", "id_dapil", "nama_dapil", $p_id_dapil); ?>
                <br>

                  </div>
                  <input type="hidden" name="tgl_daftar" value="<?php echo $p_tgl_daftar = date('Y-m-d'); ?>">
                  <input type="hidden" name="status" value="<?php echo $p_status = "N"; ?>">
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">User Name</label>
                  <div class="col-sm-3">
                    <?php cInput("text", "username", "30","username", $p_username); ?>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Password</label>
                  <div class="col-sm-3">
                    <?php cInput("password","password", "20","password", $p_password); ?>
                  </div>
                </div>
                </div-->
                <button type="submit" class="btn btn-theme" name = "kirim_daftar" value="Tambah" > DAFTAR </button>
                <button type="submit" class="btn btn-theme">BATAL</button>
              </form>
            </div>

      </div>
    </div>
  </div>
       </section>
    </section>
  </section>
</body>
