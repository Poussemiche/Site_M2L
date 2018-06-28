<?php

try
{
 $db = new PDO('mysql:host=localhost;dbname=bdd_mligue','root'); // connexion à la base de donnée
 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
  echo "<br>Erreur lors de la connexion à la bdd !".$e->getMessage();
}
?>