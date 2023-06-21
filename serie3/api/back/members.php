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
$sql="SELECT * FROM users";
$statement=$dbConnector->query($sql);
$users=$statement->fetchAll(PDO::FETCH_ASSOC);
$usersToReturn=[];
// ici je vais m'assurer que nous allons pas voir le mot de passe (meme haché c'est un risque de securité)
foreach($users as $user){
    unset($user["password"]);
    $usersToReturn[]=$user;
}
// ici je vais les afficher sous format json
echo json_encode($usersToReturn);





?>