<? require_once('connection.php'); 
if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
} 
if($headerto == true){
header("Location: http://tmtg03.ict-lab.nl/website/ingelogd.php#profielaanpas");	
}
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<title>.: Profiel :.</title>
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script src="scripts/switcher.js"></script>
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
  <div id="titelbalk">Mijn profiel</div>
  <hr class="schaduw_lijn">
  </hr>
  <div id="container_content"> <br/>
  	<div class="uitklappen vertical">
    
    	  <section id="mijnprofiel">
		      <h2><a href="#mijnprofiel">Profiel</a></h2>
		      <p>
              	<?
				$id = $_SESSION['user']['id'];
			  	$opdracht = "SELECT * FROM users WHERE id='$id'";;	
				try {
					$stmt = $db->prepare($opdracht); 
					$result = $stmt->execute();
				} catch(PDOException $ex) {
					// TODO: verwijder de 'die' op uiteindelijke website
					die("FOUT: " . $ex->getMessage()); 
				}
				
				$rij = $stmt->fetch();
				
				$name = $rij['naam'];
				$username = $rij['gebruikersnaam'];
				$dob = $rij['geboortedatum'];
				$provincie = $rij['provincie'];
				$email = $rij['email'];

				//leeftijd calc
				$beginDate = $dob;
			    $endDate = date("Y-m-d");
              	$date_parts1 = explode("-", $beginDate);
				$date_parts2 = explode("-", $endDate);
				$start_date = gregoriantojd($date_parts1[1], $date_parts1[2], $date_parts1[0]);
				$end_date = gregoriantojd($date_parts2[1], $date_parts2[2], $date_parts2[0]);
				$diff = abs($end_date - $start_date);
				$years = floor($diff / 365.25);
				
				
				echo "<table border='1' width='700px'>";
				echo "<tr>";
				echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
				echo "<td style='font-family: OpenSans-Bold'>Gebruikersnaam</td>";
				echo "<td style='font-family: OpenSans-Bold'>Provincie</td>";
				echo "<td style='font-family: OpenSans-Bold'>Geboortedatum</td>";
				echo "<td style='font-family: OpenSans-Bold'>Email</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>" . $name . "</td>";
				echo "<td>" . $username . "</td>";
				echo "<td>" . $provincie . "</td>";
				echo "<td>" . $dob . " (" . $years . ")" . "</td>";
				echo "<td>" . $email . "</td>";
				echo "</tr>";
				echo "</table>";
              	?>
              </p>
		  </section>
    	  <section id="profielaanpas">
		      <h2><a href="#profielaanpas">Profiel aanpassen</a></h2>
		      <p><br />
              	<?
                $id = $_SESSION['user']['id'];
                $opdracht = "SELECT * FROM users WHERE id='$id'";	
				try {
					$stmt = $db->prepare($opdracht); 
					$result = $stmt->execute();
					$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				} catch(PDOException $ex) {
					// TODO: verwijder de 'die' op uiteindelijke website
					die("FOUT: " . $ex->getMessage()); 
				}
				
				$rij = $stmt->fetch();
				
				echo $rij['naam'];
				
              	?>
	              <FORM name='aanpasform' method='post' action=''>
					<table width="400" border="1">
					  <tr>
					  	<input type='hidden' name='pasveld' value='<? echo $rij['id']; ?>'/>
					  	<td height="35px">Naam:</td>
					    <td height="35px"><input type='text' name='nmveld' value='<? echo $rij['naam']; ?>'/></td>
					  </tr>
					  <tr>
					    <td height="35px">Geboortedatum:</td>
					    <td height="35px"><input type='text' name='dobveld' value='<? echo $rij['geboortedatum']; ?>'/></td>
					  </tr>
					  <tr>
					    <td height="35px">Provincie:</td>
					    <td height="35px"><input type='text' name='proveld' value='<? echo $rij['provincie']; ?>'/></td>
					  </tr>
					  <tr>
					    <td height="35px">Email:</td>
					    <td height="35px"><input type='text' name='emveld' value='<? echo $rij['email']; ?>'/></td>
					  </tr>
					  <tr>
					  	<td height="1px"></td>
					  	<td height="1px"></td>
					  </tr>
					  <tr>
					    <td>&nbsp;</td>
					    <td><input class='buttonzoek' style='margin-left: -2px' type='submit' name='aanpasknop' value='Aanpassen' /></td>
					  </tr>
					</table>
				  </FORM>
                <?
				if(isset($_REQUEST["aanpasknop"]))
				{
					$mijnid = $_REQUEST["pasveld"];	
					$mijnnaam = $_REQUEST["nmveld"];
					$mijndob = $_REQUEST["dobveld"];
					$mijnpro = $_REQUEST["proveld"];
					$mijnem = $_REQUEST["emveld"];
					
					echo $mijndob;
					
					$opdracht2 = "UPDATE users SET naam='$mijnnaam', geboortedatum='$mijndob', provincie='$mijnpro', email='$mijnem' WHERE id='$id'";
					try {
						$stmt = $db->prepare($opdracht2); 
						$result = $stmt->execute();
						echo "hetwerkt";
					} catch(PDOException $ex) {
						// TODO: verwijder de 'die' op uiteindelijke website
						die("FOUT: " . $ex->getMessage());
					}
					$headerto = true;
				}
				?>
              </p>
		  </section>
		  <section id="babytoevoeg">
		      <h2><a href="#babytoevoeg">Babykaartje toevoegen</a></h2>
              <p><? require_once ('babykaartjestoevoeg_profiel.php'); ?></p>
		  </section>
		 <section id="babyzoek">
		      <h2><a href="#babyzoek">Babykaartjes zoeken</a></h2>
		      <p></p>
		  </section>
		  <section id="babykaartmaps">
		      <h2><a href="#babykaartmaps">Baby Maps</a></h2>
		      <p><? require_once('mapmultiple.php'); ?></p>
              <div id="map-canvas2"></div>
		  </section>
		</div>
		<a href="logout.php"><button class='buttonzoek' style="width: 125px; height: 36px; float: right; margin-right: 57px; text-align: center;">Uitloggen</button></a>
    <br/>
  </div>
  <footer id="footer">
    <div class="blauwelijn"></div>
    <div id="footer_content">
      <div id="footer_socialmedia_iconen"> <a href="https://plusone.google.com/_/+1/confirm?hl=en&amp;url=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/google.png" alt="" /></a>&nbsp; <a href="https://www.facebook.com/sharer/sharer.php?u=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/facebook.png" alt="" /></a>&nbsp; <a href="http://twitter.com/home?status=http://tmtg03.ict-lab.nl/website" target="_blank"><img src="img/twitter.png" alt="" /></a> </div>
      <div id="footer_copyright">
        <p class="copyright_tekst">&copy; 2013 www.babyberichten.nl</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>