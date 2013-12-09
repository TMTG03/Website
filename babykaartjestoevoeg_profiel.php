<?
//datum
$todayh = getdate($WeekMon); 
$d = $todayh[mday] + 1;
$m = $todayh[mon];
$y = $todayh[year];
$datumreactie = ("$y-$m-$d");
    require_once("connection.php");

    if(!empty($_POST)) {
        if(empty($_POST['naam'])) {
            $fout_naam = true;
			$sucess = false;
		} if(empty($_POST['tussenvoegsel'])) {
            $fout_tussen = true;
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
		}
			
		if (!$sucess) {
			
			$query = " 
				INSERT INTO babykaartjes ( 
					naam,
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
					uploaddatum
				) VALUES ( 
					:naam,
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
					:datum
				) 
			";
			
			$dob = date("Y-m-d", strtotime($_POST['geboortedatum']));
			 
			$query_params = array(
				':naam' => $_POST['naam'],
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
				':plaatje' => $_POST['plaatje'],
				':vader' => $_POST['vader'],
				':datum' => $datumreactie,
				':moeder' => $_POST['moeder']
				
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
  	<? if (isset($_POST['uploaden'])) { 
			include('resizeplaatje.php');
			extensiecheck();
	?>
       U heeft succesvol een babykaartje geupload!<br /><br />
    <? } else if (!$sucess) {
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
    <? } if (($fout_vader) || ($fout_moeder)) { ?>
    U hebt geen vader of moeder gekozen<br />
    <? } ?>
    <form id="form" class="form" method="post">
      <ul>
        <li>
          <label for="naam">Naam:</label>
          <input type="text" name="naam" id="naam" class="requiredField naam" value="<? echo htmlentities($_POST['naam'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="tussenvoegsel">Tussenvoegsel:</label>
          <input type="text" name="tussenvoegsel" id="tussenvoegsel" class="requiredField tussenvoegsel" value="<? echo htmlentities($_POST['tussenvoegsel'], ENT_QUOTES, 'UTF-8'); ?>" required />
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
          <input type="file" name="plaatje" id="plaatje" class="requiredField plaatje" value="<? echo htmlentities($_POST['plaatje'], ENT_QUOTES, 'UTF-8'); ?>" required />
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