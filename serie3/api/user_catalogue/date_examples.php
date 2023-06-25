<?php
// La manipulation de dates est tache courante en programmation. Nous allons souvent devoir utiliser des dates pour faire de nombreuses comparaisons pour savoir si une date est dans l'avenir, dans le passé, suppererieur a une autre date etc. Heuresement, php nous fourni un objet pour ceci que nous appelons Datetime


// si je fais appel a la classe DateTime et que je precise rien en parametre, je vais etre retourné un objet qui va preciser la date actuelle a la quelle on se trouve. Je vais etre retourné un objet php et je vais pouvoir acceder a des informations sur cette objet
$getDate=new DateTime();

var_dump($getDate);
echo '<br/>';
echo "Sous le format que j'ai choisi! (Y-m-d)";
echo '<br/>';
// je suis retourné un objet qui me precise les informations de la date et je peux maintenant acceder aux informations de notre date sous le format que je souhaite
echo $getDate->format("Y-m-d");
echo '<br/>';

// Ici j'instancie la classe DateTime mais cette fois si je vais preciser une date en parametre lors que j'instancie la classe
$getDate1=new DateTime("2023-08-23");
$getDate2=new DateTime("2023-11-22");

// je peux maintenant faire des comparaisons;

// meme sans traiter notre objet avec des methodes, nous pouvons deja faire des compairasions par rapport a si une date est supprerieur ou inferrieur a une autre date!
if($getDate2 > $getDate1){
    echo "2023-11-22 est supperieur a 2023-08-23!";
}
echo "<br/>";
// je peux aussi verifeir que mes dates sont supperieur a aurjourd'hui! 

if($getDate1>$getDate){
    echo "La date est supperieur a maintenant!";
}

echo "<br/>";

// Enfin, si nous voulons plus de precisions, nous pouvons avoir access a plus d'informations. Par example, par combien de temps est $getDate2 supperieur a $getDate1? 

//La methode getTimeStamp() va nous retourner le nombre de secondes qui se sont ecoulé depuis la date que nous testons et le 1er Janvier 1970. Ainsi, nous pouvons voir combien de secondes vont separer nos deux dates
$difference=$getDate2->getTimestamp()-$getDate1->getTimestamp();
echo "Difference en secondes entre Date1 et Date2";
echo '<br/>';
// Du moment que nous avons l'ecart de temps en secondes, nous pouvons ainsi le manipuler pour avoir des mois des jours etc.
echo $difference;






?>