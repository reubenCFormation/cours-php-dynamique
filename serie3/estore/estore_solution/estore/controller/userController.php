<?php
require_once('../database/queries.php');
 $getUrl=$_SERVER["REQUEST_URI"];
 $findLastOccurence=strrchr($getUrl,"/");
 if(strpos($findLastOccurence,"signup.php")){
  if(!empty($_POST)){
    if(getAddUser()){
        header("location:home_page.php?userInsertedMSG=Bienvenue"." ".$_POST["firstname"]);
   }
   else{
     $errorMsg="une erreur s'est produite";
   }
  }
  
   
 }

 function getAddUser(){
    if(!empty($_POST)){
        if(!empty($_POST["firstname"]) && !empty($_POST["lastname"]) && !empty($_POST["email"])&& !empty($_POST["password"])){
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
            $email=$_POST["email"];
            $passwordStr=$_POST["password"];
            $testIsUserInserted=addUserQuery($firstname,$lastname,$email,$passwordStr);
            if($testIsUserInserted==true){
                return true;
            }
        }
    }
 }


?>