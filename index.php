<?php 
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    // spl_autoload_register(function ($className) {
    //     include '/controllers/' . $className . '.php';
    // });

    require_once('./config.php');
    require_once('./src/fonctions.php');
    require_once('./controllers/GETController.php');
    require_once('./controllers/POSTController.php');
    use \Ovh\Api;
    use \GuzzleHttp\Client;
    use \GuzzleHttp\Exception\RequestException;

    $contenu = '';
    
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

    $routes = ['create', 'show', 'delete', 'logout'];

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

    $messageError = "Une erreur s'est produite, merci de rééssayer. ";
    $classError = 'danger';

    $account = $_SESSION['account'] ?? '';
    $needToConnect = $_SESSION['needToConnect'] ?? true;
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? 'default';

    if(! in_array($action, $routes) && $action != 'default'){
        header("Location: /");
        exit;
    }

    // Si aucun membre n'est connecté
    if($needToConnect){
        if($method == 'GET'){
            ob_start();
            include('./views/login.php');
            $contenu = ob_get_clean();
        }else if($method == 'POST'){
            $account = htmlentities($_POST['account']);
            $email = $account .'@'. $domain;
            $password = htmlentities($_POST['password']);

            if (! canLoginEmailAccount($imapServer, $email, $password)){        
                $class = 'danger';
                $message = "Impossible de vous connecter, veuillez rééssayer.";
                
                ob_start();
                include('./views/login.php');
                $contenu = ob_get_clean();
            }else{
                $needToConnect = false;
                ob_start();
                include('./views/logged.php');
                $contenu = ob_get_clean();
            }
        }
    }else{
        // On checke si le compte possède déjà un répondeur ou non
        // Si une erreur est générée alors on suppose que c'est non
        try {
            $conn->get("/email/domain/$domain/responder/$account/");
            $_SESSION['responderAvailable'] = true;
        } catch (RequestException $e) {
            unset($_SESSION['responderAvailable']);
        }

        // Les données utilisées dans les différentes méthodes des controllers
        $data = [
            'domain' => $domain,
            'account' => $account,
            'conn' => $conn,
            'buttons' => $buttons,
            'action' => $action,
            'classError' => $classError,
            'messageError' => $messageError,
        ];

        $controller = $method.'Controller';

        ob_start();
        $controller::$action($data);
        $contenu = ob_get_clean();
    }

    require './views/layout.php';

    // On met à jour les variables de SESSION
    $_SESSION['needToConnect'] = $needToConnect;
    $_SESSION['account'] = $account;
?>