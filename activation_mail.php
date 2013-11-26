<?
	require_once("connection.php");
	// email en gebruiker ophalen
	if(empty($_GET['email']) || 
	  empty($_GET['gebruiker'])) {
	  $fout = true;
	}
	
	function spamcheck($field){
	  $field=filter_var($field, FILTER_SANITIZE_EMAIL);
	  if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
		return TRUE;
	  } else {
		return FALSE;
	  }
	}
	if (isset($_GET['email'])) {
	  $mailcheck = spamcheck($_GET['email']);
	  if ($mailcheck == FALSE){
		$email_fout = true;
	  } else if (!$fout) {
		  $name = $_GET['gebruiker']; 
		  $to = $_GET['email'];
		  $email_subject = "Activatie mail: $name";
	
		  $datum = date('d/m/Y H:i:s');
		  // email headers defineren
		  $headers = 'From: Babyberichten.nl <noreply@ict-lab.nl>';
					 
		  $headers = stripslashes($headers);
		  $headers = str_replace('\n', '', $headers); // Verwijder \n
		  $headers = str_replace('\r', '', $headers); // Verwijder \r
		  $headers = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $headers)); // Slashes van quotes
		  // inhoudt van de mail defineren	
		  $inhoud_mail = "===================================================\n";
		  $inhoud_mail .= "Activatie mail " . $_SERVER['HTTP_HOST'] . "\n";
		  $inhoud_mail .= "===================================================\n\n";
					  
		  $inhoud_mail .= "Naam: " . htmlspecialchars($_GET['gebruiker']) . "\n";
		  $inhoud_mail .= "E-mail adres: " . htmlspecialchars($_GET['email']) . "\n\n";
		  $inhoud_mail .= "Klik op de Onderstaande link om uw account te activeren \n\n";
		  $inhoud_mail .= "http://tmtg03.ict-lab.nl/website/activation.php?gebruiker=" . htmlspecialchars($_GET['gebruiker']) . "&email=" . htmlspecialchars($_GET['email']) . "\n\n";
						
		  $inhoud_mail .= "Verstuurd op " . $datum . "\n\n";
						
		  $inhoud_mail .= "===================================================\n\n";
		  // email verzenden
		  mail($to,$email_subject,$inhoud_mail,$headers);
		  $verstuurd = true;
		}
	}
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Registreren :.</title>
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
  <div id="titelbalk">Registreren</div>
  <hr class="schaduw_lijn">
  </hr>
  <br/>
  <br/>
  <div id="container_content"> 
    <? if ($verstuurd) { 
       if (isset($_GET['registreren'])) {
		 // terug linken naar registreren.php
         header("Location: registreren.php?registreren=true"); 
         die("doorlinken naar registreren.php");
       }
    ?>
    <!-- weergeven als de activatie email nogmaals verstuurd is --> 
    De activatie email is succesvol opnieuw naar uw email adres verzonden<br />
    <br />
    <a href="login.php">Klik hier</a> om terug te gaan naar het inlog formulier<br />
    <? } else { ?>
    <!-- weergeven als er wat verkeerds is gegaan --> 
    De activatie email kon niet worden verzonden<br />
    probeer het later nog eens<br />
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