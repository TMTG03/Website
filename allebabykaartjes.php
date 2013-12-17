<? require_once('connection.php') ?>
<!doctype html>
<html manifest="thema.appcache" class="no-js" lang="en">
<head>
<meta charset="utf-8">
<title>.: Alle babykaartjes :.</title>
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
          <? } else { ?>
          <li class='has-sub'><a href='ingelogd.php'><span>Account</span></a>
            <ul>
              <li class='last'><a href='logout.php'><span>Uitloggen</span></a></li>
            </ul>
          </li>
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
  <div id="titelbalk">Alle babykaartjes</div>
  <hr class="schaduw_lijn"></hr>
  <div id="container_content2">
   <div id="zoek_minimize">
	  <div id="zoek_links_minimize">
      Zoek op provincie
	  </div>
    <div id="zoekbar_rechts_minimize">
    <form id="form_zoek" class="form_zoek" method="post">
      <div id="zoekbar_rechts_vak2_onder_minimize" class="dropdownpijl_minimize">
        <select name="provincie">
          <option value="">&nbsp;&nbsp;Selecteer provincie</option>
          <optgroup label="Noord Nederland">
          <option value="Groningen">Groningen</option>
          <option value="Friesland">Friesland</option>
          <option value="Drenthe">Drenthe</option>
          <option value="Noord-Holland">Noord-Holland</option>
          </optgroup>
          <optgroup label="Midden Nederland">
          <option value="Overijsel">Overijssel</option>
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
        <button name="zoekverzend" class='buttonzoek' style="width: 125px; height: 36px; float: left; text-align: center; " type="submit">Zoeken</button>
      </div>
    </form>
  </div>

<?
	// Als de knop ingedrukt is voert die dit uit
	if((isset($_POST["zoekverzend"]))) 
	{
		// deze haalt provincie uit het veld provincie in de formulier
		$provincie = $_POST['provincie'];
		// check als de provincie leeg is
		if (!$provincie == "")
		{
			// zoekfunctie die zoekt op provincie
			$provinciecheck = " provincie LIKE '%".$provincie."%' OR " . "";		
		}
		// sql query die alles uit de tabel babykaartjes ophaald		
		$opdracht = "SELECT * FROM babykaartjes WHERE" . $provinciecheck;

		$opdracht = substr($opdracht, 0, -4);
		
		//PDO resultaat database
		try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		// Hier worden alle velden samengevoegd
		$rij = $stmt->fetchAll();
		
		// Als er meer rijen dan 0 zijn worden de resultaten geladen
		if(count($rij) > 0) {
				// laten zien welke provincie geselecteerd zijn
				echo "Deze volgende resultaten uit uw provincie " . $provincie . " zijn nu zichtbaar<br/><br/><br/><br/>";
				// nieuwe tabel voor babykaartjes
				echo "<table border='1' width='1100px'>";
				echo "<tr>";
				echo "<td style='font-family: OpenSans-Bold'>Plaatje</td>";
				echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
				echo "<td style='font-family: OpenSans-Bold'>T.V.</td>";
				echo "<td style='font-family: OpenSans-Bold'>Achternaam</td>";
				echo "<td style='font-family: OpenSans-Bold'>Roepnaam</td>";
				echo "<td style='font-family: OpenSans-Bold'>Geboortedatum</td>";
				echo "</tr>";
				echo "<tr>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "<td>&nbsp;</td>";
				echo "</tr>";
				
				// foreach loop die rij als persoon weergeeft
				foreach($rij as $persoon){
					// persoonsid word hier opgehaald
					$hetid = $persoon['id'];
					echo "<tr>";
					// hier worden alle eigenschappen van de persoon weergeven in een tabel
					echo "<td height='20px'>" . "<a href='babykaartjes_enkel.php?id=" . $persoon['id'] . "'><img src='../database/plaatjes/klein/" .  $persoon['plaatje'] . "' width='100' height='100' /></a> </td>";
					echo "<td height='10px'>" . $persoon['naam'] . "</td>";
					echo "<td height='10px'>" . $persoon['tussenvoegsel'] . "</td>";
					echo "<td height='10px'>" . $persoon['achternaam'] . "</td>";
					echo "<td height='10px'>" . $persoon['roepnaam'] . "</td>";
					echo "<td height='10px'>" . date("d-m-Y", strtotime($persoon['geboortedatum'])) . "</td>";
					echo "</tr>";
					
				}
					echo "</table>";
					// als er geen velden zijn laat die zien in welke provincie er geen velden zijn
			} else {
			echo "Helaas er zijn geen geboortekaartjes gevonden binnen uw provincie " . $provincie . ".";
		}
	}
	?>   

     
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