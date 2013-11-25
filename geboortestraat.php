<?php
// stel de connection data in
$geo_host = '127.0.0.1';
$geo_user = 'geonl';
$geo_pass = 'geonl';
$geo_db   = 'dbgeonl';

// maak verbinding met de database
$db = mysql_connect($geo_host, $geo_user, $geo_pass);
mysql_select_db($geo_db, $db);

// lees de ingevoerde letters
$term = $_GET["term"];

// beveilig evt. speciale tekens
$term = str_replace("'", "\\'", urldecode($term));

// maak de query
$sql = "SELECT DISTINCT `cityname`.`name` AS `city`, `province`.`name` AS `province` FROM `city` JOIN `cityname` ON `city`.`id` = `cityname`.`city_id` JOIN `province` ON `city`.`province_id` = `province`.`id` WHERE `cityname`.`name` LIKE '%" . $term . "%' AND `cityname`.`official` = 1 AND `cityname`.`active` = 1 AND `city`.`municipality_id` IS NOT NULL ORDER BY `cityname`.`name` ASC, `province`.`name` ASC";

// voer de query uit
$result = mysql_query($sql, $db);

// lees de resultaten van de query
while ($row = mysql_fetch_array($result))
{
	// lees de provincie uit
	$province = $row["province"];
	
	// bepaal de afkorting per provincie
	switch ($province)
	{
		case "Drenthe":
			$prov_short = "Drenthe";
			break;
		case "Flevoland":
			$prov_short = "Flevoland";
			break;
		case "Friesland":
			$prov_short = "Friesland";
			break;
		case "Gelderland":
			$prov_short = "Gelderland";
			break;
		case "Groningen":
			$prov_short = "Groningen";
			break;
		case "Limburg":
			$prov_short = "Limburg";
			break;
		case "Noord-Brabant":
			$prov_short = "Noord-Brabant";
			break;
		case "Noord-Holland":
			$prov_short = "Noord-Holland";
			break;
		case "Overijssel":
			$prov_short = "Overijssel";
			break;
		case "Utrecht":
			$prov_short = "Utrecht";
			break;
		case "Zeeland":
			$prov_short = "Zeeland";
			break;
		case "Zuid-Holland":
			$prov_short = "Zuid-Holland";
			break;
	}
	
	// sla de stadsnaam met de provincie-afkorting er achter op in een array
	$cities[] = $row["city"] . " (" . $prov_short . ")";
}

// toon de array in JSON formaat
echo json_encode($cities);
?>