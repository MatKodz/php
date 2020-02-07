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

  require "connection.php"; // connection à la bbd

  $sth = $conn->prepare($req); //prépapration de la requête avec paramètre

  $dep = $_GET['departement'].'%'; // formatage de l'entrée utilisateur pour que ce soit exploitable par la requête SQL (de la forme 34% par ex)

  $sth->execute(array($dep)); // exécution de la requête avec le paramètre fourni par l'utilisateur ( $dep remplace le ? dans la requête)

  $jeu = $sth->fetchAll(); // renvoi du résultat sous forme de tableau php

  foreach ($jeu as $ligne) {
    //affichage des résultats
    echo $ligne['nom_gare'] . "<br>";
  }



}


 ?>


</body>
</html>
