
$rep = "cities/";

$compteur = 0;

if(is_dir($rep)) {
  $handle = opendir($rep);
  while( false !== ($fichier = readdir($handle) ) ) {
    echo $fichier;
    if( preg_match('/(.jpg|.png)$/',$fichier)) {
      echo '<img src="'.$rep.$fichier.'">'.$fichier;
      echo round(filesize($rep.$fichier) / 1000) . "Ko";
      $compteur++;
    }
  }
  echo "Il y a  " . $compteur . "images";
}

