<?php

// La fonction prend en paramètre une adresse et va envoyer un mail à cette adresse
function envoiMail($adresseMail, $prochaineAdresse) {
	// on remplace l'adresse par le nom
	switch ($prochaineAdresse) {
	    case "eric@lalitte.com":
		$cadeau = "Eric";
        	break;
	    case "juliette.blestel@gmail.com":
		$cadeau = "Juliette";
        	break;
	    case "blestel@de-pardieu.com":
		$cadeau = "Alex";
        	break;
	    case "christine.estay@hotmail.fr":
		$cadeau = "Christine";
        	break;
	    case "vblestel@hotmail.com":
		$cadeau = "Vincent";
        	break;
	    case "emmanuellebertuzzi@gmail.com":
		$cadeau = "Emmanuelle";
        	break;
	    case "camille.blestel@gmail.com":
		$cadeau = "Camille";
        	break;
	    case "clemenceblestel@gmail.com":
		$cadeau = "Clémence";
        	break;
	    case "arnaud.blestel@gmail.com":
		$cadeau = "Arnaud";
        	break;
	    case "alice.mounier@gmail.com":
		$cadeau = "Alice";
        	break;
	}

        $to = $adresseMail;
	$subject = "Votre cadeau de Noël de la famille Blestel !";
	
	$message = "
	<html>
	  <head>
	    <title>A qui devrez-vous faire un cadeau ?</title>
	  </head>
	  <body>
	    <p>Chère famille,</p>
	    <p>Si vous recevez ce mail, c'est que le père Noël vous a choisi.</p>
	    <p>Comme convenu, à ce Noël, vous n'aurez à faire qu'un seul cadeau à une seule personne. Même si rien ne vous empêche d'en faire d'autres.</p>
	    <p>Il faut donc que votre cadeau soit formidable !</p> 
	    <p>Mais comme vous n'en avez qu'un seul à faire, vous aurez le temps pour vous creuser les méninges et faire plaisir à l'heureux élu.</p>
	    <p>Et d'ailleurs, l'heureux élu à qui vous devrez faire le cadeau est : <strong>".$cadeau."</strong>.</p>
	    <p>A vous de lui faire plaisir !</p>
	    <img src='https://blackburnempire.com/TMNEW/wp-content/uploads/2016/12/Santa-Needs-You.jpg'>
	  </body>
	</html>
	";
	
	$headers[] = 'MIME-Version: 1.0';
	$headers[] = 'Content-type: text/html; charset=UTF-8';
	//$headers[] = 'To: elalitte@gmail.com';
	$headers[] = 'From: Père Noël des Blestel <eric@lalitte.com>';
	
	$success = mail($to, $subject, $message, implode("\r\n", $headers));
	if (!$success) {
	  $errorMessage = error_get_last()['message'];
	}
}

// On liste les utilsateurs dans un tableau
$listUsers=["eric@lalitte.com", "juliette.blestel@gmail.com", "blestel@de-pardieu.com", "alice.mounier@gmail.com", "christine.estay@hotmail.fr", "vblestel@hotmail.com", "emmanuellebertuzzi@gmail.com", "camille.blestel@gmail.com", "clemenceblestel@gmail.com", "arnaud.blestel@gmail.com"];
//$listUsers=["eric@lalitte.com", "elalitte@fastmail.fm", "elalitte@gmail.com"];
// On les mélange
shuffle($listUsers);
// On ouvre un fichier pour stocker l'ordre de la chaine
$monfichier = fopen('chaineNoelBlestel.txt', 'r+');

// On parcourt la chaine adresse par adresse
for ($i = 0; $i < count($listUsers); $i++) {
	// On ajoute l'adresse dans le fichier
	fputs($monfichier, $listUsers[$i]."\n");
	// Et on lui écrit un mail
	  // Si c'est le dernier, il fait un cadeau au premier
	if ($i == count($listUsers)-1 ) {
		envoiMail($listUsers[$i], $listUsers[0]);		
	} else {
		envoiMail($listUsers[$i], $listUsers[$i+1]);		
	}	 
}

// On ferme le fichier
fclose($monfichier);
?>
