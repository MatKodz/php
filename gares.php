<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="" method="get">
      <select class="" name="departement">
        <?php
        for($i = 1; $i < 99;$i++) {
          echo '<option value="'.$i.'">'.$i.'</option>';
        }
         ?>

      </select>
      <input type="submit" name="name" value="Rechercher">

    </form>

<?php

if(isset($_GET['departement']) && $_GET['departement']) {

  echo $_GET['departement'];

  $req = "SELECT nom_gare FROM gare_frequentation WHERE Code_postal LIKE ? ";

  require "connection.php"; // connection bbd

  $sth = $conn->prepare($req); // prep requete

  $dep = $_GET['departement'].'%'; // formatage parametre de l'utilisateur

  $sth->execute(array($dep)); // execution de la requete avec passage du parametre

  $jeu = $sth->fetchAll(); // resultat sous forme de tableau

  foreach ($jeu as $ligne) {
    //affichage des resultats
    echo $ligne['nom_gare'] . "<br>";
  }



}


 ?>


</body>
</html>
