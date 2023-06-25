<?php


require_once('../vendor/autoload.php');
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createToken(){
    $dotenv=Dotenv::createImmutable(__DIR__);
    $dotenv->load();
   
    //var_dump($_ENV["SECRET"]);
   
   $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
   
   // Create token payload as a JSON string
   $payload = json_encode(['identifier' => "unlocked!"]);
   
   // Encode Header to Base64Url String
   $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
   
   
   // Encode Payload to Base64Url String
   $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
   
   // Create Signature Hash
   $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $_ENV["SECRET"], true);
   
   // Encode Signature to Base64Url String
   $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
   
   // Create JWT
   $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
   
   return $jwt;
   
   //$decode=(json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $jwt)[1])))));
}


function createJwtDump($user) {
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $payload = [
        "user_id" => $user["id"],
        "username" => $user["firstname"],
        "roles" => ["user"],
        "exp" => time() +86400
    ];
    echo "GET SECRET";
    echo "<br/>";
    echo $_ENV["SECRET"];
    $token = JWT::encode($payload, $_ENV["SECRET"], 'HS256');
    echo "GET TOKEN";
    echo "<br/>";
    echo $token;
    echo "<br/>";

    echo "GET DECODE";
    echo "<br/>";
    $decode = JWT::decode($token, new Key($_ENV["SECRET"],"HS256"),"HS256");
    var_dump($decode);
    echo "<br/>";
    var_dump($decode->user_id);
    

    

}

//createJwtDump(["id"=>100,"firstname"=>"Jeremy"]);


function createJwt($user){
    // Ici je vais acceder au contenu de mon fichier .env. Pour pouvoir le faire, je dois faire qq traitements!
    $dotenv = Dotenv::createImmutable(__DIR__);

    $dotenv->load();
    
    $payload = [
        "user_id" => $user["id"],
        "username" => $user["firstname"],
        "roles" => ["user"],
        "exp" => time() +86400
    ];
    // Grace aux configurations plus haut, je peux
    $token = JWT::encode($payload, $_ENV["SECRET"], 'HS256');

   return $token;
   
    
}

 
 

?>