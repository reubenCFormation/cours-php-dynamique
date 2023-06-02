<?php
// grace a ce require,nous avons acces a notre variable $dbConnector!
require("connect.php");
/*
var_dump($dbConnector);
*/
// ici je verifie que j'ai bien des données qui proviennent d'un formulaire et que c'est données sont bien enregistrés dans ma superglobale $_POST
if(!empty($_POST)){
    
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    // ici nous allons voir comment inserer en base de données avec les valeurs provenant d'un formulaire!
try{
    // notez ici que nous avons des doubles quotes ("") autour de notre requette sql. Nos variables sont aussi des chaines de caracteres avec des doubles quotes. Que se passe t'il si nous precisons des doubles quotes autour de nos valuers d'insertion
    // nous voyons deja que ca ne marchera pas!
    /*
    $sql="INSERT INTO users (firstname,lastname,email,password) VALUES("firstname","lastname","email@email.com","password")";
    */
    /*
    // nous voyons que ceci marche, nous mettons en simple chaine de caracteres autour d'une double chaine de caracteres
     $sql="INSERT INTO users (firstname,lastname,email,password) VALUES('John','Doe','Jdoe@gmail.com','password')";
    $dbConnector->exec($sql);
    */

    // enfin, nous allons devoir mettre en simple chaine de caracteres autour des noms de nos variables pour avoir des valeurs dynamiques qui reporesenteront les valuers que on aurai saisi dans notre formulaire. Le simple guillemet est un delimeteur sql qui va preciser que il s'agit d'une chaine de caracteres. Meme si nos variables php sont deja des chaines de caracteres, notre sql ne les reconnait pas comme etant des chaines de caractere et nous allons devoir mettre des simples guillemets pour le faire comprendre a notre sql!

    // ici je verifie que mes données saisi ne sont pas vides
    if(!empty($firstname)&& !empty($lastname) && !empty($email) && !empty($password)){
    // si c'est le cas j'effectue ma requette
    $sql="INSERT INTO users (firstname,lastname,email,password) VALUES('$firstname','$lastname','$email','$password')";
    // ici j'effectue une requette qui ne vas pas me retourner une valeur, elle va juste inserer des données dans ma bdd. Je vais donc utiliser la fonction exec.
    $dbConnector->exec($sql);
    }
    // si j'ai des données vide je ne vais pas faire d'insertion
    else{
        echo'<h1> Erreurs lors de notre saisi! </h1>';
    }
    
    

   
    echo "Données inserer dans la table users!";
}

catch(PDOException $e){
   echo $e->getMessage();
}
}


// ici nous allons voir comment effectuer des requettes sql avec notre variable $dbConnector!
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <!--
            notez ici la propreité method, c'est pour dire que les données de notre forumaire seront envoyés en post, et donc ne seront pas visible dans l'url, contrairement a get
        -->
    <div class="container">
        <h2 class="text-center"> Inseres nos données! </h2>
    <form method="post" class="col-4 offset-2">
       
        <div class="form-group">
         <label for="exampleInputEmail1">firstname</label>
          <!--
            notez que chaque champ input a une proprieté name! En effet, pour pouvoir recuperer nos données, il faut bien cette proprieté name, sinon, notre php (dans ce cas avec $_POST) ne pourra pas recupere la donnée du formulaire!
        -->
         <input type="text" class="form-control" name="firstname">
  
        </div>
        <div class="form-group">
         <label for="exampleInputEmail1">lastname</label>
         <input type="text" class="form-control" name="lastname">
        </div>
        <div class="form-group">
         <label for="exampleInputEmail1">Email address</label>
         <input type="email" class="form-control" name="email">
  
        </div>
        <div class="form-group">
         <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
        </div>
        <div class="d-flex mt-3 justify-content-center">
            <!--
                Ici lors que je vais soumettre mon bouton, la page va se rafraichir et donc notre fichier va se re-executer de haut en bas et nous allons constater que vu que nous venons d'envoyer un formumaire en post, notre superglobale $_POST ne sera donc plus vide et nous allons pouvoir recuperer les données que nous venons d'envoyer avec notre superglobale $_POST
            -->
            <button type="submit" class="btn btn-primary col-4">Submit</button>
        </div>
      
    </form>
    </div>

    </body>
</html>