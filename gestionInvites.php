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
	      if ($_POST['evenement'] == NULL)
	      {
		      $_POST['evenement'] = $_GET['evenement'];
	      }
      ?>

      <main role="main" class="inner cover">
	  	<br/>
        <h3>Liste des participants à l'événement "<?php echo $_POST['evenement']; ?>"</h3>
	  	<div>&nbsp;</div>
	  	<div>&nbsp;</div>
	  	<div class="col-md-4">
	  	<?php 
		   	affich_invites($_POST['evenement'], $_SESSION['email'], $bdd);
		?>
		</div>
	  	<div>&nbsp;</div>
	  	<form action="ajoutInvite.php" method="post">
		<div class="row">
	  	  <div class="col">
			  <input type="text" class="form-control" name="nomInvite" placeholder="Nom/Pseudo">
	  	  </div>
	  	  <div class="col">
              <input type="email" class="form-control" name="email" placeholder="Adresse email">
	  	  </div>
	  	  	  <input type="hidden" name="evenement" value="<?php echo $_POST['evenement']; ?>" />
          <div class="col">
              <button type="submit" class="btn btn-primary">Ajouter l'invité</button>
          </div>
	  	</div>
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
