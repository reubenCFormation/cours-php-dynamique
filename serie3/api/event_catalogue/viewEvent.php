<?php

require_once('./db/queries.php');
require_once('../vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;
//ici je vais preciser que "tout le monde" a le droit a acceder a cette api
header("Access-Control-Allow-Origin: *");

// ici je vais preciser au client que nous allons retouer des données sous format json
header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');
// ici je vais recuperer tous mes utilisateurs
header('Access-Control-Allow-Headers: Authorization, Content-Type');

 $requestHeaders=getallheaders();


  if($requestHeaders["Authorization"]){

      $dotenv = Dotenv::createImmutable(__DIR__);
      $dotenv->load();

      $auth=$requestHeaders["Authorization"];
      $token=str_replace("Bearer ","",$auth);
      $decode=JWT::decode($token,new Key($_ENV["SECRETKEY"],"HS256"),"HS256");

      if($decode){
        $eventInfo=getEventInformationQuery($_GET["eventId"]);
       
        echo json_encode($eventInfo);
      }

      else{
        http_response_code(401);
      }
  
}
  
    else{
      throw new Exception("no token provided!");
    }
 


?>

