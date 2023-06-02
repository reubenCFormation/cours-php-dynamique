<?php
require_once("../controller/userController.php");

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <div class="container">
            <ul class="list-group col-6">
                <div class="d-flex"> 
                    <li class="list-group-item col-4"> Prenom </li>
                    <li class="list-group-item col-4"> Nom </li>
                    <li class="list-group-item col-4"> Email </li>
                </div>
                <!--
                    Ici je vais boucler sur mes utilisateurs. Nous avons fait un require du fichier userController et donc nous avons access a notre varaible $users
                -->     
                <?php foreach($users as $user):?>
                    <div class="d-flex"> 
                    <li class="list-group-item col-4"> <?php echo $user["firstname"] ?> </li>
                    <li class="list-group-item col-4"> <?php echo $user["lastname"] ?> </li>
                    <li class="list-group-item col-4"> <?php echo $user["email"] ?> </li>
                </div>
                <?php endforeach ?>
            </ul>
        </div>
    </body>
</html>