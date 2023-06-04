<?php
/*
 Pensez a la situation suivante: Nous avons un site e-commerce pour acheter des produits,Sur le site nous allons pouvoir consulter et acheter des produits sur le site. Voici les details du site:
 1) Nous allons avoir des utilisateurs qui vont pouvoir consulter des produits. Un utilisateur ayant le role admin va pouvoir aussi signaler des produits comme etant offensif! Un utlisateur aura les attributs suivant
    a) firstname (VARCHAR 100) requis
    b) lastname (VARCHAR 100) requis
    c email (VARCHAR 100) requis unique
    d password (VARCHAR 255) requis
    e role (VARCHAR 100) requis
2) Nous allons avoir des produits a vendre. Chaque produit va etre rajouté par un utilisateur. Etant donnée que un produit sera forcement rataché a un utilisateur, il faut forcement etre authentifié pour pouvoir rajouter un produit.
    a)title (VARCHAR 255) requis 
    b)description text requis 
    c) photo text 
    d) prix requis et doit etre superieur a zero 
    e) quantité requis et etre superieur a zero 
    f) is_flagged requis et par defaut sera 0
    Il faut egalement pensez a la relation entre la table products et users pour determiner la clé etrangere!

3) Nous allons avoir un panier. Un panier sera rataché a plusiers produits mais ne sera rataché que a un seul utilisateur. Un panier aura egalement un statut pour determiner si il est validé ou pas 
   a) is_valid
   Il faut egalement pensez a la relation entre le panier et les utilisateurs ainsi que le panier et les produits 


A) dans un premier temps, essayez de concevoir un MCD pour cette situation. N'ecrivez pas les clés etrangeres mais ecrivez les relations 1,N, 0,N,O,1,1,1 selon la situation 

B) dans un 2eme temps, ecrivez le code sql pour creer nos tables en vous inspirant du fichier blog.sql


*/

?>