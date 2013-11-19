<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>

<?
	require_once("connection.php");
	$opdracht = "SELECT * FROM users";
	$result = mysql_query($opdracht);
	while ($Rij = mysql_fetch_array($result)){
		if ($provincie == "Groningen")
		{
			$opdracht2 = "SELECT * FROM babyberichten WHERE $provincie = Groningen";
		}
		if ($provincie == "Zuid-Holland")
		{
			$opdracht2 = "SELECT * FROM babyberichten WHERE $provincie = Zuid-Holland";
		}
	}

	

	
  
	
   


?>
</body>
</html>