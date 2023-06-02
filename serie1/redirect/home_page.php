<?php
// ici nous allons utiliser des donnéés de notre session. Nous allons donc devoir faire appel a session_start()
session_start();
var_dump($_SESSION);

?>

<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <h2 class="text-center text-success"> Bienvenue a ma page d'accueil!! </h2>
        
    </body>
</html>