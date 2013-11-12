<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>.: Index :.</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/themaslider.min.js"></script>
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
      <div id="logo_plek"><a href="index.php" id="logo"><img width="333px" src="img/logo.png" border="0"></a></div>
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
          <li><a href='#'><span>Informatie</span></a></li>
          <li><a href='#'><span>Inloggen</span></a></li>
          <li class='last'><a href='#'><span>Contact</span></a></li>
        </ul>
              <div id="styleswitchen">
              	<div id="styleswitchvak1"></div>
                <div id="styleswitchvak2"></div>
                <div id="styleswitchvak3"></div>
              </div>
      </div>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="slider">
  <div id="demo" class="themaslider">
<ul>
<li>
<img src="img/slides/1.jpg" />
 <div class="slide-desc">
		<h2>Baby 1</h2>
		<p>Beschrijving</p>
  </div>
</li>
<li><img src="img/slides/2.jpg" />
   <div class="slide-desc">
		<h2>Baby 2</h2>
		<p>Beschrijving</p>
  </div>
</li>
<li><img src="img/slides/3.jpg" />
  <div class="slide-desc">
		<h2>Baby 3</h2>
		<p>Beschrijving</p>
  </div>
</li>
</ul>
</div>
  </div>
  <div id="zoekbar">
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
			<div id="zoekbar_rechts_vak1_onder"><input type="text" name="#"></div>
            <div id="zoekbar_rechts_vak2_onder" class="dropdownpijl"><select>
            <option style="color: #cccccc;">Selecteer provincie</option>
                <optgroup label="Noord Nederland">
                <option value="groningen">Groningen</option>
                <option value="friesland">Friesland</option>
                <option value="drenthe">Drenthe</option>
                <option value="nholland">Noord-Holland</option>
            </optgroup>
            <optgroup label="Midden Nederland">
                <option value="overijsel">Overijsel</option>
                <option value="gelderland">Gelderland</option>
                <option value="utrecht">Utrecht</option>
                <option value="zholland">Zuid-Holland</option>
                <option value="flevoland">Flevoland</option>
            </optgroup>
                <optgroup label="Zuid Nederland">
                <option value="zeeland">Zeeland</option>
                <option value="nbrabant">Noord-Brabant</option>
                <option value="limburg">Limburg</option>
            </optgroup>
            </select></div>
            <div id="zoekbar_rechts_vak3_onder"><input type="date" name="#" class="dropdownkalender"></div>
            <div id="zoekbar_rechts_vak4_onder">
            <select>
            <option></option>
            <option value="man">M</option>
            <option value="vrouw">V</option>
            </select>
            </div>
            <div id="zoekbar_rechts_vak5_onder"><p class='buttonzoek' style='float: left; width: 125px; text-align: center'>ZOEK</p></div>
        </div>
    </div>
  </div>
  <div id="container_content">
  	<div id="carousel_vak1"></div>
    <div id="carousel_vak2"></div>
    <div id="carousel_vak3"></div>
    <div id="carousel_kop1">
    	<p class="carouselkoptekst">Baby 1</p><br/>
		<p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
    <div id="carousel_kop2">
    	<p class="carouselkoptekst">Baby 2</p><br/>
        <p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
    <div id="carousel_kop3">
    	<p class="carouselkoptekst">Baby 3</p><br/>
        <p class="carouselonder_koptekst">Hier komt een quote</p>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="footer">
  	<div id="footer_content">
    	<div id="footer_socialmedia_iconen">
        <a href="http://www.google.nl" target="_blank"><img src="img/google.png" border="0"></a>&nbsp;<a href="http://www.facebook.com" target="_blank"><img src="img/facebook.png" border="0"></a>&nbsp;<a href="http://www.twitter.com" target="_blank"><img src="img/twitter.png" border="0"></a>&nbsp;<a href="http://www.flickr.com" target="_blank"><img src="img/flickr.png" border="0"></a>
        </div>
        <div id="footer_copyright"><p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p></div>
    </div>
  </div>
</div>
</body>
</html>