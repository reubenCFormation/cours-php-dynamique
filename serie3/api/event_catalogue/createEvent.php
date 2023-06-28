<?php
require_once("./db/queries.php");
require_once('../vendor/autoload.php');
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
//ici je vais preciser que "tout le monde" a le droit a acceder a cette api
header("Access-Control-Allow-Origin: *");

// ici je vais preciser au client que nous allons retouer des données sous format json
header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');
// ici je vais recuperer tous mes utilisateurs
header('Access-Control-Allow-Headers: *');


$headers=getallheaders();


if(isset($headers["Authorization"])){
    $auth=$headers["Authorization"];
    $token=str_replace("Bearer ","",$auth);
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    // ici je vais decoder le token envoyé dans les en-tetes pour verifier que il n'a pas etait modifié et que il va bien corredpondre aux informations de notre $payload lors que nous l'avons crée
    $decode = JWT::decode($token, new Key($_ENV["SECRETKEY"],"HS256"),"HS256");

   

    if($decode){
      
        $getData=json_decode(file_get_contents("php://input"),true);
       
        
        $getEventIsAdded=addEventQuery($getData["title"],$getData["description"],$getData["capacity"],$getData["category"],$getData["date"],$decode->user_id);

        if($getEventIsAdded){
            echo json_encode(["message"=>"evenment ajouté!"]);
        }

        else{
            echo json_encode(["error"=>"une erreur s'est produite"]);
        }
    }

    else{
        echo json_encode(["error"=>"unauthorized!"]);
    }

   
}

else{
    throw New Exception("no token provided!");
    
}


?>