<?php
/*
Le M.V.C est un acronyme pour Model-View_Controller. Cette une pratique d'ecriture de code qui est trés repandu sur beaucoup de frameworks php (Symfony,Laravel,Cake) etc. L'idée du MVC est de decouper notre application en trois grandes partie. Pour faire du "vrai" MVC il est meiux de pratiquer la programmation orienté objet car ca fluidifie beaucoup l'ecriture du code mais nous pouvons deja un peu commencer a aborder les idées du M.V.C et apprendre a meiux decouper notre code.

1) Le Model. Ceci correspond plus au moins a nos tables differentes dans notre base de données. C'est le model qui va gerer nos requettes sql a notre base de données et c'est dans notre model que les proprietés de nos tables seront defini. Nous n'avons pas encore abordé la programmation orienté objet donc il est difficile de faire un model au stade actuelle.
2) View. La partie view est tout simplement la partie visible de l'utilisateur. Concretement, c'est notre view qui va se charger d'afficher une donnée dynamique avec du html/css comme nous l'avons deja vu.
3)Controller. Le controller sera le "pont" entre le model et la view. Meme si ce n'est pas obligatoire. Le controller va souvent interoger une fonction qui sera ecrite dans notre modele. Notre controller va donc implementer la fonction ecrite dans notre modele en y faisant appel. Parfois cette fonction ecrit dans notre modele va nous retourner une valeur et dans ce cas le controlleur va recuperer la valeur et la transmettre a la view qui se chargera de faire l'affichage

*/


?>