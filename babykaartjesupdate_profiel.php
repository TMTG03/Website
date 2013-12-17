<?
//connection toevoegen
require_once("connection.php");
//inlog controle
if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
}
//id opvragen
 $id = $_GET[id];
 //gegevens selecteren
	$opdracht = "SELECT * FROM babykaartjes WHERE id='$id'";	
	try {
		$stmt = $db->prepare($opdracht); 
		$result = $stmt->execute();
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $ex) {
		// TODO: verwijder de 'die' op uiteindelijke website
		die("FOUT: " . $ex->getMessage()); 
	}
	
	$rij = $stmt->fetch();

	//gegevens opvragen uit formulier
	if(isset($_POST["uploaden"])) {
		$naam = $_POST["naam"];
		$tussenvoegsel = $_POST["tussenvoegsel"];	
		$achternaam = $_POST["achternaam"];	
		$roepnaam = $_POST["roepnaam"];	
		$dob = $_POST["geboortedatum"];	
		$adres = $_POST["adres"];	
		$postcode = $_POST["postcode"];	
		$geb = $_POST["geboorteplaats"];
		$provincie = $_POST["provincieSelect"];
		$bericht = $_POST["bericht"];
		$quote = $_POST["quote"];
		
		echo $mijndob;
		//gegevens updaten/aanpassen
		$opdracht2 = "UPDATE babykaartjes SET 
		naam='$naam', 
		tussenvoegsel='$tussenvoegsel', 
		achternaam='$achternaam', 
		roepnaam='$roepnaam', 
		geboortedatum='$dob', 
		adres='$adres', 
		postcode='$postcode', 
		geboorteplaats='$geb',
		provincie='$provincie', 
		bericht='$bericht', 
		quote='$quote' 
		WHERE id='$id'";
		try {
			$stmt = $db->prepare($opdracht2); 
			$result = $stmt->execute();
			header('Location: mijnbabykaartjes.php');
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage());
		}
		
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
  <div id="titelbalk">Mijn profiel</div>
  <hr class="schaduw_lijn">
  </hr>
  <div id="container_content2"> <br/>
    <form id="form" class="form" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label for="naam">Naam:</label>
          <input type="text" name="naam" id="naam" class="requiredField naam" value="<? echo $rij['naam']; ?>" required />
        </li>
        <li>
          <label for="tussenvoegsel">Tussenvoegsel:</label>
          <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="tussenvoegsel" value="<? echo $rij['tussenvoegsel']; ?>"/>
        </li>
                <li>
          <label for="achternaam">Achternaam:</label>
          <input type="text" name="achternaam" id="achternaam" class="requiredField achternaam" value="<? echo $rij['achternaam']; ?>" required />
        </li>
        <li>
          <label for="roepnaam">Roepnaam:</label>
          <input type="text" name="roepnaam" id="roepnaam" class="requiredField roepnaam" value="<? echo $rij['roepnaam']; ?>" required />
        </li>
        <li>
          <label for="geboortedatum">Geboortedatum:</label>
          <input type="date" name="geboortedatum" id="geboortedatum" class="requiredField geboortedatum" value="<? echo $rij['geboortedatum']; ?>" required />
          <span class="form_hint">Formaat "dd-mm-YYYY"</span> 
        </li>
        <li>
          <label for="adres">Adres:</label>
          <input type="text" name="adres" id="adres" class="requiredField adres" value="<? echo $rij['adres']; ?>" required />
        </li>
        <li>
          <label for="postcode">Postcode:</label>
          <input type="text" name="postcode" id="postcode" class="requiredField postcode" value="<? echo $rij['postcode']; ?>" required />
        </li>
        <li>
          <label for="geboorteplaats">Geboorteplaats:</label>
          <input type="text" name="geboorteplaats" id="geboorteplaats" class="requiredField geboorteplaats" value="<? echo $rij['geboorteplaats']; ?>" required />
        </li>
        <li>
          <label for="provincieSelect">Provincie:</label>
          <select id="provincieSelect" name="provincieSelect" class="requiredField provincieSelect" required>
            <optgroup label="Noord Nederland">
            <option value="Groningen">Groningen</option>
            <option value="Friesland">Friesland</option>
            <option value="Drenthe">Drenthe</option>
            <option value="Noord-Holland">Noord-Holland</option>
            </optgroup>
            <optgroup label="Midden Nederland">
            <option value="Overijsel">Overijsel</option>
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
        </li>
		<li>
          <label for="bericht">Bericht:</label>
          <input type="text" style="width: 400px; height: 200px;" name="bericht" id="bericht" class="requiredField bericht" value="<? echo $rij['bericht']; ?>" required />
        </li>
                <li>
          <label for="quote">Quote:</label>
          <input type="text" style="width: 400px; height: 100px" name="quote" id="quote" class="requiredField quote" value="<? echo $rij['quote']; ?>" required />
        </li>
        <li>
          <button class='buttonzoek' style="width: 125px; line-height: 10px; text-align: center;" type="submit" name="uploaden">Update</button>
        </li>
      </ul>
    </form>
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
