<?php
session_start();
include "koneksi/fungsi.php";
include "koneksi/koneksi.php";
include "aside.php";
include 'head.php'; 

$mode_form      = isset($_GET['mod']) ? $_GET['mod'] : "";
$p_tombol       = isset($_POST['kirim_usulan']) ? $_POST['kirim_usulan'] : "";
$display        = "style='display: none'";
$id_usulan      = isset($_GET['id']) ? $_GET['id'] : "";
$p_kec_reses    = isset($_POST['kec_reses']) ? $_POST['kec_reses']:"";
$p_id_usulan    = isset($_POST['id_usulan']) ? $_POST['id_usulan']:"";
$p_id_kecamatan = isset($_POST['kec'])? $_POST['kec']:"";
$p_id_desa      = isset($_POST['nm_desa'])? $_POST['nm_desa']:"";
$p_usulan_kegiatan = isset($_POST['usulan'])? $_POST['usulan']:"";
$p_satuan          = isset($_POST['satuan'])? $_POST['satuan']:"";
$p_vol             = isset($_POST['vol'])? $_POST['vol']:"";
$p_id_bidang       = isset($_POST['id_bidang'])? $_POST['id_bidang']:"";
$p_detail_lokasi   = isset($_POST['detail_lokasi'])? $_POST['detail_lokasi']:"";
$p_latitude        = isset($_POST['latitude'])? $_POST['latitude']:"";
$p_long_latitude   = isset($_POST['long_latitude'])? $_POST['long_latitude']:"";
$p_id_dprd         = isset($_POST['id_dprd'])? $_POST['id_dprd']:"";
$p_status          = isset($_POST['status'])? $_POST['status']:"";
$p_submit          = "TAMBAH";
if ($p_tombol == "TAMBAH") {
  $tambahusulan = "INSERT INTO t_rekapusulan (id_usulan, kec_reses, id_kec, id_desa, usulan, vol, satuan, id_bidang, detail_lokasi, latitude, long_latitude, id_dprd, status) VALUES (
                  '',
                  '$p_kec_reses',
                  '$p_id_kecamatan',
                  '$p_id_desa',
                  '$p_usulan_kegiatan',
                  '$p_vol',
                  '$p_satuan',
                  '$p_id_bidang',
                  '$p_detail_lokasi',
                  '$p_latitude',
                  '$p_long_latitude',
                  '$p_id_dprd',
                  '$p_status')";
  $Qtambah = mysql_query($tambahusulan);
  //echo $tambahusulan;
  if ($Qtambah) {
    echo  '<script>
       alert("Data Berhasil Ditambahkan");
       window.location=("8_rekapusulan.php")      
        </script>';
} else {
        echo '<scritp type="text/javascript">
       alert("Data Gagal Di Ditambahkan");
        </script>';
            }
}
else if ($p_tombol =="EDIT") {
  $q_update = mysql_query("UPDATE t_rekapusulan SET 
                        kec_reses     = '$p_kec_reses',
                        id_kec        = '$p_id_kecamatan',
                        id_desa       = '$p_id_desa',
                        usulan        = '$p_usulan_kegiatan',
                        vol           = '$p_vol',
                        satuan        = '$p_satuan',
                        id_bidang     = '$p_id_bidang',
                        detail_lokasi = '$p_detail_lokasi',
                        latitude      = '$p_latitude',
                        long_latitude = '$p_long_latitude'                        
                        WHERE id_usulan = '$p_id_usulan' ");
  if ($q_update) {
    echo  '<script>
       alert("Data Berhasil DiUpdate");
       window.location=("8_rekapusulan.php")
        </script>';
  } else {
    echo '<script>
       alert("Data Gagal Di Update")
       onclick=self.history.back()
        </script>';
  }
}
if ($mode_form == "add") {
  # code...
}
else if ($mode_form == "edit") {
$q_data_edit = mysql_query("SELECT * FROM t_rekapusulan WHERE id_usulan ='$id_usulan' ");
$a_data_edit = mysql_fetch_array($q_data_edit);
$display     = "";  
$p_id_usulan       = $a_data_edit[0];
$p_kec_reses      = $a_data_edit[1];
$p_id_kecamatan    = $a_data_edit[2];
$p_id_desa         = $a_data_edit[3];
$p_usulan_kegiatan = $a_data_edit[4];
$p_satuan          = $a_data_edit[5];
$p_vol             = $a_data_edit[6];
$p_id_bidang       = $a_data_edit[7];
$p_detail_lokasi   = $a_data_edit[8];
$p_latitude        = $a_data_edit[9];
$p_long_latitude   = $a_data_edit[10];
$p_id_dprd         = $a_data_edit[11];
$p_status          = $a_data_edit[12];
$p_submit          = "EDIT";
$view              = "EDIT";
} else {
  $display = "style='display: none'";
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html>
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
      <section class="wrapper">
         <h3><i class="fa fa-angle-right">&nbsp Usulan Kegiatan</i></h3>         
            <div class="form-panel"><h4 class="mb">
              <form action ="" name="usulankegiatan" class="form-horizontal style-form" method="POST" onSubmit="return validasi(this) ">
                <input type="hidden" name="id_usulan" value="<?php echo $p_id_usulan; ?>">
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Pilih Nama Reses</label>
                  <div class="col-sm-3">
                     <!-- <!?php cmbKec ("kec_reses", "t_reses", "id_reses", "id_kec", $p_kec_reses); ?> -->
                    <select name="kec_reses" class="form-control">
                      <option value="" selected="selected">-</option>
                      <?php 
                        $q_reses   = mysql_query("SELECT * FROM t_reses ORDER BY tgl_reses ASC") or die (mysql_error());
                        while ($data = mysql_fetch_array($q_reses)) {
                          echo "<option value='" .$data['id_reses']."'>".getkecamatan($data['id_kec'])." </option>";
                        } 
                      ?>
                    </select>
                    <br>
                </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Pilih Kecamatan</label>
                  <div class="col-sm-3">
                     <!-- <!?php cmbDB ("kec", "kecamatan", "id_kec", "nama_kec", $p_id_kecamatan); ?> -->
                    <select name="kec"  class="form-control" onChange="showDesa()">
                      <option value="" selected="selected">-</option>
                      <?php
                      $q_reses   = mysql_query("SELECT * FROM kecamatan ORDER BY id_kec  ASC") or die (mysql_error());
                      while ($data = mysql_fetch_array($q_reses)) {
                        echo "<option value='" .$data['id_kec']."'>".$data['nama_kec']." </option>";
                      }
                      ?>
                    </select>
                    <br>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Pilih Desa/Kelurahan</label>
                  <div class="col-sm-3">
                    <select name="nm_desa"  class="form-control" id="nama">
                      <option value="">Pilih Nama Desa</option>
                    
                     </select>
                      
                  </div>
                </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Pokok Pikiran</label>
                <div class="col-md-6 col-xs-11">
                  <input type="text" class="form-control" name="usulan" value="<?php echo $p_usulan_kegiatan; ?>">
              <br>                 
                </div>                           
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Volume </label>
                <div class="col-md-2 col-xs-2">
                  <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="vol" value="<?php echo $p_vol; ?>">
              <br>                 
                </div>   
                <label class="col-sm-1 col-sm-1 control-label">Satuan</label>
                <div class="col-md-2 col-xs-2">
                <input type="text"  class="form-control" name="satuan" value="<?php echo $p_satuan; ?>">
              <br>                 
                </div>  
              </div>
              <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Pilih Bidang Pelayanan</label>
                <div class="col-sm-3">
                  <?php cmbDB ("id_bidang", "bidang", "id_bidang", "nama_bidang", $p_id_bidang); ?>
              <br>
                </div>
              </div>
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Detail Lokasi</label>
                  <div class="col-sm-5">
                    <textarea class="form-control " name="detail_lokasi" required> <?php echo "$p_detail_lokasi"; ?></textarea>
                    <!--?php CInput ("text", "250","", "detail_lokasi", $p_detail_lokasi); ?-->
                  </div>
              </div>
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">Lokasi Maps</label>
              <div class="panel-body">
              <div id="map" style="width:100%;height:380px;"></div>
              </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
                <div class="col-sm-5">
                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="latitude" id="lat" value="<?php echo $p_latitude; ?>">
                    <!--?php CInput("text", "60", "lat", "latitude", $p_latitude); ?-->
                </div>
            </div>
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
                  <div class="col-sm-5">
                    <input type="text" onkeypress="return hanyaAngka(event)" class="form-control" name="long_latitude" id="lng" value="<?php echo $p_long_latitude; ?>">
                    <!--?php CInput ("text",  "200", "lng", "long_latitude", $p_long_latitude); ?-->
                  </div>
                  <input type="hidden" name="status" value="<?php echo $p_status = "BELUM"; ?>">
                  <input type="hidden" name="id_dprd" value="<?php echo $p_id_dprd = "123234"; ?>">
            </div>
                <button class="btn btn-primary" type="submit" name="kirim_usulan" value="<?php echo $view ?>">Simpan</button> 
                <input  type="button" class="btn btn-primary" value="Reset"  onclick=self.history.back()>
              </form>
            </div>       
       </section> 
    </section>
    <?php include 'footer.php'; ?>
    </section>
        <!-- modal -->
        <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Data Sukses Ditambahkan ?</h4>
              </div>              
              <div class="modal-footer">
                <button class="btn btn-theme" type="button" value="LANJUT" onclick=location.href="6.usulankegiatan.php"></button>
              </div>
            </div>
          </div>
        </div>        
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/weather.jpg", {
      speed: 500
    });
  </script>
  <!--script for this page-->
  <!--Google Map-->
  <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry&v=3.7"></script>
  <script src="lib/google-maps/maplace.js"></script>
  <script src="http://maps.google.com/maps/api/js"></script>
  <script type="text/javascript">
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

      function convert_latlng(latLng) {
     // membuat geocoder
         var geocoder = new google.maps.Geocoder();
         geocoder.geocode(latLng,  function(r) {
          if (r && r.length > 0) {
          document.getElementById('lat').innerHTML = r[0].formatted_address;
          } else {
            document.getElementById('lng').innerHTML = 'Alamat tidak di temukan di lokasi !!';
          }
        });
      }
      google.maps.event.addDomListener(window, 'load', init);
    /*  var map; 
      var geocoder; 
      var address; 
      function initialize() { 
        map = new google.maps.Map(document.getElementById("map")); 
        map.setCenter(new GLatLng(-8.389266879277888,123.56150845371098), 15); 
        map.addControl(new GLargeMapControl); 
        GEvent.addListener(map, "click", getAddress); 
        geocoder = new GClientGeocoder(); 
      }
      function getAddress(overlay, latlng) { 
        if (latlng != null) { 
          address = latlng; geocoder.getLocations(latlng, showAddress); 
        } 
      }
      function showAddress(response) { 
        map.clearOverlays(); 
        if (!response || response.Status.code != 200) { 
          alert("Status Code:" + response.Status.code); 
        } else { 
          place = response.Placemark[0];
          point = new GLatLng(place.Point.coordinates[1], place.Point.coordinates[0]); 
          marker = new GMarker(point); map.addOverlay(marker); 
          marker.openInfoWindowHtml( '<b>orig latlng:</b>' + response.name + '<br/>' + '<b>latlng:</b>' + place.Point.coordinates[1] + "," +place.Point.coordinates[0] + '<br>' + '<b>Status Code:</b>' + response.Status.code + '<br>' + '<b>Status Request:</b>' + response.Status.request + '<br>' + '<b>Address:</b>' + place.address + '<br>' + '<b>Accuracy:</b>' + place.AddressDetails.Accuracy + '<br>' + '<b>Country code:</b> ' + place.AddressDetails.Country.CountryNameCode); 
        } 
      }*/
  </script>
  <script type="text/javascript">
     function filDesa(str) {
      if (str == "") {
        document.getElementById("nama_desa").innerHTML = "";
        return;
      } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("nama_desa").innerHTML = this.responseText;
          }
        };
        xmlhttp.open("GET", "loaddesa.php?q=" + str, true);
        xmlhttp.send();
      }  
  </script>
  <script type="text/javascript">
    function loaddata(query='') {
      $.ajax({
        url:"loaddesa.php",
        method:"POST",
        data: {query:query},
        success:function (data) {
          $('body').html.(data);
        }
      })
    }
  </script>
  <script type="text/javascript">
    function  showDesa() {
      <?php
      $data = "SELECT * FROM kecamatan ORDER BY id_kec ASC";
      $hasil = mysql_query($data);
      while ($data = mysql_fetch_array($hasil)){
        $kec = $data['id_kec'];
    // membuat IF untuk masing-masing desa
      echo "if (document.usulankegiatan.kec.value == \"".$kec."\")";
      echo "{";
    // membuat option kota untuk masing-masing desa
        $query2 = "SELECT * FROM desa WHERE id_kec = '$kec' ORDER BY id_desa ASC";
        $hasil2 = mysql_query($query2);
        $content = "document.getElementById('nama').innerHTML = \"";
      while ($data2 = mysql_fetch_array($hasil2)){
        $content .= "<option value='".$data2['id_desa']."'>".$data2['nama_desa']."</option>";
      }
      $content .= "\"";
      echo $content;
      echo "}\n";
      }
      ?>
    }
  </script>
  <script language="javascript">
    function validasi(form){
      if (form.kec_reses.value == "--"){
        alert("Anda Mengisi KTP.");
        form.kec_reses.focus();
        return (false);
      }    
      if (form.kec.value == "--"){
        alert("Nama Anda Kosong.");
        form.kec.focus();
        return (false);
      }
    if (form.desa.value == "--"){
        alert("Tempat Lahir Anda Kosing!");
        form.desa.focus();
        return (false);
      }
      if (form.usulan.value == ""){
        alert("Isi Tanggal Lahir Anda!");
        form.usulan.focus();
        return (false);
      }
      if (form.vol.value == ""){
        alert("Jenis Kelamin Belum Dipilih");
        form.vol.focus();
        return (false);
      }
      if (form.satuan.value == ""){
        alert("Alamat Belum Di Isi!");
        form.satuan.focus();
        return (false);
      }
      if (form.id_bidang.value == ""){
      alert("Isi Email Anda!");
        form.id_bidang.focus();
        return (false);
      }
      if (form.detail_lokasi.value == ""){
      alert("No Telpon Belum di Isi!");
        form.detail_lokasi.focus();
        return (false);
      }
      if (form.latitude.value == "--"){
      alert("Fraksi Belum Dipilih!");
        form.latitude.focus();
        return (false);
      }
      if (form.long_latitude.value == "--"){
      alert("Dapil Belum Dipilih!");
        form.long_latitude.focus();
        return (false);
      }
       return (true);
     }
    </script>
</body>
  </html>
