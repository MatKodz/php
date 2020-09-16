<?php

// 1 Ecrire une variable de type string (prenom), Ecrire "Bonjour" + prenom + "!"; Benoit
  $prenom = "benoit";
	echo "bonjour ". $prenom .' '. "!";

// 2 Ecrire une variable "inscription" de type Boolean initialisée à Vrai; Baptiste
  $inscription = true; 
$inscription = 1;

// 3 Ecrire une variable de type integer + variable de type float, additionner ces 2 variables et écrire le résultat; Sacha
  <php?
  $a = 5;
  $b = 2.3;
	$c= $a + $b;
	echo  $c; 
	?


// 4 Initialiser une variable $a = 0; Ecrire une condition Si A est supérieur à 0 Ecrire A est positif; Sinon Ecrire A est négatif; Changer la valeur de A; // Nicolas

<?php
	$a = 0; 

	if ($a >= 0) //Si $a est supérieur à 0
	{
    echo "A est positif";
	}
	else // SINON
	{
    echo "A est négatif";
	}
?>

// 5 Variables A et B (String) - valeur au choix, Ecrire une condition qui vérifie à la fois : Si A ET B sont vrais, Alors Ecrire "Bravo" Sinon Ecrire "Erreur"; // Laura
$A="vrai";
$B="faux";
if ($A  && $B)
  echo "bravo";
else
  echo "Erreur";

// 6 Ecrire une boucle for qui affiche les nombres impairs de 50 à 100; Sebastien
    
    <?php
function impair($imp)
{
 if($imp % 2 != 0) 
 {
  return true;
 }
 return false;
}

for($i= 50; $i <= 100; $i++)
{
 if(impair($i))
 {
  echo $i." ";
 }
}
?>


// 7 Ecrire une boucle while, qui affiche les nombres de 15 à 0; Maiwenn

$i=15;
while($i>=0) {

  echo $i-- . " "; 
  
}




// 8 Soit la chaîne $a = "hola"; Ecrire la longueur de la chaîne; Nathan
echo strlen($a): int;
// 9 Soit la même châine, Ecrire la première lettre de la chaîne en majuscules; Jules

  $a= "hola";
  $a= explode("o",$a);
	$a[0] = ucfirst($a[0]);
	echo $a[0];

$a = "hola";
$rest = substr($a,0,1);  
echo strtoupper($rest);
	

// 10 Ecrire les multiples de 14 de 0 à 200; Anthony
    <?php 
      $nb = 0;
   while ($nb<200) {
 
  if(!($nb%14)){
  echo $nb . " " ;

      
  }
    $nb++;
  }
    
    ?>

// 11 Créer un tableau numéroté composé de 5 éléments qui contient 5 marques de vêtements; Marjorie
    <?php 
$vetements = [‘Balmain’, ‘Adidas’, ‘Nike’, ‘Zara’, ‘Fendi’];
print_r($vetements);
?>

// 12 Créer un tableau associatif qui contient 4 éléments représentant des entreprises d'électronique, la clé qui identifie chaque élément correspondant à 2 lettres en majuscules (qui correspondent au pays d'origine de l'entreprise); Yanis
<?
$array = [
    "FR" => "LDLC",
    "USA" => "Microsoft",
    "US" => "Apple",
    "TW" => "ASUS",

];
  print_r($array);
?>

// 13 Afficher avec une boucle foreach les 5 marques de vêtement sous la forme d'un liste <li>;
  
  <?php
$marques = array("Adidas", "Nike", "Umbro", "Kappa", "Puma");
echo ("<ul>");
foreach ($marques as $ma) {
  echo ("<li>".$ma);
  echo "</li>";
}
 
echo("</ul>");
?>

// 14 Afficher avec une boucle les 4 entreprises d'électronique + (pays d'origine) sous la forme d'un liste <li> 
  
  $companies = [
    "FR" => "LDLC",
    "USA" => "Microsoft",
    "US" => "Apple",
    "TW" => "ASUS",

];
  foreach ($companies as $pays => $entreprise)
  { 
  echo $pays . " : " . $entreprise  '<br/>';
  }

correction proposé par Seb et Jules :

      $a= ['Amerique' => 'Apple', 'France' => 'OVH', 'Ecosse' => 'Whisky', 'Turquie' => 'kebab', 'Chinois' => 'Corona'];
  foreach ($a as $key => $value) {
    echo '<li>'.$key.' a '.$value;
  }
     
// 15 Afficher le nombre d'éléments présents dans le dernier tableau associatif, ajouter un nouvel élément avec les valeurs suivantes (Fairphone, NL)

  $companies = [
    "FR" => "LDLC",
    "USA" => "Microsoft",
    "US" => "Apple",
    "TW" => "ASUS",

];
     
// 15 Afficher le nombre d'éléments présents dans le dernier tableau associatif, ajouter un nouvel élément avec les valeurs suivantes (Fairphone, NL)

echo count($companies);
array_push($companies,"Fairphone");

print_r($companies);
    
// 16 Ecrire une fonction qui permet de calculer le prix TTC à partir d'un prix HT (taux de tva à 20%), avec en paramètre un prix HT; Exécuter la fonction avec un prix HT de 17,5€;



    Correction de seb :

$prixht = 17.5;
function prixttc($prixht)
    {
        $prixttc = $prixht * 1.20;
        return $prixttc;
    }

$prixTTC = prixttc($prixht);

    echo "le prix ttc est de $prixTTC";


// corrige

 function TTC($prixHT) {
      echo $prixHT * .20 + $prixHT;

 }
 
 $produit = 17.5;
 
TTC($produit);
 ?>
