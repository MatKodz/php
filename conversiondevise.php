<?php

echo "<h2>Fonction taux de change</h2>";

?>

<form method="get">
  <input type="number" name="montantachanger">
  <input type="submit" value="Changer">
</form>

<?php

$test =  $_GET['montantachanger'];
var_dump(is_numeric($test));
if (isset($_GET['montantachanger'])) {

  if (isset($_GET['montantachanger'])&&$_GET['montantachanger']>=0 and is_numeric($_GET['montantachanger']) )
  {echo "Le montant à changer est " . $_GET['montantachanger'] . " \$";
  $montantAchat = (int) $_GET['montantachanger'];}
  else {echo "Aucun montant n'a été indiqué <br>";
    $montantAchat = 0;}

  function tauxdechange($montant, $taux, $comission) {

   if(isset($montant)&&$montant!="0")
  {$montantvente = $taux*$montant - $comission;
   echo "<h2> Montant calculé : " . $montantvente . "€";}
   else  echo '<p style="color: red;">Impossible à calculer. Le montant à changer n\'a pas été indiqué ou est égale à 0</p>';

  }

  tauxdechange($montantAchat, 0.89, 0.5);

}




?>
