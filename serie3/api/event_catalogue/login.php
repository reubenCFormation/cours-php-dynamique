<?php
require_once('./createJwt.php');



//ici je vais preciser que "tout le monde" a le droit a acceder a cette api
header("Access-Control-Allow-Origin: *");

// ici je vais preciser au client que nous allons retouer des données sous format json
header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');
// ici je vais recuperer tous mes utilisateurs
header('Access-Control-Allow-Headers: *');

$getData=json_decode(file_get_contents("php://input"),true);

$getUser=userLoginQuery($getData["email"],$getData["password"]);


if($getUser){
   
    unset($getUser["password"]);
    $token=createJwt($getUser);

    echo json_encode(["user"=>$getUser,"token"=>$token]);
}

else{
    echo json_encode(["message"=>"invalid credentials!"]);
}


?>