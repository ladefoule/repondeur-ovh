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

        // $copy = isset($_POST['copy']) ? true : false;
        // $content = htmlentities($_POST['content']);
        // $from = new Carbon($_POST['from']);
        // $to = new Carbon($_POST['to']);

        $result = postApi($array);

        if($result) {      
            $class = 'success';
            $message = "Répondeur créé avec succès !";
        }else{                        
            $class = $classError;
            $message = $messageError;
        }

        include('./views/notification.php');
        include('./views/logged.php');
    }
}
