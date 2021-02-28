<?php 
    session_start();
    require __DIR__ . '/vendor/autoload.php';
    spl_autoload_register(function ($className) {
        include '/controllers/' . $className . '.php';
    });

    require_once('./src/fonctions.php');
    require_once('./controllers/GETController.php');
    use \Ovh\Api;
    use \GuzzleHttp\Client;
    use \Carbon\Carbon;
    use \GuzzleHttp\Exception\RequestException;

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

    $routes = ['delete', 'show'];
    
    // Informations about your application
    // Répondeur 30 jours
    // Répondeur accès 30 jours
    // $applicationKey = "Pf27SCe4O3oMPFjX";
    // $applicationSecret = "L5YgAPBR6OYLtQT9kERF8b3nnH9DfTr6";
    // $consumer_key = "f1IfmhgXGmAKyjtT8BxttIOq6VnRM5VN";

    // OVH 30 Jours total
    // OVH 30 Jours total
    // $applicationKey = "4pI5RSfi34liLLm9";
    // $applicationSecret = "0efF73MYgnwchNFEVguxKtqkpFrXOfUu";
    // $consumer_key = "KnoE3IZ4Tf1So5Eo03mxmUU4KuL7txwk";

    // GET DEL POST 7 DAYS resp/*
    // GET DEL POST 7 DAYS resp/*
    $applicationKey = "Nti8t2jrFqCJzEjJ";
    $applicationSecret = "RFBZQ6VKGm6PM7c5cbOVWugQY6y8A5tH";
    $consumer_key = "2MFu1ri4lYHFCBv6BwHgWNgzZLQa3uZg";
    
    // Information about API and rights asked
    $endpoint = 'ovh-eu';

    $domain = "ladefoule.fr";
    $imapServer = 'ssl0.ovh.net';
    $contenu = '';

    $client = new Client([
        // 'http_errors' => false,
        'timeout' => 1,
        'headers' => [
            'User-Agent' => 'api_client'
        ]
    ]);

    // Get servers list
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
        try { 
            $conn->get("/email/domain/$domain/responder/$account/");
            $responderAvailable = true;
        } catch (RequestException $e) {
            $responderAvailable = false;
        }

        // Accès à la bonne route
        if($method == 'GET'){
            $data = [
                'domain' => $domain,
                'account' => $account,
                'conn' => $conn,
                'buttons' => $buttons,
                'action' => $action,
                'responderAvailable' => $responderAvailable
            ];

            $controller = $method.'Controller';

            ob_start();
            $controller::$action($data);
            $contenu = ob_get_clean();

        // Traitement des requêtes vers l'API
        }else if($method == 'POST'){
            switch ($action) {
                case 'create':
                    $copy = isset($_POST['copy']) ? true : false;
                    $content = htmlentities($_POST['content']);
                    $from = new Carbon($_POST['from']);
                    $to = new Carbon($_POST['to']);

                    try {  
                        $result = $conn->post("/email/domain/$domain/responder/", array(
                            'account' => $account, // Account of domain (type: string)
                            'content' => $content, // Content of responder (type: string)
                            'copy' => $copy, // If false, emails will be dropped. If true and copyTo field is empty, emails will be delivered to your mailbox. If true and copyTo is set with an address, emails will be delivered to this address (type: boolean)
                            'from' => $from, // Date of start responder (type: datetime)
                            'to' => $to, // Date of end responder (type: datetime)
                        ));
                
                        $class = 'success';
                        $message = "Répondeur créé avec succès !";
                        $responderAvailable = true;
                    } catch (RequestException $e) {                        
                        $class = $classError;
                        $message = $messageError;
                    }
                    break;

                case 'show':
                    try {  
                        $result = $conn->delete("/email/domain/$domain/responder/$account/");
                        $class = 'success';
                        $message = "Répondeur supprimé avec succès !";
                        $responderAvailable = false;
                    } catch (RequestException $e) {
                        // $response = $e->getResponse();
                        // $responseBodyAsString = $response->getBody()->getContents();
                        // echo $responseBodyAsString;
                        
                        $class = $classError;
                        $message = $messageError;
                    }
                    break;
                
                default:
                    break;

            }
            ob_start();
            include('./views/logged.php');
            $contenu = ob_get_clean();
        }
    }

    require './views/layout.php';
    $_SESSION['needToConnect'] = $needToConnect;
    $_SESSION['account'] = $account;
?>