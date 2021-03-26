OVH permet gérer les répondeurs directement dans leur panel d'administration. On a donc deux possibilités : 
    - soit on donne les accès du compte à tous les collaborateurs
    - soit on missionne quelqu'un qui sera chargé de gérer les répondeurs en fonction des demandes des collaborateurs

Avec cet outil, chacun de vos collaborateurs pourra gérer soit-même son répondeur sans passer par le compte principal OVH de votre structure.

PRÉREQUIS

    - installer composer
    - avoir un nom de domaine (ex : repondeur.example.com)
    - créer des accès OVH sur l'API : https://eu.api.ovh.com/createToken/ (get/post/delete sur l'url /email/domain/votredomaine.com/responder/*)

INSTALLATION

    1. composer install
    2. cp config.example.php config.php
    3. configurer le fichier config.php en fonction de votre cas

