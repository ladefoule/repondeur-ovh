<?php 
require '../config.php';

session_name($cookieName);
session_start();

// On calcule la durée de la session en fonction du choix de l'utilisateur à la connexion (1 jour par défaut ou 1 an s'il veut garder la session active)
if(isset($_SESSION['remember']) && $_SESSION['remember'])
    $expires = time()+60*60*24*365;
else
    $expires = time()+60*60;

setcookie($cookieName, $_COOKIE[$cookieName] ?? '', $expires, '/', $singleSession ? $domain : '', false, true);

use Carbon\Carbon;

require __DIR__ . '/../vendor/autoload.php';

Carbon::setLocale($lang);

$content = ''; // Layout content

$routes = [
    'GET' => ['index', 'create', 'show', 'delete', 'logout'],
    'POST' => ['index', 'create'],
];

$referer = $_SERVER['HTTP_REFERER'] ?? '/';
$messageError = $messageError . " <a class='ml-3 icon-left-outline' href='$referer'>retour</a>";

$account = $_SESSION['account'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? 'index';

// Si la route n'existe pas ou si elle existe mais que l'utilisateur n'est pas connecté
if(! in_array($action, $routes[$method]) || (! $account && $action != 'index')){
    header("Location: /");
    exit;
}

$api = new ApiOvh([
    'application_key' => $applicationKey,
    'application_secret' => $applicationSecret,
    'consumer_key' => $consumerKey,
    'endpoint' => $endpoint,
]);

// Les données utilisées dans les différentes méthodes des models et controllers
$global = [
    'domain' => $domain,
    'account' => $account,
    'api' => $api,
    'buttons' => $buttons,
    'action' => $action,
    'cookie_name' => $cookieName,
    'single_session' => $singleSession,
    'imap_server' => $imapServer,
    'class_error' => $classError,
    'message_error' => $messageError,
];

$controller = $method.'Controller';

ob_start();
$global = $controller::$action($global);
$content = ob_get_clean();

$responder = $api->get($global);
$account = $global['account'];
require '../views/layout.php';
