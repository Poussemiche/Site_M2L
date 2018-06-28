<?php include 'header_membre.php';
 if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
 exit;
 }
 ?>
 	<link href="reservation_site.css" rel="stylesheet">

    <div class="nav-scroller bg-white box-shadow">
        <nav class="nav nav-underline">
        	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="nav-link">Date de réservation
        			<input type="date" name="res_date">
		<div class="form-group nav-link" style="display: inline;">Horaire
    		<select class="form-control-sm" style="display: inline;" id="form_horaire" name="res_horaire">
      			<option value=1>08h - 12h</option>
      			<option value=2>12h - 16h</option>
      			<option value=3>16h - 20h</option>
      			<option value=4>20h - 00h</option>
    		</select>
  		</div>
  		<input class="btn-sm btn-primary" style="display: inline;" type="submit" name="submit" id="submit" value="Rechercher">
			</form>
        </nav>
    </div>
    <?php           
           if (isset($_POST['submit'])) {
           		echo '<main role="main">
						<div class="card-columns">';
				require_once 'connexion_BD.php';

				$res_date = $_POST['res_date'];
				$res_date = date("Y-m-d", strtotime($res_date));
				$res_horaire_id = $_POST['res_horaire'];
        $_SESSION['res_date'] = $_POST['res_date'];
        $_SESSION['res_horaire'] = $_POST['res_horaire'];

    			$sql = "SELECT sal_nom, sal_nb_place, sal_notes
    					FROM salle
    					WHERE sal_id NOT IN (SELECT res_sal_id FROM reservation WHERE res_date = :res_date AND res_horaire_id = :res_horaire_id)";
    			$requete = $db->prepare($sql);

    			$requete->bindValue(':res_date', $res_date);
    			$requete->bindValue(':res_horaire_id', $res_horaire_id);
    			$requete->execute();
    			$i=0;
				while ($row = $requete->fetch())
				{
    				$tab_sal_nom[$i] = $row['sal_nom'];
    				$tab_sal_nb_place[$i] = $row['sal_nb_place'];
    				$tab_sal_notes[$i] = $row['sal_notes'];
?>
    				<div class="card bg-light">
							<img class="card-img-top" <?php echo 'src="img/'. $tab_sal_nom[$i] .'.jpg"' ?> alt="Salle de réunion">
    						<div class="card-body">
      							<h5 class="card-title">Salle <?php echo $tab_sal_nom[$i]; ?></h5>
      							<p class="card-text">Salle disposant de <?php echo $tab_sal_nb_place[$i]; ?> places.</p>
      							<p class="card-text"><small class="text-muted">Informations de salle : <?php echo $tab_sal_notes[$i]; ?></small></p>
      							<form action=<?php echo '"confirm_resa.php?sal_choix='.$tab_sal_nom[$i].'"'; ?> method="POST">
                      <button class="btn btn-outline-primary float-right" style="margin-bottom: 15px;" name="reserver" value=<?php echo '"'.$tab_sal_nom[$i].'"'; ?> type="submit">Réserver</button>
                    </form>
    						</div>
 						  </div>
<?php
    				$i = $i + 1;         
				}
}       
?>
</body>
</div>
	</main>

</html>