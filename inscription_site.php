<?php session_start();
// it will never let you open index(login) page if session is set
 if (isset($_SESSION['user_id'])!="" ) {
  header("Location: home.php");
  exit;
 }
?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <link href="lib/css/bootstrap.min.css" rel="stylesheet">
    <link href="css_inscription.css" rel="stylesheet">

  <a class="btn btn-primary float-left" href="index.php" role="button">Accueil</a>
  <body class="text-center">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
      <img class="mb-4" src="https://romguillon4.files.wordpress.com/2013/09/mdl.png" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal" >Veuillez rentrer vos informations</h1>
        <div class="form-row">
          <div class="col">
            <input type="text" name="prenom" class="form-control" placeholder="Prénom" required>
          </div>
          <div class="col">
            <input type="text" name="nom" class="form-control" placeholder="Nom de famille" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <input type="text" name="email" class="form-control" placeholder="Adresse Email" required>
          </div>
          <div class="col">
            <input type="password" name="mdp" class="form-control" placeholder="Mot de passe" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <input type="text" name="num_nom_rue" class="form-control" placeholder="Numéro et nom de rue" required>
          </div>
          <div class="col">
            <input type="text" name="CP" class="form-control" placeholder="Code Postal" required>
          </div>
        </div>
        <div class="form-row">
          <div class="col">
            <input type="text" name="ville" class="form-control" placeholder="Ville" required>
          </div>
          <div class="col">
            <input type="text" name="telephone" class="form-control" placeholder="Numéro de téléphone" required>
          </div>
        </div>
        <div class="form-group">
          <label for="Form_club_select">Faites-vous partie d'un de nos club de sport ?</label>
          <select multiple class="form-control-sm" name="club_select" id="Form_club_select" required>
            <option value=8>Non membre</option>
            <option value=1>Volleyball</option>
            <option value=2>Escrime</option>
            <option value=3>Badminton</option>
            <option value=4>Tennis</option>
            <option value=5>Bowling</option>
            <option value=6>Football</option>
            <option value=7>Plongée sous-marine</option>
          </select>
        </div>
      <div class="form-group">
        <label for="Form_noclub_select">Si non vous êtes :</label>
        <select multiple class="form-control-sm" name="noclub_select" id="Form_noclub_select" required>
          <option value=1>Comité départemental</option>
          <option value=2>Association</option>
          <option value=2>Lycée</option>
          <option value=2>Collège</option>
          <option value=3>Organisme/Société hébergé par la M2L</option>
          <option value=4>Non-hébergé par la M2L</option>
        </select>
      </div>
      <input class="btn btn-primary" type="submit" name="submit" id="submit" value="S'inscrire">
      </form>

<?php

require_once 'connexion_BD.php';

$nom = isset($_POST['nom']) ? $nom = htmlspecialchars($_POST['nom']) : $nom = '';
$prenom = isset($_POST['prenom']) ? $prenom = htmlspecialchars($_POST['prenom']) : $prenom = '';
$email = isset($_POST['email']) ? $email = htmlspecialchars($_POST['email']) : $email = '';
$mdp = isset($_POST['mdp']) ? $mdp = htmlspecialchars($_POST['mdp']) : $mdp = '';
$num_nom_rue = isset($_POST['num_nom_rue']) ? $num_nom_rue = htmlspecialchars($_POST['num_nom_rue']) : $num_nom_rue = '';
$CP = isset($_POST['CP']) ? $CP = htmlspecialchars($_POST['CP']) : $CP = '';
$ville = isset($_POST['ville']) ? $ville = htmlspecialchars($_POST['ville']) : $ville = '';
$telephone = isset($_POST['telephone']) ? $telephone = htmlspecialchars($_POST['telephone']) : $telephone = '';
$club_select = isset($_POST['club_select']) ? $club_select = htmlspecialchars($_POST['club_select']) : $club_select = '';
$noclub_select = isset($_POST['noclub_select']) ? $noclub_select = htmlspecialchars($_POST['noclub_select']) : $noclub_select = '';


//$nom = !empty(htmlspecialchars($_POST['nom'])) ? htmlspecialchars($_POST['nom']) : '';
//$prenom = !empty(htmlspecialchars($_POST['prenom'])) ? htmlspecialchars($_POST['prenom']) : '';
//$email = !empty(htmlspecialchars($_POST['email'])) ? htmlspecialchars($_POST['email']) : '';
//$mdp = !empty(htmlspecialchars($_POST['mdp'])) ? htmlspecialchars($_POST['mdp']) : '';
//$num_nom_rue = !empty(htmlspecialchars($_POST['num_nom_rue'])) ? htmlspecialchars($_POST['num_nom_rue']) : '';
//$CP = !empty(htmlspecialchars($_POST['CP'])) ? htmlspecialchars($_POST['CP']) : '';
//$ville = !empty(htmlspecialchars($_POST['ville'])) ? htmlspecialchars($_POST['ville']) : '';
//$telephone = !empty(htmlspecialchars($_POST['telephone'])) ? htmlspecialchars($_POST['telephone']) : '';
//$club_select = !empty(htmlspecialchars($_POST['club_select'])) ? htmlspecialchars($_POST['club_select']) : '';
//$noclub_select = !empty(htmlspecialchars($_POST['noclub_select'])) ? htmlspecialchars($_POST['noclub_select']) : '';

if (isset($_POST['submit']))
{
  $sql = "INSERT INTO personne(per_typ_id, per_club_id, per_nom, per_prenom, per_adresse, per_cp, per_ville, per_tel, per_email, per_passwd)VALUES(:noclub_select,:club_select,:nom,:prenom,:num_nom_rue,:CP,:ville,:telephone,:email,:mdp)";

  $variables = array('noclub_select'=>$noclub_select
                     ,':club_select'=>$club_select
                     ,':nom'=>$nom
                     ,':prenom'=>$prenom
                     ,':num_nom_rue'=>$num_nom_rue
                     ,':CP'=>$CP
                     ,':ville'=>$ville
                     ,':telephone'=>$telephone
                     ,':email'=>$email
                     ,':mdp'=>$mdp);

  try{
    $requete= $db->prepare($sql);
    $requete->execute($variables);

    $id = $db->lastInsertId();

    $_SESSION["id_user"] = $id;
    $_SESSION["personne"]= $prenom;

    echo '<div class="alert alert-success" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);" role="alert">
            <h4 class="alert-heading">Inscription effecutée !</h4>
            <p>Vous êtes désormais inscrit sur le site de réservation de la Maison des ligues, votre compte sera activé après envoi d une photocopie de votre carte d identité à l adresse mail suivante : <a href="mailto:maisondesligues@ML.fr" style="text-decoration: underline;">maisondesligues@M2L.fr</a></p>
            <p>Après vérification, l accès à la page de réservation vous sera autorisée.</p>
            <hr>
            <a class="btn btn-outline-success" href="index.php" role="button">Retour accueil</a>
          </div>';
  }catch(Exception $e){
    echo "<br>Erreur :".$e->getMessage();
  }
}
?>

</body></html>