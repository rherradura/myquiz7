<header id="goiburua">
	Sartu aldatu nahi duzun ID: <input type="text" name="id" id="id"/>
	<button onclick="aldatu()">Aldatu</button>
</header>
<footer style="overflow: auto; height: 140px">
	<table border="2">
		<tr>
			<td bgcolor="black" style="color:white;"> Galderen ID </td>
			<td bgcolor="black" style="color:white;"> Korreoa </td>
			<td bgcolor="black" style="color:white;"> Galdera </td>
			<td bgcolor="black" style="color:white;"> Erantzun zuzena </td>
			<td bgcolor="black" style="color:white;"> Erantzun okerra (1) </td>
			<td bgcolor="black" style="color:white;"> Erantzun okerra (2) </td>
			<td bgcolor="black" style="color:white;"> Erantzun okerra (3) </td>
			<td bgcolor="black" style="color:white;">Zailtasun maila</td>
			<td bgcolor="black" style="color:white;">Gai arloa</td>
		</tr>
		
	<?php include 'dbConfig.php';

	$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
	$emaitza = $mysqli->query("SELECT ID,Korreoa,Galdera,Erantzun_ona, Erantzun_okerra_1, Erantzun_okerra_2, Erantzun_okerra_3,Zailtasuna,Gai_arloa FROM questions");

	if (!$emaitza) {
		echo "Error: " . $mysqli->error . "\n";
		exit;
	}
	else{
		if ($emaitza->num_rows === 0) { echo "Datu basea hutsik dago!";}
		else{
			while ($fila = $emaitza->fetch_row()) {
	?> 
				<tr>
					<td><?=$fila[0]?></td>
					<td><?=$fila[1]?></td>
					<td><?=$fila[2]?></td>
					<td><?=$fila[3]?></td>
					<td><?=$fila[4]?></td>
					<td><?=$fila[5]?></td>
					<td><?=$fila[6]?></td>
					<td><?=$fila[7]?></td>
					<td><?=$fila[8]?></td>
				</tr>
	<?php
			}
		}
		$emaitza->close();
	}
	$mysqli->close();
	?>
</footer>