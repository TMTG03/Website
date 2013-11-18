<?
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
				SELECT 
					1 
				FROM babykaartjes 
				WHERE 
					naam = :username 
			";
			
			$query_params = array( 
				':naam' => $_POST['naam'] 
			); 
			 
			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			} 
			
			$row = $stmt->fetch(); 
			
			if($row) { 
				$double_username = true;
			}
			
			$query = " 
				INSERT INTO babykaartjes ( 
					naam,
					tussenvoegsel,
					achternaam, 
					roepnaam,
					geboortedatum,
					geboorteplaats,
					geslacht,
					bericht,
					quote,
					plaatje,
					vader,
					moeder
				) VALUES ( 
					:naam,
					:tussenvoegsel, 
					:achternaam, 
					:roepnaam,
					:geboortedatum,
					:geboorteplaats,
					:geslacht,
					:bericht,
					:quote,
					:plaatje,
					:vader,
					:moeder
				) 
			";
			
			$dob = date("Y-m-d", strtotime($_POST['dob']));
			 
			$query_params = array(
				':name' => $_POST['name'],
				':username' => $_POST['username'], 
				':password' => $password,
				':dob' => $dob,
				':email' => $_POST['email'],
				':provincie' => $_POST['provincieSelect'],
				':geslacht' => $_POST['MVselect']
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
				header("Location: activation_mail.php?registreren=true&gebruiker=" . htmlspecialchars($_POST['username']) . "&email=" . htmlspecialchars($_POST['email'])); 
                die("doorlinken naar activation_mail.php");
			}
		}
	}
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Registreren :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/switcher.js"></script>
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
          <li><a href='login.php'><span>Inloggen</span></a></li>
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
  <div id="titelbalk">Registreren</div>
  <hr class="schaduw_lijn"></hr>
  <br/>
  <br/>
  <div id="container_content">
  	<? if (isset($_GET['registreren'])) { ?>
       U bent succesvol geregistreerd!<br /><br />
       U ontvangt binnen enkele minuten een bevestegings email<br /><br />
       <a href="login.php">Klik hier</a> om terug te gaan naar het inlog formulier<br /><br />
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
          <label for="name">Volledige naam:</label>
          <input type="text" name="name" id="name" class="requiredField name" value="<? echo htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="email">E-mail adres:</label>
          <input type="email" name="email" id="email" class="requiredField email" value="<? echo htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8'); ?>" required />
          <span class="form_hint">Formaat "naam@voorbeeld.nl"</span> </li>
        <li>
          <label for="dob">Geboortedatum:</label>
          <input type="text" name="dob" id="dob" class="requiredField dob" value="<? echo htmlentities($_POST['dob'], ENT_QUOTES, 'UTF-8'); ?>" required />
          <span class="form_hint">Formaat "dd-mm-YYYY"</span> </li>
        <li>
          <label for="MVselect">Geslacht:</label>
          <select id="MVselect" name="MVselect" class="requiredField MVselect" required>
            <option value="man">M</option>
            <option value="vrouw">V</option>
          </select>
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
          <label for="username">Gebruikersnaam:</label>
          <input type="text" name="username" id="username" class="requiredField username" value="<? echo htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); ?>" required />
        </li>
        <li>
          <label for="password">Wachtwoord:</label>
          <input type="password" name="password" id="password" value=""  class="requiredField password" required />
        </li>
        <li>
          <label for="password2">Herhaal wachtwoord:</label>
          <input type="password" name="password2" id="password2" value=""  class="requiredField password2" required />
        </li>
        <li>
          <button class='buttonzoek' style="width: 125px; line-height: 10px; text-align: center;" type="submit">Registreren</button>
        </li>
      </ul>
    </form>
	<? } ?>
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