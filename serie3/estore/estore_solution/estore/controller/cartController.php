<?php
require('../database/queries.php');
require('../database/cart_queries.php');
// ici je verifie si nous avons bien un utilisateur qui souhaite ajouter un produit dans notre panier et si c'est le cas nous allons traiter l'ajout du produit dans le panier
 if(isset($_GET["productToAdd"])){
    
    $cartItems=executeInsertToCartQuery($_SESSION["user"]["id"],$_GET["productToAdd"]);
 }
// si nous avons pas de queryParam productToAdd, ca veux dire que nos utilisateur n'ont pas cliquer sur un lien pour ajouter un produit, donc ils sont juste la pour consulter leur panier, dans ce cas, nous allons retourner les informations concernant les produits dans le panier
 else{
    // ici je vais d'abord devoir recuperer le panier de l'utilisateur. La fonction doesUserHaveActiveCartQuery va tester si un utilisateur a deja un panier actif ou pas. Si c'est le cas, nous serons retourné le panier de l'utilisateur. Sinon, nous seront retourné false.
    $getUserCart=doesUserHaveActiveCartQuery($_SESSION["user"]["id"]);
    // si nous avons bien un panier actif
    if($getUserCart){
        echo "CONDITION MET!!!";
        // je recupere tous les produits qui se trouvent dans ce panier
        $cartItems=getAllUserCartItemsQuery($getUserCart["id"]);
    }
    // sinon ca veux dire que notre panier est vide et nous avons rien dans notre panier
    else{
        $cartItems=[];
    }
    
 }

 if(isset($_GET["validate_basket"])){

 }
 // ici je vais ecrire une fonction pour calculer le nombre de produits qui se trouvent dans mon panier
 function buildTotalItems($items){
    $quantity=0;
    foreach($items as $item){
        // j'incremente la variable total par la quantité de chaque produit dans mon panier
        $quantity+=$item["quantity_in_cart"];
    }

    return $quantity;
 }
// ici je vais ecrire une fonction pour calculer le prix total par rapport aux produits dans mon panier
 function buildTotalPrice($items){
    $total=0;

    foreach($items as $item){
        // je multiplie le nombre de produits dans mon panier par le prix du produit
        $total+=$item["quantity_in_cart"]*$item["product_price"];
    }

    return $total;
 }

 // ici je creeé des variables qui vont stocker en valeur le nombre de produits dans mon panier ainsi que le prix total de mon panier et je vais pouvoir les afficher dans la vue cart.php

 $totalItems=buildTotalItems($cartItems);
 $totalPrice=buildTotalPrice($cartItems);

 function buildNewQuantity($items){
    
   
    foreach($items as $item){
        $cartReadyForValidate=true;
        // ici je vais recuperer la nouvelle quantité restant du produit en stocke apres avoir valider mon panier
        $newQuantity=$item["product_quantity"]-$item["quantity_in_cart"];
        $newQuantites=[];
        // si je veux valider plus d'achats produits qui se trouve actuellement en stocke
        if($newQuantity<0){
            $cartReadyForValidate=false;
            $_SESSION["quantity-warning"]="Quantité insuffisante pour valider ce produit";
            return false;
        }
        // sinon ca veux dire que il me reste suffisament de produits en stocke pour pouvoir les valider et je vais donc mettre a jour la quantité des produits dans mon panier
        else{
            $newQuantites[]=$newQuantity;
        }
    }

    if($cartReadyForValidate){
        foreach($newQuantites as $index=>$quantity){
            updateProductQuatntityQuery($quantity,$items[$index]["product_id"]);
        }
    }

    return true;
  
 
 }
 // si je suis pret a valider mon panier
 if(isset($_GET["validate_basket"])&& !empty($_GET["validate_basket"])){
    // si chaque produit a suffisament de quantité en stocke pour pouvoir etre validé,ici je sera retourné true
 $getCartReadyForValidate=buildNewQuantity($cartItems);
 // si je suis bien retourné true, je vais proceder a valider mon panier et donc a le desactiver.
if($getCartReadyForValidate){
    // ici nous avons toujours le meme paneir dans chacun de nos cartItems (qui correspond au parametre $items lors que je vais faire appel a la fonction) Je peux donc recuperer le premier indexe du tableau et recuperer l'id de mon panier vue que chaque index aura la meme valuer pour mon cart_id

    desactivateCartQuery($cartItems[0]["cart_id"]);
    // ensuite je redirige vers la page d'accueil et j'affiche un message de feliciations pour avoir valider le panier
    header('location:./home_page.php?basket_validated_msg=Merci, vous avez bien validé votre panier!');
}
 }


 


 echo'<pre>';
 var_dump($cartItems);
 echo '</pre>'




?>