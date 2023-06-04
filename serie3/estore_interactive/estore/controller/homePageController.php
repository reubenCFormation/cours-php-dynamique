<?php

$getUrl=$_SERVER["REQUEST_URI"];
$findLastOccurence=strrchr($getUrl,"/");

if(strpos($findLastOccurence,"home_page.php")){
   
    treatQueryParams();
}

function treatQueryParams(){
   if(isset($_GET["logout"])&& $_GET["logout"]==true){
        echo "CONDITION MET!!";
        // la fonction session_destroy n'a pas un comportement qui est trés intuitif. Lors que j'apelle la fonction session_destroy, ma session n'est pas detruite automatiquement, ma session est tout simpltement éxpiré et il va falloir que la page se rafraichisse une deuxieme fois avant de reelement "vider" ma session. C'est pour cela que je fait une redirection apres avoir appelé session_destroy.
        session_destroy();
        
        header('location:./home_page.php');
   }

   

 
}

?>