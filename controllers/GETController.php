<?php

use Carbon\Carbon;

class GETController
{
    /**
     * Method create
     *
     * @param array $array
     *
     * @return array
     */
    public static function create(array $array)
    {
        // Variables utilisées dans la view form.php
        $domain = $array['domain'];
        $account = $array['account'];
        $action = $array['action'];
        $to = $from = $copy = $content = '';
        $formMethod = 'POST';
        $buttons = $array['buttons'];

        
        if(isset($_SESSION['form'])){
            $copy = $_SESSION['form']['copy'];
            $from = $_SESSION['form']['from'];
            $to = $_SESSION['form']['to'];
            $content = $_SESSION['form']['content'];
        }
        
        include('./views/form.php');
        return $array;
    }
    
    /**
     * Method show
     *
     * @param array $array
     *
     * @return array
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

            // Variables utilisées dans la view form.php
            $copy = $result['copy'];
            $content = htmlentities($result['content']);
            $from = new Carbon($result['from']);
            $from = $from->format('Y-m-d');
            $to = new Carbon($result['to']);
            $to = $to->format('Y-m-d');

            include('./views/form.php');
        } else {
            $class = $classError;
            $message = $messageError;
            include('./views/notification.php');

            include('./views/logged.php');
        }

        return $array;
    }
    
    /**
     * Method delete
     *
     * @param array $array
     *
     * @return array
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

        return $array;
    }
    
    /**
     * Method logout
     *
     * @param array $array
     *
     * @return array
     */
    public static function logout(array $array)
    {
        session_destroy();
        
        $message = "Vous êtes déconnecté.";
        $class = "success";
        include('./views/notification.php');
        
        // Variables utilisées dans la view login.php
        $account = '';
        $domain = $array['domain'];
        include('./views/login.php');
        
        $array['account'] = '';
        return $array;
    }
    
    /**
     * Method index
     *
     * @param array $array
     *
     * @return array
     */
    public static function index(array $array)
    {
        // Variables utilisées dans la view logged.php
        $action = $array['action'];
        $buttons = $array['buttons'];
        $account = $array['account'];
        $domain = $array['domain'];
        $responder = getApi($array);

        if($account)
            include('./views/logged.php');
        else
            include('./views/login.php');

        return $array;
    }
}
