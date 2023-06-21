<?php
require_once('./header.php');
require_once('../database/queries.php');


 if(isset($_GET["flag_comment"])){
   flagCommentQuery($_GET["flag_comment"]);
   $flagMsg="commentaire signalé comme offensif!";
 }

 if(isset($_GET["product_id"]) && !empty($_GET["product_id"])){
  $comments=getProductCommentsQuery($_GET["product_id"]);
}

 /*
 echo '<pre>';
 var_dump($comments);
 echo '</pre>';
 */
 


?>

<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
    
      <div class="container">
      <h2> Commentaires pour le produit <span class="text-info">  <?php echo $_GET["product_title"] ?> </span> </h2>
      <div class="col-9 d-flex flex-column justify-content-center">
        <?php if(isset($flagMsg) && !empty($flagMsg)):?>
          <h4 class="text-warning text-center"> <?php echo $flagMsg ?> </h4>
        <?php endif ?>
        <?php if(!empty($comments)):?>
          <?php foreach($comments as $comment):?>
            <?php if(!$comment["is_flagged"]):?>
            <div class="border border-rounded bg-seconday p-2">
              <div class="text-center text-info"> Ecrit par <?php echo $comment["user_firstname"].' '.$comment["user_lastname"] ?>  </div>
               <p class="text-center"> <?php echo $comment["comment"] ?> </p>
               <?php if(isset($_SESSION["user"]) && $_SESSION["user"]["role"]=='admin'):?>
                <div class="d-flex justify-content-center">
                  <a href="comments.php?product_id=<?php echo $_GET["product_id"]?>&product_title=<?php echo $_GET["product_title"]?>&flag_comment=<?php echo $comment["id"] ?>" class="btn btn-warning col-3"> Signaler Comme Offensif </a>
               </div>
              
               <?php endif ?>
               <?php else: ?>
                <div class="d-flex justify-content-center">
                   <div class="text-center text-warning"> Ce commentaire a etait signalé comme innaproprié! </div>
                </div>
               
               <?php endif ?>
            </div>
            <br/>
            
          <?php endforeach ?>
        <?php endif ?>
      </div>

      
        
      </div>
        
    </body>
</html>