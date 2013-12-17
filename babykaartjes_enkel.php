<? require_once('connection.php');

//if(empty($_SESSION['user'])) { 
//	header("Location: login.php"); 
//	die("Doorlinken naar login.php");
//}

$id = $_GET["id"];
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
$source = file_get_contents($url);
$obj = json_decode($source);
$lat = $obj->results[0]->geometry->location->lat;
$long = $obj->results[0]->geometry->location->lng;

//reacties
if((isset($_POST["reageer"]))) {
$reactie = $_REQUEST['bericht'];
//datum ophalen
$now = time();
$num = date("w");
if ($num == 0)
{ $sub = 6; }
else { $sub = ($num-1); }
$WeekMon  = mktime(0, 0, 0, date("m", $now)  , date("d", $now)-$sub, date("Y", $now));
$todayh = getdate($WeekMon); 

$d = $todayh[mday] + 1;
$m = $todayh[mon];
$y = $todayh[year];
//eind datum ophalen
$datumreactie = ("$y-$m-$d");
$gebruikersnaam = $_SESSION['user']['gebruikersnaam'];
$idbabykaart = $_SESSION['id'];

	if(!empty($_POST)) {
        if(empty($_POST['bericht'])) {
            $fout_naam = true;
			$sucess = false;
		}
		
		if (!$sucess) {
			
				$query = " 
				INSERT INTO reacties( 
					bericht,
					datumreactie, 
					gebruikersnaam,
					babyid
				) VALUES ( 
					:reactie, 
					:datumreactie, 
					:gebruikersnaam,
					:babyid
				) 
			";
			
			
			 
			$query_params = array(
				':reactie' => $_POST['bericht'],
				':datumreactie' => $datumreactie,
				':gebruikersnaam' => '$gebruikersnaam',
				':babyid' => '$id',
			);
				try {
				$stmt1 = $db->prepare($query); 
				$result1 = $stmt1->execute($query_params);
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			}
			if (!$PDOException) {
				$sucess = true;
			}
		}
	}
		
    
	}
	$opdracht = "SELECT * FROM reacties";

try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		

		$rij2 = $stmt->fetchAll();
		
		
?> 
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Babykaartjes :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/switcher.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script type="text/javascript" src="scripts/share.js"></script>
<style>
#map-canvas {
	width: 200px;
	height: 360px;
}
</style>
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
          <li class='has-sub'><a href='allebabykaartjes.php'><span>Babykaartjes</span></a>
            <ul>
              <li class='has-sub'><a href='allebabykaartjes.php'><span>Babykaartjes</span></a>
                <ul>
                  <li><a href='allebabykaartjes.php'><span>Alle babykaartjes</span></a></li>
                  <li><a href='mijnbabykaartjes.php'><span>Mijn babykaartjes</span></a></li>
                  <li class='last'><a href='babykaartjestoevoeg.php'><span>Nieuw babykaartje</span></a></li>
                </ul>
              </li>
              <li class='has-sub'><a href='mapall.php'><span>Babymaps</span></a></li>
            </ul>
          </li>
          <li><a href='info.php'><span>Informatie</span></a></li>
          <? if(empty($_SESSION['user'])) { ?>
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <? } else { ?>
          <li class='has-sub'><a href='ingelogd.php'><span>Account</span></a>
            <ul>
              <li class='last'><a href='logout.php'><span>Uitloggen</span></a></li>
            </ul>
          </li>
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
  <div id="titelbalk">Geboorte kaartje</div>
  <hr class="schaduw_lijn">
  </hr>
  <div id="container_content2"> <br/>
    <br/>
    <div class="tabs">
      <div class="tab">
        <input type="radio" id="tab-1" name="tab-group-1" checked>
        <label for="tab-1" style="border-top: 3px solid <? echo $rij['kleurcode'] ?>; border-bottom: 3px solid <? echo $rij['kleurcode'] ?>; border-left: 3px solid <? echo $rij['kleurcode'] ?>; border-right: 2px solid <? echo $rij['kleurcode'] ?>;">Algemeen</label>
        <div class="content" style="border: 3px solid <? echo $rij['kleurcode'] ?>;">
          <div id="tabs-foto"> <? echo"<img src='../database/plaatjes/klein/" .  $rij['plaatje'] . "' />" ?> </div>
          <div id="tabs-naam"> <? echo $rij['naam']; echo ' '; if ($rij['tussenvoegsel'] != NULL) { echo $rij['tussenvoegsel']; echo ' ';} echo $rij['achternaam']; ?> </div>
          <div id="tabs-map">
            <div id="map-canvas"></div>
          </div>
          <div id="tabs-bericht"> <? echo nl2br($rij['bericht']); ?> </div>
          <div id="tabs-delen"><div class="share"></div></div>
        </div>
      </div>
      <div class="tab">
        <input type="radio" id="tab-2" name="tab-group-1">
        <label for="tab-2" style="border-top: 3px solid <? echo $rij['kleurcode'] ?>; border-bottom: 3px solid <? echo $rij['kleurcode'] ?>; border-left: 2px solid <? echo $rij['kleurcode'] ?>; border-right: 2px solid <? echo $rij['kleurcode'] ?>;"">Info</label>
        <div class="content" style="border: 3px solid <? echo $rij['kleurcode'] ?>;">
        
          <div class="tabs-informatie-content"> test </div>
        </div>
      </div>
      <div class="tab">
        <input type="radio" id="tab-3" name="tab-group-1">
        <label for="tab-3" style="border-top: 3px solid <? echo $rij['kleurcode'] ?>; border-bottom: 3px solid <? echo $rij['kleurcode'] ?>; border-left: 2px solid <? echo $rij['kleurcode'] ?>; border-right: 3px solid <? echo $rij['kleurcode'] ?>;">Bericht</label>
        <div class="content" style="border: 3px solid <? echo $rij['kleurcode'] ?>;"> 
        <? require_once("reacties.php"); ?> 
        
        </div>
      </div>
    </div>
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen"> <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp; <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" alt="" /></a>&nbsp; <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" alt="" /></a> </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>