<?php include 'dbConfig.php';
	$korreoa = $_POST['korreoa'];
	$izenAbizen = $_POST['izenabizen'];
	$nick = $_POST['nick'];
	$pass = $_POST['pass'];
	$passCrypt = crypt($pass,'st');
	
	$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
	$emaitza = $mysqli->query("SELECT * FROM erabiltzaileak");
	$aurkitua=false;
	
	if (!$emaitza) {
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}
	else{
		while ($fila = $emaitza->fetch_row() || $aurkitua==false) {
			if ($fila[0] == $korreoa || $fila[1] == $izenAbizen || $fila[2] == $nick){
				$emaitza2= $mysqli->query("UPDATE erabiltzaileak SET Pasahitza='$passCrypt' WHERE (Korreoa='$korreoa',IzenDeiturak='$izenAbizen',Goizizena='$nick')");
				if (!$emaitza2) {echo "Error: " . $emaitza2 . "<br>" . $mysqli->error;}
				$aurkitua=true;
			}
		}
		echo 'Pasahitza berrezarri duzu, ez ahaztu!';
		$emaitza->close();
	}
	$mysqli->close();
?>