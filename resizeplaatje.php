<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>resizeplaatje</title>
</head>

<body>
<?
function resizejpeg($map, $plaatje, $maximale_breedte, $maximale_hoogte, $thumb_breedte, $thumb_hoogte, $ext)
{
    list($orginele_breedte, $orginele_hoogte, $or_t) = getimagesize($map.$plaatje);
	$ratio = ($orginele_hoogte / $orginele_breedte);

	if ($ext == "image/jpeg") {
		$or_image = imagecreatefromjpeg($map.$plaatje);
	} else if ($ext == "image/gif") {
		$or_image = imagecreatefromgif($map.$plaatje);
	}

	if ($orginele_breedte > $maximale_breedte || $orginele_hoogte > $maximale_hoogte) {

		if ($orginele_breedte > $maximale_breedte) {
			$rs_breedte = $maximale_breedte;
			$rs_hoogte = $ratio * $maximale_hoogte;
		} else {
			$rs_breedte = $orginele_breedte;
			$rs_hoogte = $orginele_hoogte;
		}

		if ($rs_hoogte > $maximale_hoogte) {
			$rs_breedte = $maximale_breedte / $ratio;
			$rs_hoogte = $maximale_hoogte;
		}

		$rs_image = imagecreatetruecolor($rs_breedte, $rs_hoogte);
		imagecopyresampled($rs_image, $or_image, 0, 0, 0, 0, $rs_breedte, $rs_hoogte, $orginele_breedte, $orginele_hoogte);
	} else {
		$rs_breedte = $orginele_breedte;
		$rs_hoogte = $orginele_hoogte;

		$rs_image = $or_image;
	}

	if ($ext == "image/jpeg") {
		imagejpeg($rs_image, $map.$plaatje, 150);
	} else if ($ext == "image/gif") {
		imagegif($rs_image, $map.$plaatje, 150);
	}

	$th_image = imagecreatetruecolor($thumb_breedte, $thumb_hoogte);

	$nieuwe_breedte = (($rs_breedte / 4));
	$nieuwe_hoogte = (($rs_hoogte / 4));

	imagecopyresized($th_image, $rs_image, 0, 0, $nieuwe_breedte, $nieuwe_hoogte, $rs_breedte, $rs_hoogte, $rs_breedte, $rs_hoogte);

	if ($ext == "image/jpeg") {
		imagejpeg($th_image, $map.'thumb_'.$plaatje, 150);
	} else if ($ext == "image/gif") {
		imagegif($th_image, $map.'thumb_'.$plaatje, 150);
	}

	return true;
    
}

function extensiecheck(){
require_once("connection.php");
	$tabel = "babykaartjes";
	$titel = $_REQUEST['naam'];
	$naam = $_FILES['file']['name'];
	$sql = "INSERT INTO $tabel (naam, bestand) VALUES ('$titel', '$naam')";
	
	if (!file_exists("../database/plaatjes/" . $naam)) {
		$toegestaan = array("gif", "jpeg", "jpg", "png");
		$temp = explode(".", $naam);
		$extensie = end($temp);
		if ((($_FILES["file"]["type"] == "image/gif")
		|| ($_FILES["file"]["type"] == "image/jpeg")
		|| ($_FILES["file"]["type"] == "image/jpg")
		|| ($_FILES["file"]["type"] == "image/pjpeg"))
		&& in_array($extensie, $toegestaan)) {
			if ($_FILES["file"]["error"] > 0) {
				echo "Fout: " . $_FILES["file"]["error"] . "<br>";
			} else if (file_exists("../database/plaatjes/", $naam)) {
				echo "Deze afbeelding is al eerder geupload!";
			}
			
			mysql_query($sql);
			move_uploaded_file($_FILES['file']['tmp_name'], "../database/plaatjes/" . $naam);
			resizejpeg("../database/plaatjes/", $naam, 200, 200, 150, 150, $_FILES["file"]["type"]);
			echo "Uw afbeelding is geupload<br/>";
		} else {
			echo "Gebruik een bestand met de extensie jpg, jpeg, png of gif";
			echo $_FILES["file"]["type"];
		}
	} else {
		echo "Deze afbeelding is al eerder geupload!";
	}
}
?>
</body>
</html>