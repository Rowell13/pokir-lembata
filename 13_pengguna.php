<?php
//include "koneksi/fungsi.php";
//include "koneksi/koneksi.php";
include "aside.php";
include 'head.php';

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

$total_results    = mysql_result(mysql_query("SELECT COUNT(*) FROM t_dprd"),0);
$mod              = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_id_kirim       = isset($_POST['id_kirim']) ? $_POST['id_kirim'] : "";
$p_id_ktp         = isset($_POST['id_dprd']) ? $_POST['id_dprd'] : "";
$p_tgl_kirim      = isset($_POST['tgl_kirim']) ? $_POST['tgl_kirim'] : "";
$p_status         = isset($_POST['status'])? $_POST['status'] :"";
$p_tombol         = isset($_POST['kirim_daftar']) ? $_POST['kirim_daftar'] : "";
$p_submit         = "KIRIM";
$id_del           = isset($_GET['id']) ? $_GET['id'] : NULL;

if ($mod == "del") {
  $q_del = mysql_query("DELETE FROM t_dprd WHERE id_dprd = '$id_del'");
  if ($q_del) {
    echo "<script>
    alert('Data berhasil Dihapus');
    window.location=('13_pengguna.php');
     </script>";
  } else {
    echo "<script>alert('Data Gagal Dihapus'). </script>";
  }
}

if ($mod == "aktif") {
    $p_status = 'Y';    
          $q_aktif = mysql_query("UPDATE t_dprd SET status = '$p_status' WHERE id_dprd = '$id_del' ");    
  if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Di Aktifkan');
    window.location=('13_pengguna.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Aktifkan'). </script>";
    }
  }
    
if ($mod == "nonaktif") {
    $p_status = 'N';    
          $q_aktif = mysql_query("UPDATE t_dprd SET status = '$p_status' WHERE id_dprd = '$id_del' ");    
    if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Di Non Aktifkan');
    window.location=('13_pengguna.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Non Aktifkan') </script>";
    }
  }

if ($mod == "aktifall") {
    $p_status = 'Y';
    foreach ($_POST['kode'] AS $id_del ) {
          $q_aktif = mysql_query("UPDATE t_dprd SET status = '$p_status' WHERE id_dprd = '$id_del' ");
    }
    if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Di Non Aktifkan');
    window.location=('13_pengguna.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Non Aktifkan'). </script>";
    }
  }

if ($mod == "nonaktifall") {
    $p_status = 'N';
    foreach ($_POST['kode'] AS $id_del ) {
          $q_aktif = mysql_query("UPDATE t_dprd SET status = '$p_status' WHERE id_dprd = '$id_del' ");
    }
    if ($q_aktif) {
      echo "<script>
    alert('Akun berhasil Di Non Aktifkan');
    window.location=('13_pengguna.php');
     </script>";
  } else {
    echo "<script>alert('Akun Gagal Di Non Aktifkan'). </script>";
    }
  }
  // if ($mod=="edit") {
  //   # code...
  // }
