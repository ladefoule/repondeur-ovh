<?php

use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class POSTController
{
    /**
     * Method create
     *
     * @param array $array
     *
     * @return void
     */
    public static function create(array $array)
    {
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $action = $array['action'];
        $buttons = $array['buttons'];
        $classError = $array['classError'];
        $messageError = $array['messageError'];

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

        // header("Location : /");
        include('./views/logged.php');
    }
}
