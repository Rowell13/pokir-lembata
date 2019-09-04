<!DOCTYPE html>
<?php 
include 'header.php';
include 'aside.php';
 ?>

<head>

<title>Get Lattitude and Longitude onmouseover and onclick in Google Map v2 - Programming - Google Maps</title>

<script src="http://maps.google.com/maps/api/js"></script>



</head>

<body>
  <section id="container">
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Input Daerah Pemilihan</h3>
        <!-- BASIC FORM ELELEMNTS -->
        <div class="row mt">
          <div class="col-lg-12">
           <div class="form-panel">
           	 <form class="form-horizontal style-form" method="get">  

		<div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Lokasi Maps</label>
            <div class="panel-body">
            <div id="mapa" style="width:100%;height:380px;"></div>
            </div>
        </div> 
		<div class="form-group">
          <label class="col-sm-2 col-sm-2 control-label">Latitude</label>
              <div class="col-sm-5">
               <input class="form-control" id="latspan" type="text" value="">
              </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
            <div class="col-sm-5">
            <input class="form-control" id="lngspan" type="text" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude</label>
            <div class="col-sm-5">
            <input class="form-control" id="latlong" type="text" value="">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 col-sm-2 control-label">Long Latitude ketika di klik</label>
            <div class="col-sm-5">
            <input class="form-control" id="latlongclicked" type="text" value="">
            </div>
        </div>


<script type="text/javascript">
if (GBrowserIsCompatible())
{
map = new GMap2(document.getElementById("mapa"));
map.addControl(new GLargeMapControl());
map.addControl(new GMapTypeControl(3));
map.setCenter( new GLatLng(-8.3566592, 123.4550784), 11,0);

GEvent.addListener(map,'mousemove',function(point)
{
document.getElementById('latspan').innerHTML = point.lat()
document.getElementById('lngspan').innerHTML = point.lng()
document.getElementById('latlong').innerHTML = point.lat() + ', ' + point.lng()
});

GEvent.addListener(map,'click',function(overlay,point)
{
document.getElementById('latlongclicked').value = point.lat() + ', ' + point.lng()

});
}
</script>

</div>
</div>
</div>
</form>
</section>
</section>
</section>
</body>
</html>