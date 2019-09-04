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
    $p_id_usulan    = isset($_POST['id_usulan'])? $POST['id_usulan']: NULL;     
    $p_detail       = isset($_POST['detail'])? $_POST['detail']:NULL;
     $p_latitude    = isset($_POST['latitude']) ? $_POST['latitude'] : NULL;   
    $p_ket     = isset($_POST['keterangan'])? $_POST['keterangan']:NULL;
    $p_long_latitude  = isset($_POST['long_latitude'])? $POST['long_latitude']: NULL;

    if ($tb_act == "Tambah") {
      $display = "style='display: none'";
      $q_tambah_peta = mysql_query("INSERT INTO t_peta VALUES ('', '$id_usulan', '$p_detail', '$p_latitude', 'p_long_latitude', $p_ket)");
      if ($q_tambah_peta) {
        echo "<script></script>";
      } else {
         echo "<script></script>";
      }
    } else if ($tb_act == "Edit") {
      $display = "style='display: none'";
      $q_edit_peta = mysql_query("UPDATE t_peta SET  detail_alamat = '$p_detail',
                                                      latitude  = '$p_latitude',
                                                      lng_latitude    = '$p_long_latitude',
                                                      detail      = '$p_ket',                                                      
                                                      WHERE id_peta = '$p_id_peta'");
      if ($q_edit_peta) {
        echo "<script></script>";
      } else {
        echo "<script></script>";
      }
    } else {
      $display = "style='display: none'";
    }
?>
<body onload="initialize()" >
  <section id="container">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Input Daerah Pemilihan</h3>
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
        <form class="form-horizontal style-form" method="get">  
        <div class="form-group">
        <label class="col-sm-2 col-sm-2 control-label">Nama Institut</label>
              <div class="col-sm-5">
              <?php CInput("text","kabupaten", "60", "","") ?>
              </div>
        </div> 
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Kabupaten</label>
              <div class="col-sm-5">
              <?php CInput("text","propinsi", "60", "","") ?>
              </div>
        </div>    
        <div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Propinsi</label>
              <div class="col-sm-5">
              <?php CInput("text","latitude", "60", "","") ?>
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
               <input class="form-control" id="lat" type="text">
              </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
            <div class="col-sm-5">
            <input class="form-control" id="lng" type="text" >
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
            <div class="col-sm-5">
            <input class="form-control" id="latlong" type="text">
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
  <textarea id="alamat" style="width: 795px; resize:none;" placeholder="Cari alamat"></textarea>
<br/>
<button onclick="cari_alamat()">CARI ALAMAT</button>
<br/>
<strong>Info Alamat :</strong><span id="info-alamat"></span>
<br/>
<strong>Latitude :</strong><span id="lat"></span>
<br/>
<strong>Longitude :</strong><span id="lng"></span>
</body>
       </section>
      <!-- /wrapper -->
    </section>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
function init(){
 var info_window = new google.maps.InfoWindow();
 // menentukan level zoom
 var zoom = 11;

 // menentukan latitude dan longitude
 var pos = new google.maps.LatLng(-8.389266879277888,123.56150845371098);

 // menentukan opsi peta yang akan di buat
 var options = {
  'center': pos,
  'zoom': zoom,
  'mapTypeId': google.maps.MapTypeId.ROADMAP
 };

 // membuat peta
 var map = new google.maps.Map(document.getElementById('map'), options);
 info_window = new google.maps.InfoWindow({
  'content': 'loading...'
 });
}
function cari_alamat(){
 // mengambil isi dari textarea dengan id alamat
 var alamat = document.getElementById('alamat').value;

 // membuat geocoder
 var geocoder = new google.maps.Geocoder();
 geocoder.geocode(
  {'address': alamat}, 
  function(results, status) { 
   if (status == google.maps.GeocoderStatus.OK) {
    var info_window = new google.maps.InfoWindow();

    // mendapatkan lokasi koordinat
    var geo = results[0].geometry.location;

    // set koordinat
    var pos = new google.maps.LatLng(geo.lat(),geo.lng());

    // update lokasi saat ini
    posisi_marker(pos);

    // rubah lokasi saat ini menjadi alamat
    convert_latlng(pos);

    // opsi peta yang akan di tampilkan
    var option = {
     center: pos,
     zoom: 16,
     mapTypeId:google.maps.MapTypeId.ROADMAP
    };

    // membuat peta
    var map = new google.maps.Map(document.getElementById('map'),option);
    info_window = new google.maps.InfoWindow({
     content: 'loading...'
    });

    // menambahkan marker pada peta
    // agar marker bisa di drag maka anda perlu menambahkan object draggable
    var marker1 = new google.maps.Marker({
    position : new google.maps.LatLng(-8.389266879277888,123.56150845371098),
    title : 'lokasi',
    map : map,
    draggable : true });
  
 
  google.maps.event.addListener(marker1, 'drag', function() {
    updateMarkerPosition(marker1.getPosition());
  });

    // menambahkan event click ketika marker di klik
    google.maps.event.addListener(marker, 'click', function () {
     info_window.setContent('<b>'+ this.title +'</b>');
     info_window.open(map, this);
    });
   } else {
    alert('Lokasi Tidak Ditemukan'); 
   } 
  }
 );
}

// menentukan posisi marker
function posisi_marker(pos) {
 // menampilkan latitude dan longitude pada id lat dan lng
 document.getElementById('lat').innerHTML = pos.lat();
 document.getElementById('lng').innerHTML = pos.lng();
}

// merubah geotag menjadi alamat
function convert_latlng(pos) {

 // membuat geocoder
 var geocoder = new google.maps.Geocoder();
 geocoder.geocode({'latLng': pos}, function(r) {

  if (r && r.length > 0) {
   document.getElementById('info-alamat').innerHTML = r[0].formatted_address;
  } else {
   document.getElementById('info-alamat').innerHTML = 'Alamat tidak di temukan di lokasi !!';
  }

 });
}
google.maps.event.addDomListener(window, 'load', init);
</script>


    <!--footer end-->
  </section>
</body>

</html>
