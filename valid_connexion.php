<?php

include_once 'fonctions.php';
include_once 'start.php';

?>
<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content=" Site pour un Noël responsable">
    <meta name="author" content="Eric Lalitte">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Le site du père Noël raisonnable.</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="cover.css" rel="stylesheet">
  </head>

  <body class="text-center">

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <?php
	      include_once 'isconnected.php';
      ?>

      <main role="main" class="inner cover">
	  	<?php

	  	$bdd=db_connect();	
	  	
	  	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email'])) 
	  	{
		  $session=log_ok($_POST['email'], $_POST['password'], $bdd);
		  if (isset($session['email'])) {
			  echo "tutu";
			  $_SESSION=$session;
			  header('Location: gestionEvenements.php');
		  }
	  	}
	  	else
	  	{
		  	echo "Le format choisi pour votre adresse email n'est pas correct ou utilise des caractères interdits.<br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page de connexion.</button></a>';
	  	}
	  		
	  	?>

      </main>

      <footer class="mastfoot mt-auto">
        <div class="inner">
          <p>Copyright Eric Lalitte.</p>
        </div>
      </footer>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>