<?php
// un cookie est une maniere d'enregistrer des informations d'un utilisateur sur un navigateur qui utilise. Un cookie est enreigistré sous forme d'un fichier texte qui va pouvoir etre lu par le navigateur et enregistré. Par default les cookies vont expirer lors que nous allons fermer le navigatuer mais nous pouvons si nous le souhaitons definir par nous meme une date d'expiration pour un cookie.

// comment definir un cookie? Avec la fonction php setcookie. Cette fonction prends 3 parametres
/*
1) Le premier parametre sera le nom de notre cookie
2) Le deuxieme parametre sera la valeur que notre cookie va prendre (noter que ceci doit etre une chaine de caracteres!)
3) Le troisieme parametre sera un tableau d'options et c'est nottament ici que nous allons preciser la durée de vie
*/

/*
    Les limitations des cookies 
    1) La valeur que nous allons affecter a un cookie doit toujours etre une chaine de caracteres
    2) Les cookies ne sont que reconnu au niveau du dossier dans lequelles nous les avons defini, ainsi si nous remontez d'un dossier notre cookie ne sera plus reconnu 
    3) Nous devons effacer chaque index de nos cookies un par un. Nous ne pouvons pas effacer index par index contrairement a $_SESSION
*/
require_once('../db/connect.php');
if(!empty($_POST)){
  
    if(!empty($_POST["email"])&& !empty($_POST["password"])){
        $email=$_POST["email"];
        
        $passwordStr=$_POST["password"];
        $sql="SELECT * FROM users WHERE email=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$email]);
        $user=$statement->fetch(PDO::FETCH_ASSOC);
       
        if(!empty($user)){
            $verifyIfAuth=password_verify($passwordStr,$user["password"]);
            // si mon utilisateur est bien verifié je vais creer un cookie avec la fonction setcookie et je vais pouvoir avoir access a ces informations partout dans mon programme
            if($verifyIfAuth){
                
                
                setcookie("userId",$user["id"],
                [
                    // le temps d'expiration d'un cookie est determiné par le nombre de secondes depuis l'invetion de unix. La fonctio time() en php va nous renvoyer le nombre de secondes qui se sont écoulés depuis 1 Janvier 1970. Par example, si nous souhaitons que notre cookie expire dans une heure, nous allons devoir mettre time()+3600
                    "expires"=>time()+3600,
                    'httponly'=>true,
                    'secure'=>true

                ]);

               var_dump($_COOKIE);

               // pour effacer une clé d'un cookie
               unset($_COOKIE["userId"]);

               
            }
        }
    }
}





?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <div class="container"> 
            <h4> Creation de cookies </h4>
            <div class="col-6">
                <form method="post">
                    <div class="form-group">
                        <label for="email"> Email </label>
                        <input type="email" class="form-control" name="email"/>
                    </div>

                    <div class="form-group">
                        <label for="email"> Password </label>
                        <input type="password" class="form-control" name="password"/>
                    </div>
                    <div class="col-6 d-flex justify-content-center mt-2">
                        <button type="submit" class="btn btn-primary col-6"> Valider </button>
                    </div>
                   
                </form>
            </div>
          
       </div>
    </body>
</html>