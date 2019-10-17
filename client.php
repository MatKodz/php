<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <div class="container">

    <?php


    //connexion à la BDD

    require "connect.php";

    $requetePL = "SELECT SUBSTR(CUS_lastname,1,1) AS FL FROM customer_list GROUP BY FL ORDER BY FL";
    echo '<nav><ul class="pagination">';
    foreach ($dbh->query($requetePL) as $premiere_lettre) {
      echo '<li class="page-item"><a class="page-link" href="'.$_SERVER['SCRIPT_NAME'].'?filtre='.$premiere_lettre[0].'">' . strtoupper($premiere_lettre[0]) .'</a></li>';
    }
    echo '<li class="page-item"><a class="page-link" href="'.$_SERVER['SCRIPT_NAME'].'">Tout</a></li>';
    echo "</ul></nav><div class=\"row\">";

    if (isset($_GET['filtre']) && preg_match('/^[a-zA-Z]{1}$/', $_GET['filtre']) ) {
      $requete = "SELECT * FROM customer_list WHERE CUS_lastname LIKE '".$_GET['filtre']. "%' ";
      }

      else $requete = "SELECT * FROM customer_list ORDER BY CUS_lastname";

    foreach($dbh->query($requete) as $client){
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
