<?
//connection toevoegen
require_once("connection.php");
//controlleren of er ingelogd is
if(empty($_SESSION['user'])) { 
	header("Location: login.php"); 
	die("Doorlinken naar login.php");
}

//id opvragen
$id = $_GET[id];
echo "$id";
//gegevens verwijderen
$sql = "DELETE FROM babykaartjes WHERE id =  $id";

$stmt = $db->prepare($sql);  
$stmt->execute();
header('Location: http://tmtg03.ict-lab.nl/website/overzichtdelete.php');
/*$opdracht = "SELECT plaatje FROM babykaartjes WHERE id = $id ";
try {
			$stmt2 = $db->prepare($opdracht); 
			$result = $stmt2->execute();
		} catch(PDOException $ex) {
			// TODO: verwijder de 'die' op uiteindelijke website
			die("FOUT: " . $ex->getMessage()); 
		}
		
		$rij = $stmt2->fetchAll();
		foreach($rij as $veld){
		$afbeelding = $veld['plaatje'];
		}
		$file = "../database/klein/".$afbeelding;
		$file2 = "../database/groot/".$afbeelding;
		delete($file);
		delete($file2);*/
?>
<!doctype html>
<html manifest="thema.appcache">
<head>
<meta charset="utf-8">
<link rel="icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
<link rel="stylesheet" type="text/css" href="css/style.css" title="default">
<link rel="roze stylesheet" type="text/css" href="css/style_roze.css" title="roze" />
<link href="css/autocomplete.css" rel="stylesheet" type="text/css" />
<link rel="blauwroze stylesheet" type="text/css" href="css/style_blauw_roze.css" title="blauwroze" />
<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
<script src="http://code.jquery.com/jquery.js"></script>
<script type="text/javascript" src="scripts/jquery-1.8.2.js"></script>
<script type="text/javascript" src="scripts/jquery-ui-1.9.0.custom.min.js"></script>
<script src="scripts/switcher.js"></script>
<script type="text/javascript">

	
	$(document).ready(function() {
    var elements = document.getElementsByTagName("INPUT");
    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = function(e) {
            e.target.setCustomValidity("");
            if (!e.target.validity.valid) {
                e.target.setCustomValidity("Vul dit veld in");
            }
        };
        elements[i].oninput = function(e) {
            e.target.setCustomValidity("");
        };
    }
})
	</script>
</head>
<body>
  	
</body>
</html>