<?php
 // nous avons vu que nous pouvons inserer en base de données nos données saisi dans un formulaire. Rien ne nous empeche de pouvoir les recuperer et les afficher. 

 // je vais recuperer ma connection a ma bdd qui me donne access a ma variable $dbConnector et je vais donc pourvoir me connecter a ma base de données.
 require("connect.php");
 // ici je vais recuperer tous mes utilisateurs
 $sql="SELECT * FROM users";
 // ici je suis en train de faire une requette qui va me retourner des données, je vais donc utiliser la fonction query pour recuperer mes utilisateurs;

// ici je defini ma requette
 $statement=$dbConnector->query($sql);
 // ici je suis retourné un objet PDOStatement. Cette objet va pouvoir appliquer ces propres fonctions et l'une de ces fonctions s'apelle fetchAll. Cette objet a aussi une fonction qui s'appelle fetch et qui a un comportement similaire a fetchAll.
 var_dump($statement);

 /*
 Ici j'utilise la methode fetchAll et je lui precise que je souhaite tous mes données sous forme d'un tableau associatif. Que est ce qui me sera retourné?
 1) premier dimension (un tableau numerique ou chaque index correspond a un tableu assocaitif
 2) deuxieme dimension (un tableau associatif qui contient chaque champs de ma table users comme la clé et sa valeur correspondant inscrit dans la table)
 */

 $users=$statement->fetchAll(PDO::FETCH_ASSOC);
 echo "<h2> Plusiers utilisateurs avec fetchAll </h2>";
 var_dump($users);
 echo "<br/>";

 

 
 
 


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <div class="container">
            <ul class="list-group col-9"> 
                <div class="d-flex"> 
                    <li class="list-group-item col-3">prenom </li>
                    <li class="list-group-item col-3">nom</li>
                    <li class="list-group-item col-3"> email </li>
                </div>
                
                    <?php foreach($users as $user): ?>
                        <div class="d-flex"> 
                            <li class="list-group-item col-3"> <?php echo $user["firstname"] ?> </li>
                            <li class="list-group-item col-3"> <?php echo $user["lastname"] ?> </li>
                            <li class="list-group-item col-3"> <?php echo $user["email"] ?> </li>
                        </div>
                    <?php endforeach ?>
                
            
            </ul>
        </div>
    </body>
</html>