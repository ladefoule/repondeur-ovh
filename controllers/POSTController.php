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
        $classError = $array['classError'];
        $messageError = $array['messageError'];

        $result = postApi($array);

        if($result) {      
            $class = 'success';
            $message = "Répondeur créé avec succès !";
        }else{                        
            $class = $classError;
            $message = $messageError;
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
}
