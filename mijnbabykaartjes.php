<? require_once('connection.php');

if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
}
?>
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
  <div id="titelbalk">Mijn babykaartjes</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content">
  	<br/>
 	<br/>
    <?
		$id = $_SESSION['user']['id'];
		
		$opdracht = "SELECT * FROM babykaartjes WHERE userid='$id'";
		
		try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		

		$rij = $stmt->fetchAll();
		
		
		if(!empty($rij)){		
			echo "<table border='1' width='960px'>";
			echo "<tr>";
			echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
			echo "<td style='font-family: OpenSans-Bold'>T.V.</td>";
			echo "<td style='font-family: OpenSans-Bold'>Achternaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Roepnaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Geboortedatum</td>";
			echo "<td style='font-family: OpenSans-Bold'>Bewerken</td>";
			echo "<td style='font-family: OpenSans-Bold'>Verwijderen</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
		
			foreach($rij as $persoon){
				
				$hetid = $persoon['id'];
	
				echo "<tr>";
				echo "<td height='20px'>" . $persoon['naam'] . "</td>";
				echo "<td height='20px'>" . $persoon['tussenvoegsel'] . "</td>";
				echo "<td height='20px'>" . $persoon['achternaam'] . "</td>";
				echo "<td height='20px'>" . $persoon['roepnaam'] . "</td>";
				echo "<td height='20px'>" . $persoon['geboortedatum'] . "</td>";
				echo "<td height='20px'><a href='babykaartjesupdate_profiel.php?id=" . $hetid . "'><img src='img/edit.png' alt='Bewerken' width='20%'/></a></td>";
				echo "<td height='20px'><a href='babykaartjesdelete_profiel.php?id=" . $hetid . "'><img src='img/edit.png' alt='Verwijderen' width='20%'/></a></td>";
				echo "</tr>";
			}
			echo "</table>";
		}else{
			echo "U heeft nog geen babykaartjes toegevoegd, Maak <a href='babykaartjestoevoeg.php'>Hier</a> uw babykaartje.<br /><br />
				<p>Heeft u moeite met het inloggen of uploaden van een babykaartje. Klik dan <a href='img/pdf/Handleiding_babyberichten.pdf'>Hier!</a></p>";	
		}
	?>    
		
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