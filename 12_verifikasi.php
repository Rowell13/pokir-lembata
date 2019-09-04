<?php
//include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
include 'head.php';
include 'footer.php';
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

$p_id_verifikasi  = isset($_POST['id_verifikasi']) ? $_POST['id_verifikasi']:"";
$p_id_usulan      = isset($_POST['id_usulan']) ? $_POST['id_usulan'] : "";
$p_id_kirim       = isset($_POST['id_kirim']) ? $_POST['id_kirim'] : "";
$p_id_admin       = isset($_POST['id_admin']) ? $_POST['id_admin'] : "";
$p_tgl_kirim      = isset($_POST['tgl_verifikasi']) ? $_POST['tgl_verifikasi'] : "";
$p_status         = isset($_POST['status'])? $_POST['status'] :"";
$p_tombol         = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_submit         = "KIRIM";
$mod              = isset($_GET['mod']) ? $_GET['mod'] : NULL;
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
          <!-- <div id = rekapusulan-page> -->
        <!-- <form action="8_rekapusulan.php" method="post" class="form-horizontal style-form" enctype="multipart/form-data"> -->
        <h3><i class="fa fa-angle-right">Data Terverifikasi</i></h3>
        <div class="row mb">
          <div class="content-panel">
            <div class="adv-table">
    <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
    <thead> 
    <tr>
      <th class='hidden-phone'>No Verifikasi</th>
    <th class='hidden-phone'>usulan</th>
    <th class='hidden-phone'>Vol</th>
    <th class='hidden-phone'>Sat</th>
    <th hidden=""></th>
    <th hidden=""></th>
    <th hidden=""></th>
    <th class='hidden-phone'>Desa</th>
    <th class='hidden-phone'>Bidang</th>
    <th class='hidden-phone'>Lokasi Usulan</th>
    <th class='hidden-phone'>Waktu Verifikasi</th>  
    </tr>
    </thead>
    <tbody> 
    <tr>    
    <?php
    $q_usulan   = mysql_query("SELECT * FROM t_verifikasi INNER JOIN t_rekapusulan ON t_rekapusulan.id_usulan = t_verifikasi.id_usulan INNER JOIN t_dprd ON t_dprd.id_dprd = t_verifikasi.id_dprd ORDER BY tgl_verifikasi ") or die (mysql_error());
    $j_data     = mysql_num_rows($q_usulan);
    if ($j_data == 0) {
      echo "<tbody><td class ='center hidden-phone' colspan='9'>-- Tidak Ada Data --</td></tbody>";
    } 
    else {  
      while ($a_usulan = mysql_fetch_array($q_usulan)) {
        echo "              
        </td>            
        <td >$a_usulan[id_verifikasi]</td>
        <td >$a_usulan[usulan]</td>
        <td >$a_usulan[vol]</td>
        <td >$a_usulan[satuan]</td>
        <td hidden> $a_usulan[id_admin]</td>
        <td hidden>"; echo getdprd($a_usulan['id_dprd']); echo"</td>
        <td hidden>"; echo getreses($a_usulan['id_reses']); echo"</td>
        <td >"; echo getdesa($a_usulan['id_desa']); echo "</td>
        <td >"; echo getbidang($a_usulan['id_bidang']); echo "</td>
        <td>$a_usulan[detail_lokasi]</td> 
        <td>$a_usulan[tgl_verifikasi]</td>        
        ";
      }
    }
    ?>  
    </tr>
    </tbody>
    </table>"   
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
              <a href="8_rekapusulan.php"><button class="btn btn-theme" type="submit" name = "kirim_daftar" value="KIRIM" >Kirim</button></a>
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
                 <p> Apa Anda Yakin Akan Menghapus Data <?php echo "$a_usulan[5]"; ?>?</p>
                <span> *) Data yang terhapus tidak dapat dikembalikan!  </span>
            </div>
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
              <button class="btn btn-theme" type="submit" name = "mod" value="del" >Kirim</button>
            </div>
        </div>
      </div>
  </div>
  </div>
  </div>
  </div>    
  <!-- </form>
</div> -->
    </section>
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
      sOut += '<tr><td>Nama Reses</td><td>'+aData[7]+' </td></tr>';
      sOut += '<tr><td>Di Reses Oleh</td><td>'+aData[6]+'</td></tr>';
      sOut += '<tr><td>Di Verifikasi OLeh</td><td>'+aData[5]+'</td></tr>';
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