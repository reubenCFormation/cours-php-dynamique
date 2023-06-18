<?php
require_once('connect.php');
require_once('queries.php');
// ici nous allons verifier si notre utilisateur a deja un panier en cours. Si c'est le cas, nous allons retourner les inforamtions sur le panier sous forme de tableau associatif. Sinon, nous allons retourner false
function doesUserHaveActiveCartQuery($userId){
 try{
    $dbConnector=connect();
    $sql="SELECT * FROM cart WHERE user_id=? AND is_active=?";
    $statement=$dbConnector->prepare($sql);
    $statement->execute([$userId,'1']);
    $result=$statement->fetch(PDO::FETCH_ASSOC);

    if($result){
        return $result;
    }

    else{
        return false;
    }
    
 }

 catch(PDOException $e){
    echo $e->getMessage();
 }
}
// ici j'ai une fonction pour ajouter un panier pour un utilisateur
function addCart($userId){
    try{
        $dbConnector=connect();
        // je creé mon nouveau panier ici
        $sql="INSERT into cart (is_active,user_id) VALUES (?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute(['1',$userId]);
        // ici je vais recuperer la derniere insertion grace a la methode pdo lastInsertId, en l'occurence ca sera notre nouvuera panier
        try{
            // en utilisant la dernier insertion, je vais pouvoir recuperer le panier que je viens de creer
            $lastInsertId=$dbConnector->lastInsertId();
            $sql="SELECT * FROM cart WHERE id=?";
            $statement=$dbConnector->prepare($sql);
            $statement->execute([$lastInsertId]);
            $getCart=$statement->fetch(PDO::FETCH_ASSOC);
           
            return $getCart;
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
       
        
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function executeInsertToCartQuery($userId,$productId){
   
 try{
  
    // je verifie si l'utilisateur a deja un panier en cours ou pas
    $getCart=doesUserHaveActiveCartQuery($userId);

    if($getCart){
       
        // ici je fait appel a la fonction pour inserer des produits dans un panier existant
        insertProductsIntoCartQuery($getCart["id"],$productId);
    }

    else{
        // ici je vais d'abord devoir creer un panier et ensuite je vais pouvoir inserer mes produits
        $getCart=addCart($userId);
        insertProductsIntoCartQuery($getCart["id"],$productId);
      
        
    }

    // quoi que il en soit je vais retourner les informations sur mes produits dans mon panier
  
    $getCartItems=getAllUserCartItemsQuery($getCart["id"]);

    return $getCartItems;
 }

 catch(PDOException $e){
    echo $e->getMessage();
 }
}
 // ici nous allons gerer l'ajout d'un produit a notre panier
function insertProductsIntoCartQuery($cartId,$productId){
    $dbConnector=connect();
    try{
        
        
        // si nous avons bien un panier en cours, je vais pouvoir y ajouter des produits au panier
        
            // avant d'ajouter des produits, je vais devoir verifier que il reste suffisament de produits en stocke pour pouvoir les ajouter au panier. Je vais donc faire appel a la fonction testIfQuantityAvaiableQuery en precisant le produit et le panier 
            $getIsAvailable=testIfQuantityAvailableQuery($productId,$cartId);
            // si il nous reste des produits en stocke, nous allons inserer le produit dans le panier via la table de jointure
            if($getIsAvailable){
            
                $sql="INSERT into cart_products (product_id,cart_id) VALUES (?,?)";
                $statement=$dbConnector->prepare($sql);
                $statement->execute([$productId,$cartId]);
               
            }
            // sinon je vais afficher un message d'avertissement pour dire que il n'a pas suffisament de produits en stocke
            else{
                
                $_SESSION["quantity-warning"]="Quantité insuffisante pour ce produit";
               
            }

           

        

        // si je n'ai pas de
    }
    
    catch(PDOException $e){
        echo $e->getMessage();
    }
}



function testIfQuantityAvailableQuery($productId,$cartId){
    try{
        $dbConnector=connect();
        // ici je vais verifier le nombre de produits dans le panier deja existant de l'utilisateur
        $sql="SELECT * FROM cart_products WHERE product_id=? AND cart_id=?";
        $statement=$dbConnector->prepare($sql);
        // je defini le produit et le panier
        $statement->execute([$productId,$cartId]);
        // je vais recuperer tous les produits contenu dans mon panier
        $getCartProducts=$statement->fetchAll(PDO::FETCH_ASSOC);

        // je vais maintenant devoir recuperer les informations sur mon produit. Vu que j'ai deja access au product_id, je peux tout simplement le passer en argument

        $getProduct=findProductQuery($productId);
        // ici je teste que nous avons suffisament de quantité en stocke
        if($getProduct["quantity"]>count($getCartProducts)){
            return true;
        }
        else{
            return false;
        }
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getAllUserCartItemsQuery($cartId){
    // ici je vais faire une grande requette pour recuperer tous les produits qui se trouvent dans mon panier.Je vais vouloir grouper par produit. Donc je vais vouloir afficher le nombre de fois que chaque produit se trouve dans mon panier. C'est une grande requette!
    try{
        $dbConnector=connect();
        $sql="SELECT 
        count(cart_products.product_id) AS quantity_in_cart, 
        cart.id AS cart_id,
        products.quantity AS product_quantity, 
        products.title AS product_title,
        products.price AS product_price,
        products.photo AS product_photo,
        products.description AS product_description
        FROM products 
        JOIN cart_products ON cart_products.product_id=products.id 
        JOIN cart ON cart_products.cart_id=cart.id 
        WHERE cart.id=?
        GROUP BY cart_products.product_id";

        $statement=$dbConnector->prepare($sql);
        
        $statement->execute([$cartId]);
        $getCartItems=$statement->fetchAll(PDO::FETCH_ASSOC);
        
        return $getCartItems;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }

}

function updateProductQuatntityQuery($newQuantity,$cartId){
    $dbConnector=connect();
    try{
        $sql="UPDATE cart SET quantity=? WHERE id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$newQuantity,$cartId]);
        return true;

    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function desactivateCartQuery($cartId){
 $dbConnector=connect();
 try{
    $sql="UPDATE cart SET is_active=? WHERE id=?";
    $statement=$dbConnector->prepare($sql);
    $statement->execute(['0',$cartId]);
    return true;
 }

 catch(PDOException $e){
    echo $e->getMessage();
 }
}
?>