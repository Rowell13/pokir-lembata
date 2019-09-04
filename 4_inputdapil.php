<!DOCTYPE html>
<?php
//session_start();
//include "koneksi/fungsi.php";
//include 'koneksi/koneksi.php';
include "aside.php";
include 'head.php';
$sesi_id            = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : NULL;
$sesi_username      = isset($_SESSION['username']) ? $_SESSION['username'] : NULL;
$sesi_nama          = isset($_SESSION['namauser']) ? $_SESSION['namauser'] : NULL;
if (!isset($_SESSION['username'])) {
   echo "<script>document.location.href='1_home.php';</script>";
} else {
  $id_dapil = isset($_GET['id']) ? $_GET['id'] : NULL;
  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    if ($mod == "del") {
      $q_delete_dapil = mysql_query("DELETE FROM t_dapil WHERE id_dapil = '$id_dapil'");
      if ($q_delete_dapil) {
        echo "<script type='text/javascript'>
              alert('Data Berhasil Di Hapus');
              window.location=('4_inputdapil.php');
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Data Gagal Di Hapus');
              window.location=('4_inputdapil.php');
              </script>";
      }
    } 
    if ($mod == "aktif") {
      $q_delete_dapil = mysql_query("UPDATE t_dapil SET status = '$p_status' WHERE id_dapil = '$id_dapil'");
      if ($q_delete_dapil) {
        echo "<script type='text/javascript'>
              alert('Data Berhasil Di Hapus');
              window.location=('4_inputdapil.php');
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Data Gagal Di Hapus');
              window.location=('4_inputdapil.php');
              </script>";
      }
    }
    $display        = "style='display: none'";  //default = formnya dihidden

    $tb_act         = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;        //ambil variabel POST value Tombol FOrm
    $p_id_dapil     = isset($_POST['id_dapil']) ? $_POST['id_dapil'] : NULL;      //ambil variabel POST id_dapil
    $p_kd_dapil     = isset($_POST['kd_dapil']) ? $_POST['kd_dapil'] : NULL;
    $p_nama_dapil   = isset($_POST['nama_dapil']) ? $_POST['nama_dapil'] : NULL;    //ambil variabel POST nama_dapil
    $p_kec_dapil    = isset($_POST['kec_dapil'])? $_POST['kec_dapil']:NULL;
    $p_id_setwan    = isset($_POST['id_setwan'])? $_POST['id_setwan']:NULL;
    $p_ket          = isset($_POST['ket'])? $_POST['ket']:NULL;
    $p_status       = isset($_POST['stat'])? $POST['stat']: NULL;

    if ($tb_act == "Tambah") {
      $display = "style='display: none'";
      $q_tambah_dapil = mysql_query("INSERT INTO t_dapil VALUES ('', '$p_kd_dapil', '$p_nama_dapil', '$p_kec_dapil', '$p_id_setwan', '$p_ket', '$p_status')");
      //$q_tambah_dapil = mysql_query($q_tambah_dapil);
      echo $q_tambah_dapil;
      if ($q_tambah_dapil) {
        echo "<script type='text/javascript'>
              alert('Data Berhasil Ditambahkan');
              window.location=('4_inputdapil.php');
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Dapil Gagal Ditambahkan')             
              </script>";
      }
    } else if ($tb_act == "Edit") {
      $display = "style='display: none'";
      $q_edit_dapil = mysql_query("UPDATE t_dapil SET kd_dapil   = '$p_kd_dapil'
                                                      nama_dapil = '$p_nama_dapil',
                                                      kec_dapil  = '$p_kec_dapil',
                                                      id_admsetwan  = '$p_id_setwan',
                                                      ket        = '$p_ket'
                                                      --status     = '$p_status'
                                                      WHERE id_dapil = '$p_id_dapil'");
      echo $q_edit_dapil;
      if ($q_edit_dapil) {
        echo "<script type='text/javascript'>
              alert('Dapil berhasil Diubah');
              window.location=('4_inputdapil.php')
              </script>";
      } else {
        echo "<script type='text/javascript'>
              alert('Dapil Gagal diubah');              
              </script>";
      }
    } else {
      $display = "style='display: none'";
    }

?>
<!DOCTYPE html>
<html>
<body>
  <section id="container">
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"> Input Daerah Pemilihan | Tambah Dapil <a href="?p=4_inputdapil&mod=add" class="fa fa-plus"></a></i> </h3></h3>
        <div class="row mb">
          <div class="content-panel">
            <div class="adv-table">
            
    <!-- // ================ TAMPILKAN DATANYA =====================// -->
          <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
          <thead>
          <tr>
          <th width='15%'>Kode Dapil</th>
          <th width='20%'>Daerah Pemilihan</th>
          <th width='20%'>Kecematan Pemilihan</th>
          <th width='25%'>Keterangan</th>
          <th width='5%'>Status</th>
          <th width='20%'>Control</th>
          </tr>
          </thead>
          <tbody>
              <?php
              $q_dapil  = mysql_query("SELECT * FROM t_dapil ORDER BY id_dapil ASC") or die (mysql_error());
              $j_data   = mysql_num_rows($q_dapil);

              if ($j_data == 0) {
                echo "<tbody><td class ='center hidden-phone' colspan='6'>-- Tidak Ada Data --</td></tbody>";
              } else {
                $no = 1;
                while ($a_dapil = mysql_fetch_array($q_dapil)) {
                  echo "<tr>             
                        <td>$a_dapil[1]</td>
                        <td>$a_dapil[2]</td>
                        <td>$a_dapil[3]</td>
                        <td>$a_dapil[5]</td>
                        <td>$a_dapil[6]</td>
                        <td center=''>
                        <a href='?p=4_inputdapil&mod=edit&id=$a_dapil[0]'>Edit</a> |";
                        if ($a_dapil[6]=='Y') {
                          echo "<a href='?p=4_inputdapil&mod=aktif&id=$a_dapil[0]')\">Aktif</a></td>";
                        } else {
                          echo "<a href='?p=4_inputdapil&mod=aktif&id=$a_dapil[0]')\">Non Aktif</a></td>";
                        }              
                        echo "</tr>";
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
                $q_edit_dapil = mysql_query("SELECT * FROM t_dapil WHERE id_dapil = '$id_dapil'");
                $a_edit_dapil = mysql_fetch_array($q_edit_dapil);
                // $p_id_dapil   = $a_edit_dapil[0];
                $p_kd_dapil   = $a_edit_dapil[1];
                $p_nama_dapil = $a_edit_dapil[2];
                $p_kec_dapil  = $a_edit_dapil[3];
                //$p_id_setwan  = $a_edit_dapil[4];
                $p_ket        = $a_edit_dapil[5];
                $p_status     = $a_edit_dapil[6];
                $view = "Edit";
              } else if ($mod == "add") {
                $display    = "";
                $p_id_dapil   = "";
                $p_nama_dapil = "";
                $p_kec_dapil  = "";
                //$p_id_setwan  = ;
                $p_ket        = "";
                $p_status     = "";
                $view       = "Tambah";
              } else {
                $display = "style='display: none'";
              }
              ?>
              
              <form action="?p=4_inputdapil" class="form-horizontal style-form" method="post" <?php echo $display;?>>
                <h4 class="mb"> <i class="fa fa-angle-right">  Form Daerah Pemilihan</i></h4>
                <div class="form-group" hidden="true">
                  <label class="col-sm-2 col-sm-2 control-label">ID Dapil</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="id_dapil" readonly value="<?php echo $id_dapil; ?>" >
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kode Dapil</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="kd_dapil" value="<?php echo $p_kd_dapil; ?>" >
                  </div>
                </div>
                <div class="form-group" >
                  <label class="col-sm-2 col-sm-2 control-label">Nama Daerah Pemilihan</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="nama_dapil"  value="<?php echo $p_nama_dapil; ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Kecamatan Pemilihan</label>
                  <div class="col-sm-2">
                    <input type="text" class="form-control" name="kec_dapil"  value="<?php echo $p_kec_dapil; ?>">
                    <input type="hidden" class="form-control" name="id_setwan" hidden=""  value="<?php echo $_SESSION['id_user']; ?>">
                  </div>
                </div>
				        <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Keterangan</label>
                  <div class="col-sm-2">
                   <input type="text" class="form-control" name="ket"  value="<?php echo $p_ket; ?>">
                  </div>
                </div>
                <div class="form-group" hidden="">
                  <label class="col-sm-2 col-sm-2 control-label">Status</label>
                  <div class="col-sm-2">
                   <input type="text" class="form-control" name="stat" value="<?php echo $p_status="Y"; ?>">
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
