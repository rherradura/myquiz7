<?php 
	error_reporting(1);
	include 'dbConfig.php';
	if (isset($_POST['btn'])){
		$korreoa = $_POST['korreoa'];
		$izenAbizen = $_POST['izenabizen'];
		$nick = $_POST['nick'];
		$pass = $_POST['pass'];
		$passCrypt = crypt($pass,'st');
		
		$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
		$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
		$emaitza = $mysqli->query("SELECT Korreoa,IzenDeiturak,Goizizena FROM erabiltzaileak");
		$aurkitua= false;
		
		if (!$emaitza) {
			echo "Error: " . $mysqli->error . "\n";
			exit;
		}
		else{
			while ($fila = $emaitza->fetch_row()) {
				if ($fila[0] == $korreoa && $fila[1] == $izenAbizen && $fila[2] == $nick){
							$emaitza2= $mysqli->query("UPDATE erabiltzaileak SET Pasahitza='$passCrypt' WHERE Korreoa='$korreoa' AND IzenDeiturak='$izenAbizen' AND Goizizena='$nick'");
							if ($emaitza2==FALSE) {echo "Error: " . $emaitza2 . "<br>" . $mysqli->error;}
							$aurkitua=true;
				}
			}
			$emaitza->close();
		}
		$mysqli->close();
		if ($aurkitua==false){echo "Ezin izan da pasahitza berrezarri, birpasatu ez daudela datu okerrik";}
		else{echo "Pasahitza berrezarri da, ez ahaztu oraingoa";}
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>
		xhro = new XMLHttpRequest();
		xhro.onreadystatechange = function(){
			if ((xhro.readyState==4)){
				document.getElementById("emaitza").innerHTML= xhro.responseText;
			}
		}
		function pasahitzaEgiaztatu(pass){
			document.getElementById("emaitza").innerHTML= xhro.responseText;

			var g4 = document.getElementById("g4").value;
			pasahitza="pass="+g4;
			
			xhro.open("POST","nusoapPass.php", true);
			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro.send(pasahitza);
		}
		function balioztatu(){
		    var div = document.getElementById("emaitza").innerHTML;
		    if (div=='Pasahitza tipiko da eta baliogabea da, ez da segurua')
		        {alert("Ezin duzu pasahitza hori erabili");
		        return false;
		    }
		}
	</script>
	</head>
	<body style="background-color:black; color:white;">
		<h1>Pasahitza berrezarri <font size="2">*Beharrezkoa da eremu guztiak betetzea</font></h1>
		<form id="erregistratu" name="erregistratu" action="<?php echo $_SERVER['PHP_SELF'] ?>" onsubmit="balioztatu()" method="POST">
			<table>
				<tr>
					<td>  Sartu korreoa </td>
					<td colspan="3"><input name="korreoa" id="g1" type = "text" size="40"></td>
				</tr>
				<tr>
					<td> Sartu Izen-deiturak </td>
					<td colspan="3"><input name="izenabizen" id="g2" type = "text" size="40"></td>
				</tr>
				<tr>
					<td> Sartu goizizena </td>
					<td colspan="3"><input name="nick" id="g3" type = "text" size="40"></td>
				</tr>
				<tr>
					<td> Sartu pasahitza berria</td>
					<td colspan="3"><input name="pass" id="g4" type = "password" pattern=".{6,}" size="40" onchange="pasahitzaEgiaztatu(this.value)"></td>
				</tr>
				<tr>
					<td> Errepikatu pasahitza berria</td>
					<td colspan="3"><input name="errepass" id="g5" type = "password" pattern=".{6,}" size="40"/> </td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input id="btn" name="btn" type="submit" value="Berrezarri" style="background-color:grey;"/>
					<input type="reset" value="Garbitu"style="background-color:grey;"/>
					<a href="layout.php"><input type="button" value="Atzera" style="background-color:grey"/></a></td>
				</tr>
			</table>
			<div id = "emaitza" name ="emaitza" align="left"></div>
		</form>
	</body>
</html>