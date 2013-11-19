<?
    require_once("connection.php");

    if(!empty($_POST)) {
		// nakijken of alle velden zijn ingevuld (HTML5 kijkt dit al na maar voor de zekerheid nog een keer)
        if(empty($_POST['username'])) {
            $fout_username = true;
			$sucess = false;
		} if(empty($_POST['name'])) {
            $fout_name = true;
			$sucess = false;
		} if(empty($_POST['password'])) {
            $fout_password = true;
			$sucess = false;
		} if(empty($_POST['email'])) {
            $fout_email = true;
			$sucess = false;
		} if(empty($_POST['dob'])) {
            $fout_dob = true;
			$sucess = false;
		} if(empty($_POST['MVselect'])) {
            $fout_mv = true;
			$sucess = false;
		} if(empty($_POST['provincieSelect'])) {
            $fout_provincie = true;
			$sucess = false;
		// kijk of het email adress geldig is
		} if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { 
            $fout_ongeldig_email = true; 
			$sucess = false;
        } if ($_POST['password'] != $_POST['password2']) {
		    $fout_password2 = true;
			$sucess = false;
		}
			
		if (!$sucess) {

			$query = " 
				SELECT 
					1 
				FROM users 
				WHERE 
					gebruikersnaam = :username 
			";
			// PDO variable koppelen
			$query_params = array( 
				':username' => $_POST['username'] 
			); 
			// query uitvoeren
			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params); 
			} catch(PDOException $ex) {
				// TODO: verwijder de 'die' op uiteindelijke website
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			} 
			
			$row = $stmt->fetch(); 
			// filteren of de username al bestaat of niet
			if($row) { 
				$double_username = true;
			}
			// insert query
			$query = " 
				INSERT INTO users ( 
					gebruikersnaam,
					wachtwoord,
					salt, 
					naam,
					geboortedatum,
					provincie,
					geslacht,
					email
				) VALUES ( 
					:username,
					:password, 
					:salt, 
					:name,
					:dob,
					:provincie,
					:geslacht,
					:email
				) 
			";
			// random salt generen en password encrypten
			$salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
			$password = hash('sha256', $_POST['password'] . $salt);
			for($round = 0; $round < 65536; $round++) { 
				$password = hash('sha256', $password . $salt); 
			}
			// geboorte datum omgooien naar database formaat
			$dob = date("Y-m-d", strtotime($_POST['dob']));
			// PDO variable koppelen
			$query_params = array(
				':name' => $_POST['name'],
				':username' => $_POST['username'], 
				':password' => $password, 
				':salt' => $salt,
				':dob' => $dob,
				':email' => $_POST['email'],
				':provincie' => $_POST['provincieSelect'],
				':geslacht' => $_POST['MVselect']
			);
			// query uitvoeren
			try {
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params);
			} catch(PDOException $ex) {
				// TODO: verwijder de 'die' op uiteindelijke website
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			}
			if (!$PDOException) {
				$sucess = true;
				// doorlinken naar het script dat de activatie email verstuurd
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
       if ($fout_username) { ?>
    U hebt geen username in gevuld <br />
    <? } if ($fout_name) { ?>
    U hebt geen volledige naam in gevuld <br />
    <? } if ($fout_password) { ?>
    U hebt geen wachtwoord in gevuld <br />
    <? } if ($fout_email) { ?>
    U hebt geen e-mail adres in gevuld <br />
    <? } if ($fout_ongeldig_email) { ?>
    U hebt geen geldig e-mail adres in gevuld <br />
    <? } if ($double_username) { ?>
    Deze gebruikers naam is al in gebruik <br />
    <? } if ($fout_dob) { ?>
    U hebt geen geldige geboorte datum ingevuld<br />
    <? } if ($fout_password2) { ?>
    De wachtwoorden die u hebt ingevuld zijn niet hetzelfde <br />
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