<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
      main {
        width: 90%;
        margin: 0 auto;
      }
      .bloc {
        width: 40%;
        display: inline-block;
        padding: 3%;
        vertical-align: top;
      }
      .bloc li {
        border: 1px solid #999;
        padding: 10px;
        margin: 5px 0;
        background: #fafafa;
      }

      .bloc ul {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      h3 {
        font-family: "Avenir Next", sans-serif;
        font-size: 40px;
        color: #ff7f7f;
      }

      .badge {
        background-color: #333;
        padding: 5px;
        color: white;
      }
    </style>
  </head>
  <body>
    <h2>Affichage des fichiers par type</h2>
    <?php

    $rep = "ressources/";

    echo "<h2>Répertoire chemin : $rep</h2>";

    echo "<p>SERVER ROOT " . $_SERVER['DOCUMENT_ROOT'] . " et DIR : " .  __DIR__ . "</p>";

    $pdfs = [];
    $images = [];

    if (is_dir($rep)) {

      $dh = opendir($rep);

      while ( ($fichier = readdir($dh)) !== false) {
        if (preg_match('/(.pdf)$/',$fichier))
        $pdfs[] = $fichier;
        else if (preg_match('/(.png)$/',$fichier))
        $images[] = $fichier;
      }

      closedir($dh);

      //echo __DIR__ . "/ressources/pin.png";


      ?>
      <main>
      <div class="bloc">
      <h3>Les PDF</h3>
        <ul>
          <?php
          foreach ($pdfs as $pdf) {
            echo "<li><a href=\"{$rep}{$pdf}\">" . $pdf . "</a> " .  round(filesize($rep.$pdf) / 1000) ." Ko - <span class=\"badge\">" . strstr($pdf,".") . " </span></li>";

          }
          ?>
        </ul>
      </div>
      <div class="bloc">
      <h3>Les images</h3>
        <ul>
          <?php
          foreach ($images as $img) {
            echo "<img src=\"{$rep}{$img}\"><hr>";
          }
          ?>
        </ul>
      </div>
    </main>

      <?php

    }

    ?>

  </body>
</html>
