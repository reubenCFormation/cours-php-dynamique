<?php
require('./connect.php');



// ici nous allons creer un programme qui va nous retourner une liste de nos utilisateurs sous un format json. Ce script pourra ensuite etre "consommer" par un client front end.

// les headers (en-tetes) contiennent les informations additionelles par rapport a une communication http. Grossomodo, elles vont contenir des informations supplementaires par rapport a la requette ou reponse qui seront important a prendre en compte. Ces inforamtions pourront etre le type de reponse attendu, qui a le droit de voir la reponse http etc. Etant donné que notre serveur est en train d'etre interogé par un client dans ce cas, les en tetes specifiés concerneront la response que le serveur va enboyer au client.

//ici je vais preciser que "tout le monde" a le droit a acceder a cette api
header("Access-Control-Allow-Origin: *");

// ici je vais preciser au client que nous allons retouer des données sous format json
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

    // nous allons remplacer la chaine de caractere "Bearer " par une chaine de caractere vide pour la variable $auth. Cela va nous renvoyer uniquement la valeur du token (qui est pour l'instant bidon)
    $token=str_replace("Bearer ","",$auth);

    // si ce que j'ai envoyé coté front correspond bien a ce que j'ai recuperé coté back, nous allons faire le traitement neccesaire pour renvoyer nos utilisateurs
    if($token=="my_token"){
        $sql="SELECT * FROM users";
    $statement=$dbConnector->query($sql);
    $users=$statement->fetchAll(PDO::FETCH_ASSOC);
    $usersToReturn=[];
    $headers=getallheaders();
    
    // ici je vais m'assurer que nous allons pas voir le mot de passe (meme haché c'est un risque de securité)
    foreach($users as $user){
        unset($user["password"]);
        $usersToReturn[]=$user;
    }
    // ici je vais les afficher sous format json
    http_response_code(200);
    echo json_encode($usersToReturn);
    
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