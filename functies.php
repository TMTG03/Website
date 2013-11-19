<?

function tab1(){	
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