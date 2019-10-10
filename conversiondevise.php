<?php

echo "<h2>Fonction taux de change USD to EUR</h2>";

?>

<form method="get">
  <input type="number" name="montantachanger">
  <input type="submit" value="Changer">
</form>

<?php

function tauxdechange($montant, $taux, $comission) {

    if( isset($montant) && $montant > 5)
  {
  $montantvente = $taux*$montant - $comission;
  echo "<h2> Montant calculé : " . $montantvente . "€";
  }
     else  echo '<p style="color: red;">Impossible à calculer. Le montant à changer n\'a pas été indiqué ou est égale à 0</p>';

}

if (isset($_GET['montantachanger'])) {
  $montantAchat = $_GET['montantachanger'];
  tauxdechange($montantAchat, 0.89, 0.5);
}


?>
