<?php
	$index=$gestion=$inscription=$connexion="";
	switch ($_SERVER['PHP_SELF']) {
	    case "/pere-noel-raisonnable/index.php":
		$index = "active";
        	break;
	    case "/pere-noel-raisonnable/gestionEvenements.php":
		$gestion = "active";
        	break;
	    case "/pere-noel-raisonnable/inscription.php":
		$inscription = "active";
        	break;
        case "/pere-noel-raisonnable/connexion.php":
		$connexion = "active";
        	break;
	    }
	  	if (isset($_SESSION['email']))
	  	{
	  	echo '        <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand"><a class="nav-link" href="index.php">pere-noel-raisonnable.fr</a></h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link '.$index.'" href="index.php">Accueil</a>
            <a class="nav-link '.$gestion.'" href="gestionEvenements.php">Mes évènements</a>
            <a class="nav-link" href="deconnexion.php">Se déconnecter</a>
          </nav>
        </div>
      </header>';
	  	}
	  	else
	  	{
	  	  echo '        <header class="masthead mb-auto">
        <div class="inner">
          <h3 class="masthead-brand"><a class="nav-link" href="index.php">pere-noel-raisonnable.fr</a></h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link '.$index.'" href="index.php">Accueil</a>
            <a class="nav-link '.$inscription.'" href="inscription.php">S\'inscrire</a>
            <a class="nav-link '.$connexion.'" href="connexion.php">Connexion</a>
          </nav>
        </div>
      </header>';
	  	}
?>