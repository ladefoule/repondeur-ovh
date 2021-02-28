<?php

use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;

class GETController
{

    public static function create(array $array)
    {
        $to = $from = $copy = $content = '';
        include('../views/form.php');
    }

    public static function show(array $array)
    {
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $action = $array['action'];
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

        // ob_start();
        include('./views/form.php');
        // $contenu = ob_get_clean();
    }

    public static function delete(array $array)
    {
        session_destroy();
        $needToConnect = true;
        $account = '';
        // ob_start();
        include('./views/login.php');
        // $contenu = ob_get_clean();
    }

    public static function default(array $array)
    {
        // ob_start();
        $buttons = $array['buttons'];
        $domain = $array['domain'];
        $account = $array['account'];
        $conn = $array['conn'];
        $responderAvailable = $array['responderAvailable'];
        include('./views/logged.php');
        // $contenu = ob_get_clean();
    }
}
