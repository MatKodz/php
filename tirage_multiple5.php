<?php

$tirage = array();
$multiple5 = array();

for ($i=0;$i < 10 ; $i++) {
  $nb = rand(0,100);
  //$tirage .= "<p>#$i : $nb </p>";
  $tirage[] = $nb;
  // equivalent à array_push($tirage,$nb);
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

//echo "<div><h3>Tirage</h3>" . $tirage . "</div>";
//echo "<div><h2>Les multiples de 5</h2>" . $multiple5 . "</div>";

 ?>
