<?php
// je charge le contenu de mon fichier userController.php
require_once("../controller/userController.php");


?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <div class="container">
            <h2 class="text-center"> Inserer un utilisateur </h2>
            <!--
                Ici je recupere ma variable $insertSuceeded qui va me renoyer lors que  un utlisateur a bien etait inseré.Si cette variable est bien defini et egale a true, je vais afficher mon message de felications pour dire que l'utlisateur a bien etait inseré en base de données
            -->
             <?php if(isset($insertSucceeded) &&$insertSucceeded==true):?>
                <h4 class="text-success text-center"> Utilisateur bien inseré </h4>
             <?php endif ?>
            <form method="post">
                <div class="form-group col-6 offset-2">
                    <label for="firstname"> Prenom</label>
                    <input type="text" name="firstname" class="form-control"/>
                </div>
                <div class="form-group col-6 offset-2">
                    <label for="lastname"> Nom </label>
                    <input type="text" name="lastname" class="form-control"/>
                </div>

                <div class="form-group col-6 offset-2">
                    <label for="email"> Email </label>
                    <input type="email" name="email" class="form-control"/>
                </div>

                <div class="form-group col-6 offset-2">
                    <label for="password"> Password </label>
                    <input type="password" name="password" class="form-control"/>
                </div>

                <div class="text-center d-flex justify-content-center mt-2">
                    <button type="submit" class="btn btn-primary col-3"> Valider </button>
                </div>


            </form>
        </div>
    </body>
</html>


<script>
    // ce code est neccesaire pour empecher notre formulaire d'etre soumis a chaque fois que la page a etait rafraichi
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>