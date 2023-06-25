<?php
require_once('./queries.php');
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
header('Access-Control-Allow-Headers: Authorization, Content-Type');
$requestHeaders=getallheaders();

if($requestHeaders["Authorization"]){
    $auth=$requestHeaders["Authorization"];

    // nous allons remplacer la chaine de caractere "Bearer " par une chaine de caractere vide pour la variable $auth. Cela va nous renvoyer uniquement la valeur du token qui a etait envoyé dans les en-tetes coté front
    $token=str_replace("Bearer ","",$auth);
    // configuration pour acceder a mon fichier .env
    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    // ici je vais decoder le token envoyé dans les en-tetes pour verifier que il n'a pas etait modifié et que il va bien corredpondre aux informations de notre $payload lors que nous l'avons crée
    $decode = JWT::decode($token, new Key($_ENV["SECRET"],"HS256"),"HS256");
    // si notre token correspond
   if($decode){
    $users=getUsersQuery();
    $usersToReturn=[];
    foreach($users as $user){
        unset($user["password"]);
        $usersToReturn[]=$user;
    }

    echo json_encode($usersToReturn);
   }
   // sinon je vais lancer une erreur
   else{
    http_response_code(401);

   }
}


?>