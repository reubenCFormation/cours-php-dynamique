<?php
session_start();
if(isset($_GET["logout"]) && !empty($_GET["logout"])){
    var_dump($_GET["logout"]);
    echo '<br/>';
    session_destroy();

    var_dump($_SESSION);
}
?>

<!DOCTYPE html>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <h2 class="text-success text-center"> Bienvenue a la page d'accueil! </h2>
    </body>
</html>