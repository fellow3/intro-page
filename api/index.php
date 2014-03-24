<?php
require 'vendor/autoload.php';

// Prepare app
$app = new \Slim\Slim(array(
    'templates.path' => 'templates',
    'mode' => 'development',
    'debug' => true,
));

// Create monolog logger and store logger in container as singleton 
// (Singleton resources retrieve the same log resource definition each time)
$app->container->singleton('log', function () {
    $log = new \Monolog\Logger('slim-skeleton');
    $log->pushHandler(new \Monolog\Handler\StreamHandler('logs/app.log', \Monolog\Logger::DEBUG));
    return $log;
});

// Prepare view
/*$app->view(new \Slim\Views\Twig());
$app->view->parserOptions = array(
    'charset' => 'utf-8',
    'cache' => realpath('templates/cache'),
    'auto_reload' => true,
    'strict_variables' => false,
    'autoescape' => true
);
$app->view->parserExtensions = array(new \Slim\Views\TwigExtension());

// Define routes
$app->get('/', function () use ($app) {
    // Sample log message
    $app->log->info("Slim-Skeleton '/' route");
    // Render index view
    $app->render('index.html');
});
 */

require_once 'libs/JSONApiView.php';
$app->view(new \JSONApiView());
$app->hook('slim.before.router', function () use($app)
{
    $uri = $app->request()->getResourceUri();

    if (($k = strpos($uri, "/", 1)) === false)
    {
        $controller = $uri;
    }
    else
    {
        $controller = substr($uri, 0, $k);
    }

    // define controllers here
    switch ($controller)
    {
        case "/users": require_once("app/user.php"); break;
        case "/user": require_once("app/user.php"); break;
        case "/user_survey": require_once("app/user_survey.php"); break;
    }
});

$app->get('/hello/:name', function($name) use ($app) {
    echo "hello $name";
});
$app->get('/hello', function() use ($app) {
    echo "hello sexy";
});
// Run app
$app->run();
