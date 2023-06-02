<?php
    // souvent, nous allons voulour redirger nos utilisateurs vers d'autres pages. Par exemple, si un utilisateur s'authentifie et que il fourni les bonnes informations, nous allons voulour rediriger cette utilisateur vers la page d'accueil. Voyons un example avec notre formulaire d'authentication!

require_once('../db/connect.php');

// ici nous allons voir comment on peux s'authentifier et faire la verification que nous avons bien un utilisateur avec un email et un mot de passe en base de données

if(!empty($_POST)){
    // si mes deux champs ont bien etait saisi
    if(!empty($_POST["email"]&& !empty($_POST["password"]))){
        $email=$_POST["email"];
        $passwordStr=$_POST["password"];

        // je vais recuperer mon utilisateur selon l'email que j'ai saisi pour voir si cette email existe bien en base de données
        $sql="SELECT * FROM users WHERE email=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$email]);
        // nous pouvons aussi utiliser la fonction fetch au lieu de fetchAll qui a un comportement qui est trés similaire
        $result=$statement->fetch(PDO::FETCH_ASSOC);
        // si j'ai bien une valeur dans ma table users avec un email qui matche l'email que j'ai saisi dans mon formulaire je veux verifier avec la fonction php password_verify pour etre sur que le mot de passe que j'ai saisi en base de données correspond bien au mot de passe que j'ai saisi dans mon formulaire
        if(!empty($result)){
            // ici la fonction php password_verify va verifier que le mot de passe que j'ai saisi correspond bien a la version "claire" de mon mot de passe crypté en base de données. Si c'est le cas, cette fonction va nous renvoyer true (vrai)
            $checkIfValidPassword=password_verify($passwordStr,$result["password"]);
            // si je suis bien authentifié, on va rediriger vers la page d'accueil avec la fonction header. La fonction header de php nous permet de rediriger vers une autre page que nous allons preciser. La fonction header attends un parametre qui sera une chaine de caractere qui va preciser ou nous souhaitons rediriger. Notez que elle s'ecrit avec le mot location:{la page que je souhaite acceder}. Notez aussi que header ne fonctionnera PAS si nous avons deja effectué un affichage html avant d'y faire appel


           

            // si j'ai pu bien m'authentifier, on va rediriger vers la page home_page.php
            if($checkIfValidPassword){
                header('location:./home_page.php');
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
        <h2 class="text-center"> Authentication</h2>
        <!--
            ici j'utilise une nouvelle methode php qui s'apelle isset. isset va verifier si une valeur existe dans le programme et que elle n'est pas null. Si c'est le las, isset va renvoyer true (vrai). Ici je dois verifier que j'ai bien une valuer $checkIfValidPassword et que cette valeur est egale a true
        -->
        <form method="post"> 
            <div class="form-group col-4 offset-2"> 
                 <div class="text-center"> Saisir votre email </div>
                 <input type="text" class="form-control" name="email"/> 
            </div>

            <div class="form-group col-4 offset-2"> 
                 <div class="text-center"> Saisir votre mot de passe </div>
                 <input type="password" class="form-control" name="password"/> 
            </div>
            <div class="d-flex col-4 offset-2 justify-content-center mt-2"> 
                <button type="submit" class="col-6 btn btn-primary"> Envoyer </button>
            </div>
        </form>
        
    </body>
</html>

