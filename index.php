<? require_once('connection.php') ?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Index :.</title>
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
<script>
$(document).ready(function() {
	$("#datepicker").datepicker();
});
</script>
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
  <div id="slider">
    <div id="demo" class="themaslider">
      <ul>
        <li> <img src="img/slides/1.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 1</h2>
            <p>Beschrijving</p>
          </div>
        </li>
        <li><img src="img/slides/2.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 2</h2>
            <p>Beschrijving</p>
          </div>
        </li>
        <li><img src="img/slides/3.jpg" alt="" />
          <div class="slide-desc">
            <h2>Baby 3</h2>
            <p>Beschrijving</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="zoekbar">
    <form id="form_zoek" class="form_zoek" method="post">
    <div id="zoekbar_links">
      <h2 class="zoekbar_links_header">Zoeken</h2>
      <h4 class="zoekbar_links_summary">Zoek een geboortekaartje</h4>
    </div>
    <div id="zoekbar_rechts">
      <div id="zoekbar_rechts_header">
        <div id="zoekbar_rechts_vak1">Naam:</div>
        <div id="zoekbar_rechts_vak2">Provincie:</div>
        <div id="zoekbar_rechts_vak3">Geboortedatum:</div>
        <div id="zoekbar_rechts_vak4">M/V</div>
      </div>
      <div id="zoekbar_rechts_input">
        <div id="zoekbar_rechts_vak1_onder">
          <input type="text" name="#" />
        </div>
        <div id="zoekbar_rechts_vak2_onder" class="dropdownpijl">
          <select>
            <option style="color: #cccccc;">Selecteer provincie</option>
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
        </div>
        <div id="zoekbar_rechts_vak3_onder">
          <input type="text" name="#" class="dropdownkalender" placeholder="dd-mm-YYYY" />
        </div>
        <div id="zoekbar_rechts_vak4_onder">
          <select id="MVselect">
            <option value="man">M</option>
            <option value="vrouw">V</option>
          </select>
        </div>
        <div id="zoekbar_rechts_vak5_onder">
          <p class='buttonzoek' style='float: left; width: 125px; text-align: center'>ZOEK</p>
        </div>
      </div>
    </div>
    </form>
  </div>
  <div id="container_content">
    <div id="carousel_vak1"></div>
    <div id="carousel_vak2"></div>
    <div id="carousel_vak3"></div>
    <div id="carousel_kop1">
      <p class="carouselkoptekst">Baby 1</p>
      <br/>
      <p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
    <div id="carousel_kop2">
      <p class="carouselkoptekst">Baby 2</p>
      <br/>
      <p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
    <div id="carousel_kop3">
      <p class="carouselkoptekst">Baby 3</p>
      <br/>
      <p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen">
        <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp;
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