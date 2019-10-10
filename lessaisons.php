<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Les saisons</title>

  <meta charset="UTF-8">

  <script type="text/javascript">

  </script>

  <style>
  body { padding: 0; margin: 0; font-family: 'Avenir Next', san-serif;}
  h1 {border-bottom: 2px ridge #eee; padding: 4% 3%; background: linear-gradient(to bottom right,#bbb 35%,#eee); font-size: 6vw; color: #111; margin: 0;}
  p { color: #111; border-left: 5px solid lime; padding-left: 15px; font-size: 130%; margin-top: 2%;}
  main { padding: 3%; line-height: 2em;}
  code { padding: 5px 10px; background-color: #333; color: white; border-radius: 8px; font-size: 120%; margin: 0 10px; }
  samp { padding: 5px; border: 2px solid #ddd; color: black; }
  </style>

</head>
<body>
  <?php

// Page de test des tableaux

echo "<h1>Les saisons</h1>";

echo "<main>";

$lessaisons = array("été","automne","hiver","printemps");

echo "<p>J'affiche le résultat à l'aide de print_r() </p>";

echo '<code>$lessaisons = array("été","automne","hiver","printemps");</code><br>';

echo '<code>print_r($lessaisons);</code><br>';

echo "<samp>";

print_r($lessaisons);

echo "</samp>";


$season = array( "Winter" => array("January","February","March"), "Spring" => array("April","May","June"), "Summer" => array("July","August","September"), "Fall" => array("October","November","December"));

echo '<code>$season = array( "Winter" => array("January","February","March"), "Spring" => array("April","May","June"), .... )</code><br><br>';


$mois = date("F");

foreach ($season as $lacle => $thesaison)
{

  echo "Liste des mois " . $lacle . " : ";

  for ($i = 0; $i < count($thesaison); $i++)
  {
    echo "<samp>" . $thesaison[$i] . "</samp> ";
    if ($thesaison[$i] == $mois)
    $quelsaison = $lacle;

  }
  echo "<br>// " . $lacle . " starts in ". $thesaison[0];
  echo "<br>";


}

echo "<p>J'affiche la saison du mois en cours</p>";

    echo "Nous sommes au mois de <samp>" . $mois . " </samp> donc en <samp> " . $quelsaison . "</samp>" ;

    echo "<p>Exemple de tableau imbriqué</p>";

    echo "<code>\$season[\"Summer\"][2] </code>affiche ";

if (isset($season["Summer"][2]))
echo " <samp>" . $season["Summer"][2] . "</samp>";
else echo "Le mois demandé n'existe pas";

?>

</main>

</body>
</html>
