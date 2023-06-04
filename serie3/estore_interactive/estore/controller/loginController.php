<?php

 require("../database/queries.php");
 $getUrl=$_SERVER["REQUEST_URI"];
 $findLastOccurence=strrchr($getUrl,"/");
 

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
    
    
 }

?>