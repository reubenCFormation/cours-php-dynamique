<?php 
require("./connect.php");
//ici je vais preciser que "tout le monde" a le droit a acceder a cette api
header("Access-Control-Allow-Origin: *");
// ici je precise que je vais autoriser toutes les en-tetes. Mon front va me renvoyer une en-tete de type application/json
header('Access-Control-Allow-Headers: *');

// ici je vais preciser que cette api va nous retourner du json
header("Content-Type:application/json");

// ici je vais definir les methodes (modes d'access) acceptable pour acceder a cette api
header('Access-Control-Allow-Methods: GET, POST,PUT');




// En outre, remarquez que ici nous n'utilisons pas la variable $_POST. En effet,$_POST n'est que utilisable lors que le content-type est multiport/formdata ou application/w-www-form-urlencoded. Ce sont des formats de données differents que le application/json tandis que nous utilisons des données JSON ici.


// ici je vais recuperer les données qui me seront envoyés par le javascript. Ces données seront stockés dans un fichier que nous appelons php://input et avec la fonction file_get_contents je vais pouvoir recuperer ces données. Ces données me seront renvoyés sous forme de chaine de caracteres et je vais donc devoir faire un json_decode dessus. Ensuite je vais pouvoir acceder a mes données sous forme de tableau associatif

$getData=json_decode(file_get_contents("php://input"),true);
// si mon serveur a recu des données du javascript
if(!empty($getData)){
    try{
        $sql="INSERT INTO users (firstname,lastname,email,description,password) VALUES(?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $hash=password_hash($getData["password"],PASSWORD_BCRYPT);
        $statement->execute([$getData["firstname"],$getData["lastname"],$getData["email"],$getData["description"],$hash]);
    
        echo json_encode(["message"=>"Utilisateur bien insereés en Base De données!"]);
    
    }

    catch(pdoException $e){
        echo json_encode(["message"=>$e->getMessage()]);
    }
   
}





?>