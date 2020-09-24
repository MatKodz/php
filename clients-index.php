<!DOCTYPE html>
<html lang="fr">
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  <meta charset="utf-8">


<!-- en-tete du document -->

  <title>Liste Client</title>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script type="text/javascript">

  </script>

  <style>

  body {font-family: 'Avenir Next', sans-serif;}


    .col- { border-bottom: 4px solid grey; padding: 2%; margin: 2% 0; background: #fafafa;}
    .client { border: 10px solid #fff; padding: 15px; background: #fcfcfc;}
    .client p { margin: 2px 0; border-bottom: 1px solid #eee;}
    .row div:nth-of-type(2n){
      background: #ededed;
    }

  </style>

</head>

<body>

<div class="container">

  <div class="jumbotron mt-2">

    <h1 class="text-dark">Liste des clients enregistrés</h1>
    <hr>
    <h4>Actions</h4>
    <a href="ajout-client.php" class="btn btn-success">Ajouter un client</a>

  </div>

</div>

<div class="container">
  <div class="row">
    <div class="col-sm">
    <h4>Classé par date d'inscription par défaut (la plus récente) </h4>
  </div>
  </div>

  <?php

require_once('connect-bdd.php');

// connexion à la bdd

  $requete_fl = "SELECT SUBSTR(CUS_lastname,1,1) AS FL FROM customer_list GROUP BY FL";

  $res_l = $conn->query($requete_fl);

  ?>

  <nav aria-label="Lettre client">
  <ul class="pagination">

  <?php

  function display_selected($letter) {
    if ( isset($_GET['filterby']) && strtolower($letter) == strtolower($_GET['filterby']) ) {
      return "active";
      // si filterby correspond à la lettre qui s'affiche, alors retourne la valeur "active" sinon ne retourne rien , cette fonction est appelée à chaque itération de la boucle qui affiche la première lettre du nom
    }
  }

  while ($lettre = $res_l->fetch()) {
     echo '<li class="page-item '. display_selected($lettre['FL']) . '"><a class="page-link" href="'.$_SERVER['SCRIPT_NAME'].'?filterby='.$lettre['FL'].'">' . $lettre['FL'] .'</a></li>';
   }
   echo '<li class="page-item"><a class="page-link" href="'. $_SERVER['PHP_SELF'].'">Tout afficher</a></li>';

   ?>

     </ul>
    </nav>

   <div class="row">

     <?php

  $req = "SELECT CUS_id, CUS_lastname, CUS_firstname, CUS_email, CUS_phone, CUS_address, CUS_zipcode, CUS_town, CUS_commuting, CUS_info, DATE_FORMAT(CUS_register, '%d-%m-%Y') AS date_inscription FROM customer_list ORDER BY CUS_register DESC";

  $req_prep = "SELECT CUS_id, CUS_lastname, CUS_firstname, CUS_email, CUS_phone, CUS_address, CUS_zipcode, CUS_town, CUS_commuting, CUS_info, DATE_FORMAT(CUS_register, '%d-%m-%Y') AS date_inscription FROM customer_list WHERE CUS_lastname LIKE ? ORDER BY CUS_register DESC";

  if (isset($_GET['filterby'])) {
    $fb = trim($_GET['filterby']);
    if (is_string($fb) && preg_match('/^\w{1}$/',$fb)) {
      $sth = $conn->prepare($req_prep);
      $sth->bindValue(1,"$fb%");
      $sth->execute();
    }
    else {
       echo '<div class="col-12"><p class="alert alert-danger">Aucune correspondance trouvée sur ' . strip_tags($fb) .'</p></div>';
       $sth = $conn->query($req);
    }
  }
  else {
    $sth = $conn->query($req);
  }

  $jeu = $sth->fetchAll(); //$sth stocke le jeu de résultats sous la forme de PDO Statement, le jeu de résultats est différent si le paramètre filterby est pris en compte ou pas

  if(!$jeu) echo '<div class="col-12"><p class="alert alert-danger">Aucune correspondance trouvée sur : ' . strip_tags($fb) .'</p></div>';
// si le jeu de résultats est vide : afficher pas de résultats

  foreach($jeu as $client) {
// affichage du jeu de résultats
    echo '<div class="col-xs col-sm-6 col-lg-4 client">';
    echo '<h4 class="bg bg-dark rounded text-white p-2">'.strtoupper($client['CUS_lastname']).' '.$client['CUS_firstname']. " <small>(" . $client['CUS_id'] . ")</small>". '</h3>';
    echo '<p><b>Inscription le :</b> <span class="badge bagde-pill badge-primary font-weight-normal">'.$client['date_inscription'].'</span></p>';
    echo '<a href="mailto:'.$client['CUS_email'].'">'.$client['CUS_email'].'</a></p>';
    echo '<p><b>Tél : </b>'.$client['CUS_phone'].'</p>';
    echo '<p>'.$client['CUS_address'].'</p>';
    echo '<p>'.$client['CUS_zipcode'].' '.$client['CUS_town'].'</p>';
    echo '<p><b>Moyen de transport:</b> '.$client['CUS_commuting'].'</p>';
    echo '<form action="modifier-client.php" method="post" name="update"><button type="submit" class="btn btn-primary my-2">Modifier</button><input type="hidden" name="idcust" value = "'.$client['CUS_id'].'"></form>';
    echo '<p><b>Info complémentaires:</b> '.$client['CUS_info'].'</p>';
    echo '</div>';
  }

  $conn = NULL;

  ?>

  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col">
      <hr>
      <p>Liste des clients par ordre alphabétique. Filtrage possible.</p>
    </div>
  </div>
</div>


</body>

</html>
