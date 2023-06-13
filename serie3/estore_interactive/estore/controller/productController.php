<?php

 require_once('../database/queries.php');
 
 $getUrl=$_SERVER["REQUEST_URI"];
 /*
  Ici je vais recuperer la chaine de caractere contenu apres ma derniere occurence de / dans mon url. 

 */
 $findLastOccurence=strrchr($getUrl,"/");
 /*
  Si add_product.php est trouvé dans la chaine de caractere qui a etait renvoyé par $findLastOccurence, ca veux dire que je suis actuellement sur la page add_product.php, je vais donc declencher la fonction getAddProduct
 */
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