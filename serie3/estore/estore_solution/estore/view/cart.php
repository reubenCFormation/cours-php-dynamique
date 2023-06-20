<?php
require_once('./header.php');
require_once('../controller/cartController.php');
// si j'ai bien un message m'indiquant que il n'a plus de stocke disponbile
if(isset($_SESSION["quantity-warning"])){
   
    // je vais creer une variable
    $quantityMsg=$_SESSION["quantity-warning"];
    // je vais ensuite unset $_SESSION["quantity-warning"] car je ne veux que afficher ce message une seul fois lors que nous essayons d'ajouter un produit avec un stock insuffisant et non chaque fois que nous allons rendre visite sur la page. Etant donnée que j'ai ma variable $qauntityMsg, le message s'affichera lors que il le faut.
    unset($_SESSION["quantity-warning"]);
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"/>
    </head>

    <body style="background:#fafdfe;">
        <div class="container">
            <h2 class="text-center text-info"> Mon Panier </h2>
            <?php if(isset($quantityMsg)):?>
                <h4 class="text-danger text-center"> <?php echo $quantityMsg ?> </h4>
            <?php endif ?>
                
            <?php if(!empty($cartItems)) :?>
            <?php foreach($cartItems as $cartItem):?>
            <div class="d-flex flex-column p-2">
                <div class="row border border-dark rounded d-flex">
                
                    <div class="col-3 align-self-center text-info p-1 border rounded"> Titre: <?php echo $cartItem["product_title"] ?></div>
                    <div class="col-3 p-1 border rounded"> <img style="height:150px; width:100%;object-fit:cover;" class="img img-fluid" src="<?php echo $cartItem["product_photo"]?>"/> </div>
                    <div style="overflow-wrap:break-word;" class="col-3 p-1 border rounded text-info"> <?php echo $cartItem["product_description"] ?></div>
                    <div class="col-3 align-self-center p-1 border rounded">
                        <div class="text-info"> Prix: <?php echo $cartItem["product_price"]?> </div>
                        <div class="text-info"> Quantité: <?php echo $cartItem["quantity_in_cart"] ?> </div>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
            <div class="col-9 row border border-dark p-2">
                <div class="col-4 p-1 border border-rounded text-center "> Nombre d'items dans votre panier:<?php echo $totalItems ?> </div>
                <div class="col-4 p-1 border border-rounded text-center "> Total de votre panier:<?php echo $totalPrice ?> </div>
                <div class="col-4 d-flex justify-content-center"> 
                <a href="cart.php?validate_basket=<?php echo true ?>" class="col-9 btn btn-primary"> Valider Le Panier </a>
                </div>
                
          </div>
          <?php endif?>
          
        </div>
    </body>
</html>

<script>
    // ce code est neccesaire pour empecher notre formulaire d'etre soumis a chaque fois que la page a etait rafraichi
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>