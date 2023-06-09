<?php
require_once("connect.php");

function userLoginQuery($email,$password){
    $dbConnector=connect();
    $sql="SELECT * FROM users WHERE email=?";
    $statement=$dbConnector->prepare($sql);
    $statement->execute([$email]);
    $getUser=$statement->fetch(PDO::FETCH_ASSOC);
  
    if(!empty($getUser)){
        try{
            $verifyPassword=password_verify($password,$getUser["password"]);
            if($verifyPassword){
                return $getUser;
            }
    
            else{
                return false;
            }
        }

        catch(PDOException $e){
            echo $e->getMessage();
        }
      
    }
}

function addProductQuery($title,$description,$price,$quantity,$user,$photoUrl=null){
    try{
        $dbConnector=connect();
        $sql="INSERT into products (title,description,price,quantity,user_id,photo) VALUES(?,?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$title,$description,$price,$quantity,$user,$photoUrl]);
        var_dump($statement);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
   
}

function addUserQuery($firstname,$lastname,$email,$hash){
    try{
        $dbConnector=connect();
        $sql="INSERT into users(firstname,lastname,email,password,role) VALUES (?,?,?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$firstname,$lastname,$email,$hash,'user']);
        return true;
    }
    
    catch(PDOException $e){
        echo $e->getMessage();
    }
}


function getAllProductsQuery(){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM products";
        $statement=$dbConnector->query($sql);
        $products=$statement->fetchAll(PDO::FETCH_ASSOC);
      
        return $products;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function findProductQuery($id){
    try{
        $dbConnector=connect();
        $sql="SELECT products.*,users.firstname AS user_firstname, users.lastname AS user_lastname, users.email AS user_email FROM products JOIN users ON products.user_id=users.id WHERE products.id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$id]);
        $product=$statement->fetch(PDO::FETCH_ASSOC);
        return $product;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function flagProductQuery($id){
    try{
        $dbConnector=connect();
        $sql="UPDATE products SET is_flagged=? WHERE id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute(['1',$id]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function addProductCommentQuery($comment,$productId,$userId){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO comments (comment,product_id,user_id) VALUES (?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$comment,$productId,$userId]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getProductCommentsQuery($productId){
    try{
        $dbConnector=connect();
        $sql="SELECT comments.*,
        products.title AS product_title, 
        users.firstname AS user_firstname,
        users.lastname AS user_lastname, 
        users.email AS user_email 
        FROM comments 
        JOIN products ON comments.product_id=products.id 
        JOIN users ON comments.user_id=users.id  
        WHERE product_id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$productId]);
        $comments=$statement->fetchAll(PDO::FETCH_ASSOC);
       
        return $comments;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function flagCommentQuery($commentId){
    try{
        $dbConnector=connect();
        $sql="UPDATE comments SET is_flagged=? WHERE id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute(['1',$commentId]);
        return true;
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}

function checkIfUserHasRatedProductQuery($productId,$userId){
    try{
        $dbConnector=connect();
        $sql="SELECT * FROM ratings 
        JOIN products ON ratings.product_id=products.id 
        JOIN users ON ratings.user_id=users.id 
        WHERE ratings.product_id=? AND ratings.user_id=?";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$productId,$userId]);
        $result=$statement->fetchAll(PDO::FETCH_ASSOC);

        if(!$result){
            return false;
        }
        
        else{
            return true;
        }
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function rateProductQuery($rating,$productId,$userId){
    try{
        $dbConnector=connect();
        $sql="INSERT INTO ratings (rating,product_id,user_id) VALUES (?,?,?)";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$rating,$productId,$userId]);
        return true;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

function getAverageProductRatingQuery($productId){
    try{
        $dbConnector=connect();
        $sql="SELECT AVG(ratings.rating) AS average_rating FROM ratings 
        JOIN products ON ratings.product_id=products.id 
        WHERE products.id=?
        GROUP BY products.id";
        $statement=$dbConnector->prepare($sql);
        $statement->execute([$productId]);
        $ratings=$statement->fetch(PDO::FETCH_ASSOC);
        return $ratings;
    }

    catch(PDOException $e){
        echo $e->getMessage();
    }
}

// ECRIVEZ ICI UNE FONCTION POUR INSERER NOS UTILSATEURS

// ECRIVEZ ICI UNE FONCTION POUR RECUPERER TOUS NOS PRODUITS 

// ECRIVEZ ICI UNE FONCTION POUR RECUPERER UN PRODUIT SELON SON ID ET AFFICHEZ LES INFORMATIONS DE LA PERSONNE QUI A AJOUTE NOTRE PRODUIT










?>