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
// si mon utilisateur est bien authentifié, il nous a fourni le bon email et le bon mot de passe
if($getUser){
    unset($getUser["password"]);
    // je vais lui creer un token
    $createToken=createJwt($getUser);
    // je vais renvoyer ce token pour que il puisse etre utilisé par mon front-end
    echo json_encode(["user"=>$getUser,"token"=>$createToken]);
}

else{
    // sinon je vais renvoyer un message comme quoi notre utilisateur n'a pas rentré les bonnes informations
    
    echo json_encode(["error"=>"invalid credentials"]);
}





?>