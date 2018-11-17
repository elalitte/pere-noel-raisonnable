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
	      $bdd=db_connect();
      ?>

      <main role="main" class="inner cover">
	  	<h3>Ici, vous pourrez :</h3>
	  	<div>
		  	<ul>
			  	<li>Voir la liste de vos événements,</li>
			  	<li>Créer des événements comme vos Noëls,</li>
			  	<li>Accéder à la liste des invités d'un événement,</li>
			  	<li>Effacer ces événements.</li>
			</ul>
	  	</div>
          <p>Cliquez sur un événement pour ajouter des participants</p>
	  	<div>&nbsp;</div>
	  	<div>&nbsp;</div>
	  	<div class="col-md-4">
	  	<?php 
		  	affich_evenements($_SESSION['email'], $bdd);
		?>
		</div>
		<div>&nbsp;</div>
	  	<div>&nbsp;</div>
	  	<form action="ajoutEvenement.php" method="post">
		<div class="form-group">
		  <label for="exampleInputEmail1">Evènement</label>
		  <input type="text" class="form-control" id="evenement" name="evenement" placeholder="Ajoutez un futur évènement.">
		</div>
		<br/>
		<button type="submit" class="btn btn-primary">Ajouter l'évènement</button>
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
