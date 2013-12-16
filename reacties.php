<? require_once('connection.php'); ?>
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
$datumreactie = ("$y-$m-$d");
$gebruikersnaam = $_SESSION['user']['gebruikersnaam'];
$idbabykaart = $_SESSION['id'];

	if(!empty($_POST)) {
        if(empty($_POST['bericht'])) {
            $fout_naam = true;
			$sucess = false;
		}
		
		if (!$sucess) {
			
				$query = " 
				INSERT INTO reacties( 
					bericht,
					datumreactie, 
					gebruikersnaam,
					babyid
				) VALUES ( 
					:reactie, 
					:datumreactie, 
					:gebruikersnaam,
					:babyid
				) 
			";
			
			
			 
			$query_params = array(
				':reactie' => $_POST['bericht'],
				':datumreactie' => $datumreactie,
				':gebruikersnaam' => 'henk',
				':babyid' => '1',
			);
				try {
				$stmt = $db->prepare($query); 
				$result = $stmt->execute($query_params);
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			}
			if (!$PDOException) {
				$sucess = true;
			}
		}
	}
		
    
	}
	$opdracht = "SELECT * FROM reacties";

try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		

		$rij = $stmt->fetchAll();
		
		
?> 
	<div id="reacties">
    <form action="" method="post">
      Reactie:
      <textarea name="bericht" cols="" rows="">
</textarea>
      <br>
      <input name="reageer" value="Reageer" type="submit">
    </form>
   
    <?
    echo "<table border='1' width='700px'>";
		foreach($rij as $veld){
				echo "<tr>";
				echo "<tr style='font-family: OpenSans-Bold'>Naam: </tr>";
				echo "<tr>" . $veld['gebruikersnaam'] . "<br></tr>";
				echo "<tr style='font-family: OpenSans-Bold'>Datum: </tr>";
				echo "<tr>" . $veld['datumreactie'] . "<br></tr>";
				echo "<tr style='font-family: OpenSans-Bold'>Bericht: <br></tr>";
				echo "<tr>" . $veld['bericht'] . "<br></tr>";
				echo "</tr>";
				
				}
			
				echo "</table>";
	?>
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