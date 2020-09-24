<?php  if (isset($_POST['envoyer'])) {
  // vérifier si le formuliare a été cliqué
  if ( !empty(trim($_POST['identifier'] ) ) && !empty(trim($_POST['pass'] ) )) {
    // vérification que les champs de formulaire ne sont pas vides
    $req = "SELECT CUS_id,CUS_email FROM customer_list WHERE CUS_email = ? AND CUS_password = MD5(?)";
    require("connect.php");
    $sth = $dbh->prepare($req);
    $sth->execute(array($_POST['identifier'],$_POST['pass']));
    $jeu = $sth->fetch(); // vérifier si le jeu de résultats contient des données / des lignes de résultat
    if($jeu) {
      session_start();
      $_SESSION['profile_id'] = $jeu['CUS_id'];
      $_SESSION['profile_email'] = $jeu['CUS_email'];
      header("Location: ./member/");
    }
    else $msg = "Le compte n'existe pas";

  }
  else echo "Vous n'avez rempli tous les champs";
}
?>
<!DOCTYPE html>
<html>
<head>
  <style>
  form { width: 50%; margin: 5% auto; background: #fafafa; padding: 5%; line-height: 2em;}
  body { font-family: Avenir, sans-serif;}
  label { width: 50%;}
  div.champ { border-bottom: 1px solid lightgrey; padding: 2% 0; margin: 2% 0;}
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <meta charset="utf-8">
</head>
<body>

<form name="connect-session" method="post" action="">
<h2>Accès espace Membre</h2>
<div class="champ"><label for="identifiant">Identifiant :</label><input type="text" name="identifier" id="identifiant" value=""></div>
<div class="champ"><label for="passd">Mot de passe :</label><input type="password" name="pass" id="passd"></div>
<div style="text-align: center; padding: 4% 0;"><input type="submit" name="envoyer" value="Se connecter" class="btn btn-success mx-3"> <input type="reset" value="Recommencer" class="btn btn-light">
<?php
if(isset($msg))
echo '<p class="alert alert-danger">' . $msg . '</p>';
?>
</div>
</form>

</body>
</html>
