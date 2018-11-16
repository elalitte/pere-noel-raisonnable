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
	    <div class="jumbotron">
			<h1 class="display-4">Un seul cadeau !</h1>
			<p class="lead">Si vous avez <strong>la chance</strong> de recevoir des cadeaux de toutes les personnes de votre famille. Il vous arrive peut-être parfois de na <strong>pas avoir besoin</strong> de tous ces cadeaux. Vous devez aussi faire des cadeaux à tout le monde, et trouver le bon cadeau pour chacun n'est <strong>pas toujours facile</strong>, ni économique.</p>
			<hr class="my-4">
			<p class="lead">Père Noël raisonnable vous permet de créer <stong>une chaîne</stong> entre toutes les personnes de votre famille, collègues ou amis. Et chacun n'a plus alors qu'<stong>un seul cadeau</stong> à faire, et n'en recevra qu'un seul. Cela vous permettra de vous concentrer pour offrir <stong>le plus beau cadeau</stong> possible à la personne qui vous sera attribuée automatiquement par le site.</p>
			<a class="btn btn-primary btn-lg" href="inscription.php" role="button">Je m'inscris !</a>
		</div>
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
