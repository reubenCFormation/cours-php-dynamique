<?php
require_once('./header.php');
require_once('../controller/userController.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <!--
            Ici, faites en sorte de pouvoir s'inscrire comme un utilisateur. Vous devriez avoir un formulaire avec les champs nom,prenom,email,et mot de passe. Lors que vous allez saisir ses informations et que toutes les informations seront bien rensiegnés, nous allons rediriger vers la page d'accuiel. Verifiez que notre utilisateur a bient etait inseré en base de données et que son mot de passe est bien crypté.

            //BONUS: faites en sorte d'afficher un message de bienvenue a l'utilisateur apres que il est validé son inscription. 
        -->
    </body>
</html>

<script>
    // ce code est neccesaire pour empecher notre formulaire d'etre soumis a chaque fois que la page a etait rafraichi
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>