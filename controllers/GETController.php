<?php

use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class GETController
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
        $action = $array['action'];
        $to = $from = $copy = $content = '';
        $formMethod = 'POST';
        
        include('./views/form.php');
    }
    
    /**
     * Method show
     *
     * @param array $array
     *
     * @return void
     */
    public static function show(array $array)
    {
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $action = $array['action'];
        $classError = $array['classError'];
        $messageError = $array['messageError'];
        $formMethod = 'GET';

        try {
            $result = $conn->get("/email/domain/$domain/responder/$account/");
            $copy = $result['copy'];
            $content = htmlentities($result['content']);
            $from = new Carbon($result['from']);
            $from = $from->format('Y-m-d');
            $to = new Carbon($result['to']);
            $to = $to->format('Y-m-d');
        } catch (RequestException $e) {
            $class = $classError;
            $message = $messageError;
        }

        include('./views/form.php');
    }
    
    /**
     * Method delete
     *
     * @param array $array
     *
     * @return void
     */
    public static function delete(array $array)
    {
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $action = $array['action'];
        $buttons = $array['buttons'];
        $classError = $array['classError'];
        $messageError = $array['messageError'];

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

        include('./views/logged.php');
    }
    
    /**
     * Method logout
     *
     * @param array $array
     *
     * @return void
     */
    public static function logout(array $array)
    {
        session_destroy();
        $needToConnect = true;
        $account = '';
        include('./views/login.php');
    }
    
    /**
     * Method default
     *
     * @param array $array
     *
     * @return void
     */
    public static function default(array $array)
    {
        $buttons = $array['buttons'];
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $responderAvailable = $array['responderAvailable'];
        include('./views/logged.php');
    }
}
