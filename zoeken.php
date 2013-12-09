<? require_once('connection.php');

if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
}
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Info :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/switcher.js"></script>
<script src="scripts/jquery.scrollTo-1.4.3.1-min.js"></script>
<script src="scripts/script.js"></script>
<script>
function initialize() {
	var SchoolLatlng = new google.maps.LatLng(51.9274743,4.4782271);
	var getLatlng = new google.maps.LatLng(<? echo $lat ?>,<? echo $long ?>);
    var meisje = 'img/markerMeisje.png';
    var jongen = 'img/markerJongen.png';
	var mapOptions = {
		streetViewControl: false,
		scrollwheel: false,
		panControl: false,
		zoomControl: false,
		mapTypeControl: false,
		overviewMapControl: false,
		zoom: 13,
		center: getLatlng
	}
	var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	
	var marker2 = new google.maps.Marker({
		position: getLatlng,
		map: map,
	    icon: <? if($rij[geslacht] == "jongen"){ ?>jongen,<? }else{ ?>meisje,<? } ?>
		title: 'marker'
	});
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>
</head>

<body>
<div id="container">
  <div id="headercolor">
    <div id="container_breedte">
      <header id="logo_plek"><a href="index.php" id="logo"><img width="333" src="img/logo.png" alt="" /></a></header>
      <nav id="menu">
        <ul>
          <li class='active'><a href='index.php'><span>Home</span></a></li>
          <li class='has-sub'><a href='#'><span>Babykaartjes</span></a>
            <ul>
              <li class='has-sub'><a href='#'><span>tekst</span></a>
                <ul>
                  <li><a href='#'><span>tekst</span></a></li>
                  <li class='last'><a href='#'><span>tekst</span></a></li>
                </ul>
              </li>
              <li class='has-sub'><a href='#'><span>tekst</span></a>
                <ul>
                  <li><a href='#'><span>tekst</span></a></li>
                  <li class='last'><a href='#'><span>tekst</span></a></li>
                </ul>
              </li>
            </ul>
          </li>
          <li><a href='info.php'><span>Informatie</span></a></li>
          <? if(empty($_SESSION['user'])) { ?>
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <? } else { ?>
          <li><a href='ingelogd.php'><span>Account</span></a></li>
          <? } ?>
          <li class='last'><a href='contact.php'><span>Contact</span></a></li>
        </ul>
        <div id="styleswitchen">
          <div id="styleswitchvak1"><a href="#" onclick="setActiveStyleSheet('default'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
          <div id="styleswitchvak2"><a href="#" onclick="setActiveStyleSheet('roze'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
          <div id="styleswitchvak3"><a href="#" onclick="setActiveStyleSheet('blauwroze'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
        </div>
      </nav>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="tussen_balk"></div>
  <div id="titelbalk">Informatie</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content">
  	<br/>
 	<br/>
    <?
	if((isset($_POST["zoekverzend"]))) 
	{
		
		$naam = $_POST['naam'];
		$provincie = $_POST['provincie'];
		$geboortedatum = $_POST['datum'];
		$geslacht = $_POST['geslacht'];
		
		if (!$provincie == "")
		{
			$provinciecheck = " provincie LIKE '%".$provincie."%' OR " . "";		
		}
			
		if (!$naam == "")
		{
			$naamcheck = " naam LIKE '%".$naam."%' OR " . "";	
		}
		
		if (!$geboortedatum == "")
		{
			$dobcheck = " geboortedatum LIKE '%".$geboortedatum."%' OR " . "";	
		}
		
		if (!$geslacht == "")
		{
			$geslachtcheck = " geslacht LIKE '%".$geslacht."%' OR " . "";	
		}
		
		$opdracht = "SELECT * FROM babykaartjes WHERE" . $naamcheck . $provinciecheck . $dobcheck . $geslachtcheck;

		$opdracht = substr($opdracht, 0, -4);
		
		try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		

		$rij = $stmt->fetchAll();
		
			echo "<table border='1' width='700px'>";
			echo "<tr>";
			echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
			echo "<td style='font-family: OpenSans-Bold'>T.V.</td>";
			echo "<td style='font-family: OpenSans-Bold'>Achternaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Provincie</td>";
			echo "<td style='font-family: OpenSans-Bold'>Geslacht</td>";
			echo "<td style='font-family: OpenSans-Bold'>Locatie</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
	
		foreach($rij as $persoon){
			
			$hetid = $persoon['id'];
			$hetgoedeid = $hetid.$persoon['id'];
			echo "<tr>";
			echo "<td height='20px'>" . $persoon['naam'] . "</td>";
			echo "<td height='20px'>" . $persoon['tussenvoegsel'] . "</td>";
			echo "<td height='20px'>" . $persoon['achternaam'] . "</td>";
			echo "<td height='20px'>" . $persoon['provincie'] . "</td>";
			echo "<td height='20px'>" . $persoon['geslacht'] . "</td>";
			echo "<td height='20px'>" ?><p><a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'"><img src='img/map.png'/><? $idzoeken.$persoon['id'] = $persoon['id']; ?></a></p><? "</td>";
			echo "</tr>";
		}
			echo "</table>";
		
	}
	?>   
        <div id="light" class="white_content">Maps.
        <? 
		$id = $idzoeken.$persoon['id'];
		$opdracht = "SELECT
						*
					 FROM
						babykaartjes
					 WHERE
						id='$id'";
		try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		$rij = $stmt->fetch();
		$adres = "$rij[adres]";
		
		$adres = str_replace(" ", "+", $adres);
		
		$url='http://maps.googleapis.com/maps/api/geocode/json?address='.$adres.'+Netherlands+NL&sensor=false';
		echo $url;
		$source = file_get_contents($url);
		$obj = json_decode($source);
		$lat = $obj->results[0]->geometry->location->lat;
		$long = $obj->results[0]->geometry->location->lng; 
		
	?> 
        <div id="map-canvas3"></div>
        <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'">Sluiten</a></div>
        <div id="fade" class="black_overlay"></div>
    
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen">
        <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp;
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" alt="" /></a>&nbsp;
        <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" alt="" /></a>
      </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>