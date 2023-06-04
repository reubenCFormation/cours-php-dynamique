<?php

 require_once('../database/queries.php');
 
 $getUrl=$_SERVER["REQUEST_URI"];
 $findLastOccurence=strrchr($getUrl,"/");
 if(strpos($findLastOccurence,"add_product.php")){
    
   if(getAddProduct()){
     $successMsg="Produit rajouté avec success!";
   } 
   else if(!empty($_POST)){
    $errorMsg="Une erreur s'est produite!";
   }

   
 }

 if(strpos($findLastOccurence,"home_page.php")){
    
  /*
  rajouter un produit
  */

    
   
     
 }

 if(strpos($findLastOccurence,"product_details.php")){
    $product=findProduct();
    if(empty($product)){
      $errorMsg="Une erreur s'est produite";
    }
  
   
}



 function uploadImage(){
    if (isset($_FILES["image"])) {
        var_dump($_FILES);
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
  

 function getAddProduct(){
    
    if(!empty($_POST)){
        if(!empty($_POST["title"])&& !empty($_POST["description"]) && !empty($_POST["quantity"])){
            echo 'FUNCTION CALLED!';
            $title=$_POST["title"];
            $description=$_POST["description"];
            $quantity=$_POST["quantity"];
            $price=intval($_POST["price"]);
            $getImageUrl=uploadImage();
            $userId=$_SESSION["user"]["id"];
        
            $isProductAdded=addProductQuery($title,$description,$getImageUrl,$price,$quantity,$userId);

            if($isProductAdded){
                return true;
            }
        }
    }
  

 }
?>