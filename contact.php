<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Index :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/themaslider.min.js"></script>
<script src="scripts/switcher.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#demo').themaslider({'delay':5000, 'fadeSpeed': 2000,'showNextPrev':true,'showPlayButton':true,'autoStart':true});
	jQuery('#demo1').themaslider({'delay':5000, 'fadeSpeed': 2000,'autoStart':true,'pauseOnHover':true});
});
</script>
</head>

<body>
<div id="container">
  <div id="headercolor">
    <div id="container_breedte">
      <div id="logo_plek"><a href="index.php" id="logo"><img width="333px" src="img/logo.png" /></a></div>
      <div id="menu">
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
          <? if(empty($_SESSION['user'])) { ?>
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <? } else { ?>
		  <li><a href='ingelogd.php'><span>Account</span></a></li>
          <? } ?>
          <li><a href='login.php'><span>Inloggen</span></a></li>
          <li class='last'><a href='contact.php'><span>Contact</span></a></li>
        </ul>
        <div id="styleswitchen">
          <div id="styleswitchvak1"><a href="#" onclick="setActiveStyleSheet('default'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
          <div id="styleswitchvak2"><a href="#" onclick="setActiveStyleSheet('roze'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
          <div id="styleswitchvak3"><a href="#" onclick="setActiveStyleSheet('blauwroze'); return false;"><img src="img/clear.png" height="20" width="20" alt="" /></a></div>
        </div>
      </div>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="tussen_balk"></div>
  <div id="titelbalk">Contact</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content">
    <div id="googlemaps"> <br/>
  	<section id="map"> </section>
  </div>
  <br/>
  <br/>
 <? if ($ok) { ?>
            Heeft u vragen of suggesties? U kunt gerust met ons contact opnemen.<br/>
            Wij horen graag van u, door middel van het onderstaande formulier kunt u een berichtje naar ons versturen.<br/><br/>
		      <? }
                
              // E-mailadres
              $mail_ontv = '66164@ict-lab.nl';
                
              // checks voor naam en e-mailadres
              if ($_SERVER['REQUEST_METHOD'] == 'POST')
              {
                  // naam controle
                  if (empty($_POST['naam']))
                      $naam_fout = 1;
                  // e-mail controle
                  if (function_exists('filter_var') && !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
                      $email_fout = 1;
                  // overload controle
                  if (!empty($_SESSION['antiflood'])) {
                      $seconde = 60;
                      $tijd = time() - $_SESSION['antiflood'];
                      if($tijd < $seconde)
                          $antiflood = 1;
                  }
              }
              // Kijk of alle velden zijn ingevuld en correct zijn ingevuld
              if (($_SERVER['REQUEST_METHOD'] == 'POST' && (!empty($antiflood) || empty($_POST['naam']) || !empty($naam_fout) || empty($_POST['mail']) || !empty($email_fout) || empty($_POST['bericht']) || empty($_POST['onderwerp']))) || $_SERVER['REQUEST_METHOD'] == 'GET') {
                  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                      if (!empty($naam_fout))
                          echo '<p>Uw naam is niet ingevuld.</p>';
                      elseif (!empty($email_fout))
                          echo '<p>Uw e-mailadres is niet juist.</p>';
                      elseif (!empty($antiflood))
                          echo '<p>U mag slechts &eacute;&eacute;n bericht per ' . $seconde . ' seconde versturen.</p>';
                      else
                          echo '<p>U bent uw naam, e-mailadres, onderwerp of bericht vergeten in te vullen.</p>';
                  }
				  
				  ?>
			      <script>
			      $(document).ready(function() {
 			         $("#datepicker").datepicker();
			      });
    
			      var uur = new Date().getHours();
   			   	  if (uur >= 18)
    			  	document.write('Goedenavond, hier kunt u contact met ons opnemen.')
    			  else if (uur >= 12)
    			  	document.write('Goedemiddag, hier kunt u contact met ons opnemen.')
    			  else if (uur >= 6)
    			  	document.write('Goedemorgen, hier kunt u contact met ons opnemen.')
    			  else
   			      	document.write('Goedenacht, hier kunt u contact met ons opnemen.');
    
    			  </script>
				  <br/>
				  <br/>
				  <br/>
                  <?
                        
                // e-mail formlier
                echo '<form id="form" class="form" method="post">
                    <ul>
					<li>
                    <label for="naam">Naam:</label>
                    <input type="text" id="naam" name="naam" value="' . (isset($_POST['naam']) ? htmlspecialchars($_POST['naam']) : '') . '" required />
					</li>
                    <li>
                    <label for="mail">E-mailadres:</label>
                    <input type="email" id="mail" name="mail" value="' . (isset($_POST['mail']) ? htmlspecialchars($_POST['mail']) : '') . '" required />
					<span class="form_hint">Formaat "naam@voorbeeld.nl"</span>
                    </li>
					<li>                      
                    <label for="onderwerp">Onderwerp:</label>
                    <input type="text" id="onderwerp" name="onderwerp" value="' . (isset($_POST['onderwerp']) ? htmlspecialchars($_POST['onderwerp']) : '') . '" required />
					</li>
                    <li>
                    <label for="bericht">Bericht:</label>
                    <textarea id="bericht" name="bericht" rows="8" style="width: 400px;" required>' . (isset($_POST['bericht']) ? htmlspecialchars($_POST['bericht']) : '') . '</textarea>
                    </li>
					<li>
					<button name="submit" id="submit" class="buttonzoek" type="submit" style="width: 125px; line-height: 10px">Versturen</button>
					</li>
					</ul>
                </form>';
		      // versturen naar
              } else {      
                // datum
                $datum = date('d/m/Y H:i:s');
                    
                $inhoud_mail = "===================================================\n";
                $inhoud_mail .= "Ingevulde contact formulier " . $_SERVER['HTTP_HOST'] . "\n";
                $inhoud_mail .= "===================================================\n\n";
                  
                $inhoud_mail .= "Naam: " . htmlspecialchars($_POST['naam']) . "\n";
                $inhoud_mail .= "E-mail adres: " . htmlspecialchars($_POST['mail']) . "\n";
                $inhoud_mail .= "Bericht:\n";
                $inhoud_mail .= htmlspecialchars($_POST['bericht']) . "\n\n";
                    
                $inhoud_mail .= "Verstuurd op " . $datum . " via het IP adres " . $_SERVER['REMOTE_ADDR'] . "\n\n";
                    
                $inhoud_mail .= "===================================================\n\n";
                  
                // spam protectie
                  
                $headers = 'From: ' . htmlspecialchars($_POST['naam']) . ' <' . $_POST['mail'] . '>';
                 
                $headers = stripslashes($headers);
                $headers = str_replace('\n', '', $headers); // Verwijder \n
                $headers = str_replace('\r', '', $headers); // Verwijder \r
                $headers = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $headers)); // Slashes van quotes
                  
                $_POST['onderwerp'] = str_replace('\n', '', $_POST['onderwerp']); // Verwijder \n
                $_POST['onderwerp'] = str_replace('\r', '', $_POST['onderwerp']); // Verwijder \r
                $_POST['onderwerp'] = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $_POST['onderwerp'])); // Slashes van quotes
                $ok = true;
                if (mail($mail_ontv, $_POST['onderwerp'], $inhoud_mail, $headers)) {
                    // spam controle
                    $_SESSION['antiflood'] = time();
                    echo 'Het contactformulier is verzonden<br /><br />
                    Bedankt voor het invullen van het contactformulier. We zullen zo spoedig mogelijk contact met u opnemen';
                } else {
                    echo 'Het contactformulier is niet verzonden<br /><br />
                    Onze excuses het contactformulier kon niet worden verzonden';
                }
              }
              ?>
  </div>
  <div id="footer">
  <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen">
        <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" /></a>&nbsp;
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" /></a>&nbsp;
        <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" /></a>
      </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script> 
<script type="text/javascript" src="scripts/jquery.gmap.min.js"></script> 
<script type="text/javascript" src="scripts/maps.js"></script>
</body>
</html>