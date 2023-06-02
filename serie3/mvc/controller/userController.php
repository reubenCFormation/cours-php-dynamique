<?php
// je fais appel a mon fichier qui contient toutes mes fonctions pour executer mes requettes sql
 require_once('../dbQueries/queries.php');
 // notre superglobal $_SERVER a access a une clé qui s'appelle "REQUEST_URI", cette clé va nous retourner l'url actuelle qui est inscrit dans notre navigateur
 var_dump($_SERVER["REQUEST_URI"]);

 $getUrl=$_SERVER["REQUEST_URI"];
// ici la fonction strpos va determiner si notre url contient la chaine de caracters "/insert_user.php" et si c'est le cas, elle va nous retourner l'index numerique de la premeire occurence dans la chaine de caracteres. Si elle ne trouve pas la chaine, elle va nous retourner false. Remarquer que notre url est basé sur le fichier que nous sommes en train d'executer. Si mon url aura /insert_user.php ceci veux dire que je suis en train d'executer les instructions contenu dans insert_user.php

// si nous sommes sur la page /insert_user.php
 if(strpos($getUrl,"/insert_user.php")!=false){
  
    // je vais faire appel a la fonction pour inserer mes données et en meme temps je vais verfier que elle me renvoie true et que mes données ont donc bien etait inseré. Si c'est le cas je vais declarer une variable $insertSuceeded que je vais pouvoir utiliser dans la veiw
    if(insertUserFormData()==true){
        $insertSucceeded=true;
       
    }
    
 
    
  }
  // si on voit dans l'url select_users.php (ce qui veux dire que j'execute le fichier select_users.php), je vais faire appel a la fonction getUsers qui va me retourner mes utilsateurs
  if(strpos($getUrl,"/select_users.php")!=false){
    $users=getUsers();
   
    
    
    
  }

 function insertUserFormData(){
    // si notre $_POST contient des valeurs
    if(!empty($_POST)){
        
        // si les valuers que j'ai saisi dans mon formulaire ne sont pas vides
        if(!empty($_POST["firstname"])&& !empty($_POST["lastname"]) && !empty($_POST["email"])&& !empty($_POST["password"])){
            
            $email=$_POST["email"];
            $firstname=$_POST["firstname"];
            $lastname=$_POST["lastname"];
            $passwordStr=$_POST["password"];
            // je crype mon mot de passe
            $hash=password_hash($passwordStr,PASSWORD_BCRYPT);

            // j'effecture mon insertion, et si elle fonctionne je suis censé etre retourné la valeur true
            $checkInsert=insertUser($firstname,$lastname,$email,$hash);
         
           // si la fonction insertUser me retourne true je vais a mon tour faire un return de true
            if($checkInsert){
               
                return true;
            }

            else{
                return false;
            }

            

        
        }
    }

    return false;
 }
 // ici je defini ma fonction pour recuperer mes utilisateurs. Je fait appel a la fonction selectUsers de mon fichier queries.php que j'ai require dans ce fichier
 function getUsers(){
    $users=selectUsers();
    return $users;
 }




  
 
 

?>