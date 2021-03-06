<?php

use Carbon\Carbon;

class GETController
{
    /**
     * Method create
     *
     * @param array $global
     *
     * @return array
     */
    public static function create(array $global)
    {
        // Variables utilisées dans la view form.php
        $domain = $global['domain'];
        $account = $global['account'];
        $action = $global['action'];
        $to = $from = $content = '';
        $copy = true;
        $formMethod = 'POST';
        
        if(isset($_SESSION['form'])){
            $copy = $_SESSION['form']['copy'];
            $from = $_SESSION['form']['from'];
            $to = $_SESSION['form']['to'];
            $content = $_SESSION['form']['content'];
        }
        
        include('../views/form.php');
        return $global;
    }
    
    /**
     * Method show
     *
     * @param array $global
     *
     * @return array
     */
    public static function show(array $global)
    {
        $domain = $global['domain'];
        $account = $global['account'];
        $api = $global['api'];
        $action = $global['action'];

        $responder = $api->get($global);

        if($responder) {
            // Variables utilisées dans la view form.php
            $copy = $responder['copy'];
            $content = htmlentities($responder['content']);
            $from = new Carbon($responder['from']);
            $from = $from->format('Y-m-d');
            $to = new Carbon($responder['to']);
            $to = $to->format('Y-m-d');

            include('../views/form.php');
        } else {
            $class = $global['class_error'];
            $message = $global['message_error'];
            include('../views/notification.php');

            include('../views/logged.php');
        }

        return $global;
    }

    /**
     * Method update
     *
     * @param array $global
     *
     * @return array
     */
    public static function update(array $global)
    {
        $domain = $global['domain'];
        $account = $global['account'];
        $api = $global['api'];
        $action = $global['action'];
        $formMethod = 'POST';

        $responder = $api->get($global);

        if($responder) {
            // Variables utilisées dans la view form.php
            $content = htmlentities($responder['content']);
            $from = new Carbon($responder['from']);
            $from = $from->format('Y-m-d');
            $to = new Carbon($responder['to']);
            $to = $to->format('Y-m-d');

            if(isset($_SESSION['form'])){
                $from = $_SESSION['form']['from'];
                $to = $_SESSION['form']['to'];
                $content = $_SESSION['form']['content'];
            }

            include('../views/form.php');
        } else {
            $class = $global['class_error'];
            $message = $global['message_error'];
            include('../views/notification.php');

            include('../views/logged.php');
        }

        return $global;
    }
    
    /**
     * Method delete
     *
     * @param array $global
     *
     * @return array
     */
    public static function delete(array $global)
    {
        $api = $global['api'];
        $result = $api->delete($global);
        if($result) {  
            $class = 'success';
            $message = "Répondeur supprimé avec succès !";
        }else{            
            $class = $global['class_error'];
            $message = $global['message_error'];
        }
        include('../views/notification.php');
        
        // Variables utilisées dans la view logged.php
        $action = $global['action'];
        $account = $global['account'];
        $domain = $global['domain'];
        $responder = $api->get($global);
        include('../views/logged.php');

        return $global;
    }
    
    /**
     * Method logout
     *
     * @param array $global
     *
     * @return array
     */
    public static function logout(array $global)
    {
        $cookieName = $global['cookie_name'];
        $domain = $global['domain'];
        $singleSession = $global['single_session'];

        // Suppression de la session
        session_destroy();

        // Suppression du cookie
        if(isset($_COOKIE[$cookieName])){
            unset($_COOKIE[$cookieName]);
            setcookie($cookieName, null, time() - 3600, '/', $singleSession ? $domain : '');
        }
        
        
        $message = "Vous êtes déconnecté.";
        $class = "success";
        include('../views/notification.php');
        
        // Variables utilisées dans la view login.php
        $account = '';
        $domain = $global['domain'];
        include('../views/login.php');
        
        $global['account'] = '';
        return $global;
    }
    
    /**
     * Method index
     *
     * @param array $global
     *
     * @return array
     */
    public static function index(array $global)
    {
        $api = $global['api'];

        // On supprime les données du formulaire potentiellement sauvegardées dans la SESSION
        unset($_SESSION['form']); 

        // Variables utilisées dans la view logged.php
        $action = $global['action'];
        $account = $global['account'];
        $domain = $global['domain'];
        
        if($account){
            $responder = $api->get($global);
            include('../views/logged.php');
        }else
            include('../views/login.php');

        return $global;
    }
}
