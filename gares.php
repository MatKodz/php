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
          $dep_f = str_pad($i,2,0,STR_PAD_LEFT); // formatage du numéro de département pour avoir un 0 devant pour les dép de 1 à 9
          echo '<option value="'.$dep_f.'">'.$dep_f.'</option>'; // création d'un select avec dans l'attribut value le num du département + libellé
        }
         ?>

      </select>
      <input type="submit" name="name" value="Rechercher">

    </form>

<?php

if(isset($_GET['departement']) && $_GET['departement']) {

  echo $_GET['departement'];

  $req = "SELECT nom_gare, Code_postal FROM gare_frequentation WHERE Code_postal LIKE ? ";

  require "connection.php"; // connection à la bbd

  $sth = $conn->prepare($req); //prépapration de la requête avec paramètre

  $dep = $_GET['departement'].'%'; // formatage de l'entrée utilisateur pour que ce soit exploitable par la requête SQL (de la forme 34% par ex)

  $sth->execute(array($dep)); // exécution de la requête avec le paramètre fourni par l'utilisateur ( $dep remplace le ? dans la requête)

  $jeu = $sth->fetchAll(); // renvoi du résultat sous forme de tableau php

  foreach ($jeu as $ligne) {
    //affichage des resultats
    echo "<p>" . $ligne['nom_gare'] . ' | ' . $ligne['Code_postal'] . "<hr></p>";
  }


}


 ?>


</body>
</html>
