<?php

 require("../database/queries.php");
 // ici avec ma superglobale $_SERVER je vais pouvoir trouver l'url sur laquelle je me trouve
 $getUrl=$_SERVER["REQUEST_URI"];
 // ici grace a la fonction strrcrh, je vais pouvoir trouver la chaine de caractere contenu apres ma derniere occurence de / sur mon url. Ainsi, je vais pouvoir cibler le fichier sur lequelle je me trouve actuellement
 $findLastOccurence=strrchr($getUrl,"/");
 
// ici si la chaine login.php est contenu dans ma chaine $findLastOccurence ca veux dire que je me trouve sur le fichier login.php. Si je me trouve sur ce fichier, je vais declencher la fonction getUserLogin!
 if(strpos($findLastOccurence,"login.php")!=false){
    if(getUserLogin()=="user not found"){
        $errorMsg="Authentication échoué!";
    }

  
    
 }

 function getUserLogin(){
    if(!empty($_POST)){
        if(!empty($_POST["email"])&& !empty($_POST["password"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
            $getUserVerified=userLoginQuery($email,$password);
            var_dump($getUserVerified);
            if(!$getUserVerified){
                return "user not found";
            }
            if($getUserVerified){
               
                $_SESSION["user"]=$getUserVerified;
                header('location:home_page.php?welcome=Bienvenue'." ".$_SESSION["user"]["firstname"]);
               
            }

          
        }

    }

    else{
        return "Connectez vous";
    }
    
    
 }

?>