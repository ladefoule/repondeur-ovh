<?php

class POSTController
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
        $api = $global['api'];
        $result = $api->post($global);

        if($result) {
            $class = 'success';
            $message = "Répondeur créé avec succès !";
        }else{                        
            $class = $global['class_error'];
            $message = $global['message_error'];
        }
        include('../views/notification.php');

        // Variables utilisées dans la view logged.php
        $action = $global['action'];
        $buttons = $global['buttons'];
        $account = $global['account'];
        $domain = $global['domain'];
        $responder = $api->get($global);
        include('../views/logged.php');
        return $global;
    }
    
    /**
     * index
     *
     * @param  mixed $global
     * @return void
     */
    public static function index(array $global)
    {
        $api = $global['api'];
        $domain = $global['domain'];
        $account = $global['account'];
        $buttons = $global['buttons'];
        $imapServer = $global['imap_server'];
        $cookieName = $global['cookie_name'];
        $singleSession = $global['single_session'];

        $email = htmlspecialchars($_POST['account']) .'@'. $domain;
        $password = htmlspecialchars($_POST['password']);
        $remember = isset($_POST['remember']) ? true : false;

        if (! canLoginEmailAccount($imapServer, $email, $password)){        
            $class = 'danger';
            $message = "Impossible de vous connecter, veuillez rééssayer.";
            include('../views/notification.php');

            $account = '';
            include('../views/login.php');
        }else{
            // Variables utilisées dans la view logged.php
            $account = htmlspecialchars($_POST['account']);
            
            $_SESSION['account'] = $account; // On active la SESSION
            $global['account'] = $account; // On met à jour la variable $global
            
            if($remember)
                $expires = time()+60*60*24*365; // 1 an
            else
                $expires = time()+60*60; // 1 heure

            $cookieDomain = $singleSession ? $domain : '';
            $cookie = [
                'expires' => $expires,
                'domain' => $cookieDomain,
                'account' => $account,
            ];

            setcookie($cookieName, serialize($cookie), $expires, '/', $cookieDomain, false, true);
            
            $responder = $api->get($global);
            include('../views/logged.php');
        }

        return $global;
    }
}
