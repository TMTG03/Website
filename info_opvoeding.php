<? require_once('connection.php') ?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Info :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/switcher.js"></script>
<script src="scripts/jquery.scrollTo-1.4.3.1-min.js"></script>
<script src="scripts/script.js"></script>
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
  <div id="titelbalk">Informatie</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content">
  <br/>
  <br/>
  <h1 class="info_knop">Welkom op de informatie pagina van babyberichten.nl!</h1>
  Hier vind u de volgende informatie:
  <div id="nav-list">
  <a href="#idElement1">Vruchtbaarheid</a><p>
  <a href="#idElement2">De zwangerschap</a><p>
  <a href="#idElement3">Opvoeding</a><p>
  <a href="#idElement4">Webshops</a><p><br>
  
  <div id="idElement1">
     <h1 class="info_knop">Over de website</h1>
     Op deze website vind je allerlei informatie over zwanger worden, zwanger zijn en de bevalling.<br>
     Als u op zoek bent naar informatie over vruchtbaarheid, zwangerschapstesten, voeding tijdens de zwangerschap, voorbereiding op de bevalling of over de kraamweken kunt u hier de informatie vinden.<br>
      Een zwangerschap kun je grofweg in drie fases onderscheiden: zwanger worden, zwanger zijn en de bevalling. We zullen ze hier alle 3 behandelen.<br>
    </div>  
    <div id="idElement2">    
    <h1 class="info_knop">Vruchtbaarheid</h1><br>
    Als je zwanger wil worden, is het belangrijk dat zowel jij als je partner vruchtbaar zijn.<br>
    Als het na een jaar niet gelukt is om zwanger te raken, kun je laten onderzoeken wat hier de oorzaak van is en behandelingen ondergaan.<br>
    </div>
    
    <div id="idElement3">Onvruchtbaarheid<br>
	Voor een verminderde vruchtbaarheid of onvruchtbaarheid zijn verschillende verklaringen.<br>
    Bijvoorbeeld een ongezonde levensstijl of onvoldoende zaadcellen. <br>
    Er bestaan een aantal behandelingen om desondanks toch zwanger te raken.<br>
     </ div>   
    <div id="idElement3"> </ div> 
    <div id="idElement4"> </ div>  
  <a class="toNav" href="#nav-list">Terug naar boven</a>
</div>
  
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen">
        <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp;
        <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" alt="" /></a>&nbsp;
        <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" alt="" /></a>
      </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>