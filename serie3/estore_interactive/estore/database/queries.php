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








?>