<?php
// pour notre projet final. Nous allons creer un annuaire de gestion d'evenments. Nous aurons trois entités principales qui seront representés comme des tables dans notre base de données
 /*
    1) User. Un utilisateur aura les proprietés suivantes.Avant de pouvoir s'authentifier, un utlisateur va devoir s'inscrire.
        -id (clé primaire)
        -firstname VARCHAR 100
        -lastname VARCHAR 100
        -email VARCHAR 100
        -password  VARCHAR 255
        -description  TEXT
    2) Event. Un evenment aura les properietés suivantes
        -id (clé primaire)
        -title VARCHAR 100
        -description TEXT
        -category VARCHAR 100 (une categorie sera une liste deroulante de choix que vous allez choisir)
        -capacity  INT 
        -date DATE
        - A noter que un evenment sera crée par un utlisateur

    3) Ticket. Un ticket sera une reservation pour un evenment et aura les propertiés suivantes 
        -id (clé primaire)
        -un ticket sera lié a un evenment 
        - un ticket sera reservé par un utilsateur 



    Concernant les fonctionnalités nous devons faire les choses suivantes:

    1)Avoir la capacité de s'inscrire et de se connecter

    2) Pouvoir recuperer tous les evenments (on doit etre authentifié pour le faire). Nous allons que recuperer les evenments qui seront dans une date future
    3) Pouvoir recuperer les informations d'un evenment. Nous allons devoir aussi recuperer le prenom et le nom de chaque participant de l'evenment (le nom de chaque personne qui a reservé un billet) (nous devons etre authentifié pour le faire)
    4 )Pouvoir s'incrire a un evenemnt (nous devons etre authentifié pour le faire)
    5) Pouvoir creer un evenment (nous devons etre authentifié pour le faire)

 */


?>