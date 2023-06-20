<?php
require_once('./header.php');
require_once('../database/queries.php');

 if(isset($_GET["product_id"]) && !empty($_GET["product_id"])){
    $comments=getProductComments($_GET["product_id"]);
 }

 echo '<pre>';
 var_dump($comments);
 echo '</pre>';


?>

<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
    
      <div class="container">
      <h4 class="text-center"> Commentaires pour le produit <span class="text-info">  <?php echo $_GET["product_title"] ?> </span> </h4>

      
        
      </div>
        
    </body>
</html>