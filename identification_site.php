<?php session_start();
// it will never let you open index(login) page if session is set
 if (isset($_SESSION['user_id'])!="" ) {
  header("Location: home.php");
  exit;
 }

require_once 'connexion_BD.php';

if(isset($_POST['login'])){
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $mdp = !empty($_POST['mdp']) ? trim($_POST['mdp']) : null;
    
    $sql = "SELECT per_id, per_typ_id, per_club_id, per_email, per_passwd FROM personne WHERE per_email = :email AND per_passwd = :mdp";
    $requete = $db->prepare($sql);

    $requete->bindValue(':email', $email);
    $requete->bindValue(':mdp', $mdp);
    $requete->execute();
    
    $user = $requete->fetch(PDO::FETCH_ASSOC);
    
    //If $user is FALSE.
    if($user === false){
        ?>
        <div class="alert alert-danger" role="alert">
        Adresse mail ou mot de passe incorrect.
        </div>
        <?php 
    } else{
            $_SESSION['user_id'] = $user['per_id'];
            $_SESSION['logged_in'] = time();
            $_SESSION['id_type_per'] = $user['per_typ_id'];
            $_SESSION['id_club_per'] = $user['per_club_id'];
            header('Location: home.php');
            exit;
            
        }
    }

?>

<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Identification</title>

    <link href="lib/css/bootstrap.min.css" rel="stylesheet">

    <link href="signin.css" rel="stylesheet">
  </head>

<div class="container">
  <body class="text-center">
    <form class="form-signin" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST">
     <img class="mb-4" src="https://romguillon4.files.wordpress.com/2013/09/mdl.png" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Veuillez rentrer vos identifiants</h1>
      <label for="inputEmail" class="sr-only" name=email >Adresse email</label>
      <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Adresse Email" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Mot de passe</label>
      <input type="password" id="inputPassword" name="mdp" class="form-control" placeholder="Mot de passe" required="">
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Se souvenir de moi
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Se connecter</button>
      <a class="btn btn-link" href="inscription_site.php" role="button">S'inscrire</a>
    </form>
  </div>

</body></html>