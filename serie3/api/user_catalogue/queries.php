<?php
require('./connect.php');

function loginQuery($email,$password){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM users WHERE email=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$email]);
        $getUser=$statement->fetch(PDO::FETCH_ASSOC);
    
        if($getUser){
            $verifyPassword=password_verify($password,$getUser["password"]);
            if($verifyPassword){
                return $getUser;
            }
    
            else{
                return false;
            }
        }
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
  
    
}

function getUsersQuery(){
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

function findUserQuery($userId){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM users WHERE id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$userId]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
        if($user["id"]){
            return $user;
        }

        else{
            return false;
        }
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function insertUserQuery($firstname,$lastname,$email,$password,$description,$expDate=null){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO users (firstname,lastname,email,password,description,expiration_date) VALUES (?,?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$firstname,$lastname,$email,$password,$description,$expDate]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>