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

  <body>

    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <?php
	      include_once 'isconnected.php';
      ?>

      <main role="main" class="inner cover">
	  	<h3>En vous inscrivant, vous pourrez :</h3>
	  	<div >
		  	<ul>
			  	<li>Créer des listes pour chaque Noël (famille, amis, collègues),</li>
			  	<li>Inscrire les participants à ces listes,</li>
			  	<li>Créer aléatoirement une chaîne entre les participants,</li>
			  	<li>Envoyer un mail à chaque participant avec le nom de la personne à qui il doit faire un cadeau.</li>
			</ul>
	  	</div>
	  	<div>&nbsp;</div>
	  	<div>&nbsp;</div>
	  	<form action="ajoutcompte.php" method="post">
	  	<div class="form-row">
		  <div class="form-group col-md-6">
	  	    <label for="inputFirstName">Prénom</label>
	  	    <input type="text" class="form-control" id="inputFirstName" name="prenom" placeholder="Bernard">
	  	  </div>
	  	  <div class="form-group col-md-6">
	  	    <label for="inputLastName">Nom</label>
	  	    <input type="text" class="form-control" id="inputLasttName" name="nom" placeholder="Chombier">
	  	  </div>
	  	  <div class="form-group col-md-12">
	  	    <label for="inputEmail4">Email</label>
	  	    <input type="email" class="form-control" id="inputEmail4" name="email" placeholder="bchombier@gmail.com">
	  	  </div>
	  	  <div class="form-group col-md-6">
	  	    <label for="inputPassword1">Mot de passe</label>
	  	    <input type="password" class="form-control" id="inputPassword1" name="pass1" placeholder="Entrez votre mot de passe">
	  	  </div>
	  	  <div class="form-group col-md-6">
	  	    <label for="inputPassword2">Mot de passe</label>
	  	    <input type="password" class="form-control" id="inputPassword2" name="pass2" placeholder="Une seconde fois pour s'assurer qu'il n'y a pas d'erreur">
	  	  </div>
	  	</div>
	  	<div>&nbsp;</div>
	  	<button type="submit" class="btn btn-primary">Valider</button>
	  	</form>
	  </main>

      <footer class="mastfoot mt-auto">
        <div class="inner center">
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
