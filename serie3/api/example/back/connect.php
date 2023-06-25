<?php
 
    $host="localhost";
    // ma base de données
    $dbname="serie1_exo_1_solution";
    // mon utilisateur (par defaut root)
    $username="root";
    // mon mot de passe (j'en precise pas). Plus tard, nous allons voir comment securiser notre mot de passe avec les variables d'environment
    $password="";
   
    $dbConnector=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
    $dbConnector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
 

?>