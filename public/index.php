<?php 
    session_start();
    use Ovh\Api;
    use GuzzleHttp\Client;
    require __DIR__ . '/../vendor/autoload.php';

    require_once('../config.php');

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

    $referer = $_SERVER['HTTP_REFERER'] ?? '/';
    $messageError = "Une erreur s'est produite, merci de rééssayer. <a class='ml-3 icon-left-outline' href='$referer'>retour</a>";
    $classError = 'danger';

    $routes = [
        'GET' => ['index', 'create', 'show', 'delete', 'logout'],
        'POST' => ['index', 'create'],
    ];

    $account = $_SESSION['account'] ?? '';
    $method = $_SERVER['REQUEST_METHOD'];
    $action = $_GET['action'] ?? 'index';

    // Si la route n'existe pas ou si elle existe mais que l'utilisateur n'est pas connecté
    if(! in_array($action, $routes[$method]) || (! $account && $action != 'index')){
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

    // Les données utilisées dans les différentes méthodes des models et controllers
    $array = [
        'domain' => $domain,
        'account' => $account,
        'conn' => $conn,
        'buttons' => $buttons,
        'action' => $action,
        'imapServer' => $imapServer,
        'classError' => $classError,
        'messageError' => $messageError,
    ];
    
    $controller = $method.'Controller';

    ob_start();
    $array = $controller::$action($array);
    $contenu = ob_get_clean();

    $responder = getApi($array);
    $account = $array['account'];
    require '../views/layout.php';
?>