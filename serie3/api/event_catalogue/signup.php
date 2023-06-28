<?php
    require_once('./db/queries.php');
    //ici je vais preciser que "tout le monde" a le droit a acceder a cette api
    header("Access-Control-Allow-Origin: *");

    // ici je vais preciser au client que nous allons retouer des données sous format json
    header("Content-Type:application/json");

    // ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
    header('Access-Control-Allow-Methods: GET, POST,PUT');
    // ici je vais recuperer tous mes utilisateurs
    header('Access-Control-Allow-Headers: Authorization, Content-Type');

    $getData=json_decode(file_get_contents("php://input"),true);


    $hash=password_hash($getData["password"],PASSWORD_BCRYPT);

    insertUserQuery($getData["firstname"],$getData["lastname"],$getData["email"],$hash,$getData["description"]);

    echo json_encode(["message"=>"user inserted"]);

    


?>