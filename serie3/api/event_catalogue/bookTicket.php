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

$requestHeaders=getallheaders();

 
    if($requestHeaders["Authorization"]){

        $auth=$requestHeaders["Authorization"];
        $token=str_replace("Bearer ","",$auth);
    
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    
        $decode=JWT::decode($token,new Key($_ENV["SECRETKEY"],"HS256"),"HS256");
    
        if($decode){
            
            $getData=json_decode(file_get_contents("php://input"),true);
            $getIsTicketBooked=bookTicketQuery($decode->user_id,$getData["eventId"]);

            if($getIsTicketBooked){
                echo json_encode(["message"=>"evenment reservé!"]);
            }
        }
    
        else{
            http_response_code(401);
            echo json_encode(["error"=>"unauthorized"]);
        }
    
      }
    
      else{
        throw new Exception("no token provided!");
      }
   

?>