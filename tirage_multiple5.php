<?php

$tirage = array();
$multiple5 = array();

for ($i=0;$i < 10 ; $i++) {
  $nb = rand(0,100);
  //$tirage .= "<p>#$i : $nb </p>";
  $tirage[] = $nb;
  // equivalent à array_push($tirage,$nb) qui rajoute une nouvelle entrée avec la valeur de $nb ds le tableau tirage
    if ($nb % 5 == 0)
    $multiple5[] = $nb;
    //$multiple5 .= "<p> $nb </p>";
}

foreach ($tirage as $key => $value) {
  echo "<p>#" . $key .":". $value ."</p>";
}

echo "<h2>Multiple de 5</h2>";

foreach ($multiple5 as $value) {
  echo "<p>" . $value ."</p>";
}

 ?>
