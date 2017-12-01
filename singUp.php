<?php include 'dbConfig.php';
	if (isset($_POST['submitbtn'])){
		$korreoa = $_POST['korreoa'];
		$izenAbizen = $_POST['izenabizen'];
		$nick = $_POST['nick'];
		$pass = $_POST['pass'];
		$passCrypt = crypt($pass,'st');
		
		$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
		$emaitza = $mysqli->query("SELECT Korreoa,Goizizena FROM erabiltzaileak");
		
		
		if (!$emaitza) {
			echo "Error: " . $mysqli->error . "\n";
			exit;
		}
		else{
			while ($fila = $emaitza->fetch_row()) {
				if ($fila[0] == $korreoa){echo '<body style="background-color:black"><center>
												<font style="color: red; font-size:20"> Jadanik existitzen da horrelako korreo bat, sartu beste bat mesedez</font>
												</center></body>'; return false;}
				if ($fila[1] == $nick){echo '<body style="background-color:black"><center>
												<font style="color: red; font-size:20"> Jadanik existitzen da horrelako goizizen bat, sartu beste bat mesedez</font>
												</center></body>'; return false;}	
			}
			$emaitza2= $mysqli->query("INSERT INTO erabiltzaileak (Korreoa,IzenDeiturak,Goizizena,Pasahitza) VALUES ('$korreoa','$izenAbizen','$nick','$passCrypt')");
			if ($emaitza2==FALSE) {echo "Error: " . $emaitza2 . "<br>" . $mysqli->error;}
			$emaitza->close();
		}
		$mysqli->close();
		header('Location: layout.php');
	}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>SingUp</title>
		<link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
		<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
		<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
		   
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script>

		xhro = new XMLHttpRequest();
		xhro.onreadystatechange = function(){
			if ((xhro.readyState==4)){
				document.getElementById("korBaliozko").innerHTML= xhro.responseText;
			}
		}
		
		function korreoaEgiaztatu(email){
			document.getElementById("korBaliozko").innerHTML= xhro.responseText;

			var g1 = document.getElementById("g1").value;
			emaila="email="+g1;
			
			xhro.open("POST","nusoapKorreoa.php", true);
			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro.send(emaila);
		}
		
		xhro2 = new XMLHttpRequest();
		xhro2.onreadystatechange = function(){
			if ((xhro2.readyState==4)){
				//document.getElementById("korBaliozko").innerHTML= xhro.responseText;
				document.getElementById("passBaliozko").innerHTML= xhro2.responseText;
			}
		}
		
		function pasahitzaEgiaztatu(pass){
			document.getElementById("passBaliozko").innerHTML= xhro2.responseText;

			var g4 = document.getElementById("g4").value;
			pasahitza="pass="+g4;
			
			xhro2.open("POST","nusoapPass.php", true);
			xhro2.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro2.send(pasahitza);
		}
		
		function Balioztatu(){
			var g1 = document.getElementById("g1").value; //alert(g1);
			var g2 = document.getElementById("g2").value; //alert(g2);
			var g3 = document.getElementById("g3").value; //alert(g3);
			var g4 = document.getElementById("g4").value; //alert(g4);
			var g5 = document.getElementById("g5").value; //alert(g5);
			var diva = document.getElementById("korBaliozko").innerHTML; //alert(diva);
			var diva2 = document.getElementById("passBaliozko").innerHTML; //alert(diva2);
			
			if (g1 == 'undefined' || g1 === null || g1 === ''){alert("Sartu zure korreoa!");return false;};
			if (g2 == 'undefined' || g2 === null || g2 === ''){alert("Sartu izen deiturak!");return false;};
			if (g3 == 'undefined' || g3 === null || g3 === ''){alert("Sartu goizizena!");return false;};
			if (g4 == 'undefined' || g4 === null || g4 === ''){alert("Sartu pasahitza!");return false;};
			if (g5 == 'undefined' || g5 === null || g5 === ''){alert("Sartu pasahitza errepikatuta!");return false;};
			
			if (g4!=g5){ alert("Kontuz! Sartutako pasahitza eta errepikazioa ez dira berdinak! Birspasatu"); return false;}
			
			var korreoMota = new RegExp (/^[a-z]+[0-9]{3}@ikasle\.ehu\.(eus|es)$/);
			if (!korreoMota.test(g1)){
				alert("Korreoa ez da zuzena! (Korreo adibidea: izena000@ikasle.ehu.[es/eus])"); return false;
			}
			
			var izenDeituraMota = new RegExp(/^[A-Z]{1}[a-z]+\s[A-Z]{1}[a-z]+(\s)*$/);
			if (!izenDeituraMota.test(g2)){ alert("Izena eta Abizenaren lehen hitza letra larriz"); return false;}
			
			if (diva == 'Korreoa ez dago matrikulatuta Web Sistemetan, sartu beste bat'){alert("Ezin zara erregistratu Web Sistemetan matrikulatuta egon gabe"); return false;}
			if (diva2 == 'Pasahitza tipiko da eta baliogabea da, ez da segurua'){alert("Ezin duzu pasahitza hori erabili"); return false;}
		}

	</script>
	</head>
    <body>
	<h1>Erregistratu <font size="1">*Beharrezkoa da eremu guztiak betetzea</font></h1>
		<form id="erregistratu" name="erregistratu" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" onSubmit="Balioztatu()">
			<table>
				<tr>
					<td>  Sartu korreoa </td>
					<td colspan="3"><input name="korreoa" id="g1" type = "text" size="40" onchange="korreoaEgiaztatu(this.value)"><font size="1" >adibidez: proba123@ikasle.ehu.(es/eus)</font></td>
				</tr>
				<tr>
					<td> Sartu Izen-deiturak </td>
					<td colspan="3"><input name="izenabizen" id="g2" type = "text" size="40" minlength="2"/><font size="1">Izen eta Abizen bakarra</font></td>
				</tr>
				<tr>
					<td> Sartu goizizena </td>
					<td colspan="3"><input name="nick" id="g3" type = "text" size="40" maxlenght="1" oninvalid="setCustomValidity('Gehienez hitz bat!')" 
					oninput="setCustomValidity('')"/><font size="1">Hitz bakarra</font></td>
				</tr>
				<tr>
					<td> Sartu pasahitza </td>
					<td colspan="3"><input name="pass" id="g4" type = "password" pattern=".{6,}" size="40" onchange="pasahitzaEgiaztatu(this.value)"/><font size="1">Gutxienez 6 karaktere</font></td>
				</tr>
				<tr>
					<td> Errepikatu pasahitza </td>
					<td colspan="3"><input name="errepass" id="g5" type = "password" pattern=".{6,}" size="40"/> </td>
				</tr>
				<tr>
					<td><input id="btn" name="submitbtn" type="submit" value="Erregistratu"/>
					<input type="reset" value="Garbitu"/>
					<a href="layout.php"><input type="button" value="Atzera" /></a></td>
				</tr>
			</table>
			<div id = "korBaliozko" name ="korBaliozko" align="left">Zure korreoa matrikulatuta dago Web Sistemetan?</div>
			<br/>
			<div id = "passBaliozko" name ="passBaliozko" align="left"><div>
		</form>
    </body>
</html>