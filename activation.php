<? require_once("connection.php"); 
// nakijken of de account al geactiveerd was of niet
$query = " 
	SELECT
		active
	FROM 
		users
	WHERE 
		gebruikersnaam = :username
	AND
		email = :email
";
// PDO variable koppelen
$query_params = array(
	':username' => $_GET['gebruiker'],
	':email' => $_GET['email']
); 
// query uitvoeren
try {
	$stmt = $db->prepare($query); 
	$result = $stmt->execute($query_params);
} catch(PDOException $ex) {
	// TODO: verwijder de 'die' op uiteindelijke website
	die("FOUT: " . $ex->getMessage()); 
}

$row = $stmt->fetch(); 
// uitvoeren als de accoutn nog niet geactiveerd was
if ($row['active'] == 0) {
	$query = " 
		UPDATE 
			users
		SET
			active=1
		WHERE 
			gebruikersnaam = :username
		AND
			email = :email
	";
	// PDO variable koppelen
	$query_params = array(
		':username' => $_GET['gebruiker'],
		':email' => $_GET['email']
	); 
	
	// query uitvoeren
	try {
		$stmt = $db->prepare($query); 
		$result = $stmt->execute($query_params);
		$active = "true";
	} catch(PDOException $ex) {
		// TODO: verwijder de 'die' op uiteindelijke website
		die("FOUT: " . $ex->getMessage()); 
	}
} else {
	// opslaan als de accoutn al geactiveerd was
	$was_actief = true;
}

?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Inloggen :.</title>
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
  <div id="titelbalk">Account activeren</div>
  <hr class="schaduw_lijn">
  </hr>
  <br/>
  <br/>
  <div id="container_content"> 
    <!-- weergeven als de account al was geactiveerd-->
    <? if ($was_actief == true) { ?>
    Uw account is al geactiveerd<br />
    <br />
    <a href="login.php">Klik hier</a> om terug te gaan naar het inlog formulier<br />
    <!-- weergeven of de account is geactiveerd of niet -->
    <? } else if ($active == "true") { ?>
    Uw account is succesvol geactiveerd<br />
    <br />
    <a href="login.php">Klik hier</a> om terug te gaan naar het inlog formulier<br />
    <? } else { ?>
    Uw account kon niet worden geactiveerd<br />
    Probeer het later nog eens<br />
    <? } ?>
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen"> <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp; <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" alt="" /></a>&nbsp; <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" alt="" /></a> </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>