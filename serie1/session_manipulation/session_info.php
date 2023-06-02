<?php
session_start();

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
        <ul>
            <li> Prenom: <?php echo $_SESSION["user"]["firstname"]?> </li>
            <li> Nom: <?php echo $_SESSION["user"]["lastname"]?> </li>
            <li> Email: <?php echo $_SESSION["user"]["email"] ?></li>
        </ul>

        <br/>
        <a href="./home_page.php?logout=<?php echo true ?>" class="btn btn-primary col-2 offset-2"> Deconnection</a>

    
    </body>
</html>