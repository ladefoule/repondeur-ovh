OVH ne permet de gérer les répondeurs de mails que dans le panel d'administration. Pour ainsi activer cette possibilité là on se retrouve avec deux solutions : 
    - soit on donne les accès du compte principal à tous les collaborateurs ayant une adresse email
    - soit on missionne quelqu'un chargé de gérer les répondeurs en fonction des demandes des collaborateurs

Pour limiter les risques engendrés par le partage des accès OVH à tous les collaborateurs mais aussi éviter d'allouer des ressources permanentes pour ce genre de taches, utilisez plutôt cet outil qui s'occupera de gérer tout seul les répondeurs de mails de vos collaborateurs. Ces derniers auront chacun un espace pour gérer soit-même son répondeur sans passer par le compte principal OVH de votre structure.

PRÉREQUIS

    - installer php (installer et activer le module php-imap)
    - installer composer
    - avoir un nom de domaine (ex : repondeur.example.com)
    - créer des accès OVH sur l'API : https://eu.api.ovh.com/createToken/
      (avec les méthodes get/post/delete sur l'url /email/domain/VOTRENOMDEDOMAINE/responder/*)

INSTALLATION

    1. $ composer install
    2. $ cp config.example.php config.php
    3. configurer le fichier config.php en fonction de votre cas

