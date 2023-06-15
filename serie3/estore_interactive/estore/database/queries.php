<?php
require_once("connect.php");

function userLoginQuery($email,$password){
    $dbConnector=connect();
    $sql="SELECT * FROM users WHERE email=?";
    $statement=$dbConnector->prepare($sql);
    $statement->execute([$email]);
    $getUser=$statement->fetch(PDO::FETCH_ASSOC);
  
    if(!empty($getUser)){
        try{
            $verifyPassword=password_verify($password,$getUser["password"]);
            if($verifyPassword){
                return $getUser;
            }
    
            else{
                return false;
            }
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
      
    }
}

function addProductQuery($title,$description,$price,$quantity,$user,$photoUrl=null){
    try{
        $dbConnector=connect();
        $sql="INSERT into products (title,description,price,quantity,user_id,photo) VALUES(?,?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$title,$description,$price,$quantity,$user,$photoUrl]);
        var_dump($statement);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
   
}

function addUserQuery($firstname,$lastname,$email,$hash){
    try{
        $dbConnector=connect();
        $sql="INSERT into users(firstname,lastname,email,password,role) VALUES (?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$firstname,$lastname,$email,$hash,'user']);
        return true;
    }
    
    catch(PDOException $e){
        echo $e->getMessage();
    }
}

// ECRIVEZ ICI UNE FONCTION POUR INSERER NOS UTILSATEURS

// ECRIVEZ ICI UNE FONCTION POUR RECUPERER TOUS NOS PRODUITS 

// ECRIVEZ ICI UNE FONCTION POUR RECUPERER UN PRODUIT SELON SON ID ET AFFICHEZ LES INFORMATIONS DE LA PERSONNE QUI A AJOUTE NOTRE PRODUIT










?>