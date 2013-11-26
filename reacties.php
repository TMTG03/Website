<? require_once("connection.php"); ?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Reacties :.</title>
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
          <li class='last'><a href='contact.php'><span>Contact</span></a></li>
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
  <div id="container_content">
  <?
  if((isset($_POST["reageer"]))) {
	  $reactie = $_REQUEST['bericht'];
	  //datum ophalen
	  $now = time();
	  $num = date("w");
	  if ($num == 0)
   	  { $sub = 6; }
	  else { $sub = ($num-1); }
	  $WeekMon  = mktime(0, 0, 0, date("m", $now)  , date("d", $now)-$sub, date("Y", $now));
	  $todayh = getdate($WeekMon); 

	  $d = $todayh[mday] + 1;
	  $m = $todayh[mon];
	  $y = $todayh[year];
	  //eind datum ophalen
	  $datumreactie = ("$d-$m-$y");
	  $gebruikersnaam = $_SESSION['gebruikersession'];
	  $idbabykaart;
	  $opdracht = "SELECT * FROM babykaartjes WHERE id='$idbabykaart'";
	  $opdracht2 = "INSERT INTO reacties (babyid, bericht, datumreactie, gebruikersnaam) VALUES ('$idbabykaart', '$reactie', '$datumreactie', '$gebruikersnaam')";
	  if(mysql_error){
		  echo mysql_error;
		  }
  }else{
  ?>
  <form action="info2.php" method="post">
  Reactie: <textarea name="bericht" cols="" rows="">
  </textarea>
  <br>
  <input name="reageer" value="Reageer" type="submit">
  </form>
  <? } ?>
  </div>  
  <div id="footer">
  <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen">
        <a href="http://www.google.nl" target="_blank"><img src="img/google.png" /></a>&nbsp;
        <a href="http://www.facebook.com" target="_blank"><img src="img/facebook.png" /></a>&nbsp;
        <a href="http://www.twitter.com" target="_blank"><img src="img/twitter.png" /></a>&nbsp;
      </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </div>
</div>
</body>
</html>