<? 
    require_once("connection.php"); 
	// sessie verwijderen zodat de gebruiker is uitgelogd
    unset($_SESSION['user']);
	// doorlinken naar login met een variable om te filteren dat er uitgelogd is
    header("Location: login.php?logout=true"); 
    die("doorlinken naar login.php?logout=true");
	// we willen natuurlijk geen trailing white spaces zien...
	// vandaar dat we php niet afsluiten hier
	//
	// http://php.net/manual/en/language.basic-syntax.instruction-separation.php