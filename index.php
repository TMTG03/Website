<? require_once('connection.php');

$opdracht = "SELECT 
			   	* 
			 FROM 
				babykaartjes 
			 ORDER BY 
				id 
			 DESC LIMIT 
				4";
try {
	$stmt = $db->prepare($opdracht); 
	$result = $stmt->execute();
} catch(PDOException $ex) {
	// TODO: verwijder de 'die' op uiteindelijke website
	die("FOUT: " . $ex->getMessage()); 
}
$rij = $stmt->fetch();
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Index :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default"/>
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/themaslider.min.js"></script>
<script src="scripts/switcher.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#demo').themaslider({'delay':5000, 'fadeSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoStart':true});
	jQuery('#demo1').themaslider({'delay':5000, 'fadeSpeed': 2000,'autoStart':true,'pauseOnHover':true});
});
</script>
<script>
$(document).ready(function() {
	$("#datepicker").datepicker();
});
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
          <? } else { 
		     if ($_SESSION['user']['admin'] == '1') { ?> 
          <li class='has-sub'><a href='ingelogd.php'><span>Account</span></a></a>
            <ul>
              <li><a href='admin.php'><span>Admin panel</span></a></li>
              <li class='last'><a href='logout.php'><span>Uitloggen</span></a></li>
            </ul>
          </li>
          <? } else { ?>
          <li class='has-sub'><a href='ingelogd.php'><span>Account</span></a></a>
            <ul>
              <li class='last'><a href='logout.php'><span>Uitloggen</span></a></li>
            </ul>
          </li>
          <? }
		  } ?>
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
  <div id="slider">
    <div id="demo" class="themaslider">
      <ul>
        <li> <img src="img/slides/1.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 1</h2>
            <p>Beschrijving</p>
          </div>
        </li>
        <li><img src="img/slides/2.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 2</h2>
            <p>Beschrijving</p>
          </div>
        </li>
        <li><img src="img/slides/3.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 3</h2>
            <p>Beschrijving</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="grijzelijn_dun"></div>
  <div id="zoekbar">
    <div id="zoekbar_links">
      <h2 class="zoekbar_links_header">Zoeken</h2>
      <h4 class="zoekbar_links_summary">Zoek een geboortekaartje</h4>
    </div>
    <div id="zoekbar_rechts">
    <div id="zoekbar_rechts_header">
      <div id="zoekbar_rechts_vak1">Naam:</div>
      <div id="zoekbar_rechts_vak2">Provincie:</div>
      <div id="zoekbar_rechts_vak3">Geboortedatum:</div>
      <div id="zoekbar_rechts_vak4">J/M</div>
    </div>
    <div id="zoekbar_rechts_input">
    <form id="form_zoek" class="form_zoek" method="post" action="zoeken.php">
      <div id="zoekbar_rechts_vak1_onder">
        <input type="text" name="naam" />
      </div>
      <div id="zoekbar_rechts_vak2_onder" class="dropdownpijl">
        <select name="provincie">
          <option value="">Selecteer provincie</option>
          <optgroup label="Noord Nederland">
          <option value="Groningen">Groningen</option>
          <option value="Friesland">Friesland</option>
          <option value="Drenthe">Drenthe</option>
          <option value="Noord-Holland">Noord-Holland</option>
          </optgroup>
          <optgroup label="Midden Nederland">
          <option value="Overijsel">Overijssel</option>
          <option value="Gelderland">Gelderland</option>
          <option value="Utrecht">Utrecht</option>
          <option value="Zuid-Holland">Zuid-Holland</option>
          <option value="Flevoland">Flevoland</option>
          </optgroup>
          <optgroup label="Zuid Nederland">
          <option value="Zeeland">Zeeland</option>
          <option value="Noord-Brabant">Noord-Brabant</option>
          <option value="Limburg">Limburg</option>
          </optgroup>
        </select>
      </div>
      <div id="zoekbar_rechts_vak3_onder">
        <input type="text" name="datum" class="dropdownkalender" placeholder="dd-mm-YYYY" />
      </div>
      <div id="zoekbar_rechts_vak4_onder">
        <select id="MVselect" name="geslacht">
		  <option value=""></option>
          <option value="jongen">J</option>
          <option value="meisje">M</option>
        </select>
      </div>
      <div id="zoekbar_rechts_vak5_onder">
        <button name="zoekverzend" class='buttonzoek' style="width: 125px; height: 36px; float: left; text-align: center; " type="submit">Zoeken</button>
      </div>
      </div>
      </div>
    </form>
  </div>
  <div id="container_content" style="height: 700px">
         <?
	$rij = $stmt->fetchAll();
	?>
    
    <div id="carousel_vak1"><? echo"<a href='babykaartjes_enkel.php?id=" . $rij['0']['id'] . "'><img src='../database/plaatjes/groot/" .  $rij['0']['plaatje'] . "' width='300' height='200' /></a>" ?></div>
    <div id="carousel_vak2"><? echo"<a href='babykaartjes_enkel.php?id=" . $rij['1']['id'] . "'><img src='../database/plaatjes/groot/" .  $rij['1']['plaatje'] . "' width='300' height='200' /></a>" ?></div>
    <div id="carousel_vak3"><? echo"<a href='babykaartjes_enkel.php?id=" . $rij['2']['id'] . "'><img src='../database/plaatjes/groot/" .  $rij['2']['plaatje'] . "' width='300' height='200' /></a>" ?></div>
        <ul>
          <?php
			foreach($rij as $caroussel) {
		?>
          <li>
            <div id='carousel_kop1'>
              <?php
				echo "<p class='carouselkoptekst'>" . $caroussel['naam'] . "</p></br>";
				echo "<p class='carouselonder_koptekst'>" . $caroussel['quote'] . "</p></br>";
			?>
            </div>
          </li>
          <?php
			}
          ?>
	      
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