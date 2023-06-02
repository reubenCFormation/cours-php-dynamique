<?php
/*
 Pensez a la situation suivante: Nous avons un site e-commerce pour acheter des produits,Sur le site nous allons pouvoir consulter et acheter des produits sur le site. Voici les details du site:
 1) Nous allons avoir des utlisateurs qui vont pouvoir consulter et acheter des produits 
 2)Un produit doit forcement etre rajouté par un utilisateur authentifié et nous allons lié ce produit a l'utilisateur qui l'a rajouté. L'utilisateur pourra par la suite modifier les informations sur ce produit
 3) Un utilisateur aura un role, soit auditeur, soit admin. Les admins pourront supprimer des produits qui aurai une description offensif, ils pourront donc "flaggé" un produit comme etant offensif et decider de le desactivé.
 4)Un produit va avoir un titre, une description,une quantité et une photo (la photo n'est pas obligatoire) et finalement nous allons vouloir savoir si ce produit a etait "flaggé" par l'admin. Un produit sera aussi lié a l'utilisateur qui l'aurai ajouté 
 5) Un produit sera aussi lié a une categorie. Un produit peut avoir plusiers categories et une categorie peut etre lié a plusiers produits
 6) Un utilisateur va pouvoir acheter des produits et lors que il achete un produit ce produit sera rajouté dans son panier. Un panier peux comporter pluseirs produits, mais un panier sera forceement lié a un utilisateur. Un panier aura aussi un statut et ce status va correspondre a si il est validé ou non.

 // Avec ces informations essayés de concevoir un mcd pour une telle applications 
 


*/

?>