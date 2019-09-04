<!DOCTYPE html>
<?php 
include "koneksi/koneksi.php";
include 'koneksi/fungsi.php';
include 'head.php';
include "aside.php";

?>

<body>
<section id="container">
	<header class="header black-bg">
      <div class="sidebar-toggle-box">
        <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Tampilkan/Sembunyikan Menu"></div>
      </div>
      <a href="1_index.php" class="logo"><b>E<span>POKIR</span></b></a>
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
      <div>
        <p>
          &copy; E-Pokir. <strong> Kabupaten Lembata</strong>. Studio E-Goverment 
        </p> 
      </div>
      <div class="top-menu">
        <ul class="nav pull-right top-menu">
          <?php echo ' <li><a class="logout" href="1_logout.php">Logout</a></li>'; ?>
         
        </ul>
      </div>
  </header>
	<section id="main-content">
    <section class="wrapper"><h3><i class="fa fa-angle-right">&nbsp Profil</i> </h3>
      <div class="form-panel">
        <form action="" method="POST" class="form-horizontal style-form" enctype="multipart/form-data" onSubmit="return validasi(this)">
          <?php   
    // ================ TAMPILKAN DATANYA =====================//
    echo "<table border='2' class='table table-hover'><tr>
          <th width='10%'>NIP</th>
          <th width='20%'>Nama</th>
          <th width='15%'>Email</th>
          <th width='15%'>No. HP</th>
          <th width='20%'>User Name</th>
          <th width='20%'>Control</th>
          </tr>";
    $q_user  = mysql_query("SELECT * FROM t_skpd ORDER BY user_id ASC") or die (mysql_error());
    $j_data   = mysql_num_rows($q_user);

    if ($j_data == 0) {
      echo "<tr><td id='tengah' colspan='6'>-- Tidak Ada Data --</td></tr>";
    } else {      
      while ($a_user = mysql_fetch_array($q_user)) {
        echo "<tr>
              <td>$a_user[2]</td>
              <td>$a_user[3]</td>
              <td>$a_user[4]</td>
              <td>$a_user[5]</td>
              <td>$a_user[6]</td>
              <td id='tengah'><a href='?p=5.inputfraksi&mod=edit&id=$a_user[0]'>Ganti Password</a> </td>
              </tr>";        
      }
    }
    echo "</table>";
    ?>
        </form>
      </div>
		</section>
	</section>
	<?php include 'footer.php'; ?>
</section>
</body>

 