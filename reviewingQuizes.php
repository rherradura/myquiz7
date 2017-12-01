<?php
	session_start();
	if ($_SESSION['email']!=="Irakaslea"){
		echo'<body style="background-color:black"><center>
		<font style="color: white; font-size:20"> EZ ZARA IRAKASLE BEZALA ERREGISTRATU, EZIN ZARA ZATI HONETARA SARTU</font>
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
		
		function showQuizClick(){
			document.getElementById("emaitza").innerHTML= "";
			xhro.open("GET","showAddQuestionTeacher.php",true);
			xhro.send();
		}
		
		function aldatu(){
			var id = document.getElementById("id").value;
			ID="id="+id;
			
			xhro.open("POST","changeQuiz.php", true);
			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro.send(ID);
		}
		
		function saveClick(){
			var g0 = document.getElementById("g0").value;
			var g1 = document.getElementById("g1").value;
			var g2 = document.getElementById("g2").value;
			var g3 = document.getElementById("g3").value;
			var g4 = document.getElementById("g4").value;
			var g5 = document.getElementById("g5").value;
			var g6 = document.getElementById("g6").value;
			//alert(g0);alert(g1);alert(g2);alert(g3);alert(g4);alert(g5);alert(g6);
						
			if (g0 == 'undefined' || g0 === null || g0 === ''){alert("Galdera ez da zuzena!");return false;}
			if (g1 == 'undefined' || g1 === null || g1 === ''){alert("Erantzun zuzena ez da zuzena!");return false;}
			if (g2 == 'undefined' || g2 === null || g2 === ''){alert("Erantzun okerra 1 ez da zuzena!");return false;}
			if (g3 == 'undefined' || g3 === null || g3 === ''){alert("Erantzun okerra 2 ez da zuzena!");return false;}
			if (g4 == 'undefined' || g4 === null || g4 === ''){alert("Erantzun okerra 3 ez da zuzena!");return false;}
			if (g5 == 'undefined' || g5 === null || g5 === ''){alert("Zailtasun maila ez da zuzena!");return false;}
			if (g6 == 'undefined' || g6 === null || g6 === ''){alert("Identifikazioa ez da zuzena!");return false;}
			if (g5<1 || g5>5){alert("Zailtasuna 1 eta 5 artean izan behar da!");return false;}
			fDatuak="galdera="+g0+"&zuzena="+g1+"&okerra1="+g2+"&okerra2="+g3+"&okerra3="+g4+"&zaila="+g5+"&gaia="+g6;
			
			xhro.open("POST","updateQuestion.php", true);
			xhro.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			xhro.send(fDatuak);
			
			if(!xhro){document.getElementById("emaitza").innerHTML= 'Arazoa datuak sartzerakoan';}
			else{
				document.getElementById("emaitza").innerHTML= 'Datuak ondo gorde dira';
				document.getElementById("emaitza2").innerHTML='<button onclick="showDBClick()">Ikusi nire DBko galderak</button>';
			}
		}
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
		<span><a href="reviewingQuizes.php?q=home" style="color: blue;">Home</a></span>
		<span onclick="showQuizClick()" style="text-decoration: underline; color: blue;">Ikusi edo aldatu galderak</span>	
		<span onclick="credits()" style="text-decoration: underline; color: blue;">Credits</span>
	</nav>
    <section class="main" id="s1">
		<div id="emaitza">Hemen agertuko da informazioa!
		<?php
			if(isset($_GET['q'])&&($_GET['q']=='home')){
				echo '<script>document.getElementById("emaitza").innerHTML="";</script>Hemen agertuko da informazioa!';
			}
		?>
	</div>
    </section>
	<footer class='main' id='f1'>
		<p align ="right"><a href="http://en.wikipedia.org/wiki/Quiz" target="_blank" style="color: blue;">What is a Quiz?</a></p>
		<p align ="right"><a href='https://github.com' style="color: blue;">Link GITHUB</a></p> 	
	</footer>
</div>
</body>
</html>