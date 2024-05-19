<?php

use app\controllers\AuthController;
use app\core\Application;
use app\controllers\SiteController;

require_once __DIR__.'/../vendor/autoload.php';

// setup env variables
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

// setup config
$config = [
    'userClass' => \app\models\User::class,
    'db' =>  [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD']
    ]
];

// setup app
$app = new Application(dirname(__DIR__), $config);

// setup routes
$app->router->get('/', [SiteController::class, 'home']);
// dans Router.resolve() call_user_func() essaye d'éxécuter la fonction 'handleContact' qui est dans la classe SiteController

// auth routes
$app->router->get('/connexion', [AuthController::class, 'login']);
$app->router->post('/connexion', [AuthController::class, 'login']);
$app->router->get('/inscription', [AuthController::class, 'register']);
$app->router->post('/inscription', [AuthController::class, 'register']);
$app->router->get('/deconnexion', [AuthController::class, 'logout']);

$app->run();
