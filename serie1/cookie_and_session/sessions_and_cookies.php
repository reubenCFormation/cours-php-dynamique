<?php
/*
    On entend souvent parlé des termes cookie et sessions.Les deux termes sont liés mais pas exactement la meme chose.
    1) Que est un cookie? Un cookie est un petit fichier texte qui sera sauvegardé coté client. Ainsi ce fichier texte pourra sauvegarder certaines informations de notre utilisateur pour pouvoir meiux cerner ces habitudes. Etant donnée que les cookies sont stocké coté client, ils sont pas trés securisé et tout le monde peux venir consulter les informations. Finalement,les cookies ne peux que sauvegarder des chaines de caracteres comme type de données.

    2) Que est une session? Une session est une maniere de sauvegarder des informations de maniere plus securisé. Contrairement au cookies, les sessions sauvegardent leurs informations sur un serveur securisé et donc sont beaucoup plus securisé que les cookies. Une session prends fin automatiqueemnt lors que l'utilisateur ferme son navigateur ou lors que il se deconnecte

    3) Comment fonctionnent l'interaction entre les cookies et les session? Lors que nous allons crée une session, nous allons églament creer un cookie et ce cookie va avoir un identifiant. Les informations de notre session seront sauvegarder sur une base de données coté serveur et notre session va pouvoir etre identifié par l'id unique du cookie qui vient d'etre crée qui sera sauvegardé en base de données et pourra identifier la session
*/

 

?>