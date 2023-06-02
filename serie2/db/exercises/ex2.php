<?php
/*
 Pensez a la situation suivante: Nous avons un site e-commerce pour acheter des produits,Sur le site nous allons pouvoir consulter et acheter des produits sur le site. Voici les details du site:
 1) Nous allons avoir des utlisateurs qui vont pouvoir consulter et acheter des produits 
 2)Un produit doit forcement etre rajouté par un utilisateur authentifié et nous allons lié ce produit a l'utilisateur qui l'a rajouté.
 3) Un utilisateur aura un role, soit auditeur, soit admin. Que les admin pourront rajouter des produits mais cette restriction ne changera pas la conception de votre base de données. En outre, un utilisateur aura un firstname,lastname,email et mot de passe. Chacun de ces champs sont obligatoires
 4)Un produit va avoir un titre, une description,une quantité et une photo (la photo n'est pas obligatoire). Un produit sera aussi lié a l'utilisateur qui l'aurai ajouté
 5) Un produit sera aussi lié a une categorie. Un produit peut avoir plusiers categories et une categorie peut etre lié a plusiers produits
 6) Un utilisateur va pouvoir acheter des produits et lors que il achete un produit ce produit sera rajouté dans son panier. Un panier peux comporter pluseirs produits, mais un panier sera forceement lié a un utilisateur. Un panier aura aussi un statut et ce status va correspondre a si il est validé ou non.

 // Avec ces informations essayéz de concevoir la base de données pour une telle application. Ecrivez tout dans un fichier sql
 


*/

?>