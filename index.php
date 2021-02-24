<?php include('header.php') ?>

<?php
    require __DIR__ . '/vendor/autoload.php';
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

    $client = new Client([
        'timeout' => 1,
        'headers' => [
            'User-Agent' => 'api_client'
        ]
    ]);

    // $ovh = new Api( $applicationKey,  // Application Key
    //             $applicationSecret,  // Application Secret
    //             $endpoint,      // Endpoint of API OVH Europe (List of available endpoints)
    //             $consumer_key); // Consumer Key

    // Get servers list
    $conn = new Api($applicationKey,
            $applicationSecret,
            $endpoint,
            $consumer_key,
            $client
        );

    // Activation d'un répondeur
    // print_r($_POST);
    if(isset($_POST['responder_post'])){
        $account = $_POST['email'];
        $emailCopy = $_POST['email-copie'];
        $copy = isset($_POST['copie']) ? true : false;
        $content = $_POST['message'];
        $fromDate = new Carbon($_POST['debut']);
        $toDate = new Carbon($_POST['fin']);

        try {
            // $result = $conn->get("/email/domain/$domain/responder", array(
            //     'account' => $account, // Responder name (type: string)
            // ));
    
            $result = $conn->post("/email/domain/$domain/responder", array(
                'account' => $account, // Account of domain (type: string)
                'content' => $content, // Content of responder (type: string)
                'copy' => $copy, // If false, emails will be dropped. If true and copyTo field is empty, emails will be delivered to your mailbox. If true and copyTo is set with an address, emails will be delivered to this address (type: boolean)
                'copyTo' => $emailCopy, // Account where copy emails (type: string)
                'from' => $fromDate, // Date of start responder (type: datetime)
                'to' => $toDate, // Date of end responder (type: datetime)
            ));

            print_r( $result );

            ?>
                <div class="alert alert-success alert-block">    
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>Répondeur créé avec succès !</strong>
                </div>
            <?php
        } catch (Exception $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            // echo $responseBodyAsString;
            ?>
            <div class="alert alert-danger alert-block">    
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>Une erreur s'est produite, veuillez recommencer !</strong>
            </div>
            <?php
        }
    }
?>