<?php include 'header_membre.php';?>

<div class="container" style="width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto; max-width: 960px;">
	<div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" style="margin-top: 15px;" src="img/logo_m2l" alt="" width="72" height="72">
        <h2>Finalisation de la commande</h2>
    </div>
      <div class="text-center">
      	<?php $sal_nom = $_GET['sal_choix']; ?>
      	<img <?php echo 'src="img/'. $sal_nom .'.jpg"' ?> style="display: inline-block;" class="rounded img-thumbnail" alt="Responsive image" width="400" height="250">
      	<div class="col-md-4 order-md-2 mb-4" style="display: inline-block;">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
            		<span class="text-muted">Informations</span>
          		</h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Salle : <?php echo $sal_nom; ?></h6>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Horaire : <?php if($_SESSION['res_horaire'] == 1) echo '8h00 - 12h00';
                            								 if($_SESSION['res_horaire'] == 2) echo '12h00 - 16h00';
                            								 if($_SESSION['res_horaire'] == 3) echo '16h00 - 20h00';
                            								 if($_SESSION['res_horaire'] == 4) echo '20h00 - 00h00'; ?></h6>
                        </div>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Date réservation : <?php echo $_SESSION['res_date']; ?></h6>
                        </div>
                    </li>
                </ul>      
		</div>
      </div>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
	<button class="btn btn-primary text-center" type="submit" name="confirm_resa">Confirmer</button>
  </form>

  <?php
  var_dump($_POST);
//  if (!empty($_POST['confirm_resa'])){
  	var_dump($_POST);
  	require_once 'connexion_BD.php';

  	$user_id = $_SESSION['user_id'];
  	$id_type_per = $_SESSION['id_type_per'];
  	$res_date = $_SESSION['res_date'];
  	$res_horaire_id = $_SESSION['res_horaire'];	
  	$sal_id = $_GET['sal_choix'];
  	if($sal_id == 'Daum') $sal_id = 1;
  	if($sal_id == 'Galle') $sal_id = 2;
  	if($sal_id == 'Baccarat') $sal_id = 3;
  	if($sal_id == 'Corbin') $sal_id = 4;
  	if($sal_id == 'Majorelle') $sal_id = 5;
  	if($sal_id == 'Gruber') $sal_id = 6;
  	if($sal_id == 'Lamour') $sal_id = 7;
  	if($sal_id == 'Longwy') $sal_id = 8;
  	if($sal_id == 'Amphitheatre') $sal_id = 9;
  	if($sal_id == 'Restauration et Convivialite') $sal_id = 10;

	try {
  		$sql = "INSERT INTO reservation (res_per_id, res_per_typ_id, res_sal_id, res_date, res_horaire_id)
    					VALUES (:user_id, :id_type_per, :sal_id, :res_date, :res_horaire_id)";
    				$requete = $db->prepare($sql);

    				$requete->bindValue(':user_id', $user_id);
    				$requete->bindValue(':id_type_per', $id_type_per);
    				$requete->bindValue(':sal_id', $sal_id);
    				$requete->bindValue(':res_date', $res_date);
    				$requete->bindValue(':res_horaire_id', $res_horaire_id);
    				$requete->execute();
    			    echo '<div class="alert alert-success" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);" role="alert">
            <h4 class="alert-heading">Réservation effectuée !</h4>
            <p>Votre réservation est enregistrée, vous allez prochainement recevoir une facture à votre adresse email d\'içi peu.
            <p>Vous devrez régler le prix de la réservation dès votre arrivée à l\'accueil.</p>
            <p>(Le prix est déterminé en fonction du type d\'organisation que vous représentez.)</p>
            <hr>
            <a class="btn btn-outline-success" href="home.php" role="button">Retour accueil</a>
          </div>';
    	}
	catch(PDOException $e){
    	echo $sql . "<br>" . $e->getMessage();
    	}
//   }
  ?>