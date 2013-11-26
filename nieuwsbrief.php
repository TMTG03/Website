<?
	require_once("connection.php");
			$query = " 
				SELECT 
					* 
				FROM users 
				WHERE  
			";	
			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute; 
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			} 
			while($rs=$stmt->fetch()){
    $rs['qty']=$_SESSION['basket'][$rs['productid']];
    $rs['total'] += $rs['qty']*$rs['price'];
    $total += $rs['total'];
    $a[] = $rs;
}






//zuidholland
			$query = " 
				SELECT 
					* 
				FROM babykaartjes 
				WHERE 
					provincie = Zuid-Holland 
			";			
			 
			try { 
				$stmt = $db->prepare($query); 
				$result = $stmt->execute; 
			} catch(PDOException $ex) {
				die("FOUT: " . $ex->getMessage()); 
				$PDOException = true;
			} 
		

  
	
   


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>


</body>
</html>