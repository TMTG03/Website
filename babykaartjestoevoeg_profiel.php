<?
require_once("connection.php");

    if(!empty($_POST)) {
        if(empty($_POST['naam'])) {
            $fout_naam = true;
			$sucess = false;
		} if(empty($_POST['achternaam'])) {
            $fout_achternaam = true;
			$sucess = false;
		} if(empty($_POST['roepnaam'])) {
            $fout_roepnaam = true;
			$sucess = false;
		} if(empty($_POST['geboortedatum'])) {
            $fout_geboortedatum = true;
			$sucess = false;
		} if(empty($_POST['geboorteplaats'])) {
            $fout_geboorteplaats = true;
			$sucess = false;
		} if(empty($_POST['provincie'])) {
            $fout_provincie = true;
			$sucess = false;
		} if(empty($_POST['geslacht'])) {
           $fout_geslacht = true;
			$sucess = false;
		} if(empty($_POST['bericht'])) {
            $fout_bericht = true;
			$sucess = false;	
		} if(empty($_POST['quote'])) {
            $fout_quote = true;
			$sucess = false;
		} if(empty($_POST['plaatje'])) {
            $fout_plaatje = true;
			$sucess = false;
		} if(empty($_POST['vader'])) {
            $fout_vader = true;
			$sucess = false;
		} if(empty($_POST['moeder'])) {
            $fout_moeder = true;
			$sucess = false;
		} if(empty($_POST['kleurcode'])) {
			$fout_kleurcode = true;
			$sucess = false;
		} if(empty($_FILES['plaatje'])) {
            $fout_plaatje = true;
			$sucess = false;
		}
		
		function getExtension($str) {

        	$i = strrpos($str,".");
        	if (!$i) { return ""; } 
        	$l = strlen($str) - $i;
        	$ext = substr($str,$i+1,$l);
        	return $ext;
		}
		
		
		$image        = $_FILES["plaatje"]["name"];
    	$uploadedfile = $_FILES['plaatje']['tmp_name'];
    
	    if ($image) {
	        $filename  = stripslashes($_FILES['plaatje']['name']);
	        $extension = getExtension($filename);
	        $extension = strtolower($extension);
			$databasenaam = $_POST['naam'] . $_POST['achternaam'] . date('Y-m-d-H-i-s') . "." . $extension;
	        if (($extension != "jpg") && ($extension != "jpeg") && ($extension != "png") && ($extension != "gif")) {
	            $fout_plaatje_ext = true;
				$sucess = false;
	        } else {
	            $size = filesize($_FILES['plaatje']['tmp_name']);
            
	            if ($extension == "jpg" || $extension == "jpeg") {
	                $uploadedfile = $_FILES['plaatje']['tmp_name'];
					$src          = imagecreatefromjpeg($uploadedfile);
				} else if ($extension == "png") {
					$uploadedfile = $_FILES['plaatje']['tmp_name'];
					$src          = imagecreatefrompng($uploadedfile);
				} else {
					$src = imagecreatefromgif($uploadedfile);
				}
				
				list($width, $height) = getimagesize($uploadedfile);
				
				$newwidth  = 300;
				$newheight = 200;
				$tmp       = imagecreatetruecolor($newwidth, $newheight);
				
				$newwidth1  = 200;
				$newheight1 = 200;
				$tmp1       = imagecreatetruecolor($newwidth1, $newheight1);
				
				imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				
				imagecopyresampled($tmp1, $src, 0, 0, 0, 0, $newwidth1, $newheight1, $width, $height);
				
				$filename  = "../database/plaatjes/groot/" . $databasenaam;
				$filename1 = "../database/plaatjes/klein/" . $databasenaam;
				
				imagejpeg($tmp, $filename, 100);
				imagejpeg($tmp1, $filename1, 100);
				
				imagedestroy($src);
				imagedestroy($tmp);
				imagedestroy($tmp1);
			}
		}
			
		if (!$sucess) {
			
			$query = " 
				INSERT INTO babykaartjes ( 
					naam,
					userid,
					tussenvoegsel,
					achternaam, 
					roepnaam,
					geboortedatum,
					adres,
					postcode,
					geboorteplaats,
					provincie,
					geslacht,
					bericht,
					quote,
					plaatje,
					vader,
					moeder,
					kleurcode,
					datum
				) VALUES ( 
					:naam,
					:userid,
					:tussenvoegsel, 
					:achternaam, 
					:roepnaam,
					:geboortedatum,
					:adres,
					:postcode,
					:geboorteplaats,
					:provincie,
					:geslacht,
					:bericht,
					:quote,
					:plaatje,
					:vader,
					:moeder,
					:kleurcode,
					:datum
				) 
			";
			
			$dob = date("Y-m-d", strtotime($_POST['geboortedatum']));
			 
			$query_params = array(
				':naam' => $_POST['naam'],
				':userid' => $_SESSION['user']['id'],
				':tussenvoegsel' => $_POST['tussenvoegsel'],
				':achternaam' => $_POST['achternaam'],
				':roepnaam' => $_POST['roepnaam'],
				':geboortedatum' => $dob,
				':adres' => $_POST['adres'],
				':postcode' => $_POST['postcode'],
				':geboorteplaats' => $_POST['geboorteplaats'],
				':provincie' => $_POST['provincieSelect'], 
				':geslacht' => $_POST['MVselect'],
				':bericht' => $_POST['bericht'],
				':quote' => $_POST['quote'],
				':plaatje' => $databasenaam,
				':vader' => $_POST['vader'],
				':moeder' => $_POST['moeder'],
				':kleurcode' => "#".$_POST['kleurcode'],
				':datum' => date("Y-m-d")
			);
			 
			try {
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params);
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			}
			if (!$PDOException) {
				$sucess = true;
			}
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
  	<? if (!$sucess) {
       if ($fout_naam) { ?>
    U hebt geen naam in gevuld <br />
    <? } if ($fout_tussen) { ?>
    U hebt geen tussenvoegsel in gevuld <br />
    <? } if ($fout_achternaam) { ?>
    U hebt geen achternaam in gevuld <br />
    <? } if ($fout_roepnaam) { ?>
    U hebt geen roepnaam in gevuld <br />
    <? } if ($fout_geboorteplaats) { ?>
    U hebt geen geldige geboorteplaats in gevuld <br />
    <? } if ($fout_adres) { ?>
    U hebt geen / geldig adres ingevoerd <br />
    <? } if ($fout_postcode) { ?>
    U hebt geen / geldig postcode ingevoerd <br />
    <? } if ($fout_provincie) { ?>
    U hebt geen provincie ingevuld <br />
    <? } if ($double_username) { ?>
    Deze naam is al in gebruik <br />
    <? } if ($fout_geboortedatum) { ?>
    U hebt geen geldige geboorte datum ingevuld<br />
    <? } if ($fout_geslacht) { ?>
    U hebt geen geslachts ingevuld <br />
    <? } if ($fout_bericht) { ?>
    U hebt geen bericht ingevoerd <br />
    <? } if ($fout_quote) { ?>
    U hebt geen quote ingevoerd <br />
    <? } if ($fout_plaatje) { ?>
    U heeft geen plaatje geselecteerd om te uploaden <br />
    <? } if ($fout_plaatje_ext) { ?>
    U heeft waarschijnlijk een verkeerd bestand (geen plaatje) geselecteerd om te uploaden <br />
    <? } if (($fout_vader) || ($fout_moeder)) { ?>
    U hebt geen vader of moeder gekozen<br />
    <? } if ($fout_kleurcode) { ?>
    U heeft geen kleurcode geselecteerd<br />
    <? } if ($sucess) { ?>
    Uw babykaartje is sucessvol geupload!<br />
    <? } ?>
    <form id="form" class="form" method="post" enctype="multipart/form-data">
      <ul>
        <li>
          <label for="naam">Naam:</label>
          <input type="text" name="naam" id="naam" class="requiredField naam" value="<? echo htmlentities($_POST['naam'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="tussenvoegsel">Tussenvoegsel:</label>
          <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="tussenvoegsel" value="<? echo htmlentities($_POST['tussenvoegsel'], ENT_QUOTES, 'UTF-8'); ?>"/>
        </li>
                <li>
          <label for="achternaam">Achternaam:</label>
          <input type="text" name="achternaam" id="achternaam" class="requiredField achternaam" value="<? echo htmlentities($_POST['achternaam'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="roepnaam">Roepnaam:</label>
          <input type="text" name="roepnaam" id="roepnaam" class="requiredField roepnaam" value="<? echo htmlentities($_POST['roepnaam'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="geboortedatum">Geboortedatum:</label>
          <input type="text" name="geboortedatum" id="geboortedatum" class="requiredField geboortedatum" value="<? echo htmlentities($_POST['geboortedatum'], ENT_QUOTES, 'UTF-8'); ?>" required />
          <span class="form_hint">Formaat "dd-mm-YYYY"</span> 
        </li>
        <li>
          <label for="adres">Adres:</label>
          <input type="text" name="adres" id="adres" class="requiredField adres" value="<? echo htmlentities($_POST['adres'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="postcode">Postcode:</label>
          <input type="text" name="postcode" id="postcode" class="requiredField postcode" value="<? echo htmlentities($_POST['postcode'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="geboorteplaats">Geboorteplaats:</label>
          <input type="text" name="geboorteplaats" id="geboorteplaats" class="requiredField geboorteplaats" value="<? echo htmlentities($_POST['geboorteplaats'], ENT_QUOTES, 'UTF-8'); ?>" required />
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
          <label for="MVselect">Geslacht:</label>
          <select id="MVselect" name="MVselect" class="requiredField MVselect" required>
            <option value="jongen">Jongen</option>
            <option value="meisje">Meisje</option>
          </select>
        </li>
		<li>
          <label for="bericht">Bericht:</label>
          <input type="text" style="width: 400px; height: 200px;" name="bericht" id="bericht" class="requiredField bericht" value="<? echo htmlentities($_POST['bericht'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
                <li>
          <label for="quote">Quote:</label>
          <input type="text" style="width: 400px; height: 100px" name="quote" id="quote" class="requiredField quote" value="<? echo htmlentities($_POST['quote'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
         <li>
          <label for="plaatje">Plaatje:</label>
          <input type="file" name="plaatje" id="plaatje" accept="image/*" class="requiredField plaatje" value="<? echo htmlentities($_POST['plaatje'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="vader">Vader:</label>
          <input type="text" name="vader" id="vader" class="vader" value="<? echo htmlentities($_POST['vader'], ENT_QUOTES, 'UTF-8'); ?>" />
        </li>
        <li>
          <label for="moeder">Moeder:</label>
          <input type="text" name="moeder" id="moeder" class="moeder" value="<? echo htmlentities($_POST['moeder'], ENT_QUOTES, 'UTF-8'); ?>" />
        </li>
        <li>
          <label for="color">Kaart kleur:</label>
          <input type="text" name="kleurcode" id="color" class="color" value="<? echo htmlentities($_POST['kleurcode'], ENT_QUOTES, 'UTF-8'); ?>" />
        </li>
        <li>
        	
        	<label for="checkbox">Ik accepteer de algemene <a href="voorwaarden.php" target="_blank">voorwaarden</a></label>
            <input name="checkbox" value="checkbox" type="checkbox" id="checkbox" style=" width: 22px; height: 22px" required x-moz-errormessage="Accepteer de voorwaarden." />
        </li>
        <li>
          <button class='buttonzoek' style="width: 125px; line-height: 10px; text-align: center;" type="submit" name="uploaden">Uploaden</button>
        </li>
      </ul>
    </form>
	<? } ?>
</body>
</html>