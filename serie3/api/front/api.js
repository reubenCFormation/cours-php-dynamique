/*
 On a souvent entendu le mot A.P.I mais est ce que on sait reelement ce que c'est? Moi je sais, mais que a moitié peut etre mais je vais essayer d'expliquer. 

 A.P.I porte l'acronyme Application Programming Interface. Grossomodo, une A.P.I est utilisé pour faire deux machines communiquer entre eux. Dans le web, nous utilisons les API rest. En API Rest, le client (le front end) va faire une demande au serveur (dans ce cas,le serveur se sont nos fichiers PHP) et le serveur va repondre au client soit avec du html mais plus souvent avec du JSON. Donc le client adresse une demande au serveur et le serveur traite cette demande et lui fournit un reponse. 

 Il y a deux methodes principales que les API utilisent. 

 1) GET: La methode GET est utilisés pour recuperer les données d'un serveur web et uniquement pour ca. Nous n'allons pas "ecrire" des données dans le back end mais seulement les recuperer. Il est fortement deconseillés d'envoyer des données au serveur avec la methode GET, pour divers raisons de securité et aussi par convention. Pour cela il faut utiliser la methode POST. En outre, la methode GET a des limitations par rapport a la longeur en terme de chaine de caracteres et les urls seront stocké dans la memoire

 2) POST: La methode POST sera utilisé pour ecrire des données au serveur. Ces données seront contenu dans le "request body" et seront recuperer par le serveur. Le servuer va ensuite traiter ces données pour faire divers chsoes (la plupar du temps pour ajouter des champs a la base de données).

 Il y aussi la methode PUT qui peux etre utilisé pour modifier des données mais elle est moins souvent utilisé


*/