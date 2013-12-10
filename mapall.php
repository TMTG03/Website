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
              <li class='has-sub'><a href='#'><span>Babykaartjes</span></a>
                <ul>
                  <li><a href='babykaartjestoevoeg.php'><span>Toevoegen</span></a></li>
                  <li><a href='#'><span>Aanpassen</span></a></li>
                  <li class='last'><a href='#'><span>Verwijderen</span></a></li>
                </ul>
              </li>
              <li class='has-sub'><a href='mapall.php'><span>Babymaps</span></a></li>
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
      </div>
    </div>
  </div>
  <div class="blauwelijn"></div>
  <div id="tussen_balk"></div>
  <div id="titelbalk">Babymaps</div>
  <hr class="schaduw_lijn"/>
  <div id="container_content">
	<style>
    #map-canvas {
    width: auto;
    height: 600px;
    }
    </style>
  	<? require_once("mapmultiple.php"); ?>
    </div>
    <div id="map-canvas" style="margin-top:-30px"></div>
  </div>
  <div id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen"> <a href="https://plusone.google.com/_/+1/confirm?hl=en&url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" /></a>&nbsp; <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" /></a>&nbsp; <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" /></a> </div>
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