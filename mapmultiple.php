
	<?
	require_once("connection.php"); //including connection

	//read database >
	$opdracht = "SELECT * FROM babykaartjes"; 
	try {
       		$stmt = $db->prepare($opdracht); 
      		$result = $stmt->execute();
	} catch(PDOException $ex) {
      		// TODO: verwijder de 'die' op uiteindelijke website
        	die("FOUT: " . $ex->getMessage()); 
	}
	//fetch $rij
	$rij = $stmt->fetchAll();

	//display error
	echo mysql_error();

	?>
	<!--including google maps api-->
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

	<!--Maps script -->
	<script type="text/javascript">
		function initialize() {
			//setting start lat/lng
			var SchoolLatlng = new google.maps.LatLng(51.9274743,4.4782271);
			//custom icons
			var meisje = 'img/markerMeisje.png';
			var jongen = 'img/markerJongen.png';
			var school = 'img/markerGlr.png';
			//map options
			var mapOptions = {
				streetViewControl: false,
				panControl: false,
				zoomControl: false,
				mapTypeControl: false,
				overviewMapControl: false,
				zoom: 9,
				center: SchoolLatlng
			}
			//map show
			var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		
			//add "main" marker
			var marker = new google.maps.Marker({
				position: SchoolLatlng,
				map: map,
				icon: school,
				title: 'Grafisch Lyceum Rotterdam'	
			});
		
			<?
			//Marker script
			foreach($rij as $marker){ 
			//convert adress to lat/lng
				$adres = "$marker[adres]";
				$adres = str_replace(" ", "+", $adres);
				$url='http://maps.googleapis.com/maps/api/geocode/json?address='.$adres.'+Netherlands+NL&sensor=false';
				$source = file_get_contents($url);
				$obj = json_decode($source); 
				$lat = $obj->results[0]->geometry->location->lat;
				$long = $obj->results[0]->geometry->location->lng;
				$idco = $marker['id'];
			?>
				//set lat/long for each marker
				var getLatlng = new google.maps.LatLng(<? echo $lat ?>,<? echo $long ?>);
							
				//set content for infowindows in each marker
				var mijnkaart<? echo $marker['id'];?> = '<div id="content<? echo $marker['id'];?>" style="width: auto; overflow: hidden">'+
				'<div id="siteNotice<? echo $marker['id'];?>">'+
				'</div>'+
				'<p>&nbsp;</p>'+
				'<h1 id="firstHeading<? echo $marker['id'];?>" class="firstHeading<? echo $marker['id'];?>"><? echo $marker["roepnaam"]; ?></h1>'+
				'<div id="bodyContent<? echo $marker['id'];?>">'+
				'<p>Geboortedatum: <? echo $marker['geboortedatum']; ?></p>'+
				'<p>Quote: <? echo $marker['quote']; ?></p>'+
				'<p>&nbsp;</p>'+
				'</div>'+
				'</div>';
				
				//create infowindow
				var infowindow<? echo $marker['id'];?> = new google.maps.InfoWindow({
					content: mijnkaart<? echo $marker['id'];?>,
				});
				
				//create marker
				var marker<? echo $marker['id'];?> = new google.maps.Marker({
					position: getLatlng,
					map: map,
					icon: <? if($marker[geslacht] == "jongen"){ ?>jongen,<? }else{ ?>meisje,<? } ?>
					title: 'Baby Berichten'
				});
				
				//event listener for infowindow
				google.maps.event.addListener(marker<? echo $marker['id'];?>, 'click', function() {
					infowindow<? echo $marker['id'];?>.open(map,marker<? echo $marker['id'];?>);
				});
				
			<? } //end marker script?>	
		
		}
	//load the map	
	google.maps.event.addDomListener(window, 'load', initialize);
	
	</script>
