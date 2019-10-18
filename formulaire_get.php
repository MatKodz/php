<?php if(isset($_GET['envoyer']))
{
  $chaineaverifier = trim($_GET['nom']); // je stocke la chaine à vérifer dans une variable et je supprime les espaces superflus
  if( empty($chaineaverifier) )
  echo '<p class="fail">Remplissez le champ nom car il est vide</p>';
  else if (strlen($chaineaverifier) < 3)
  echo '<p class="fail">Format invalide (minimum 3 caractères)</p>';
}
 ?>
    <main>
      <form class="" action="" method="get">
        <p><label>Votre nom </label><input type="text" name="nom" value=""></p>
        <p><label>Votre prénom </label><input type="text" name="prenom" value=""></p>
        <p><label>Votre mail </label><input type="email" name="mail" value=""></p>
        <input type="submit" name="envoyer" value="Envoyer">
      </form>
    </main>
