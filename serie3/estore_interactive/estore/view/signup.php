<?php
require_once('./header.php');
require_once('../database/queries.php');

if(!empty($_POST)){
    $firstname=$_POST["firstname"];
    $lastname=$_POST["lastname"];
    $email=$_POST["email"];
    $passwordStr=$_POST["password"];

    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($passwordStr)){
        $hash=password_hash($passwordStr,PASSWORD_BCRYPT);
        $getInsert=addUserQuery($firstname,$lastname,$email,$hash);

        if($getInsert){
            $successMsg="utilisateur bien insere!";
        }
    }

    else{
        $errorMsg="Erreur de saisi des champs!";
    }

 }


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
    <div class="container"> 
        <?php if(isset($errorMsg) && !empty($errorMsg)):?>
                <h4 class="text-danger text-center"> <?php echo $errorMsg ?> </h4>
        <?php endif ?>

        <?php if(isset($successMsg) && !empty($successMsg)):?>
                <h4 class="text-success text-center"> <?php echo $successMsg ?> </h4>
        <?php endif ?>


        <h2 class="text-center"> Inscription </h2>
        <form method="post">
            
            <div class="form-group">
                <label for="exampleInputPassword1">firstname</label>
                <input type="text" class="form-control" name="firstname">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">lastname</label>
                <input type="text" class="form-control" name="lastname">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">email</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">password</label>
                <input type="password" class="form-control" name="password">
            </div>
            <br/>
            <div class="form-group w-100 d-flex justify-content-center">
                <button type="submit" class="w-25 btn btn-primary">Submit</button>
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