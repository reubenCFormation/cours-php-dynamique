<?php
require('../database/queries.php');
require('../database/cart_queries.php');
 $getUrl=$_SERVER["REQUEST_URI"];
 $findLastOccurence=strrchr($getUrl,"/");
/*
 if(strpos($findLastOccurence,"cart.php")){
    $cartItems=getCartItems();
   
    //var_dump($cartItems);
    if(!empty($cartItems)>0){
        $totalItems=getTotalBasketItems($cartItems);
        $totalPrice=getTotalCartItemsPrice($cartItems);
    }
    if(isset($_SESSION["quantity-warning"])){
        $errorMsg=$_SESSION["quantity-warning"];
        unset($_SESSION["quantity-warning"]);
    }

    if(isset($_GET["validate_basket"])&& $_GET["validate_basket"]==true){
        if(updateProductQuantity($cartItems)){
            header("location:home_page.php?validate_basket_msg=Panier bien validé!");
        }
        else{
            $errorMsg="Insuffisante Quantité en stocke";
        }
    }

 }

 function getCartItems(){
    if(isset($_GET["productAdded"])){
        
        $getCartItems=treatNewProductAddedToBasketQuery($_SESSION["user"]["id"],$_GET["productAdded"]);
        
        return $getCartItems; 
    }

    else{
        $getCart=checkIfUserHasActiveCartQuery($_SESSION["user"]["id"]);
       

        if(!empty($getCart)){
            $getCartItems=returnCartItemsQuery($getCart["id"]);
            return $getCartItems;
        }
    }
 }

 function getTotalCartItemsPrice($cartItems){
        $price=0;
        foreach($cartItems as $cartItem){
            $price+=$cartItem["quantity_in_cart"]*$cartItem["price"];
        }
        return $price;
 }

 function getTotalBasketItems($cartItems){
    $total=0;
    foreach($cartItems as $cartItem){
        $total+=$cartItem["quantity_in_cart"];
    }
    return $total;
 }

 function checkIfCartValid($cartItems){
        $quantites=[];
        foreach($cartItems as $cartItem){
            if($cartItem["quantity_in_cart"]>$cartItem["quantity"]){
               
                return false;
            }
            else{
                $quantites[]=$cartItem["quantity"]-$cartItem["quantity_in_cart"];
            }
            
        }

        return $quantites;
    
 }

 function updateProductQuantity($cartItems){
    
    $quantities=checkIfCartValid($cartItems);
    
   if(!empty($quantities)){
    foreach($cartItems as $index=>$cartItem){
        updateProductQuantityQuery($quantities[$index],$cartItem["id"]);
    
    }
    
    desactivateCartQuery($cartItems[0]["cart_id"]);
   
    return true;
   }

   else{
   
     return false;
   }
    
 }

 */


?>