<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>functies</title>
</head>

<body>
<?
function tab1(){
require_once("connection.php");

$query = "SELECT * FROM babykaartjes WHERE id = 4"; 
$result = mysql_query($query) or die ("Fout in de opdracht: $query. ".mysql_error()); 
if (mysql_num_rows($result) > 0) { 
	while($row = mysql_fetch_row($result)) { 
		echo "<tr>";
		echo "<td>" . $row[1] . "</td>";
		echo "<td> <img src='../../../database/MEOF1/" . $row[2] . "' /> </td>";
		echo "<td> <img src='../../../database/MEOF1/thumb_" . $row[2] . "' /> </td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Geen rijen in de database gevonden"; 
} 
}
?>
</body>
</html>