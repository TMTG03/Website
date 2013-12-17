<?
require_once("connection.php");

$opdracht = "SELECT 
				 naam, email, provincie
			 FROM
				 users
			 WHERE
				 nieuwsbrief='1'";

try {
	$stmt = $db->prepare($opdracht); 
	$result = $stmt->execute();
} catch(PDOException $ex) {
	// TODO: verwijder de 'die' op uiteindelijke website
	die("FOUT: " . $ex->getMessage()); 
}

$rij = $stmt->fetchAll();

foreach($rij as $persoon) {
	
    $provincie = $persoon['provincie'];
	$datum = date("Y-m-d");
	$opdracht = "SELECT 
					 *
				 FROM
					 babykaartjes
				 WHERE
					 provincie='$provincie'
				 AND
				     datum='$datum'";
	
	try {
		$stmt = $db->prepare($opdracht); 
		$result = $stmt->execute();
	} catch(PDOException $ex) {
		// TODO: verwijder de 'die' op uiteindelijke website
		die("FOUT: " . $ex->getMessage()); 
	}
	
	$rij2 = $stmt->fetchAll();
	
	if (count($rij2) > 0) {
		$inhoud_mail = "Hallo " . htmlspecialchars($persoon['naam']) . "! \n\n";
		$inhoud_mail .= "Er zijn vandaag " . count($rij2) . " nieuwe babykaartjes gepost in uw provincie \n";
		$inhoud_mail .= "De volgende baby kaartjes zijn vandaag gepost,\n\n";
		foreach($rij2 as $baby) {
			$inhoud_mail .= $baby['vader'] . " en " . $baby['moeder'] . " hebben een baby kaartjes gepost voor " . $baby['naam'] . " die geboren is te " . $baby['geboorteplaats'] . "\n";
		}
		$inhoud_mail .= "\n";
		$inhoud_mail .= "Dit bericht is automatisch gegenereerd door babyberichten.nl\n";
		$inhoud_mail .= "U kunt zich afmelden voor deze berichten door de nieuwsbrief voorkeur in uw profiel te wijzigen \n";
		  
		$headers = 'From: babyberichten.nl <noreply@babyberichten.nl>';
		
		$inhoud_mail = str_replace("($provincie)", "", $inhoud_mail);
		
		print_r($inhoud_mail);
	
		mail($persoon['email'], 'Nieuwe baby kaartjes gepost', $inhoud_mail, $headers);
	}

}
?>  
