<? 
    require_once("connection.php");
	// als de sessie bestaat is er al ingelogd -> door verwijzen naar ingelogd.php
    if(!empty($_SESSION['user'])) { 
        header("location: " . $_SESSION['url']); 
        die("Doorlinkennaar laatste pagina"); 
	}
    $submitted_username = '';
	// Selecteer alles van de gebruiker om in een sessie te plaatsen
	if(!empty($_POST)) {
        $query = " 
            SELECT 
                *
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
        }
        $login_ok = false;
        $row = $stmt->fetch();
		// wachtwoord check
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
			// salt en wachtwoord legen zodat deze niet in de sessie komen
            unset($row['salt']); 
            unset($row['password']);
            $_SESSION['user'] = $row;
			// doorlinken naar ungelogd.php
			header("location: " . $_SESSION['url']); 
            die("Doorlinkennaar laatste pagina"); 
        } else {
			// filteren voor geactiveerde account
			if ($active != 1)
            $fout = 1;
			// ingevulde username defineren voor in de form
            $submitted_username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8'); 
        } 
    } 
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Login :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
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
  <div id="tussen_balk"></div>
  <div id="titelbalk">Login</div>
  <hr class="schaduw_lijn">
  </hr>
  <br/>
  <br/>
  <div id="container_content"> 
    <!-- filteren of er op uitloggen is geklikt-->
    <? if (!empty($_GET['logout'])) { ?>
    U bent sucessvol uitgelogd <br />
    <br />
    <!-- weergeven als er niet ingelogd kon worden -->
    <? } if ($fout == 1) { ?>
    Incorrecte gebruikersnaam en / of wachtwoord! <br />
    <br />
    <!-- weergeven als de account nog niet is geactiveerd -->
    <? } else if ($active == 1) { ?>
    U hebt uw account nog niet geactiveerd<br />
    Klik op de link in uw e-mail inbox om uw account te activeren <br />
    <br />
    <!-- activatie mail link -->
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
          <button class='buttonzoek' style="width: 125px; line-height: 10px; text-align: center;" type="submit">Inloggen</button>
        </li>
      </ul>
    </form>
    </br>
    </br>
    Nog geen inlog gegevens? <a href="registreren.php">Registreer nu!</a><br /><br />
	<p>Heeft u moeite met het inloggen of uploaden van een babykaartje. Klik dan <a href="img/pdf/Handleiding_babyberichten.pdf">Hier!</a></p>
    
  	  
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