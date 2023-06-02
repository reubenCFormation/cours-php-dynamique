<?php
require_once('../../data/connect.php');
// ici je vais ecrire mes requettes sql. Mes requettes sql seront executer dans des fonctions et pour les effectuer je vais faire appel a ces fonctions lors que j'aurai besoin d'effectuer la requette sql. Mes appels a mes fonctions vont s'executer dans mon controller

// cette fonction prendra 4 parametres differents, chaque parametre sera un champ que je vais vouloir inserer en bdd
function insertUser($firstname,$lastname,$email,$hash){
    try{
        // ici grace a mon require, j'ai access a la fonction connect du fichier connect.php qui me retourne mon objet PDO pour me connecter a la base de données
        $dbConnector=connect();
        $sql="INSERT INTO users (firstname,lastname,email,password) VALUES(?,?,?,?)";
        $statement=$dbConnector->prepare($sql);

        $statement->execute([$firstname,$lastname,$email,$hash]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
    
}

// cette fonction va me retourner tous mes utilisateurs que j'ai stocké en base de données
function selectUsers(){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM users";
        $statement=$dbConnector->query($sql);
        $users=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $users;

    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>