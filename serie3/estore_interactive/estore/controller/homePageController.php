<?php
// ici je vais cibler l'url de mon navigateur grace a la super globale $_SERVER qui a une clé REQUEST_URI qui aura stocké comme valeur notre url actuelle
$getUrl=$_SERVER["REQUEST_URI"];

// ici grace a la fonction strrcrh, je vais pouvoir trouver la chaine de caractere contenu apres ma derniere occurence de /. Ainsi, je vais pouvoir cibler le fichier sur lequelle je me trouve actuellement
$findLastOccurence=strrchr($getUrl,"/");

// ici si je me trouve sur le fichier home_page.php je vais faire appel a la fonction treatQueryParams.

if(strpos($findLastOccurence,"home_page.php")){
   
    treatQueryParams();
}

function treatQueryParams(){
    // ici si j'ai un query prarm logout et que il est defini a true, je vais decider de vider la session et d'y mettre fin en appelant la fonction session_destroy
   if(isset($_GET["logout"])&& $_GET["logout"]==true){
        
        // Apres avoir appelé la fonction session_destroy je vais rediriger vers la page d'accueil ce qui a pour but de rafraichir la page une deuxieme fois et donc de vider mon tableau $_SESSION"
        session_destroy();
        
        header('location:./home_page.php');
   }


   

  

   

 
}

?>