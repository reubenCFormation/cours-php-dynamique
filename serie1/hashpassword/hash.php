<?php
// je recupere les informations de ma base de données!
require_once("../db/connect.php");
// Jusq'a present, nous constatons que nos mot de passe sont en claires. Ainsi, si quel que un arrivait a s'incruster dans notre base de données, ils pourront voler nos mot de passe trés facilement car ils sertont en claires. Eviddement, ceci presente de grandes risques de securité.

// ici je recupere le mot de passe en claire (ATTENTION, A ne jamais faire sur un vrai projet!!) Ici c'est juste pour l'exemple!
$password="password";
// Ici avec la fonction password_hash je peux crypté le mot de passe de l'utilisateur. Cette fonction prends deux parametres, le premier est le mot de passe en clair et le deuxieme et l'algorithme de cryptage que nous allons utiliser
$hashedPassword=password_hash($password,PASSWORD_BCRYPT);
// Ici nous pouvons voir a quoi ressemble un mot de passe crypté
var_dump($hashedPassword);
echo '<br>';

// ici je vais mettre a jour un utilisateur de ma base de donnée que je vais choisir par email
$sql="UPDATE users set PASSWORD=? WHERE email=?";
$statement=$dbConnector->prepare($sql);
// ici on est censé voir que la base de données s'est mise a jour avec le mot de passe crypté pour notre utilisateur
$statement->execute([$hashedPassword,"reubchou@gmail.com"]);




?>