<?php
if(isset($_POST['valider'])) {
  // je vérifie que le formulaire a été envoyé une première fois
  if( $_POST['identifier'] && $_POST['pass'] )
  {
    // je vérifie que les chmaps ne sont pas vides
    require "connect.php"; // connection à la BDD
    $req = "SELECT * FROM customer_list WHERE CUS_email = ? and CUS_password = MD5(?)";
    $smth = $dbh->prepare($req);
    $smth->execute(array($_POST['identifier'],$_POST['pass']));
    $res = $smth->fetch(); // je vérifie si la requete renvoie des resultats, cela signifie qu'un utilisateur avec le username / mdp existe
    if($res){
      session_start(); // je démarre une session en associant des superglobales de session sur l'utilisateur connecté
      $_SESSION['lenom'] = $res['CUS_lastname'];
      $_SESSION['leprenom'] = $res['CUS_firstname'];
      $_SESSION['id'] = $res['CUS_id'];
      header("Location: ./member/"); // je redirige l'utilisateur vers lespace membre
    }
    else echo 'Mot de passe / username érrone';
  }
  else echo "Tous les champs doivent être remplis";
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
<div style="text-align: center; padding: 4% 0;"><input type="submit" value="Se connecter" class="btn btn-success mx-3" name="valider"> <input type="reset" value="Recommencer" class="btn btn-light"></div>
</form>

</body>
</html>
