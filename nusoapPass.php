<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	require_once('lib/nusoap.php');
	require_once('lib/class.wsdlcache.php');
	
	$soapclient = new nusoap_client("http://localhost/myquiz6/egiaztatuPasahitza.php?wsdl",true);	
	$emaitza = $soapclient->call('egiaztatuP',array( 'x'=>$_POST['pass'])); 
	
	if ($emaitza == "BALIOZKOA"){echo "Pasahitza segurua eta baliozkoa da";}
	elseif ($emaitza == "BALIOGABEA"){echo "Pasahitza tipiko da eta baliogabea da, ez da segurua";}
	else{echo "arazoa";}
?>
