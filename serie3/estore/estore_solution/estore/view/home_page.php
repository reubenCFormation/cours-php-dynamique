<?php
 require_once('./header.php');
 require_once('../database/queries.php');

 if(isset($_GET["logout"])&& $_GET["logout"]==true){
        
    // Apres avoir appelé la fonction session_destroy je vais rediriger vers la page d'accueil ce qui a pour but de rafraichir la page une deuxieme fois et donc de vider mon tableau $_SESSION"
    session_destroy();
    
    header('location:./home_page.php');
}

if(isset($_GET["flagProductId"]) && !empty($_GET["flagProductId"])){
    flagProductQuery($_GET["flagProductId"]);
    $flagMsg="Produit signalé comme offensif";
}



$products=getAllProductsQuery();



 

?>

<!DOCTYPE html>

<html>
    <head>
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
     <link rel="stylesheet" href="style/style.css"/>
    </head>

    <body style="background:#fafdfe;">
        <div class="container"> 
            <?php
                if(isset($_GET["welcome"])):?>
                    <h4 class="text-center text-success"> <?php echo $_GET["welcome"] ?> </h4>
                <?php endif ?>

                <?php if(isset($flagMsg) && !empty($flagMsg)):?>
                    <h4 class="text-warning text-center"> <?php echo $flagMsg ?> </h4>
                <?php endif ?>

                <?php if(isset($_GET["basket_validated_msg"])):?>
                    <h4 class="text-success text-center"> <?php echo $_GET["basket_validated_msg"] ?> </h4>
                <?php endif ?>
            
           <?php if(count($products)>0):?>
                <div class="d-flex flex-wrap justify-content-center">
                    <?php foreach($products as $product):?>
                        <div class="card col-3 m-2">
                         <img style="height:200px; object-fit:cover;" class="card-img-top" src=<?php echo $product["photo"]?> alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product["title"]?></h5>
                                <p class="card-text"><?php echo $product["description"] ?></p>

                                <?php if(isset($_SESSION["user"])):?>
                                <div class="d-flex flex-column align-items-center">
                               
                                    <?php if($product["quantity"]>0 && !$product["is_flagged"]): ?>
                                    
                                        <a href="./product_details.php?product_id=<?php echo $product["id"]?>" class="btn btn-primary col-9 m-1"> Voir les details </a>
                                    <?php elseif($product["quantity"]<0 && !$product["is_flagged"]): ?>
                                        <div class="text-center text-warning"> Hors Stocke </div>

                                     <?php elseif($product["is_flagged"]):?>
                                       
                                        <div class="text-warning text-center"> Ce produit a etait signalé comme etant offensif </div>
                                    <?php endif ?>

                                    <?php if($_SESSION["user"]["role"]=="admin"):?>
                                        <?php if(!$product["is_flagged"]):?>
                                        <a href="?flagProductId=<?php echo $product["id"]?>" class="btn btn-warning col-9 m-1"> Signaler comme offensif </a>
                                            
                                        <?php endif ?>
                                    <?php endif ?>
                                    </div>
                                <?php endif ?>
                                
                            </div>
                        </div>
                    <?php endforeach?>
                </div>
             <?php else :?>

              <h4 class="text-warning"> Pas de produit actuellement en base</h4>
            <?php endif ?>
           <!--
            PARTIE 1
                 Dans un premier temps, trouvez un moyen d'afficher tous nos produits (il  va falloir recuperer nos produits dans la base de données et les afficher ici). Pour ce faire, ecrivez votre requete dans le fichier queires.php avec une fonction, et ensuite faites appel a cette fonction que vous avez ecrit dans queries.php dans votre productController.php qui aura pour but d'afficher tous nos produits.  Affichez le titre, la description  et la photo du produit. Utilisez la classe card de bootstrap pour vous faciliter le travail. 
            PARTIE 2

                 Aprés avoir pu recuperer les produits et les affichez:
                    a) Si l'utilisateur est connecté (cette a dire que il s'est authentifié). Nous allons aussi affichez les produits mais nous allons rajouter qq fonctionnalités. Faites en sorte d'afficher l'une des deux choses suivantes. Si il reste des produits en stocke, affichez un lien pour voir les details du produit. Ce lien va pointez vers la page product_details.php Si il nous reste plus de produit en stocke, affichez un message disant que le produit est hors stocke et nous n'allons pas avoir de lien pour consulter le produit. 

                    b) Si notre utilisateur est connecté et que il a le role admin, pour chacun de nos produits, rajoutez un lien pour pouvoir signaler le produit dans la liste comme etant offensif si nous le souhaitons. 

                    BONUS: En cliquant sur le lien pour signaler un produit comme etant offensif, nous allons faire une requette sql et mettre a jour ce produit pour le signaler comme etant offensif dans la base de données. En ooutre, si un produit est signalé comme offensif,il n'y aura plus de lien pour consuler les details du produit. 
            -->

     
        </div>
    </body>

    <script>
    // ce code est neccesaire pour empecher notre formulaire d'etre soumis a chaque fois que la page a etait rafraichi
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
</html>