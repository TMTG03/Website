<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Simple markers</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
<?
$id = $_GET["id"];

//require_once("connection.php");
//$opdracht = "SELECT adres FROM babykaartjes WHERE id='$id'";
//$result = mysql_query($opdracht);
//$rij = mysql_fetch_array($result);
//$adres = "$rij[adres]";

$adres = "van brugstraat 27";

$adres = str_replace(" ", "+", $adres);

$url='http://maps.googleapis.com/maps/api/geocode/json?address='.$adres.'+Netherlands+NL&sensor=false';
$source = file_get_contents($url);
$obj = json_decode($source);
$lat = $obj->results[0]->geometry->location->lat;
$long = $obj->results[0]->geometry->location->lng;
?></br><?
echo $lat;
?></br><?
echo $long;
?></br><?
echo $url;
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function initialize() {
  var SchoolLatlng = new google.maps.LatLng(51.9274743,4.4782271);
  var getLatlng = new google.maps.LatLng(<? echo $lat ?>,<? echo $long ?>);
  var meisje = 'location of image';
  var jongen = 'location of image';
  var mapOptions = {
	streetViewControl: false,
	panControl: false,
	zoomControl: false,
	mapTypeControl: false,
	overviewMapControl: false,
    zoom: 14,
    center: myLatlng
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  var marker = new google.maps.Marker({
      position: SchoolLatlng,
      map: map,
      title: 'Hello World!'
	
  });
  
  var marker2 = new google.maps.Marker({
      position: getLatlng,
      map: map,
      title: 'Hello World!'
	  });
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>