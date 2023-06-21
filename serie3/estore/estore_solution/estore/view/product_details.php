<?php
require_once('../database/queries.php');
require_once('./header.php');

 $product=findProductQuery($_GET["product_id"]);

 $hasUserRatedProduct=checkIfUserHasRatedProductQuery($_GET["product_id"],$_SESSION["user"]["id"]);

 if(!empty($_POST)){
    if(!empty($_POST["rating"])){
       $isProductRated=rateProductQuery($_POST["rating"],$_GET["product_id"],$_SESSION["user"]["id"]);

       if($isProductRated){
         $productAddedMsg="Produit bien note!";
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
        <div class="container mt-3">
           
              <!--
                Cette page va afficher les details d'un produit que nous aurons selectionné. Pensez a utilisez les query params. Ici, affichez le titre,la description,la quantité,le prix ef les informations sur la personne qui a posté le produit (prenom et email,pensez a une maniere d'ecrire votre requette sql pour pouvoir recuperer les informations de l'utilisateur qui a posté le produit!) Aussi, trouvez un moyen de recuperer le bon id du produit dans votre requette sql Affocainsi que la quantité en stocke  et le prix. A gauche, affichez une photo du produit qui a etait selectionné
            -->
            <h4 class="text-center text-info"> Details du produit </h4>
             <?php if($product["user_id"]!=$_SESSION["user"]["id"] && !$hasUserRatedProduct): ?>
                <?php if(isset($productAddedMsg) && !empty($productAddedMsg)):?>
                    <h4 class="text-center text-success"> <?php echo $productAddedMsg ?> </h4>
                <?php endif ?>
                <h4 class="text-center text-info"> Attribuer une note a ce produit! </h4>
                <div class="d-flex justify-content-center">
                    <form method="post">
                        <div class="form-group">
                        <label class="text-center text-info">Attribuer votre note</label>
                            <select class="form-control" name="rating">
                                 <option value=1> 1 </option>
                                 <option value=2> 2</option>
                                 <option value=3> 3</option>
                                 <option value=4> 4</option>
                                 <option value=5> 5</option>
                            </select>
                         </div>
                     
                    <div class="d-flex mt-2">
                        <button type="submit" class="btn btn-primary col">Notez!</button>
                     </div>
                    
                </form>
             </div>
             <?php endif ?>
            <br/>
            <div class="d-flex justify-content-around bg-light p-2">
                <div class="col-6">
                  <div class="border shadow d-flex flex-column align-items-center justify-content-center border rounded">
                    <h4 class="text-primary"> Titre: <?php echo $product["title"] ?> </h4>
                    <p class="col-6 text-info" style="overflow-wrap:break-word;" class="text-info text-center ">  <?php echo $product["description"] ?> </p>
                    <div class="text-info"> Quantité en stocke <?php echo $product["quantity"] ?> </div>
                    <div class="text-info"> Prix <?php echo $product["price"] ?> </div>
                 </div>
                 <div class="d-flex flex-column align-items-center">
                  <div class="text-primary"> Posté Par: <?php echo $product["user_firstname"] ?> <?php echo $product["user_lastname"] ?> 
                  </div>
                   
                  <div class="text-primary"> Contact: <?php echo $product["user_email"] ?> </div>
                </div>
                </div>


                <div class="col-4">
                    <div class="col">
                        <img style="width:100%;height:300px; object-fit:cover;" src=<?php echo $product["photo"] ?> />
                    </div>
                </div>

               
            </div>
          

           <br/>
           
            <div class="d-flex justify-content-center">
                <a href="./cart.php?productToAdd=<?php echo $product["id"] ?>" class="btn btn-primary col-4"> Ajouter Au Panier </a>
            </div>
            <br/>

            <div class="d-flex justify-content-center">
                <a href="./add_comment.php?product_id=<?php echo $product["id"] ?>& product_title=<?php echo $product["title"] ?>" class="btn btn-primary col-4"> Ecrire Un commentaire </a>
            </div>
            <br/>

            <div class="d-flex justify-content-center">
                <a href="./comments.php?product_id=<?php echo $product["id"] ?> &product_title=<?php echo $product["title"] ?>" class="btn btn-primary col-4"> Consulter les commentaires </a>
            </div>
            <br/>
        </div>
    </body>
</html>