<?php 
    session_start();
    use Ovh\Api;
    use GuzzleHttp\Client;
    require __DIR__ . '/../vendor/autoload.php';
    // spl_autoload_register(function ($className) {
    //     include '/controllers/' . $className . '.php';
    // });

    require_once('../config.php');
    require_once('../src/fonctions.php');
    require_once('../controllers/GETController.php');
    require_once('../controllers/POSTController.php');

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

    $messageError = "Une erreur s'est produite, merci de rééssayer. <a class='ml-3 icon-left-outline' href='".$_SERVER['HTTP_REFERER']."'>retour</a>";
    $classError = 'danger';

    $routes = [
        'GET' => ['create', 'show', 'delete', 'logout', 'index', 'error404'],
        'POST' => ['create', 'index'],
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

    // Les données utilisées dans les différentes méthodes des controllers
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