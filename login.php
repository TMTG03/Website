<? 
    require_once("connection.php");
    if(!empty($_SESSION['user'])) { 
        header("Location: ingelogd.php"); 
        die("Doorlinken naar ingelogd.php"); 
	}
    $submitted_username = '';
	if(!empty($_POST)) {
        $query = " 
            SELECT 
                *
            FROM users 
            WHERE 
                gebruikersnaam = :username 
        ";
        $query_params = array( 
            ':username' => $_POST['username'] 
        ); 
         
        try {
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } catch(PDOException $ex) {
            die("FOUT: " . $ex->getMessage()); 
        }
        $login_ok = false;
        $row = $stmt->fetch(); 
        if($row) {
            $check_password = hash('sha256', $_POST['password'] . $row['salt']); 
            for($round = 0; $round < 65536; $round++) { 
                $check_password = hash('sha256', $check_password . $row['salt']); 
            } 
             
            if($check_password === $row['wachtwoord']) {
                $login_ok = true;
				if ($row['active'] == "0") {
					$active = 1;
					$login_ok = false;
				}
            }
        }
        if($login_ok) {
			
            unset($row['salt']); 
            unset($row['password']);
            $_SESSION['user'] = $row;
			header("Location: ingelogd.php"); 
            die("Doorlinken naar: ingelogd.php");
        } else {
			if ($active != 1)
            $fout = 1;
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
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
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <li class='last'><a href='#'><span>Contact</span></a></li>
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
  <div id="titel">Inloggen</div>
  <div id="container_content">
	<? if (!empty($_GET['logout'])) { ?>
    U bent sucessvol uitgelogd <br /><br />
    <? } if ($fout == 1) { ?>
    Incorrecte gebruikersnaam en / of wachtwoord! <br /><br />
    <? } else if ($active == 1) { ?>
    U hebt uw account nog niet geactiveerd<br />
    Klik op de link in uw e-mail inbox om uw account te activeren <br />
    <br />
    <? $link = "activation_mail.php?gebruiker=" . htmlspecialchars($_POST['username']) . "&email=" . htmlspecialchars($row['email']) ?>
    <a href=<? echo $link ?>>Klik hier</a> om de activatie e-mail nogmaals te versturen<br />
    <? } ?>
    <form id="form" class="form" method="post">
      <ul>
        <li>
          <label for="username">Gebruikersnaam:</label>
          <input type="text" name="username" id="username" value="<? echo $submitted_username; ?>" class="requiredField username" required />
        </li>
        <li>
          <label for="password">Wachtwoord:</label>
          <input type="password" name="password" id="password" value="" class="requiredField password" required />
        </li>
        <li>
          <button class='buttonzoek' style="width: 125px; text-align: center;" type="submit">Inloggen</button>
        </li>
      </ul>
    </form>
    Nog geen inlog gegevens? <a href="registreren.php">Registreer nu!</a> </div>
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