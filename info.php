<? require_once('connection.php') ?>
<!doctype html>
<html manifest="thema.appcache" class="no-js" lang="en">
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
  <div id="titelbalk">Informatie</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content">
  		<div class="uitklappen vertical">
		  <section id="vertabout">
		      <h2><a href="#vertabout">Over de website</a></h2>
     <br><p>
     Welkom op de website van babyberichten.nl, hier kunt u de volgende dingen doen:<br />
     -        Informatie over de zwangerschap opzoeken.<br />
     -        Geboortekaartjes zoeken die gefilterd kunnen worden per provincie.<br />
     -        Zelf Geboortekaartjes uploaden.<br />
     -         Aanmelden voor de automatische nieuwsbrief.<br />
     -        En een kaart bekijken met alle geboortekaartjes erop.</p>
     
     <br />
     <p>Op de hoofdpagina kunt u gelijk gemakkelijk zoeken naar geboortekaartjes, daarbij kunt u zoeken op naam, provincie, geboorte datum en geslacht.
     Als u naar de babykaartjes gaat kom u in het overzicht met alle geboortekaartjes.
     Al wilt u zelf geboortekaartjes uploaden moet u ingelogd zijn, daarna kunt u via de knop toevoegen zelf uw geboorte bekend maken.
     Ook kunt u hier oude geboortekaartjes aanpassen, geboortekaartjes verwijderen en uw inlog gegevens wijzigen. 
     Verder is er nog een contact pagina waar u buggs kunt melden en vragen kunt stellen.</p><br />

		  </section>
		  <section id="vertservices">
	        <h2><a href="#vertservices">zwanger worden</a></h2><br>
		   <p> Als je zwanger wil worden, is het belangrijk dat zowel jij als je partner vruchtbaar zijn.<br />
    Als het na een jaar niet gelukt is om zwanger te raken, kun je laten onderzoeken wat hier de oorzaak van is en behandelingen ondergaan.<br />
    
    Voor een verminderde vruchtbaarheid of onvruchtbaarheid zijn verschillende verklaringen.
    Bijvoorbeeld een ongezonde levensstijl of onvoldoende zaadcellen. 
    Er bestaan een aantal behandelingen om desondanks toch zwanger te raken.
    De leeftijd van een vrouw is erg bepalend voor haar vruchtbaarheid. Hoe ouder, hoe minder vruchtbaar. 
    Als je moeite hebt met zwanger worden is de kans 30% dat dit aan jou ligt en 30% dat het probleem bij je partner zit. 
    In 30% van de gevallen is zowel de vrouw als de man onvruchtbaar. Bij 10% van alle stellen wordt er geen oorzaak van de onvruchtbaarheid gevonden.
    Je levensstijl kan ervoor zorgen dat je minder gemakkelijk zwanger wordt. De volgende zaken hebben een negatieve invloed op de vruchtbaarheid van de vrouw: cafeïne, alcohol, roken, medicatie,< drugs, onder- en overgewicht, soa's, te veel sporten, stress, werken met schadelijke stoffen of straling, verstoring van het dag- en nachtritme. 
    De vruchtbaarheid van de man wordt negatief beïnvloed door: alcohol, roken, medicatie, drugs, koorts, soa's, te veel sporten, stress, werken met schadelijke stoffen of straling, verstoring van het dag- en nachtritme en lange deelname aan het verkeer.</p>
		  </section>
		 <section id="vertblog">
		      <h2><a href="#vertblog">zwangerschap</a></h2>
		      <p>In de baarmoeder verandert de bevruchte eicel in 9 maanden van een embryo in een foetus van zo'n 50cm. 
              Hoewel het lichaam van de foetus zich in het 1ste trimester het meest ontwikkelt, groeit het in de maanden daarop nog flink door.<br /><br />
              Een zwangerschap is een belasting voor je lichaam. Daarom kan het zijn dat je tijdens deze periode last hebt van ongemakken. 
              Ernstiger zijn complicaties; problemen die de gezondheid van jou en je kindje in gevaar kunnen brengen.<br /><br />
              Als je zwanger bent, moet je extra goed letten op je voeding. Zo weet je zeker dat je voldoende voedingstoffen binnenkrijgt. 
              Het is niet nodig om voor 2 personen te eten, maar bewust afvallen kan erg schadelijk zijn.</p>
		  </section>
		  <section id="vertcontact">
		      <h2><a href="#vertcontact">Webshops</a></h2><br />
		      <p><a href="http://www.baby-walz.nl" target="_blank">Baby-walz</a><br /><br />
<a href="http://www.babyveilig.nl" target="_blank">Babyveiling</a><br /><br />
<a href="http://www.jutenjuul.nl" target="_blank">Jut en Juul</a><br /><br />
<a href="http://www.baby-dump.nl/" target="_blank">Baby-dump</a>
              </p>
		  </section>
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