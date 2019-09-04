<!DOCTYPE html>
<?php
// include "koneksi/fungsi.php";
include 'header.php';
include "aside.php";
include 'head.php';
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
  $id_fraksi = isset($_GET['id']) ? $_GET['id'] : NULL;
  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;  

    if ($mod == "del") {
      $q_delete_fraksi = mysql_query("DELETE FROM t_fraksi WHERE id_fraksi = '$id_fraksi'");
      if ($q_delete_fraksi) {
        echo "<script type='text/javascript'>
              alert('Data berhasil Di Hapus');
              window.location=('5_inputfraksi.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Data Gagal Di Hapus');
              window.location=('5_inputfraksi.php')
              </script>";
      }
    }
    $display        = "style='display: none'";  //default = formnya dihidden

    $tb_act         = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;        //ambil variabel POST value Tombol FOrm
    $p_id_fraksi     = isset($_POST['id_fraksi']) ? $_POST['id_fraksi'] : NULL;      //ambil variabel POST id_fraksi
    $p_nama_fraksi   = isset($_POST['nama_fraksi']) ? $_POST['nama_fraksi'] : NULL;    //ambil variabel POST nama_fraksi
    $p_singkatan    = isset($_POST['singkatan'])? $_POST['singkatan']:NULL;
    $p_status       = isset($_POST['stat'])? $POST['stat']: NULL;
    if ($tb_act == "Tambah") {
      $display = "style='display: none'";
      $q_tambah_fraksi = mysql_query("INSERT INTO t_fraksi VALUES ('', '$p_nama_fraksi', '$p_singkatan', '$p_status')");
      if ($q_tambah_fraksi) {
        echo "<script type='text/javascript'>
              alert('Data berhasil Di Tambah');
              window.location=('5_inputfraksi.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Reses Gagal Di Hapus');
              window.location=('5_inputfraksi.php')
              </script>";
      }
    } else if ($tb_act == "Edit") {
      $display = "style='display: none'";
      $q_edit_fraksi = mysql_query("UPDATE t_fraksi SET nama_fraksi = '$p_nama_fraksi',
                                                      singkatan  = '$p_singkatan',
                                                      status     = '$p_status'
                                                      WHERE id_fraksi = '$p_id_fraksi'");
      if ($q_edit_fraksi) {
        echo "<script type='text/javascript'>
              alert('Fraksi berhasil Diubah');
              window.location=('5_inputfraksi.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Fraksi Gagal Diubah');
              window.location=('5_inputfraksi.php')
              </script>";
      }
    } else {  
      $display = "style='display: none'";
    }

?>
<html lang="en">
<body>
  <section id="container"> 
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right">&nbsp Input partai Pengusung | Tambah Fraksi <a href="?p=5.inputfraksi&mod=add" class="fa fa-plus"></a></i> </h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mb">
          <div class="content-panel">
            <div class="adv-table">
              <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
              <thead> 
              <tr>
              <th width='5%'>Nomor</th>
              <th width='20%'>Nama Partai Pengusung</th>
              <th width='20%'>Singkatan Partai</th>
              <th width='25%'>Status</th>
              <th width='25%'>Control</th>
              </tr>
              </thead>
              <tbody>
              <?php   
              $q_fraksi  = mysql_query("SELECT * FROM t_fraksi ORDER BY id_fraksi ASC") or die (mysql_error());
              $j_data   = mysql_num_rows($q_fraksi);
              if ($j_data == 0) {
                echo "<tbody><tr><td class ='center hidden-phone' colspan='5'>-- Tidak Ada Data --</td></tr></tbody>";
                } else {
                  $no = 1;
                  while ($a_fraksi = mysql_fetch_array($q_fraksi)) {
                    echo "<tr>
                          <td class ='center hidden-phone'>$no</td>
                          <td>$a_fraksi[1]</td>
                          <td>$a_fraksi[2]</td>
                          <td>$a_fraksi[3]</td>
                          <td id='tengah'>
                          <a href='?p=5_inputfraksi&mod=edit&id=$a_fraksi[0]'>Edit</a> |
                          <a href='?p=5_inputfraksi&mod=del&id=$a_fraksi[0]')\">Delete</a></td>
                    </tr>";
                    $no++;
                  }
                }          
              ?>
              </tbody>
              </table>
             <?php
          // ================ DATA URL "mod" ( GET ) =====================//
              if ($mod == "edit") {
                $display = "";
                $q_edit_fraksi = mysql_query("SELECT * FROM t_fraksi WHERE id_fraksi = '$id_fraksi'");
                $a_edit_fraksi = mysql_fetch_array($q_edit_fraksi);
                
                $p_nama_fraksi = $a_edit_fraksi[1];
                $p_singkatan  = $a_edit_fraksi[2];
                $p_status     = $a_edit_fraksi[3];                
                $view = "Edit";                
                } else if ($mod == "add") {
                $display    = "";
                $p_id_fraksi   = "";
                $p_nama_fraksi = "";
                $p_singkatan  = "";
                $p_status     = "";
                $view       = "Tambah";
              } else {
                $display = "style='display: none'";
              }
          ?>              
              <form action="?p=5_inputfraksi" class="form-horizontal style-form" method="post" <?php echo $display;?>>
                <h4 class="mb"><i class="fa fa-angle-right">&nbsp Form Input Partai Pengusung</i> </h4>
                <div class="form-group" hidden="">
                  <label class="col-sm-2 col-sm-2 control-label">ID Fraksi</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="id_fraksi" readonly value="<?php echo $id_fraksi; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Nama Partai Pengusung</label>
                  <div class="col-sm-3">
                    <input type="text" class="form-control" name="nama_fraksi"  value="<?php echo $p_nama_fraksi; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Singkatan</label> 
                  <div class="col-sm-3">
                  <input type="text" class="form-control" name="singkatan"  value="<?php echo $p_singkatan; ?>">
                  </div>
                  </div>              
				        <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Status</label>
                  <div class="col-sm-2">
                   <input type="text" class="form-control" name="stat" value="<?php echo $p_status; ?>">
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
            </div>        
			</div>
		</div>
	</div>	
      </section>
      <!-- /wrapper -->
    </section>
  </section>
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

</body>
</html>
<?php } ?>
