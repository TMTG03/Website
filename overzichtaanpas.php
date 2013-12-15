<?
//connectie met database inladen
require_once("connection.php");
//controlleren of er ingelogd is
if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
}

  
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link href="css/autocomplete.css" rel="stylesheet" type="text/css" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="scripts/jquery-1.8.2.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.9.0.custom.min.js"></script>
<script src="scripts/switcher.js"></script>
<script type="text/javascript" src="scripts/jscolor.js"></script>
<script type="text/javascript">
	// start deze jQuery code als het document geladen is ("document ready")
	$(document).ready(function() 
	{
		// activeer autocomplete voor het veld met ID "stad"
		$("#geboorteplaats").autocomplete({
			// geef aan welk bestand als bron voor de lijst dient
			source: "geboorteplaats.php",
			// geef aan vanf hoeveel ingetypte letters de autocomplete actief moet worden
			minLength: 2
		});
	});
	
	$(document).ready(function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Vul dit veld in");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
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
              <li class='has-sub'><a href='#'><span>Babykaartjes</span></a>
                <ul>
                  <li><a href='mijnbabykaartjes.php'><span>Mijn Babykaartjes</span></a></li>
                  <li><a href='babykaartjestoevoeg.php'><span>Toevoegen</span></a></li>
                  <li><a href='overzichtaanpas.php'><span>Aanpassen</span></a></li>
                  <li class='last'><a href='overzichtdelete.php'><span>Verwijderen</span></a></li>
                </ul>
              </li>
              <li class='has-sub'><a href='mapall.php'><span>Babymaps</span></a></li>
            </ul>
          </li>
          <li><a href='info.php'><span>Informatie</span></a></li>
          <? if(empty($_SESSION['user'])) { ?>
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <? } else { ?>
          <li class='has-sub'><a href='ingelogd.php'><span>Account</span></a></li>
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
  <div id="titelbalk">Mijn profiel</div>
  <hr class="schaduw_lijn">
  </hr>
  <div id="container_content"> <br/>
<?
	//id ophalen
	$id = $_SESSION['user']['id'];
	//gegevens selecteren
	$opdracht = "SELECT * FROM babykaartjes WHERE userid='$id'";
	//gegevens klaarzetten en ophalen
	try {
		$stmt = $db->prepare($opdracht); 
		$result = $stmt->execute();
	} catch(PDOException $ex) {
		// Error message
		die("FOUT: " . $ex->getMessage()); 
	}
	

			//tabel aanmaken
			echo "<table border='1' width='100%'>";
			echo "<tr>";
			//font bepalen  en weegeven wat het veld inhoud
			echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
			echo "<td style='font-family: OpenSans-Bold'>T.V.</td>";
			echo "<td style='font-family: OpenSans-Bold'>Achternaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Roepnaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Geboortedatum</td>";
			echo "<td style='font-family: OpenSans-Bold'>Adres</td>";
			echo "<td style='font-family: OpenSans-Bold'>Postcode</td>";
			echo "<td style='font-family: OpenSans-Bold'>Geboorteplaats</td>";
			echo "<td style='font-family: OpenSans-Bold'>Aanpassen</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
		//loop om alle gegevens op te halen
		foreach ($stmt->fetchAll() as $veld) {
			echo "<tr>";
			//opgehaalde gegevens weergeven in een tabel
			echo "<td height='20px'>" . $veld['naam'] . "</td>";
			echo "<td height='20px'>" . $veld['tussenvoegsel'] . "</td>";
			echo "<td height='20px'>" . $veld['achternaam'] . "</td>";
			echo "<td height='20px'>" . $veld['roepnaam'] . "</td>";
			echo "<td height='20px'>" . $veld['geboortedatum'] . "</td>";
			echo "<td height='20px'>" . $veld['adres'] . "</td>";
			echo "<td height='20px'>" . $veld['postcode'] . "</td>";
			echo "<td height='20px'>" . $veld['geboorteplaats'] . "</td>";
			echo "<td height='20px'> <a href = 'babykaartjesupdate_profiel.php?id=$veld[id]'>pas aan</a>  </td>";
			echo "</tr>";
		}
		//tabel afsluiten
			echo "</table>";
	

	

	?>
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