
<?php

function check_input($input) {
  if(isset($_GET['genre']) and $_GET['genre'])
  {
    if ($input == $_GET['genre'])
    return "checked";
  }
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" media="screen" title="no title">
    <title></title>
    <style media="screen">
      .d-flex span {
        flex: 1 1;
        padding: 2%;
        border-bottom: 1px solid turquoise;
      }
    </style>
  </head>
  <body>
    <h2>Les nageurs</h2>
    <form action="" method="get" class="d-flex justify-content-around">
      <div><label>Femme</label>
      <input type="radio" name="genre" value="f" <?php echo check_input('f');?> >
      <label>Homme</label>
      <input type="radio" name="genre" value="h" <?php echo check_input('h');?> >
      </div>
      <div>
        <select name="epreuve">
          <?php
          require "connection.php";
          $req_options = "SELECT DISTINCT CONCAT(perf_distance,' ', perf_style) AS OP FROM nageur_performance;";
          foreach ($dbh->query($req_options) as $option) {
            ?>
            <option value="<?php echo $option['OP']; ?>"
              <?php
              if (isset($_GET['epreuve']))
              {
                echo ($option['OP'] == $_GET['epreuve']) ? "selected" : "";
              }
            ?>
            >
            <?php echo $option['OP']; ?>
            </option>
            <?php
          }
          ?>
        </select>
        <input type="search" name="n_nageur" value="">
      </div>
      <div>
      <input type="submit" name="rechercher" value="Rechercher" class="btn btn-primary">
    </div>
    </form>


<?php

if(isset($_GET['genre']) and isset($_GET['epreuve']) and $_GET['genre'] and $_GET['epreuve']) {

    echo "coucou";
      $req = "SELECT nageur_nom, nageur_prenom, nageur_genre, CONCAT(perf_distance,' ',perf_style) AS EP, RIGHT(perf_temps,8) AS TPS, perf_date FROM nageur_performance, nageur_profil
      WHERE id_nageur = fk_id_nageur and nageur_genre = ? and CONCAT(perf_distance,' ',perf_style) = ? ";

      $sth = $dbh->prepare($req);
      $sth->bindValue(1,$_GET['genre']);
      $sth->bindValue(2,$_GET['epreuve']);
}

else if(isset($_GET['n_nageur']) && $_GET['n_nageur'] ) {

  $req = "SELECT nageur_nom, nageur_prenom, nageur_genre, CONCAT(perf_distance,' ',perf_style) AS EP, RIGHT(perf_temps,8) AS TPS, perf_date FROM nageur_performance, nageur_profil
  WHERE id_nageur = fk_id_nageur and nageur_nom LIKE ? ";

  $ch_nageur = $_GET['n_nageur'] . "%";

  $sth = $dbh->prepare($req);
  $sth->bindValue(1,$ch_nageur);
}

else {

      require "connection.php";
      $req = "SELECT nageur_nom, nageur_prenom, nageur_genre, CONCAT(perf_distance,' ', `perf_style`) AS EP, RIGHT(perf_temps,8) AS TPS, perf_date FROM nageur_performance, nageur_profil
      WHERE id_nageur = fk_id_nageur ORDER BY perf_temps DESC LIMIT 10";
      $sth = $dbh->prepare($req);

}

      $sth->execute();
      $resultat = $sth->FetchAll();
      foreach ($resultat as $performance) {
        ?>
        <p class="d-flex bd-highlight">
        <?php
        echo '<span>', $performance['nageur_nom'], ' ', $performance['nageur_prenom'],'</span><span>',
        $performance['EP'],'</span><span>',
        $performance['TPS'],'</span><span>',$performance['nageur_genre'],
        '</span><span>',$performance['perf_date'], "</span>";
        ?>
        </p>
        <?php
      }

$dbh = NULL;

?>
</body>
</html>
