<?php
/*
    Souvent, nos sessions vont stocker des informations sur des utilisateurs qui vont se connecter a nos sites web. Ces utilsateurs vont bien sur se deconnecter un jour. Etant donnée que les sessions vont souvent stocker des informations qui sont basé sur un utilisateur connecté, lors que un utilisateur va se deconnecter, nous allons vouloir se debarasser des informations de cette utilisateur car il n'est plus authentifié. Pour faire ceci, nous avons une fonction qui s'apelle session_destroy(). La fonction session_destroy() va effacter toutes les informations stocker dans la super globale $_SESSION. Lors que un utlisateur va se deconnecter, nous allons donc faire appel a la fonction session_destroy. 
*/

 

?>