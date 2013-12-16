<?
	if((isset($_POST["zoekverzend"]))) 
	{
		
		$naam = $_POST['naam'];
		$provincie = $_POST['provincie'];
		$geboortedatum = $_POST['datum'];
		$geslacht = $_POST['geslacht'];
		
		if (!$provincie == "")
		{
			$provinciecheck = " provincie LIKE '%".$provincie."%' OR " . "";		
		}
			
		if (!$naam == "")
		{
			$naamcheck = " naam LIKE '%".$naam."%' OR " . "";	
		}
		
		if (!$geboortedatum == "")
		{
			$dobcheck = " geboortedatum LIKE '%".$geboortedatum."%' OR " . "";	
		}
		
		if (!$geslacht == "")
		{
			$geslachtcheck = " geslacht LIKE '%".$geslacht."%' OR " . "";	
		}
		
		$opdracht = "SELECT * FROM babykaartjes WHERE" . $naamcheck . $provinciecheck . $dobcheck . $geslachtcheck;

		$opdracht = substr($opdracht, 0, -4);
		
		try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		

		$rij = $stmt->fetchAll();
		
			echo "<table border='1' width='400px'>";
			echo "<tr>";
			echo "<td style='font-family: OpenSans-Bold'>Naam</td>";
			echo "<td style='font-family: OpenSans-Bold'>T.V.</td>";
			echo "<td style='font-family: OpenSans-Bold'>Achternaam</td>";
			echo "<td style='font-family: OpenSans-Bold'>Provincie</td>";
			echo "<td style='font-family: OpenSans-Bold'>Geslacht</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "<td>&nbsp;</td>";
			echo "</tr>";
	
		foreach($rij as $persoon){
			
			$hetid = $persoon['id'];
			$hetgoedeid = $hetid.$persoon['id'];
			echo "<tr>";
			echo "<td height='20px'>" . $persoon['naam'] . "</td>";
			echo "<td height='20px'>" . $persoon['tussenvoegsel'] . "</td>";
			echo "<td height='20px'>" . $persoon['achternaam'] . "</td>";
			echo "<td height='20px'>" . $persoon['provincie'] . "</td>";
			echo "<td height='20px'>" . $persoon['geslacht'] . "</td>";
			echo "</tr>";
		}
			echo "</table>";
	}		
?>
