<?php
session_start();

error_reporting(1);
include 'dbConfig.php';
$id = $_POST['id'];
$_SESSION['updateId']=$id;

$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
$emaitza = $mysqli->query("SELECT Korreoa,Galdera,Erantzun_ona, Erantzun_okerra_1, Erantzun_okerra_2, Erantzun_okerra_3,Zailtasuna,Gai_arloa FROM questions WHERE ID = '$id'");

if (!$emaitza) {
	echo "Error: " . $mysqli->error . "\n";
	exit;
}
else{
	if ($emaitza->num_rows === 0) {
		echo "Datu basean ez da existitzen ID horrekin tuplarik!"; 	
	}
	else{
		while ($fila = $emaitza->fetch_row()) {
			$_SESSION['updateEmail']=  $fila[0];
?> 			
			<form id="erregistratu" name="erregistratu" method="POST">
				<table><font style="color:red; font-size:10;">Kontuan izan! Baliogabeko datuak sartzekotan hasieratik hasi beharko duzula!</font>
					<tr>
						<td align="left">Galdera:</td>
						<td><input type="text" id="g0" name="g0" value="<?=$fila[1]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Erantzun zuzena:</td>
						<td><input type="text" id="g1" name="g1" value="<?=$fila[2]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Erantzun okerra (1):</td>
						<td><input type="text" id="g2" name="g2" value="<?=$fila[3]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Erantzun okerra (2):</td>
						<td><input type="text" id="g3" name="g3" value="<?=$fila[4]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Erantzun okerra (3):</td>
						<td><input type="text" id="g4" name="g4" value="<?=$fila[5]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Zailtasun maila:</td>
						<td><input type="text" id="g5" name="g5" value="<?=$fila[6]?>" size="30"/></td>
					</tr>
					<tr>
						<td align="left">Gai-arloa:</td>
						<td><input type="text" id="g6" name="g6" value="<?=$fila[7]?>" size="30"/></td>
						<td rowspan="7"><button onclick="saveClick()">Gorde aldaketa</button></td>
					</tr>
				</table>
			</form>
<?php
		}
	}
	$emaitza->close();
}
$mysqli->close();
?>
