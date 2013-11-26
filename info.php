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
  Hier vind u de volgende informatie:<p>
  <a href="info_zwangerschap.php">De zwangerschap</a><p>
  <a href="info_opvoeding.php">Opvoeding</a><p>
  <a href="info_webshops.php">Webshops</a><p><br>
  <div id="idElement1">
     <h1 class="info_knop">Over de website</h1>
     <p>
     Welkom op de website van babyberichten.nl, hier kunt u de volgende dingen doen:<p><br>
     -	Informatie over de zwangerschap opzoeken.<p>
     -	Geboortekaartjes zoeken die gefilterd kunnen worden per provincie.<p>
     -	Zelf Geboortekaartjes uploaden.<p>
     - 	Aanmelden voor de automatische nieuwsbrief.<p>
     -	En een kaart bekijken met alle geboortekaartjes erop.<p><br>
     
     <h1 class="info_knop">Werking van de site</h1>
    <p><br>
     Op de hoofdpagina kunt u gelijk gemakkelijk zoeken naar geboortekaartjes, daarbij kunt u zoeken op naam, provincie, geboorte datum en geslacht.<p>
     Als u naar de babykaartjes gaat kom u in het overzicht met alle geboortekaartjes. <p>
     Al wilt u zelf geboortekaartjes uploaden moet u ingelogd zijn, daarna kunt u via de knop toevoegen zelf uw geboorte bekend maken. <p>
     Ook kunt u hier oude geboortekaartjes aanpassen, geboortekaartjes verwijderen en uw inlog gegevens wijzigen. <p>
     Verder is er nog een contact pagina waar u buggs kunt melden en vragen kunt stellen.<p><br>
     
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