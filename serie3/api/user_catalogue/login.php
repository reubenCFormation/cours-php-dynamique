<?php
require_once('./queries.php');
require_once('./createJwt.php');

header("Access-Control-Allow-Origin: *");

// ici je vais preciser au client que nous allons retouer des données sous format json
header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');
// ici je vais recuperer tous mes utilisateurs
header('Access-Control-Allow-Headers: *');

// je recupere mes données
$getData=json_decode(file_get_contents("php://input"),true);

$getUser=loginQuery($getData["email"],$getData["password"]);

if($getUser){
    unset($getUser["password"]);
    $createToken=createJwt($getUser);
    echo json_encode(["user"=>$getUser,"token"=>$createToken]);
}

else{
    
    echo json_encode(["error"=>"invalid credentials"]);
}





?>