<?php
 // ici nous allons voir comment nous pouvons se connecter a une base de données et effectuer des requettes basiques grace a cette connection!

 // ici je vais definir mes parametres de connection!
 $host="localhost";
 // ma base de données
 $dbname="example_1";
 // mon utilisateur (par defaut root)
 $username="root";
 // mon mot de passe (j'en precise pas). Plus tard, nous allons voir comment securiser notre mot de passe avec les variables d'environment
 $password="";

 $dbConnector=new PDO("mysql:host=$host;dbname=$dbname",$username,$password);
 $dbConnector->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 var_dump($dbConnector);

 // verifions que nous sommes bien connectés a notre base de données!
/*
 var_dump($dbConnector);
 */



?>