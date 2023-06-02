<?php
// je recupere mon objet de connection a ma bdd
require("connect.php");
// Ici nous allons voir que sans requette preparé, nous serons vulnerable a des utilisateurs malvoyants qui pourront trés facilement faire de grandes obstructions a notre base de données. Voici un exemple simple, ici je vais faire une requette simple pour recuperer un utilisateur selon son email


if(!empty($_POST)){
    
    if(!empty($_POST["email"])&& !empty($_POST["password"])){
        try{
            $email=$_POST["email"];
            $password=$_POST["password"];

        // Comme je viens de montrer, cette requette peux etre trés facilement manipulable a l'aide d'un formulaire. Meme si je moi je comprends pas a 100% comment ca fonctionne, on voit bien que il suffit de facilement manipuler les valeurs saisi dans nos formulaires pour que celle ci puisse facilement etre interpreté par notre sql et ainsi il suffit de connaitre un email ou un username et nous pouvons se connecter sans un mot de passe!. C'est loin d'etre ideale. C'est pour cela que il nous faut de requette preparé!
        /*
        $sql="SELECT * FROM users WHERE email='$email' AND password='$password'";
        $pdoStatement=$dbConnector->query($sql);
        $result=$pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        var_dump($result);
        */
        
        
       
        // c'est pour cela que nous allons utiliser les requettes preparés! Voici un example. Ici nous remplacons nos variables par un ?
        $sql="SELECT * FROM users WHERE email=? AND password=?";
        // la methode prepare va nous permettre de "preparer" notre requette mais aucune donnée sera testé par raison de nos points d'interrogations. Nos points d'interrogations sont des "joker" et sont juste pour indiquer que nous allons vouloir chercher quel que chose dans notre base de données mais nous ne savons pas encore. Ainsi, nous n'allons pas pouvoir directement modifier notre chaine de caracteres sql.
        $statement=$dbConnector->prepare($sql);
        // Ici, nous allons preciser a quoi va reelement correspondre nos valeurs. A noter que un utilisateur malvoyant ne pourra plus modifier notre requette sql, avec prepare elle a deja etait "traité" et maintenant nous allons preciser directement a quoi va correspondre nous deux points d'interrogations, dans ce cas la, ca sera nos deux variables $email et $password
        $statement->execute([$email,$password]);
        $results=$statement->fetch(PDO::FETCH_ASSOC);
        var_dump($results);
        
        
        
        
    
        }

        catch(PDOException $e){
            echo $e->getMessage();
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
        <h2 class="text-center"> Injection SQL</h2>
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