<?php include 'header.php';

           		echo '<main role="main">
						<div class="card-group">';
				require_once 'connexion_BD.php';

    			$sql = "SELECT sal_nom, sal_nb_place, sal_notes
    					FROM salle";
    			$requete = $db->prepare($sql);
    			$requete->execute();
    			$i=0;
				while ($row = $requete->fetch())
				{
    				$tab_sal_nom[0+$i] = $row['sal_nom'];
    				$tab_sal_nb_place[0+$i] = $row['sal_nb_place'];
    				$tab_sal_notes[0+$i] = $row['sal_notes'];
?>
    				<div class="card bg-light">
							<img class="card-img-top" <?php echo 'src="img/salle_reunion_'. rand(1, 8) .'.jpg"' ?> alt="Salle de réunion">
    						<div class="card-body">
      							<h5 class="card-title">Salle <?php echo $tab_sal_nom[0+$i]; ?></h5>
      							<p class="card-text">Salle disposant de <?php echo $tab_sal_nb_place[0+$i]; ?> places.</p>
      							<p class="card-text"><small class="text-muted">Informations de salle : <?php echo $tab_sal_notes[0+$i]; ?></small></p>
    						</div>
 						  </div>
<?php
    				$i = $i + 1;         
				}
?>