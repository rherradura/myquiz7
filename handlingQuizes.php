<?php
	session_start();
	if (empty($_SESSION['email']) || $_SESSION['email']=="Ezezaguna" || $_SESSION['email']=="Irakaslea"){
		echo'<body style="background-color:black"><center>
		<font style="color: white; font-size:20"> EZ ZARA ERREGISTRATU, EZIN ZARA ZATI HONETARA SARTU</font>
		<p><a href="logIn.php" style="color: red; font-size:50">LOGEATU</a></p>
		</center></body>';
		return false;
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Quizzes</title>
    <link rel='stylesheet' type='text/css' href='stylesPWS/style.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='stylesPWS/wide.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='stylesPWS/smartphone.css' />
		   
	<script type="text/javascript" language = "javascript">
		xhro = new XMLHttpRequest();
		xhro.onreadystatechange = function(){
		if ((xhro.readyState==4)){
			document.getElementById("emaitza").innerHTML= xhro.responseText;}
		}
		function credits(){
			document.getElementById("emaitza").innerHTML= "";
			xhro.open("GET","credits.php",true);
			xhro.send();
		}
			
		function addPhpClick(){
			var g2 = document.getElementById("g2").value;
			var g3 = document.getElementById("g3").value;
			var g4 = document.getElementById("g4").value;
			var g5 = document.getElementById("g5").value;
			var g6 = document.getElementById("g6").value;
			var zail = document.getElementById("cmb").value;
			var g7 = document.getElementById("g7").value;
						
			if (g2 == 'undefined' || g2 === null || g2 === ''){alert("Sartu galdera bat!");return false;};
			if (g3 == 'undefined' || g3 === null || g3 === ''){alert("Sartu erantzun zuzen bat!");return false;};
			if (g4 == 'undefined' || g4 === null || g4 === ''){alert("Sartu lehenengo erantzun okerra!");return false;};
			if (g5 == 'undefined' || g5 === null || g5 === ''){alert("Sartu bigarrengo erantzun okerra!");return false;};
			if (g6 == 'undefined' || g6 === null || g6 === ''){alert("Sartu hirugarrengo erantzun okerra!");return false;};
			if (g7 == 'undefined' || g7 === null || g7 === ''){alert("Sartu galderaren gai arloa!");return false;};
			
			fDatuak="galdera="+g2+"&zuzena="+g3+"&okerra1="+g4+"&okerra2="+g5+"&okerra3="+g6+"&zaila="+zail+"&gaia="+g7;
			
			xhro.open("POST","addQuestionAJAX.php", true);
			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro.send(fDatuak);
			
			if(!xhro){document.getElementById("emaitza").innerHTML= 'Arazoa datuak sartzerakoan';}
			else{
				document.getElementById("emaitza").innerHTML= 'Datuak ondo gorde dira';
				document.getElementById("emaitza2").innerHTML='<button onclick="showDBClick()">Ikusi nire DBko galderak</button>';
			}
		}
		
		function showDBClick(){
			document.getElementById("emaitza").innerHTML= "";
			xhro.open("GET","showAddQuestionAJAX.php",true);
			xhro.send();
		}
		
		/*function showAllDBClick(){
			document.getElementById("emaitza").innerHTML= "";
			xhro.open("GET","showAddQuestion.php",true);
			xhro.send();
		}
		
		function showAllXMLClick(){
			document.getElementById("emaitza").innerHTML= "";
			xhro.open("GET","showXMLQuestion.php",true);
			xhro.send();
		}*/
	</script>   
		
  </head>
  <body>
  <div id='page-wrap'>
	<header class='main' id='h1'>
			<span class="right">Erabiltzailea: <?=$_SESSION['email']?></span>
			<span class="right"><a href=layout.php style="color: blue;">LogOut</a> </span>
	<h2>Quiz: crazy questions</h2>
    </header>
	<nav class='main' id='n1' role='navigation'>
		<span><a href="handlingQuizes.php?q=home" style="color: blue;">Home</a></span>
		<span><a href="handlingQuizes.php?q=nireak" style="color: blue;">Maneiatu nire galderak</a></span>
		<!--<span onclick="showAllDBClick()" style="text-decoration: underline; color: blue;">Ikusi DB galdera guztiak</span>
		<span onclick="showAllXMLClick()" style="text-decoration: underline; color: blue;">Ikusi XML galdera guztiak</span>
		<span><a href=questions.xml style="color: blue;">Ikusi XML fitxategia</a></span>-->	
		<span onclick="credits()" style="text-decoration: underline; color: blue;">Credits</span>
	</nav>
    <section class="main" id="s1">
	<div id="emaitza" style="overflow: auto; height: 160px">Hemen agertuko da informazioa! 
	<?php
		if(isset($_GET['q'])&&($_GET['q']=='home')){
			echo '<script>document.getElementById("emaitza").innerHTML="";</script>Hemen agertuko da informazioa!';
		}
		if(isset($_GET['q'])&&($_GET['q']=='nireak')){
			echo '<script>document.getElementById("emaitza").innerHTML="";</script>
			<button onclick="showDBClick()">Ikusi nire DBko galderak</button>
			<form id="galderenF" name="galderenF" method="POST">
			<table>
				<tr>
					<td align="left"> Sartu galdera </td>
					<td colspan="5"><input name="galdera" id="g2" type = "text" size="80" minlength="10" /></td>
				</tr>
				<tr>
					<td align="left"> Sartu erantzun zuzena </td>
					<td colspan="5"><input name="zuzena" id="g3" type = "text" size="80"/></td>
				</tr>
				<tr>
					<td align="left"> Sartu erantzun okerra (1) </td>
					<td colspan="5"><input name="okerra1" id="g4" type = "text" size="80"/></td>
				</tr>
				<tr>
					<td align="left"> Sartu erantzun okerra (2) </td>
					<td colspan="5"><input name="okerra2" id="g5" type = "text" size="80"/> </td>
				</tr>
				<tr>
					<td align="left"> Sartu erantzun okerra (3) </td>
					<td colspan="5"><input name="okerra3" id = "g6" type = "text" size="80"/></td>
				</tr>
				<tr>
					<td align="left">Sartu zailtasun maila</td>
					<td><select name="zaila" id="cmb">
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
						</select></td>
				
					<td align="left">Sartu gai arloa</td>
					<td><input name="gaia" id="g7" type ="text"/></td>
					<td><button onclick="addPhpClick()">Balioztatu eta gorde</button></td>
				</tr>
			</table>
		</form>';
		}
	?>
	</div>
	<div id="emaitza2">
	</div>
    </section>
	<footer class='main' id='f1'>
		<p align ="right"><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank" style="color: blue;">What is a Quiz?</a></p>
		<p align ="right"><a href='https://github.com' style="color: blue;">Link GITHUB</a></p> 	
	</footer>
</div>
</body>
</html>