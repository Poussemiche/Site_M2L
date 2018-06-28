<?php session_start();
      require_once 'connexion_BD.php';?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Accueil</title>

    <link href="lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="starter-template.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
      <a class="navbar-brand" href="home.php">M2L</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="reservation.php">Réservation <span class="sr-only">(current)</span></a>
          </li>
        </ul>
          <a class="text-white mr-md-2">
            <?php
            $personne_id = $_SESSION['user_id'];
            $requete = $db->prepare("SELECT per_prenom FROM personne WHERE per_id = $personne_id");
            $requete->execute();
            $per_prenom = $requete->fetch(PDO::FETCH_ASSOC);
            echo "Bonjour ";
            print($per_prenom['per_prenom']);
            echo " !"
            ?>
          </a>
        <a href="deconnexion.php" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Déconnexion</a>
      </div>
    </nav>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Mis à la fin car s'execute plus rapidement -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="lib/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="lib/js/vendor/popper.min.js"></script>
    <script src="lib/js/bootstrap.min.js"></script>
    <script src="lib/js/collapse.js"></script>
    <script src="lib/js/dropdown.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

</body>