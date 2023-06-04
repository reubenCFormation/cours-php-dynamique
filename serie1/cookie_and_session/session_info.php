<?php
session_start();
// Si j'ai cliqué sur mon bouton pour me deconnecter, je vais tomber dans cette condition!
if(isset($_GET["logout"]) && $_GET["logout"]==true){
    /*
    comme nous pouvons le constater, ici nous allons appeler session_destroy mais notre affichage ne change pas tout de suite. Les sessions ont un comportement un peu particulier. Ici meme si nous avons bien envoyé un query param dans l'url pour nous deconnecter, la page va encore se souvenir de nos données de sessions, meme si elles sont maintenant detruite car elle garde les données de la requette precedante en memoire . Il faut donc encore une fois faire une requette (et cette fois si avec des données de session vierge) Pour mettre a jour notre affichage. Nous pouvons soit cliqué sur le bouton pour se deconnecter deux fois ou nous pouvons faire une redirection avec notre fonction header apres avoir fait appel a la fonction session_destroy.

    Si c'est pas trés clair pour vous, c'est pas trés grave, prenez juste l'habitude de faire une redirection apres avoir fait appel a la fonction session_destroy!
    */
    session_destroy();

    //ici je redirige!
    header('location:./session_start.php');
}

?>

<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <h2 class="text-center text-success"> Bienvenue aux informations de la session!! </h2>
        <h4 class="text-center">
            Voici les informations conserver dans votre session!
            
        </h4>
        <?php if(isset($_SESSION["user"])):?>
        <ul>
            <li> Prenom: <?php echo $_SESSION["user"]["firstname"]?> </li>
            <li> Nom: <?php echo $_SESSION["user"]["lastname"]?> </li>
            <li> Email: <?php echo $_SESSION["user"]["email"] ?></li>
        </ul>
        <!--
            Ici lors que je clique sur le lien pour me deconnecter, je vais envoyer un query param dans l'url que je vais appeler logout et je vais lui donner la valeur true.
        -->
        <a href="?logout=<?php echo true ?>" class="btn btn-primary col-2 offset-2"> Deconnection</a>
        <?php endif ?>

        <br/>
     

    
    </body>
</html>