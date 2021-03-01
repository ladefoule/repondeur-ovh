<?php 

    session_start();
    use Ovh\Api;
    use GuzzleHttp\Client;
    require __DIR__ . '/vendor/autoload.php';
    // spl_autoload_register(function ($className) {
    //     include '/controllers/' . $className . '.php';
    // });

    require_once('./config.php');
    require_once('./src/fonctions.php');
    require_once('./controllers/GETController.php');
    require_once('./controllers/POSTController.php');

    $contenu = ''; // Layout content

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

    $messageError = "Une erreur s'est produite, merci de rééssayer. ";
    $classError = 'danger';
    
    $routes = [
        'GET' => ['create', 'show', 'delete', 'logout', 'default'],
        'POST' => ['create', 'default'],
        // 'AUTH' => ['login', 'default'],
    ];

    $account = $_SESSION['account'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? 'default';

    if(! in_array($action, $routes[$method])){
        header("Location: /");
        exit;
    }

    $client = new Client([
        // 'http_errors' => false, // Todo : Essayer de trouver une solution pour récupérer le code erreur en utilisant la classe Api d'OVH
        'timeout' => 1,
        'headers' => [
            'User-Agent' => 'api_client'
        ]
    ]);

    // Initiation de la connexion à l'API OVH
    $conn = new Api($applicationKey,
        $applicationSecret,
        $endpoint,
        $consumer_key,
        $client
    );

    // Les données utilisées dans les différentes méthodes des controllers
    $array = [
        'domain' => $domain,
        'account' => $account,
        'conn' => $conn,
        'buttons' => $buttons,
        'action' => $action,
        'classError' => $classError,
        'messageError' => $messageError,
    ];
    
    // Si aucun membre n'est connecté
    if(! $account){
        if($method == 'GET'){
            ob_start();
            include('./views/login.php');
            $contenu = ob_get_clean();
        }else if($method == 'POST'){
            $email = htmlentities($_POST['account']) .'@'. $domain;
            $password = htmlentities($_POST['password']);

            if (! canLoginEmailAccount($imapServer, $email, $password)){        
                $class = 'danger';
                $message = "Impossible de vous connecter, veuillez rééssayer.";
                
                ob_start();
                include('./views/notification.php');
                include('./views/login.php');
                $contenu = ob_get_clean();
            }else{
                // Variables utilisées dans la view logged.php
                $account = htmlentities($_POST['account']);
                $responder = getApi($array);

                $_SESSION['account'] = $account; // On active la SESSION
                $array['account'] = $account; // On met à jour la variable $array

                ob_start();
                include('./views/logged.php');
                $contenu = ob_get_clean();
            }
        }
    }else{        
        $controller = $method.'Controller';

        ob_start();
        $controller::$action($array);
        $contenu = ob_get_clean();
    }

    require './views/layout.php';
?>