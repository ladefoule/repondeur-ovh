<?php 
    session_start();
    // session_destroy();
    require __DIR__ . '/vendor/autoload.php';
    require('./src/fonctions.php');
    use \Ovh\Api;
    use \GuzzleHttp\Client;
    use \Carbon\Carbon;
    
    // Informations about your application
    // Répondeur 30 jours
    // Répondeur accès 30 jours
    $applicationKey = "Pf27SCe4O3oMPFjX";
    $applicationSecret = "L5YgAPBR6OYLtQT9kERF8b3nnH9DfTr6";
    $consumer_key = "f1IfmhgXGmAKyjtT8BxttIOq6VnRM5VN";

    // OVH 30 Jours total
    // OVH 30 Jours total
    $applicationKey = "4pI5RSfi34liLLm9";
    $applicationSecret = "0efF73MYgnwchNFEVguxKtqkpFrXOfUu";
    $consumer_key = "KnoE3IZ4Tf1So5Eo03mxmUU4KuL7txwk";
    
    // Information about API and rights asked
    $endpoint = 'ovh-eu';

    $domain = "ladefoule.fr";
    $imapServer = 'ssl0.ovh.net';
    $content = '';

    $client = new Client([
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

    if($needToConnect){
        if($method == 'GET'){
            ob_start();
            include('./views/login.php');
            $content = ob_get_clean();
        }

        // ON VERIFIE ICI L'USER ET ON LE REDIRIGE VERS LE FORM SIYABESOIN
        // SI l'auth echous alors on sort
        if($method == 'POST'){
            $account = $_POST['account'];
            $email = $account .'@'. $domain;
            $password = $_POST['password'];

            if (! canLoginEmailAccount($imapServer, $email, $password)){        
                $class = 'danger';
                $message = "Impossible de vous connecter, veuillez rééssayer.";

                ob_start();
                include('./views/login.php');
                $content = ob_get_clean();
            }else{
                $needToConnect = false;
            }
        }
    }else{
        // Accès à la bonne route
        if($method == 'GET'){
            $route = $_GET['route'] ?? '';
            switch ($route) {
                case 'create':
                    ob_start();
                    include('./views/form.php');
                    $content = ob_get_clean();
                    break;

                case 'update':
                    ob_start();
                    include('./views/form.php');
                    $content = ob_get_clean();
                    break;

                case 'show':
                    ob_start();
                    include('./views/form.php');
                    $content = ob_get_clean();
                    break;
                
                case 'delete':
                    ob_start();
                    include('./views/form.php');
                    $content = ob_get_clean();
                    break;

                case 'logout':
                    session_destroy();
                    $needToConnect = true;
                    $account = '';
                    break;

                default:
                    // include('verif-account.php');
                    break;
            }

        // Traitement des requêtes vers l'API
        }else if($method == 'POST'){
            $action = $_POST['action'] ?? '';
            switch ($action) {
                case 'POST':
                    // $copyTo = $_POST['copyTo'];
                    $copy = isset($_POST['copy']) ? true : false;
                    $content = $_POST['content'];
                    $from = new Carbon($_POST['from']);
                    $to = new Carbon($_POST['to']);

                    try {    
                        $result = $conn->post("/email/domain/$domain/responder", array(
                            'account' => $account, // Account of domain (type: string)
                            'content' => $content, // Content of responder (type: string)
                            'copy' => $copy, // If false, emails will be dropped. If true and copyTo field is empty, emails will be delivered to your mailbox. If true and copyTo is set with an address, emails will be delivered to this address (type: boolean)
                            // 'copyTo' => $copyTo, // Account where copy emails (type: string)
                            'from' => $from, // Date of start responder (type: datetime)
                            'to' => $to, // Date of end responder (type: datetime)
                        ));
                
                        $class = 'success';
                        $message = "Répondeur créé avec succès !";
                    } catch (Exception $e) {
                        $response = $e->getResponse();
                        $responseBodyAsString = $response->getBody()->getContents();
                        echo $responseBodyAsString;
                        
                        $class = $classError;
                        $message = $messageError;
                    }
                    break;

                case 'GET':
                    $result = $conn->get("/email/domain/$domain/responder/$account");
                    // $copyTo = $result['copyTo'];
                    $copy = $result['copy'];
                    $content = $result['content'];
                    $from = $result['from'];
                    $to = $result['to'];

                    ob_start();
                    include('./views/form.php');
                    $content = ob_get_clean();
                    break;

                case 'DELETE':
                    try {  
                        $result = $conn->delete("/email/domain/$domain/responder/$account");
                        $class = 'success';
                        $message = "Répondeur supprimé avec succès !";
                    } catch (Exception $e) {
                        $response = $e->getResponse();
                        $responseBodyAsString = $response->getBody()->getContents();
                        echo $responseBodyAsString;
                        
                        $class = $classError;
                        $message = $messageError;
                    }
                    break;
                
                default:
                    // include('verif-account.php');
                    break;
            }
        }
    }

    require './views/layout.php';
    $_SESSION['needToConnect'] = $needToConnect;
    $_SESSION['account'] = $account;
?>