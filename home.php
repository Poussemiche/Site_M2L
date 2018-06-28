<?php include 'header_membre.php';
// it will never let you open home.php page if session isn't set
 if (!isset($_SESSION['user_id'])) {
  header("Location: index.php");
  exit;
 }
 ?>
