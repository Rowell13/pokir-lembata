<?php
include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
include 'head.php';
include 'footer.php';
$total_results    = mysql_result(mysql_query("SELECT COUNT(*) FROM t_rekapusulan"),0);
$p_id_kirim       = isset($_POST['id_kirim']) ? $_POST['id_kirim'] : "";
$p_id_usulan      = isset($_POST['id_usulan']) ? $_POST['id_usulan'] : "";
$p_tgl_kirim      = isset($_POST['tgl_kirim']) ? $_POST['tgl_kirim'] : "";
$p_status         = isset($_POST['status'])? $_POST['status'] :"";
$p_stat_verifikasi= isset($_POST['stat_verifikasi'])? $_POST['stat_verifikasi']:"";
$p_tombol         = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_submit         = "KIRIM";
$mod              = isset($_GET['mod']) ? $_GET['mod'] : NULL;
$id_del           = isset($_GET['id']) ? $_GET['id'] : NULL;

if ($mod == "del") {
  $q_del = mysql_query("DELETE FROM t_rekapusulan WHERE id_usulan = '$id_del'");

  if ($q_del) {
    echo "<script>
    alert('Data berhasil Dihapus');
    window.location=('8_rekapusulan.php');
     </script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus'). </script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <section id="container">
    <header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Tampilkan/Sembunyikan Menu"></div>
      </div>
      <!-- <a href="1_index.php" class="logo"><img src="image/pemkab.PNG"></a> -->
      <div class="nav notify-row" id="top_menu">
       <ul class="nav top-menu">         
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/infokom.png" width="35" height="35">
              </a>            
          </li>       
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/ntt.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="image/pemkab.png" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
          <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
              <img class="img-circle" src="" width="35" height="35">
              </a>            
          </li>
        </ul>      
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <?php echo '<li><a class="logout" href="1_logout.php">Logout</a></li>'; ?>     
        </ul>
      </div>
    </header> 
     <section id="main-content">
      <section class="wrapper">
          <!-- <form action="8_rekapusulan.php" method="post" class="form-horizontal style-form" enctype="multipart/form-data"> -->
            <h3><i class="fa fa-angle-right">Rekap Usulan | <a href="6.usulankegiatan.php?mod=add" class="ace-icon fa fa-plus-circle purple"></a></i></h3>       
            <div class="row mb">
              <div class="content-panel">
                <div class="adv-table">
                  <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
                  <thead> 
                    <tr>
                    <th class='hidden-phone'>CEK</th>
                    <th class='hidden-phone'>usulan</th>
                    <th class='hidden-phone'>Vol</th>
                    <th class='hidden-phone'>Sat</th>
                    
                    <th class='hidden-phone'>Desa</th>
                    <th class='hidden-phone'>Bidang</th>
                    <th class='hidden-phone'>Lokasi Usulan</th>
                    <th class='hidden-phone'>Status</th> 
                    <th class='hidden-phone'>Control</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $q_usulan   = mysql_query("SELECT * FROM t_rekapusulan ORDER BY id_usulan ASC") or die (mysql_error());
                    $j_data     = mysql_num_rows($q_usulan);
                    if ($j_data == 0) {
                      echo "<tbody><td class ='center hidden-phone' colspan='8'>-- Tidak Ada Data --</td></tbody>";
                    } 
                    else {  
                      while ($a_usulan = mysql_fetch_array($q_usulan)) {
                        echo "<tr>              
                              <td class='center'>";
                        if ($a_usulan[12]=='Terkirim') {
                        echo "Terkirim";
                          } else {
                            echo "<a href='8_rekapusulan.php#myModal' class='fa fa-check red bigger-150'></a>";
                          }        
                            echo "</td>            
                            <td >$a_usulan[4]</td>
                            <td >$a_usulan[5]</td>
                            <td >$a_usulan[6]</td>
                            
                            <td >"; echo getdesa($a_usulan[3]); echo "</td>
                            <td >"; echo getbidang($a_usulan[7]); echo "</td>
                            <td>$a_usulan[8]</td>
                            <td >$a_usulan[12] </td>         
                            <td><input type='hidden' name='id_kirim' value='"; echo $p_id_kirim; "'><br>
                            <input type='hidden' name='id_usulan' value='"; echo $p_id_usulan = $a_usulan[0]; "'>
                            <input type='hidden' name='tgl_kirim' value='"; echo $p_tgl_kirim = date('Y-m-d');"'>
                            <input type='hidden' name='status' value='"; echo $p_status = 'Belum'; "'>
                            <input type='hidden' name='stat_verifikasi' value='"; echo $p_stat_verifikasi = 'Belum Verifikasi'; "'></td>";
                            // if ($a_usulan[12]=='Terkirim') {
                            //   echo "<td class='center hidden-phone'>          
                            //   <a href='#' onclick=\"buka('6.usulankegiatan.php?id_usulan=$a_usulan[0]')\">Map</a></td>";
                            // } else {
                            //   echo "<td class='center hidden-phone'>
                              
                            //   </td>";
                            // }
                            echo "<td class='center'>";
                            if ($a_usulan[12]=='Terkirim') {
                            echo "<a href='#' onclick=\"buka('6.usulankegiatan.php?id_usulan=$a_usulan[0]')\">Map</a>";
                              } else {
                                echo "
                                <a href='6.usulankegiatan.php?mod=edit&id=$a_usulan[0]' class='ace-icon fa fa-pencil red bigger-150'></a> |
                              <a data-toggle='modal' href='8_rekapusulan.php#myModal' class='fa fa-check red bigger-150'> </a> |
                              <a href='?p=8_rekapusulan&mod=del&id=$a_usulan[0]' class='ace-icon fa fa-trash red bigger-150' onclick=\"return konfirmasi('Menghapus data $a_usulan[1]')\"></a></td>"; 
                              } 
                               if ($p_tombol == "KIRIM"){
                                $q_kirim_usulan = "INSERT INTO t_usulterkirim VALUES (
                                  '$p_id_kirim',
                                  '$p_id_usulan',
                                  '$p_tgl_kirim',
                                  '$p_status',
                                  '$p_stat_verifikasi')";
                                  $q_kirim = mysql_query($q_kirim_usulan);
                                  echo $q_kirim_usulan;    
                                  if ($q_kirim ) {
                                    echo '<scritp type="text/javascript">
                                    alert("Data Berhasil Ditambahkan");
                                    window.location=("8_rekapusulan.php")
                                    </script>';
                                    $q_update = mysql_query("UPDATE t_rekapusulan SET status = 'Terkirim' WHERE id_usulan = '$p_id_usulan' ");
                                    $q_daftar = mysql_query($q_update); 
                                    echo $q_update;
                                  } else {
                                     }
                               }       
                                // echo "</tr>";
                              }
                      }
                          // echo "</tr>";
                    ?>  
                  </tr>
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          <!-- </form> -->
    </section>
    <!--button data-toggle="modal" class="btn btn-theme" href="rekapusulan.php#myModal" >  </button-->
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                  <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Konfirmasi Pengiriman Usulan</h4>              
                        </div>
                        <div class="modal-body">
                             <p> Apa Anda Yakin Akan Mengirim Usulan?</p>
                            <span> *) Apabila Usulan Telah Dikirim, Anda tidak dapat melakukan perubahan lagi!! </span>
                        </div>
                        <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                          <a href="8_rekapusulan.php"><button data-dismiss="modal" class="btn btn-theme" type="submit" name = "kirim_daftar" value="KIRIM" >Kirim</button></a>
                        </div>
                    </div>
                  </div>
                </div>
                <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModalHapus" class="modal fade">
                    <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                              <h4 class="modal-title">Konfirmasi Penghapusan</h4>              
                          </div>
                          <div class="modal-body">
                               <p> Apa Anda Yakin Akan Menghapus Data ini</p>
                              <span> *) Data yang terhapus tidak dapat dikembalikan!  </span>
                          </div>
                          <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                            <button class="btn btn-theme" type="submit" name = "mod" value="del" >Kirim</button>
                          </div>
                      </div>
                    </div>
                </div>
    </section>
    <?php include 'footer.php'; ?>
  </section>
        <!-- /row -->
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
      sOut += '<tr><td>Rendering engine:</td><td>' + aData[1] + ' ' + aData[4] + '</td></tr>';
      sOut += '<tr><td>Link to source:</td><td>Could provide a link here</td></tr>';
      sOut += '<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>';
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