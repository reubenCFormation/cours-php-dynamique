<?php 
require_once("./queries.php");
require_once('../vendor/autoload.php');
use Dotenv\Dotenv;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

header("Access-Control-Allow-Origin: *");


header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');
// ici je vais recuperer tous mes utilisateurs
header('Access-Control-Allow-Headers: Authorization, Content-Type');
// ici je fais appel a la foncton getallheaders. Cette fonction va me retourner toutes les informations par rapport aux en tetes de la requette http. Dans ce cas, ca va correspondre a la requette que j'ai defini dans le fichier members.js car c'est cette url qui est interrogé. En inspectant cette variable headers, nous voyons bien que elle a une en-tete "Authorization" qui viendra de notre front
$headers=getallheaders();

// si nous avons bien envoyé une en tete avec une clé qui s'apelle "Authorization", nous allons pouvoir recuperer le token qui a etait envoyé par notre front end
if(isset($headers["Authorization"])){
    $auth=$headers["Authorization"];

    // nous allons remplacer la chaine de caractere "Bearer " par une chaine de caractere vide pour la variable $auth. Cela va nous renvoyer uniquement la valeur du token 
    $token=str_replace("Bearer ","",$auth);

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    $decode = JWT::decode($token, new Key($_ENV["SECRET"],"HS256"),"HS256");
    // si ce que j'ai envoyé coté front correspond bien a ce que j'ai recuperé coté back, nous allons faire le traitement neccesaire pour renvoyer nos utilisateurs

    if($decode){
        $user=findUserQuery($_GET["user_id"]);
        if($user){
            unset($user["password"]);
            echo json_encode($user);
        }
    }

      // sinon je vais declencher une erreur pour indiquer que on est pas autorisé a acceder a cette url
      else {
        
        http_response_code(401);
        echo json_encode(["message"=>"unauthorized!"]);
    }
    
    
    }
    
  
    


else{
    throw new Exception ("No Token Provided!");
}



?>