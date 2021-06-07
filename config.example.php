<?php
    // GET DEL POST 7 DAYS resp/*
    $applicationKey = "Nti8t2zEjJ";
    $applicationSecret = "RFBZQVWugQY6y8A5tH";
    $consumerKey = "2MFu1ri4NgzZLQa3uZg";

    $endpoint = 'ovh-eu';
    $domain = "example.fr";
    $imapServer = 'ssl0.ovh.net';

    $cookieName = 'remember_' . str_replace(['.', '-'], '_', $domain);
    $singleSession = false; // propagation de la session vers les autres sous-domaines

    $lang = 'fr';

    $buttons = [
        'delete' => [
            'button' => 'Supprimer',
            'class' => 'danger'
        ],
        'create' => [
            'button' => 'Créer',
            'class' => 'primary'
        ],
        'show' => [
            'button' => 'Visualiser',
            'class' => 'info'
        ]
    ];

    $messageError = "Une erreur s'est produite, merci de rééssayer.";
    $classError = 'danger';
// test
