<?php
/*
  la variable en php $_GET est une variable super globale. Une super global est une variable qui est accesible partout dans notre php. Elle sera reconnu dans une fonction comme en dehors d'une fonction. Cette variable est donc accesible dans chaque contexte et partout dans notre projet.

  En l'occurence, la variable $_GET va nous recuperer les données envoyés par un formulaire a partir de l'url. Les données qui ont etait transmis par le formulaire seront envoyés dans l'url et nous allons pouvoir les recupere avec la superglobale $_GET. Notez que le fait d'envoyer des données sensible (comme un mot de passe par exemple) via get est trés deconsiellé. En effet, nos données seront consultable de l'url et chaque utilisateur va pouvoir les voir.

 */
// La methode empty en php va verifier si une valeur est une chaine de caractere ou un tableau vide!. 
 if(!empty($_GET)){
    echo "get is set <br/>";
    var_dump($_GET);
 }



?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
        <!--
            notez ici la propreité method, c'est pour dire que les données de notre forumaire seront envoyés en get. Nos données seront donc envoyés dans l'url et nous allons ainsi pouvoir recuperer nos données de l'url.
        -->
    <div class="container">
        <h2 class="text-center"> Envoyés de données via GET </h2>
    <form method="get" class="col-4 offset-2">
       
        <div class="form-group">
         <label for="exampleInputEmail1">firstname</label>
          <!--
            notez que chaque champ input a une proprieté name! En effet, pour pouvoir recuperer nos données, il faut bien cette proprieté name, sinon, notre php (dans ce cas avec $_POST) ne pourra pas recupere la donnée du formulaire!
        -->
         <input type="text" class="form-control" name="firstname">
  
        </div>
        <div class="form-group">
         <label for="exampleInputEmail1">lastname</label>
         <input type="text" class="form-control" name="lastname">
        </div>
        <div class="form-group">
         <label for="exampleInputEmail1">Email address</label>
         <input type="email" class="form-control" name="email">
  
        </div>
        <div class="form-group">
         <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" name="password">
        </div>
        <div class="d-flex col-4 justify-content-center">
            <!--
                Ici lors que je vais soumettre mon bouton, la page va se rafraichir et donc notre fichier va se re-executer de haut en bas et nous allons constater que vu que nous venons d'envoyer un formumaire en post, notre superglobale $_POST ne sera donc plus vide et nous allons pouvoir recuperer les données que nous venons d'envoyer avec notre superglobale $_POST
            -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      
    </form>
    </div>

    </body>
</html>