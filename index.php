<?php 
    include('header.php');

    require __DIR__ . '/vendor/autoload.php';
    require('fonctions.php');
    use \Ovh\Api;
    use \GuzzleHttp\Client;
    use \Carbon\Carbon;
    
    // Informations about your application
    $applicationKey = "h4Owvc27Jb7kLzsM";
    $applicationSecret = "y150Fujxx6gQYq7G5UnMYo2Lue0M8ynV";
    $consumer_key = "zBcglspW9E54y9y0fEPGgMOY0tGwYy47";

    $applicationKey = "0xllQDAz0TkXJPcO";
    $applicationSecret = "mUMMiP2AkrFUNC3WuMYS3nfoxIWDJiyh";
    $consumer_key = "OnRl5zLELRHEJ8wxpKOA2Cts0GuGklRa";
    
    // Information about API and rights asked
    $endpoint = 'ovh-eu';

    $domain = "ladefoule.fr";
    $imapServer = 'ssl0.ovh.net';

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

    $method = $_SERVER['REQUEST_METHOD'];

    switch ($method) {
        case 'POST':
            $account = $_POST['email'];
            // $password = $_POST['password'];
            $emailCopy = $_POST['email-copie'];
            $copy = isset($_POST['copie']) ? true : false;
            $content = $_POST['message'];
            $fromDate = new Carbon($_POST['debut']);
            $toDate = new Carbon($_POST['fin']);

            // $email = $account .'@'. $domain;
            // if (!canLoginEmailAccount($imapServer, $email, $password)){
            //     $class = 'danger';
            //     $message = "Impossible de vous connecter, veuillez rééssayer.";
            //     break;            
            // }

            try {    
                $result = $conn->post("/email/domain/$domain/responder", array(
                    'account' => $account, // Account of domain (type: string)
                    'content' => $content, // Content of responder (type: string)
                    'copy' => $copy, // If false, emails will be dropped. If true and copyTo field is empty, emails will be delivered to your mailbox. If true and copyTo is set with an address, emails will be delivered to this address (type: boolean)
                    'copyTo' => $emailCopy, // Account where copy emails (type: string)
                    'from' => $fromDate, // Date of start responder (type: datetime)
                    'to' => $toDate, // Date of end responder (type: datetime)
                ));
        
                $class = 'success';
                $message = "Répondeur créé avec succès !";
            } catch (Exception $e) {
                // $response = $e->getResponse();
                // $responseBodyAsString = $response->getBody()->getContents();
                // echo $responseBodyAsString;
                
                $class = 'danger';
                $message = "Une erreur s'est produite, merci de rééssayer.";
            }
            break;
        
        default:
            # code...
            break;
    }

    // Personnalisation du message
    if(isset($message)){
        ?>
            <div class="alert alert-<?php echo $class ?> alert-block">    
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong><?php echo $message ?></strong>
            </div>
        <?php 
    }

    include('footer.php') 
?>