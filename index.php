<?php 
    include('header.php');

    require __DIR__ . '/vendor/autoload.php';
    require('fonctions.php');
    use \Ovh\Api;
    use \GuzzleHttp\Client;
    use \Carbon\Carbon;
    
    // Informations about your application
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

    $messageError = "Une erreur s'est produite, merci de rééssayer. ";
    $classError = 'danger';

    $method = $_SERVER['REQUEST_METHOD'];
    
    if($method == "POST"){
        $action = $_POST['method'] ?? '';
        // ON VERIFIE ICI L'USER ET ON LE REDIRIGE VERS LE FORM SIYABESOIN
        // SI l'auth echous alors on sort

        switch ($action) {
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
                    
                    $class = $classError;
                    $message = $messageError;
                }
                break;

            case 'GET':

                break;

            case 'DELETE':
                $account = $_POST['email'];
                try {  
                    $result = $conn->delete("/email/domain/$domain/responder/$account");
                    $class = 'success';
                    $message = "Répondeur supprimé avec succès !";
                } catch (Exception $e) {
                    // $response = $e->getResponse();
                    // $responseBodyAsString = $response->getBody()->getContents();
                    // echo $responseBodyAsString;
                    
                    $class = $classError;
                    $message = $messageError;
                }
                break;
            
            default:
                // include('verif-account.php');
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
    }else{
?>

    <div class="col-lg-8 p-0">
        <div class="card">
            <div class="card-header p-3">
                Gestion de votre répondeur
            </div>
            <div class="card-body p-3">
                <form action="/" method="POST">
                    <div class="form-row pb-3">
                        <label for="email" class="col-12">Email <span class="text-danger">*</span></label>
                        <input type="text" required class="form-control col-8" id="email" name="email"><span class="col-4">@<?php echo $domain ?>r</span>
                    </div>

                    <button type="submit" class="btn btn-primary px-4" name="action" value="POST">Créer</button>
                    <button type="submit" class="btn btn-info px-4" name="action" value="GET">Voir</button>
                    <button type="submit" class="btn btn-warning px-4" name="action" value="PUT">Modifier</button>
                    <button type="submit" class="btn btn-danger px-4" name="action" value="DELETE">Supprimer</button>
                </form>
            </div>
        </div>
    </div>

<?php 
    }
include('footer.php');

?>