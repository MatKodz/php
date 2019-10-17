<?php
if(isset($_POST['envoi'])) {

  $erreur = false;
  foreach ($_POST as $key => $value) {
    if(empty($value)) {
      $erreur = true; // je vérifie si chaque champ n'est pas vide, si un champ est vide la variable erreur est modifiée à true
      echo "<p>" . $key . " est vide";
    }
  }

  if(!$erreur) { // si $erreur reste à false, cela sous entend que tous les champs ont été remplis.
    $donnees = $_POST;
    array_pop($donnees);  // je supprime le dernier élément du tableau  POST qui correspond au bouton d'envoi
    $req = "INSERT INTO customer_list VALUES (NULL,?,?,?,?,?,?,?,?,?,?,NOW())";
    require "connect.php";
    $donneesv = array_values($donnees); // je transforme le tableau associatif  contenu dans $donnnes en tableau numérotée (format attendu pour la requête préparée)
    $sth=$dbh->prepare($req);
    if ($sth->execute($donneesv)) {
      echo "Création client réussie";
      print $dbh->lastInsertId();
    }
  }

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- en-tete du document -->

  <title>Inscription Client</title>

  <meta charset="UTF-8">

  <script type="text/javascript">

  function form_hidden() {
    document.getElementById('form').style.display = "none";
  };

  </script>

  <style>

  body {font-family: 'Avenir Next', sans-serif;}

  #form {padding: 2%; width: 100%;}

  input, textarea {font-size: 80%; padding: 5px; margin: 20px 0; border: 1px solid #e6e6e6; width: 200px; transition: width ease-in-out 0.4s;}

  textarea { width: 80%; height: 100px;}

  input[type="radio"]{ width: 10px; visibility: hidden;}

  input[type="radio"] + label { width: auto; border: 1px purple solid; background: #fafafa; color : purple; padding: 7px;}

  input[type="radio"]:checked + label { background: purple; color: white; }

  input:focus {box-shadow: 2px 2px 6px #666;}

  /*input:valid {color: #111; border: 2px solid #3E9E00;}*/

  input.wrong {color: #bb1100; box-shadow: 2px 2px 3px #bb1100;}

  input:required { border-left: 2px solid orange;}


    label { font-size: 14px; width: 250px; display: inline-block;}

    input + span, textarea + span { font-size: 75%; color: red; padding-left: 15px;}

    .col- { border-bottom: 4px solid grey; padding: 2%; margin: 2% 0; background: #fafafa;}

  </style>

</head>

<body>

<div class="container">

  <div class="jumbotron mt-2">

    <h1 class="text-dark">Devenir client</h1>

  </div>

</div>

<div class="container">

  <div class="row">

    <form name="formulaire" id="form" method="post" action="">
    <h3>S'inscrire comme client </h3>
    <p> Tous les champs sont obligatoires</p>

  <div class="col-">
    <label id="lanom" for="Votre nom">Votre nom</label>
    <input type="text" size="25" name="nom" id="lanom" placeholder="Votre nom ici"   value="testnom">
    <span>
            </span>
  </div>

  <div class="col-">
    <label id="laprenom" for="Votre prénom">Votre prénom</label>
    <input type="text" size="25" name="prenom" id="laprenom" placeholder="Votre prénom ici"  value="testprenom">
    <span>
            </span>
  </div>

  <div class="col-">
  <label id="lamail" for="Votre email">Votre email</label>
  <input type="email" id="lamail" size="30" name="monmail" placeholder="Votre mail ici" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" value="">
  <span>
        </span>
  </div>

  <div class="col-">
  <label id="pwd" for="Votre mot de passe">Votre mot de passe</label>
  <input type="password" id="pwd" size="20" name="monmotdepasse" value="">
  <span>
        </span>
  </div>


  <div class="col-">
    <label id="lanum" for="Votre numéro de téléphone">Votre numéro de téléphone</label>
    <input type="text" size="25" name="telephone" id="lanum" placeholder="Votre numéro de téléphone ici" pattern="[0-9]{10}" value="0610123456">
    <span>
            </span>
  </div>


  <div class="col-">
    <label id="laadresse" for="Votre adresse">Votre adresse</label>
    <input type="text" size="25" name="adresse" id="lanum" placeholder="Votre adresse" value="rue des oliviers">
    <span>
            </span>
  </div>


  <div class="col-">
    <label id="lacp" for="Votre CP">Votre code postale</label>
    <input type="text" size="5" name="codepostal" id="lacp" placeholder="Votre CP" value="34000">
    <span>
            </span>
  </div>



  <div class="col-">
  <label id="laville" for="Votre ville">Votre ville de résidence</label>
  <input type="text" size="25" name="ville" id="laville" placeholder="Votre ville ici" value="MPL">
  <span>
        </span>
  </div>

  <div class="col-">
  <label>Comment vous vous déplacez</label>
  <input type="radio" name="locomotion" value="car" id="voit" ><label for="voit">Voiture</label>
  <input type="radio" checked name="locomotion" value="bike" id="vel" > <label for="vel">Vélo</label>
  <input type="radio" name="locomotion" value="taxi" id="tax" > <label for="tax">Taxi</label>
  <input type="radio" name="locomotion" value="plane" id="avi" > <label for="avi">Avion</label>
  <span>
        </span>
  </div>

  <div class="col-">
    <label id="info" for="Vos informations">Informations complémentaires</label>
    <textarea name="info" maxlength="500">test info</textarea>
    <span>
            </span>
  </div>

  <div class="col-12 text-center">
    <input type="submit" name="envoi" value="Envoyer les informations" class="btn btn-success">
    <button type="reset" value="Reinit" class="btn btn-light">Recommencer </button>
  </div>

  </form>
</div>
</div>



</body>

</html>
