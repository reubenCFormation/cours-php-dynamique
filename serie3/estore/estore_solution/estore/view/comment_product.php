<?php
require_once('./header.php');
require_once('../database/queries.php');
if(isset($_GET["product_id"])&& !empty($_GET["product_id"])){
    if(!empty($_POST) && !empty($_POST["comment"])){
        var_dump($_POST);
        $getProductAdded=addProductComment($_POST["comment"],$_GET["product_id"],$_SESSION["user"]["id"]);

        if($getProductAdded){
            $commentAddedMsg="cçmmentaire bien ajouté!";
        }
    }
}


?>

<!DOCTYPE html>
<html>
    <head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body>
    
      <div class="container">
      <h4 class="text-center"> Ajouter Un Commentaire Pour le produit <span class="text-info">  <?php echo $_GET["product_title"] ?> </span> </h4>

      <?php if(isset($commentAddedMsg) && !empty($commentAddedMsg)):?>
            <h4 class="text-center text-success"> <?php echo $commentAddedMsg ?> </h4>
        <?php endif ?>
        <div class="d-flex justify-content-center">
            <form method="post">
                <h4 class="text-center"> Mon Commenataire</h4>
                <textarea class="form-control" rows="10" cols="40" name="comment"></textarea>
                <br/>
                <div class="form-group">
                    <label for="exampleFormControlSelect2">Example multiple select</label>
                     <select class="form-control" name="score">
                             <option>1</option>
                             <option>2</option>
                             <option>3</option>
                             <option>4</option>
                             <option>5</option>
                    </select>
                </div>
                <div class="d-flex justify-content-center"> 
                    <button type="submit" class="btn btn-primary col-4"> Valider </button>
                </div>

                
            </form>
        </div>
        
      </div>
        
    </body>
</html>