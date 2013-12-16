<?
	require_once("connection.php");
	//datum ophalen
	$todayh = getdate(); 
	$d = $todayh[mday];
	$m = $todayh[mon];
	$y = $todayh[year];
	$datum = ("$y-$m-$d");
	
	
	$opdracht = "SELECT email FROM users";
	

	
	try {
			$stmt = $db->prepare($opdracht); 
			$result = $stmt->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		$mail = $stmt->fetchAll();
		
	$opdracht2 = "SELECT * FROM babykaartjes WHERE datum='$datum'";
	try {
			$stmt2 = $db->prepare($opdracht2); 
			$result = $stmt2->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		$rij = $stmt2->fetchAll();

	
		
		
		
		foreach($mail as $email)
		{
			$to = $email['email'];
			$subject = "Nieuwsbrief";
			$headers = "babyberichten@ict-lab.nl";
			$inhoud_mail = "===================================================\n";
			$inhoud_mail .= "De nieuwsbrief\n";
			$inhoud_mail .= "===================================================\n\n";
			  
			$inhoud_mail .= "Geboorte kaarten van vandaag: \n";
			
			foreach($rij as $kaartje)
			{
				$inhoud_mail .= "===================================================\n";
				$inhoud_mail .=	"Naam: ". $kaartje['naam'] . "\n";
				$inhoud_mail .=	"Tussenvoegsel: ". $kaartje['tussenvoegsel'] . "\n";
				$inhoud_mail .=	 "Achternaam: ". $kaartje['achternaam'] . "\n";
				$inhoud_mail .=	 "Roepnaam: ". $kaartje['roepnaam'] . "\n";
				$inhoud_mail .=	 "Geboortedatum: ". $kaartje['geboortedatum'] . "\n";
				$inhoud_mail .=	 "Adres: ". $kaartje['adres'] . "\n";
				$inhoud_mail .=	 "Postcode: ". $kaartje['postcode'] . "\n";
				$inhoud_mail .=	 "Geboorteplaats: ". $kaartje['geboorteplaats'] . "\n";
				$inhoud_mail .=	 "Geslacht: ". $kaartje['geslacht'] . "\n";
				$inhoud_mail .=	 "Bericht: ". $kaartje['bericht'] . "\n";
				$inhoud_mail .=	 "<a href=Klik hier om het kaartje te bekijken: ". $kaartje['bericht'] . "\n";
				$inhoud_mail .= "===================================================\n";
					
			}
				
			
				
			
	 
		$headers = stripslashes($headers);
		$headers = str_replace('\n', '', $headers); // Verwijder \n
		$headers = str_replace("\"", "\\\"", str_replace("\\", "\\\\", $headers)); // Slashes van quotes
		  
			mail($to,$subject,$inhoud_mail,$headers);
		}
		echo "$inhoud_mail <br>";
		echo "$to <br>";
		echo "$datum <br>";
		
		



		

  
	
   


?>
