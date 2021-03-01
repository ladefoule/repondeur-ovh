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
        $buttons = $array['buttons'];
        
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
        $buttons = $array['buttons'];

        $result = getApi($array);

        if($result) {
            $result = $conn->get("/email/domain/$domain/responder/$account/");
            $copy = $result['copy'];
            $content = htmlentities($result['content']);
            $from = new Carbon($result['from']);
            $from = $from->format('Y-m-d');
            $to = new Carbon($result['to']);
            $to = $to->format('Y-m-d');
        } else {
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
        $result = deleteApi($array);
        if($result) {  
            $class = 'success';
            $message = "Répondeur supprimé avec succès !";
        }else{            
            $class = $array['classError'];
            $message = $array['messageError'];
        }
        include('./views/notification.php');
        
        // Variables utilisées dans la view logged.php
        $action = $array['action'];
        $buttons = $array['buttons'];
        $account = $array['account'];
        $domain = $array['domain'];
        $responder = getApi($array);
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
        
        $message = "Vous êtes déconnecté.";
        $class = "success";
        include('./views/notification.php');
        
        $account = '';
        $account = $array['account'];
        $domain = $array['domain'];
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
        // Variables utilisées dans la view logged.php
        $action = $array['action'];
        $buttons = $array['buttons'];
        $account = $array['account'];
        $domain = $array['domain'];
        $responder = getApi($array);
        include('./views/logged.php');
    }
}
