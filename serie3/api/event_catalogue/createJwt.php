<?php
require_once('./db/queries.php');

require_once('../vendor/autoload.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Dotenv\Dotenv;

function createJwt($user){
   
    $dotenv=Dotenv::createImmutable(__DIR__);
    $dotenv->load();
  
    
    $payload = [
        "user_id" => $user["id"],
        "exp" => time()+86400
    ];

    
 
   
    $token = JWT::encode($payload, $_ENV["SECRETKEY"], 'HS256');
  
   return $token;


}

//createJwt(["id"=>25]);


?>