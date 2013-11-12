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
  <div id="titel">Informatie</div>
  <div id="container_content">
  <? require_once('lorum.txt') ?>
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
</body>
</html>