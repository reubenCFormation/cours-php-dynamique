<?php
// creer un dossier ex3 contenu dans votre dossier exercises dans lequelle vous allez ecrire tous vos fichiers pour cette exercises
 /*
    1) Utiliser la meme base de données que vous avez utilisé pendant dans ex1

    2) Ecrivez un fichier auth.php ou vous allez vous authentifier comme utilisateur en saissisant votre email et votre mot de passe.Si la combinaison d'email et de mot de passe n'est pas bonne, faites apparaitre un message d'erreur  Si la combinaison d'email et de mot de passe est bonne, rediriger vers un fichier  que vous allez appeler user_info.php.

    3)Dans le fichier user_info.php, si nous avons des informations stocké dans notre variable globale $_SESSION, faites apparaitre sous forme de ul le prenom,nom et l'email de l'utlisateur stocké en session. Sinon faites apparaitre un petit message qui dit que il n'y a aucun utilisateur connecté pour le moment. Faites egalement apparaitre un lien pour vous deconnecter de la session. lors que vous allez cliquer sur ce lien, faites en sorte de transmettre un query param dans l'url qui dira que vous voulez terminer la session


    4)Ecrivez un fichier home_page.php qui va detruire notre session si nous avons une instruction (query param) dans notre url pour terminer la session. Faites egalement apparaitre un titre sur la page pour indiquer que nous sommes sur la page d'accueil

    5) Faites apparaitre un header sur chacune de vos pages. Ce header sera ecrit dans un fichier qui va s'appeler header.php. Ce header aura un lien pour aller a la page auth.php,home_page.php et user_info.php. Faites apparaitre ce header dans chacune de vos pages

 */
?>