<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title> Affichage des image d'un répertoire</title>
    <style>
    body {
      padding: 0;
      margin: 0;
      font-family: 'Avenir Next', sans-serif;
    }
    img { width: 250px; padding: 5px; margin: 10px; box-shadow: 2px 2px 3px lightgrey;}
    section.images { display: flex; flex-flow: row wrap;}
    section.images div { display: flex; flex-flow: column; background-color: #fafafa; margin: 5px; justify-content: space-between;}
    section.images div p{  font-family: 'Avenir Next', sans-serif; color: #999; border-bottom: 1px solid #aaa; padding: 5px; margin: 10px; font-size: 12px;}
    section.images div a {
      border: 1px solid red;
      color: red;
      padding: 4px;
      font-size: 12px;
      margin: 10px;
      text-decoration: none;
      text-align: center;
      align-self: center;
      background-color: white;
    }

    section.ajout-image {
      padding: 2%;
      background: grey;
    }
    section.ajout-image h2 {
      font-size: 200%;
      font-weight: 200;
      color: white;
    }

    section.ajout-image input[type=submit] {
      background: #5DC600;
      color: white;
      border: 0;
      padding: 10px;
      border-radius: 5px;
    }
    section.ajout-image form {
      background-color: white;
      padding: 10px;
    }

    .fancy { width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.8);
    position: fixed;
    z-index: 5;
    top: 0;
    display: none;
  }
    .fancy #thepicture {
      border: 3px solid #ccc;
      padding: 0px;
      margin: 5% auto;
      max-width: 70vw;
      max-height: 80vh;
    }

    .fancy .close {
      position: absolute;
      right: 5px;
      top: 5px;
      color: white;
      font-size: 150%;
      font-family: sans-serif;
      cursor: pointer;
      border: 2px solid white;
      border-radius: 50%;
      padding: 8px 15px;
      background: rgba(255,255,255,0.2);
    }

    img.full-w {
      width: 100%;
      box-shadow: initial;
      padding: 0;
      margin: 0;
      max-width: auto;
      max-height: 80vh;
      object-fit: cover;
    }

    p.success {
      background-color: #5DC600;
      padding: 10px;
      color: white;
    }

    p.fail {
      background-color: #f90;
      padding: 10px;
      color: white;
    }

    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  </head>
  <body>
  <main>

    <?php

    error_reporting(E_ALL);

    $nbfichier=0;

    $path_repertoire = "pictures/";

    if(isset($_GET['delete']) && $_GET['delete'] == "yes" && isset($_GET['fichier'])) {
      unlink($path_repertoire.$_GET['fichier']);
      echo '<p class="fail">Le fichier '. $_GET['fichier'] . ' a été supprimé</p>';
      header("Refresh:0; url=./");
    }
    ?>
    <section class="images">
    <?php

if (is_dir($path_repertoire)) {
      if ($rep = opendir($path_repertoire)) {
        while ( ($fichier = readdir($rep))  !== false) {
        if ( in_array(substr($fichier,-3,3),array("jpg","JPG","PNG","png"))  ) {
          //print_r(getimagesize("./pictures/$fichier"));
          $info = getimagesize("./pictures/$fichier");
            echo '<div><img src="'.$path_repertoire.$fichier.'" alt="" class="diapo">';
            echo "<p>taille  :".  $info[3] ."</p><p> Type : " . $info['mime'] ."</p>";
            echo "<p>" . filesize("./pictures/$fichier") . " bytes soit ".round(filesize("./pictures/$fichier")/1024,0)." Ko</p>";
            echo "<a href=\"{$_SERVER['SCRIPT_NAME']}?delete=yes&fichier=$fichier\">Supprimer le média</a></div>";
            $nbfichier++;
            }
          }
      }
      closedir($rep);
}
     ?>
   </section>
</main>
<section class="ajout-image">
  <?php
  echo '<p class="success">' . $nbfichier . ' images</span>';
  $nbfichier++;?>
  <h2>Ajouter une image</h2>
  <form class="" action="<?=$_SERVER['PHP_SELF']?>" enctype="multipart/form-data" method="post">
    <input type="file" name="newpicture">
    <input type="submit" value="Envoyer l'image">
  </form>
  <?php
  if(isset($_FILES['newpicture']) && $_FILES["newpicture"]["error"] == UPLOAD_ERR_OK) {
    list($name,$type,$tmp,$error,$size) = array_values($_FILES['newpicture']);
    if ( substr($_FILES['newpicture']['type'],0,5) == "image" ) {
      $nbfichier++;
      if (move_uploaded_file($tmp, "pictures/vacances-$nbfichier.jpg"))
      echo '<p class="success">le fichier '.$name.' a bien été téléchargé. Son poids en octets : '.$size.'</p>';

    }
  else echo '<p class="fail"> Le fichier '. $name .' n\'est pas une image</p>';
  }
  ?>
</section>
<div class="fancy">
  <div id="thepicture">
    <img src="" alt="">
  </div>
  <div class="close">[X]</div>
</div>
<script>
$ (function () {
  $(".diapo").click ( function () {
    chemin = $(this).attr("src");
    $(".fancy").fadeIn('fast');
    $("#thepicture img").attr("src", chemin).addClass("full-w");
    $(".close").click( function() {
      $(".fancy").fadeOut('fast');
    });
  });


});

</script>
  </body>
</html>
