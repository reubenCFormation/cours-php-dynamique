<?php
   /*
    En php les sessions sont une maniere de de stocker des informations sur un serveur et ainsi nous allons pouvoir y avoir access a ces informations sur multiple pages de notre siteweb car nos informations seront stocké sur un serveur centralisé. Les sessions sont aussi beaucoup plus securisé que les cookies vu que les données d'une session sont stocké sur un serveur distant et non dans nos navigateurs. En php nous pouvons stocker des informations d'une session dans une superglobale (rappel $_POST,$_GET) que nous allons nommer $_SESSION. Ce tableau $_SESSION va pouvoir conserver toutes les informations sur notre session et nous allons pouvoir l'alimenter comme nous le souhaitons.

    A noter: Il faut obligatoirement mettre un session_start() sur la PREMIERE ligne de notre fichier si nous souhaitons utiliser notre superglobale $_SESSION sinon la variable $_SESSION ne sera pas reconnue!!
   */
  session_start();
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
            
            if($verifyIfAuth){
                // ici grace aux session_start je vais pouvoir alimenter ma superglobale $_SESSION 
                $_SESSION["user"]=$user;
               header('location:session_info.php');

               
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
            <h4> Creation de session </h4>
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

