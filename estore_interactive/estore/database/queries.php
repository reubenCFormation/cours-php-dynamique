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

function addProductQuery($title,$description,$photoUrl,$price,$quantity,$user){
    try{
        $dbConnector=connect();
        $sql="INSERT into products (title,description,photo,price,quantity,user_id) VALUES(?,?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$title,$description,$photoUrl,$price,$quantity,$user]);
        var_dump($statement);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
   
}

function getAllProductsQuery(){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM products";
        $statement=$dbConnector->query($sql);
        $products=$statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $products;
        
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function addUserQuery($firstname,$lastname,$email,$password){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO users (firstname,lastname,email,password,role) VALUES (?,?,?,?,?)";
        $hash=password_hash($password,PASSWORD_BCRYPT);
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$firstname,$lastname,$email,$hash,"user"]);
        return true;
        
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function findProductQuery($id){
    try{
        $dbConnector=connect();
        $sql="SELECT products.*, users.firstname AS posted_by_firstname,users.lastname AS posted_by_lastname,users.email AS posted_by_email  FROM products JOIN users ON products.user_id=users.id WHERE products.id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$id]);
        $product=$statement->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function flagProductQuery($id){
    try{
        $dbConnector=connect();
        $sql="UPDATE products set is_flagged=1 WHERE id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$id]);
        return true;
    }

    catch(PDOException $e){

    }
}





?>