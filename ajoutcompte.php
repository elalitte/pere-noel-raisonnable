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
	  	
	  	include_once 'fonctions.php';
	  	include_once 'start.php';
	  	$bdd=db_connect();	
	  	
	  	if (preg_match("#^[a-zA-Z0-9._\ -]+$#", $_POST['nom']) AND preg_match("#^[a-zA-Z0-9._\ -]+$#", $_POST['prenom']) AND preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) AND $_POST['pass1'] == $_POST['pass2'] ) 
	  	{
	  	  $password = sha1($_POST['pass1']);
	  	  // On commence à tester si l'adresse entrée n'existe pas déjà
	  	  $donnees = existenceAdresseMail($_POST['email'],$bdd);
	  	  if ( $donnees['idusers'] == NULL )
	  	  // Si elle n'existe pas, on l'ajoute !
	  	  {
	  	    // On l'ajoute dans la base users
	  	    ajoutUser($_POST['prenom'],$_POST['nom'],$_POST['email'],$password,$bdd);
	  	    $_SESSION['email']=$_POST['email'];
	  	    echo "<p>Votre compte a bien été créé.</p><br />";
	  	    echo '<a href="gestionEvenements.php"><button type="submit" class="btn btn-primary">Aller à la page de gestion de vos Noëls ou événements.</button></a>';
	  	  }
	  	  else
	  	  // Sinon on indique que l'adresse existe déjà ! 
	  	  {
	  	    echo "<p>Désolé, un compte avec cette adresse email existe déjà.</p><br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page d\'inscription</button></a>';
	  	  }
	  	}
	  	else
	  	{
	  	  # Si l'adresse mail choisie est dans un format incorrect
	  	  if (preg_match("#^[a-zA-Z0-9._\ -]+$#", $_POST['nom']) == 0)
	  	  {
	  	    echo "Le format choisi pour votre nom utilise des caractères interdits.<br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page d\'inscription</button></a>';
	  	  }
	  	  else
	  	  if (preg_match("#^[a-zA-Z0-9._\ -]+$#", $_POST['prenom']) == 0)
	  	  {
	  	    echo "Le format choisi pour votre prenom utilise des caractères interdits.<br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page d\'inscription</button></a>';
	  	  }
	  	  else
	  	  if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['email']) == 0)
	  	  {
	  	    echo "Le format choisi pour votre adresse email n'est pas correct ou utilise des caractères interdits.<br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page d\'inscription</button></a>';
	  	  }
	  	  if ($_POST['pass1'] != $_POST['pass2'])
	  	  {
	  	    echo "Les deux mots de passe entrés ne sont pas les mêmes.<br /><br />";
	  	    echo '<a href="javascript:history.go(-1)"><button type="button" class="btn btn-primary">Retourner à la page d\'inscription</button></a>';
	  	  }
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