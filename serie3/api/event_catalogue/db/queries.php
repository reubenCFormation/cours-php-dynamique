<?php
require_once("connect.php");

function insertUserQuery($firstname,$lastname,$email,$password,$description){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO users (firstname,lastname,email,password,description) VALUES (?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$firstname,$lastname,$email,$password,$description]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
   
}

function userLoginQuery($email,$password){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM users WHERE email=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$email]);
        $getUser=$statement->fetch(PDO::FETCH_ASSOC);
       
        if($getUser){
            $isVerified=password_verify($password,$getUser["password"]);

            if($isVerified){
                return $getUser;
            }
        }
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function addEventQuery($title,$description,$capacity,$category,$date,$userId){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO events (title,description,capacity,category,registration_date,user_id) VALUES (?,?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$title,$description,$capacity,$category,$date,$userId]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getEventsQuery(){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM events WHERE registration_date > now()";
        $statement=$dbConnector->query($sql);
        $events=$statement->fetchAll(PDO::FETCH_ASSOC);
        return $events;

    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getEventInformationQuery($eventId){
    try{
        $dbConnector=connect();
        $sql="SELECT events.*,users.firstname,users.lastname 
        FROM events 
        JOIN users ON events.user_id=users.id 
        WHERE events.id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$eventId]);
        $event=$statement->fetch(PDO::FETCH_ASSOC);
       
        $sql="SELECT users.firstname,users.lastname 
        FROM users 
        JOIN ticket ON ticket.user_id=users.id 
        JOIN events ON ticket.event_id=events.id 
        WHERE events.id=?";

        $statement=$dbConnector->prepare($sql);
        $statement->execute([$eventId]);
        $participants=$statement->fetchAll(PDO::FETCH_ASSOC);
    
        return ["event"=>$event,"participants"=>$participants];
        
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function bookTicketQuery($userId,$eventId){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO ticket (user_id,event_id) VALUES (?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$userId,$eventId]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>