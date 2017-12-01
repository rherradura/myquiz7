<?php
session_start();
include 'dbConfig.php';
	$id = $_SESSION['updateId'];
	$korreoa = $_SESSION['updateEmail'];
	$galderak = $_POST['galdera'];
	$eZuzena = $_POST['zuzena'];
	$eOkerra1 = $_POST['okerra1'];
	$eOkerra2 = $_POST['okerra2'];
	$eOkerra3 = $_POST['okerra3'];
	$zailtasuna = $_POST['zaila'];
	$gaiak = $_POST['gaia'];
	
	if ($galderak == 'undefined' || $galderak === null || $galderak === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko galdera bat!";return false;};
	if ($eZuzena == 'undefined' || $eZuzena === null || $eZuzena === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko erantzun zuzen bat!";return false;};
	if ($eOkerra1 == 'undefined' || $eOkerra1 === null || $eOkerra1 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko lehenengo erantzun okerra!";return false;};
	if ($eOkerra2 == 'undefined' || $eOkerra2 === null || $eOkerra2 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko bigarrengo erantzun okerra!";return false;};
	if ($eOkerra3 == 'undefined' || $eOkerra3 === null || $eOkerra3 === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko hirugarrengo erantzun okerra!";return false;};
	if ($zailtasuna == 'undefined' || $zailtasuna === null || $zailtasuna === '' || $zailtasuna>5 ||$zailtasuna<1){echo "Zerbitzariko segurtasunak dio:Sartu baliozko zailtasun bat!";return false;};
	if ($gaiak == 'undefined' || $gaiak === null || $gaiak === ''){echo "Zerbitzariko segurtasunak dio:Sartu baliozko galderaren gai arloa!";return false;};
	
	$mysqli = new mysqli($zerbitzaria,$erabiltzailea,$pasahitza,$db);
	
	$emaitza = $mysqli->query("UPDATE questions SET Korreoa='$korreoa',Galdera='$galderak',Erantzun_ona='$eZuzena', Erantzun_okerra_1='$eOkerra1', Erantzun_okerra_2='$eOkerra2', Erantzun_okerra_3='$eOkerra3',Zailtasuna='$zailtasuna',Gai_arloa='$gaiak' WHERE ID='$id'");
	
	if ($emaitza==TRUE) {
?>
		<td colspan="3">Datuak ondo eguneratu dira datu basean</td>
<?php
	}else{
		echo "Error: " . $emaitza . "<br>" . $mysqli->error;
	}
	$mysqli->close();		
 ?>
	</table>
 </body>
</html>