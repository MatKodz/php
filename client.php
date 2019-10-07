<?php
// Requête SQL pour obtenir la première lettre
SELECT SUBSTR(CUS_lastname,1,1) AS FL FROM customer_list GROUP BY FL ORDER BY FL
// générer un lien de type <a href=""> pour chaque lettre<// écrire une requête spécifique si le paramètre de filtre existe et intégrer ce paramètre
  if (isset($_GET['filtre'])) {
    $requete = "SELECT * FROM customer_list WHERE CUS_lastname LIKE '".$_GET['filtre']. "%' ";
    }
?>

// fichier php fonctionnel pour afficher les clients

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="row">
<?php

//connexion à la BDD

$user = "root";
$pass = "root";
try {
$dbh = new PDO('mysql:host=localhost;dbname=Customer_management', $user, $pass);
  //echo "<h2>Connexion reussie</h2>";
}
    catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}

$Requete = "SELECT * FROM customer_list ORDER BY CUS_lastname";

foreach($dbh->query($Requete) as $client){
    echo '<div class="col-sm-3">';
    echo "<p class=\"bg-dark text-white p-3\">" . $client['CUS_lastname'] . " " . $client['CUS_firstname'] . "</p>";
    echo '<p><a href="tel:'.$client['CUS_phone'].'">' . $client['CUS_phone'] . '</a></p>';
    echo '</div>';
}

$dbh = null;

?>

</div>
</div>
</body>
</html>
