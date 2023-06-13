<?php
/*
Pensez a la situation suivante: Nous avons un site e-commerce pour acheter des produits,Sur le site nous allons pouvoir consulter et acheter des produits sur le site. Voici les details du site:
 1) Nous allons avoir des utilisateurs avec les champs suivant
    a) firstname 
    b) lastname 
    c email 
    d password 
    e role 
2) Nous allons avoir des produits a vendre. Chaque produit va etre rajouté par un utilisateur. Un utilisateur va pouvoir rajouter plusiers produtis mais un produit sera forcement lié a un utlisateur. Voici les champs 
    a) title 
    b) description 
    c) photo 
    d) price 
    e) quantity requis et etre superieur a zero 
    f) is_flagged requis et par defaut sera 0
    Il faut egalement pensez a la relation entre la table products et users 

3) Nous allons avoir un panier. Un panier sera rataché a plusiers produits. Le meme produit peux aussi se retrouver dans plusiers paniers. Un panier ne sera que rattaché a un seul utilisateur. Voici les champs de notre panier 
   a) is_valid
   Il faut egalement pensez a la relation entre le panier et les utilisateurs ainsi que le panier et les produits 


A) dans un premier temps, essayez de concevoir un MCD pour cette situation. N'ecrivez pas les clés etrangeres mais ecrivez les relations 1,N, 0,N,O,1,1,1 selon la situation 


*/

?>