?>
<!DOCTYPE html>
<html lang="en">
<body>
  <section id="container">
    <section id="main-content">
      <section class="wrapper"><h3>Data Anggota DPRD (<?php echo $total_results; ?> Pendaftar) </h3>
        <!-- <div id = "pengguna-page"> -->
        <!-- <form action="p?11_pengguna.php" method="post" class="form-horizontal style-form" enctype="multipart/form-data">  -->   
        <div class="row mb">
          <div class="content-panel">          	
            <div class="adv-table">    
              <form method="POST" action="13_pengguna.php?aksi=cek" id="myForm">
                <table cellpadding='0' cellspacing='0' border='0' class='display table table-bordered' id='hidden-table-info'>
                  <thead> 
                  <tr>    
                  <th class='center hidden-phone'>Cek</th>
                  <th class='center hidden-phone' >KTP</th>
                  <th class='center hidden-phone'>NAMA</th>
                  <th class='center hidden-phone'>FRAKSI</th>
                  <th class='center hidden-phone'>DAPIL</th>
                  <th class='center hidden-phone'>Email</th>
                  <th class='center hidden-phone'>Telp</th>
                  <th class='center hidden-phone'>Status</th> 
                  <th class='center hidden-phone'>Control</th> 
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                  $q_data   	= mysql_query("SELECT * FROM t_dprd") or die (mysql_error());
                  $j_data     = mysql_num_rows($q_data);
                  if ($j_data == 0) {
                    echo "<tbody><td class ='center hidden-phone' colspan='9'>-- Tidak Ada Data --</td></tbody>";
                  } 
                  else {
                  $id=1;          
                  while ($a_data = mysql_fetch_array($q_data)) {
                    echo "
                    <tr id='warna$id'>   
                    <td class='center hidden-phone'><input type='checkbox' name='kode[]' id='kode$id' value='$a_data[0]' onclick='ubahwarna($id)'></td>     
                    <td class='hidden-phone'>$a_data[0]</td>
                    <td class='hidden-phone'>$a_data[1]</td>
                    <td class='center hidden-phone'>"; echo getfraksi($a_data[9]); echo "</td>
                    <td class='center hidden-phone'>"; echo getdapil($a_data[10]); echo "</td>
                    <td class='hidden-phone'>$a_data[6]</td>
                    <td class='hidden-phone'>$a_data[7]</td>        
                    <td class='hidden-phone'>$a_data[14]</td>    
                    <td class='hidden-phone'>
                    <a href='10_editanggota.php?mod=edit&id=$a_data[0]' class='ace-icon fa fa-pencil red bigger-150'></a> |
                    <a href='?p=13_pengguna.php&mod=del&id=$a_data[0]' class='ace-icon fa fa-trash red bigger-150' onclick=\"return konfirmasi('Menghapus data $a_data[1]')\"></a> |
                    <a href='?p=13_pengguna.php&mod=aktif&id=$a_data[0]' class='fa fa-check'></a> |
                    <a href='?p=13_pengguna.php&mod=nonaktif&id=$a_data[0]' class='fa fa-minus-square'></a></td>
                    </tr>"; 
                    $id++;         
                    }
                  ?>                               
                  </tbody>              
                </table>
                <?php 
                  $jumlah=$id-1;
                  echo "<input type='hidden' name='jumlah' id='jumlah' value='$jumlah'></Input>
                  <div class='tools'><input type='checkbox' id='ceksemua' onclick='seleksi()' ></input> | 
                  <span onclick='aktifsemua()' style='cursor:pointer;color:red;'><i class='fa fa-check'></i></span> | 
                  </div> ";
                  }
                ?>
              </form>
              <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Konfirmasi Aktifasi Pengguna</h4>              
                      </div>
                      <div class="modal-body">
                           <p> Apa Anda Yakin Akan Mengaktifkan Pengguna Dengan Nama <?php echo"" ?>?</p>
                          
                      </div>
                      <div class="modal-footer">
                        <button data-dismiss="modal" class="btn btn-default" type="button">Batal</button>
                        <a href="11_pengguna.php"><button class="btn btn-theme" type="submit" name = "kirim_daftar" value="KIRIM" >Kirim</button></a>
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
  <!-- </form> -->
      </section>
    </section>
    <?php include 'footer.php'; ?>
  </section>	
        <!-- /row -->
  <script type="text/javascript">
    /* Formating function for row details */
    // function fnFormatDetails(oTable, nTr) {
    //   var aData = oTable.fnGetData(nTr);
    //   var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    //   sOut += '<tr><td></td><td>' + aData[2] + ' ' + aData[3] + '</td></tr>';
    //   sOut += '<tr><td></td><td>Could provide a link here</td></tr>';
    //   sOut += '<tr><td></td><td>And any further details here (images etc)</td></tr>';
    //   sOut += '</table>';

    //   return sOut;
    // }

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
      function seleksi() {
        var
        jumlah = parseInt(document.getElementById('jumlah').value);
        nilai=document.getElementById("ceksemua").value;
        if (document.getElementById('ceksemua').checked==true) 
        {
          for (i=1;i<=jumlah;i++)
           {           
            kode="kode"+i;
            document.getElementById(kode).checked= true;
           }
        } 
        else if (document.getElementById('ceksemua').checked==false) 
        {
          for (i=1;i<=jumlah;i++)
           {            
            kode="kode"+i;
            document.getElementById(kode).checked= false;
           }
        }
      }

      function aktifsemua(){
        var        
        jumlah=parseInt(document.getElementById("jumlah").value);
        jumlah=0;
        //alert(jumlah);
        //jumlahx=parseInt(document.getElementById("jumlah").value);
        for (i=1;i<=jumlah;i++) {          
          kode="jumlah"+i;
          if (document.getElementById(kode).checked==true) {
            jumlah=1;

          } else {
            jumlah=jumlah;
          }
        } //alert(jumlahx);
        if (jumlah>0){
          tanya=confirm("Apakah Anda Yakin Mengaktifkan Semua Baris Data Yang Dipilih?");
          if (tanya==1) {
            document.getElementById("myForm").action="13_pengguna.php?mod=aktifall";
            document.getElementById("myForm").submit();
          }
        }
        else {
          alert("Silakan Memilih Data Terlebih Dahulu!");
        }
      }

       function ubahwarna(str) {
        var
        warna="warna"+str;
        kode="kode"+str;
        if (document.getElementById(kode).checked==true) {
          document.getElementById(warna).style="background:#ddd;";
        }
        else {
          document.getElementById(warna).style="none";
        }
       }
    </script>
</body>
</html>
<?php } ?>

<!--    // <label class='checkbox'>                
                //         <a class='btn btn-theme' data-toggle='modal' href='pengguna.php#myModalHapus'> NON AKTIF</a>
                //         <a class='btn btn-theme' data-toggle='modal' href='pengguna.php#myModal'> AKTIF</a>
                //         <span class='pull-right'>
                //         </span>
                //         </label>";
              //   $total_pages = ceil($total_results / $max);
                        //// <th class='hidden-phone' >Foto</th> <td class='hidden-phone'><img src= foto/$a_data[8] width='10%'> </td>
              //   echo "<center>";
              //   if($hal > 1){
              //   $prev = ($page-1);
              //   echo "<a class='paging' href=$_SERVER[PHP_SELF]?p=11_pengguna&hal=$prev></a>";
              //   }
              //   for($i = 1; $i <= $total_pages; $i++){
              //   if(($hal) == $i){
              //   echo "<span class='aktif'>$i</span>";
              //   } else {
              //   echo "<a class=\"fa fa-fast-forward\" href=$_SERVER[PHP_SELF]?p=11_pengguna&hal=$i>$i</a>";
              //   }
              // }
              //   if($hal < $total_pages){
              //   $next = ($page + 1);
              //   echo "<a class=\"fa fa-fast-forward\" href=$_SERVER[PHP_SELF]?p=11_pengguna&hal=$next></a>";
              //   }
              //   echo "</center>";

                // if ($p_tombol == "KIRIM") {
                //   $q_update = "UPDATE t_dprd  VALUES (
                //                     '$p_status')";
                //     $q_update = mysql_query($q_update_data);
                //     //echo $q_kirim_usulan;    
                
                //   //echo "Gagal";
                // }  -->
              
                 
              <!--button data-toggle="modal" class="btn btn-theme" href="rekapusulan.php#myModal" >  </button-->
              <!-- <input type="hidden" name="status" value="<!?php echo $p_status = "Y"; ?>"> -->