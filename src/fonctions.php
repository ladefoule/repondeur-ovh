<?php 

use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

Carbon::setLocale('fr');

function canLoginEmailAccount($imapServer, $email, $password)
{
    try {
        $mbox = imap_open('{'.$imapServer.':993/imap/ssl}INBOX', "$email", "$password");
        if (!$mbox) {
            return false;
        }

        // Close IMAP connection if it was correctly opened
        imap_close($mbox);

        return true;
    } catch (Exception $e) {
        return false;
    }
}

function getApi($array)
{
    $conn = $array['conn'];
    $domain = $array['domain'];
    $account = $array['account'];

    if(! $account)
        return false;

    // On checke si le compte possède déjà un répondeur ou non
    // Si une erreur est générée alors on suppose que c'est non
    try {
        $result = $conn->get("/email/domain/$domain/responder/$account/");
        $result['copy'] = $result['copy'];
        $result['content'] = htmlentities($result['content']);
        $from = new Carbon($result['from']);
        $result['from'] = $from->format('Y-m-d');
        $result['fromFR'] = $from->translatedFormat('d M Y');
        $to = new Carbon($result['to']);
        $result['to'] = $to->format('Y-m-d');
        $result['toFR'] = $to->translatedFormat('d M Y');
        return $result;
    } catch (RequestException $e) {
        return false;
    }
}

function postApi($array)
{
    $domain = $array['domain'];
    $account = $array['account'];
    $conn = $array['conn'];

    $copy = isset($_POST['copy']) ? true : false;
    $content = htmlentities($_POST['content']);
    $from = new Carbon($_POST['from']);
    $to = new Carbon($_POST['to']);

    try {  
        $conn->post("/email/domain/$domain/responder/", array(
            'account' => $account, // Account of domain (type: string)
            'content' => $content, // Content of responder (type: string)
            'copy' => $copy, // If false, emails will be dropped. If true and copyTo field is empty, emails will be delivered to your mailbox. If true and copyTo is set with an address, emails will be delivered to this address (type: boolean)
            'from' => $from, // Date of start responder (type: datetime)
            'to' => $to, // Date of end responder (type: datetime)
        ));

        return true;
    } catch (RequestException $e) {                        
        return false;
    }
}

function deleteApi($array)
{
    $domain = $array['domain'];
    $account = $array['account'];
    $conn = $array['conn'];

    try {  
        $conn->delete("/email/domain/$domain/responder/$account/");
        return true;
    } catch (RequestException $e) {
        // $response = $e->getResponse();
        // $responseBodyAsString = $response->getBody()->getContents();
        // echo $responseBodyAsString;
        
        return false;
    }
}