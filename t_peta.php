<!DOCTYPE html>
<?php
include "koneksi/fungsi.php";
include "header.php";
include "aside.php";
include "footer.php";

  $id_peta  = isset($_GET['id']) ? $_GET['id'] : NULL;
  $mod      = isset($_GET['mod']) ? $_GET['mod'] : NULL;
    $display        = "style='display: none'";  //default = formnya dihidden
    $tb_act         = isset($_POST['tb_act']) ? $_POST['tb_act'] : NULL;        
    $p_id_peta      = isset($_POST['id_peta']) ? $_POST['id_peta'] : NULL; 
    $p_institusi    = isset($_POST['n_institusi'])? $_POST['n_institusi']: NULL;     
    $p_kabupaten    = isset($_POST['kabupaten']) ? $_POST['kabupaten'] : NULL;   
    $p_propinsi     = isset($_POST['propinsi'])? $_POST['propinsi']:NULL;
    $p_detail       = isset($_POST['detail'])? $_POST['detail']:NULL;
    $p_latitude       = isset($_POST['latitude'])? $_POST['latitude']: NULL;
    $p_long_latitude  = isset($_POST['long_latitude'])? $_POST['long_latitude']: NULL;

    if ($tb_act == "Tambah") {
      $display = "style='display: none'";
      $q_cek_ganda = mysql_query("SELECT * FROM t_peta WHERE n_institusi = '$p_institusi' AND latitude = '$p_latitude'");
      $j_cek_ganda = mysql_fetch_array($q_cek_ganda);
      
      if ($j_cek_ganda > 0) {
        echo '<script type="text/javascript">
              alert("Data Pernah Di Tambahkan Sebelumnya");
              </script>';
     } else
      $q_tambah_peta = mysql_query("INSERT INTO t_peta VALUES ('', '$p_institusi', '$p_kabupaten','$p_propinsi', '$p_detail', '$p_latitude', 'p_long_latitude')");
      if ($q_tambah_peta) {
        echo '<script type="text/javascript">
              alert("Data berhasil Di Tambahkan");
              </script>';
      } else {
        '<script type="text/javascript">
              alert("Data Gagal Di Tambahkan");
              </script>';
      }
    } else if ($tb_act == "Edit") {
      $display = "style='display: none'";
      $q_edit_peta = mysql_query("UPDATE t_peta SET  n_institusi = '$p_institusi',
                                                      kabupate n  = '$p_kabupaten',
                                                      propinsi    = '$p_propinsi',
                                                      detail      = '$p_detail',
                                                      latitude    = '$p_latitude',
                                                      long_latitude    = '$p_long_latitude'

                                                      WHERE id_peta = '$p_id_peta'");
      if ($q_edit_peta) {
        echo "<h4 class='alert_success'>Data berhasil diupdate<span id='close'>[<a href='#'>X</a>]</span></h4>";
      } else {
        echo "<h4 class='alert_error'>".mysql_error()."<span id='close'>[<a href='#'>X</a>]</span></h4>";
      }
    } else {
      $display = "style='display: none'";
    }
?>
<body>
  <section id="container">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Input Lokasi</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
           <div class="form-panel" >


    <?php
    // ================ DATA URL "mod" ( GET ) =====================//

    if ($mod == "edit") {
      $display = "";
      $q_edit_peta  = mysql_query("SELECT * FROM t_peta WHERE id_peta = '$id_peta'");
      $a_edit_peta = mysql_fetch_array($q_edit_peta);

      $p_institusi       = $a_edit_peta[1];
      $p_kabupaten       = $a_edit_peta[2];
      $p_propinsi        = $a_edit_peta[3];
      $p_detail          = $a_edit_peta[4];
      $p_latitude        = $a_edit_peta[5];
      $p_long_latitude   = $a_edit_peta[6];
      $view              = "Edit";

    } else if ($mod == "add") {
      $display           = "";
      $p_id_peta         = "";
      $p_institusi       = "";
      $p_kabupaten       = "";
      $p_propinsi        = "";
      $p_detail          = "";
      $p_latitude        = "";
      $p_long_latitude   = "";
      $view              = "Tambah";
    } else {
      $display = "style='display: none'";
    }

    ?>              
        <h4 class="mb"> <i class="fa fa-angle-right">  </i> Input Lokasi kerja</h4>
        <form class="form-horizontal style-form" method="post">  
        <div class="form-group">
          
        <label class="col-sm-2 col-sm-2 control-label">Nama Institut</label>
        <input type="hidden" name="id_peta" value="<?php echo $p_id_peta; ?>">
              <div class="col-sm-5">
              <?php CInput("text","n_institusi", "60", "","") ?>
              </div>
        </div> 
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Kabupaten</label>
              <div class="col-sm-5">
              <?php CInput("text","kabupaten", "60", "","") ?>
              </div>
        </div>    
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Propinsi</label>
              <div class="col-sm-5">
              <?php CInput("text","propinsi", "60", "","") ?>
              </div>
        </div>
       <!--div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Detail Lokasi</label>
            <div class="col-sm-5">
            <!?php CInputtext ("detail_lokasi", "") ?>
            </div>
        </div-->
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Lokasi Maps</label>
            <div class="panel-body">
            <div id="map" style="width:100%;height:380px;"></div>
            </div>
        </div> 

        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
              <div class="col-sm-5">
              <?php CInput("text","latitude", "60", "lat","") ?>
              </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
              <div class="col-sm-5">
              <?php CInput("text","long_latitude", "60", "lng","") ?>
              </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Detail Lokasi</label>
            <div class="col-sm-5">
            <input class="form-control" name = "detail" type="text" value="<?php echo $p_detail; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude ketika di klik</label>
            <div class="col-sm-5">
            <input class="form-control" id="latlongclicked" type="text" >
            </div>
        </div>
          <tr> <input type="submit" name="tb_act" class="btn btn-theme" value="Tambah"> </tr>
      </form>
      </div>
      </div>
    </div>
  </div>

			</div>
		</div>
	</div>
       </section>
      <!-- /wrapper -->
    </section>
    <script src="http://maps.google.com/maps/api/js"></script>
    <script>
function updateMarkerPosition(latLng) {
    document.getElementById('lat').value = [latLng.lat()];
    document.getElementById('lng').value = [latLng.lng()];
  }

    var myOptions = {
      zoom: 12,
        scaleControl: true,
      center:  new google.maps.LatLng(-8.389266879277888,123.56150845371098),
     // mapTypeId: google.maps.MapTypeId.ROADMAP
      mapTypeId: google.maps.MapTypeId.HYBRID
    };
    var map = new google.maps.Map(document.getElementById("map"),
        myOptions);
 
  var marker1 = new google.maps.Marker({
  position : new google.maps.LatLng(-8.389266879277888,123.56150845371098),
  title : 'lokasi',
  map : map,
  draggable : true
  });
  google.maps.event.addListener(marker1, 'drag', function() {
    updateMarkerPosition(marker1.getPosition());
  });

      </script>
  </section>
</body>

</html>
