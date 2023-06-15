<?php
require_once("./header.php");
require_once('../database/queries.php');
function uploadImage(){
    if (isset($_FILES["image"])) {
        //var_dump($_FILES);
        $file = $_FILES["image"];
      
        
        $fileName = $file["name"];
        $fileTmpPath = $file["tmp_name"];
        
      
        $targetDir = "uploads/";
        $targetFilePath = $targetDir . $fileName;
      
        
        if (move_uploaded_file($fileTmpPath, $targetFilePath)) {

         
          echo "File uploaded successfully.";
        }
        $getEndPosUrl=strpos($_SERVER["REQUEST_URI"],"/add_product.php");
       
       
        $getSubStrUrl=substr($_SERVER["REQUEST_URI"],0,$getEndPosUrl);
        

       
        
        $imageUrl ='http://'. $_SERVER["HTTP_HOST"] . $getSubStrUrl . '/' . $targetFilePath;
        
        return $imageUrl;
        
    }




 }


 if(!empty($_POST)){
    if(!empty($_POST["price"])&& !empty($_POST["title"])&& !empty($_POST["description"]) && !empty($_POST["quantity"])){
       
        $title=$_POST["title"];
        $description=$_POST["description"];
        $quantity=$_POST["quantity"];
        $price=intval($_POST["price"]);
        $getImageUrl=uploadImage();
        $userId=$_SESSION["user"]["id"];
    
        $getIsProductAdded=addProductQuery($title,$description,$price,$quantity,$userId,$getImageUrl);
        var_dump($getIsProductAdded);
        if($getIsProductAdded){
            $successMsg="Produit rajouté avec succes!";
        }

        
    }
}
  

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body style="background:#fafdfe;">
        <div class="container">
            <?php if(isset($errorMsg)): ?>
                <h4 class="text-center text-danger"> Une erreur s'est produite</h4>
            <?php endif ?>

            <?php if(isset($successMsg)):?>
                <h4 class="text-center text-success"> Produit rajouté avec succes! </h4>
            <?php endif ?>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group col-4">
                    <label for="title"> Titre </label>
                    <input type="text" class="form-control" name="title"/>
                </div>
                <div class="form-group col-4">
                    <div>  Description</div>
                    <textarea name="description" rows=10 cols=50> </textarea>
                </div>

                <div class="form-group col-4">
                    <label for="quantity"> Prix </label>
                    <input type="text" class="form-control" name="price">
                </div>

                <div class="form-group col-4">
                    <label for="quantity"> Quantité </label>
                    <input type="number" class="form-control" name="quantity"/>
                </div>

                <div class="form-group col-4">
                    <label for="photo"> Photo </label>
                    <input type="file" class="form-control" name="image"/>
                </div>

                <div class="form-group col-4 mt-2">
                    <button type="submit" class="btn btn-primary col-6"> Valider </button>
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