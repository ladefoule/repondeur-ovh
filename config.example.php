<?php
    $applicationKey = "Nti8t2zEjJ";
    $applicationSecret = "RFBZQVWugQY6y8A5tH";
    $consumerKey = "2MFu1ri4NgzZLQa3uZg";

    $endpoint = 'ovh-eu';
    $domain = "example.fr";
    $imapServer = 'ssl0.ovh.net';

    $cookieName = 'remember_' . str_replace(['.', '-'], '_', $domain);
    $singleSession = false; // propagation de la session vers les autres sous-domaines

    $lang = 'fr';

    $messageError = "Une erreur s'est produite, merci de rééssayer.";
    $classError = 'danger';
// test
