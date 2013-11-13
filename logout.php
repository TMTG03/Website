<? 
    require_once("connection.php"); 
    unset($_SESSION['user']);
    header("Location: login.php?logout=true"); 
    die("doorlinken naar login.php?logout=true");