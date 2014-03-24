<?php

$app = \Slim\Slim::getInstance();
$app->get('/users', function() use ($app) {
    //echo 'you landed on users page';
    $app->render(200, array('name'=>'foobar'));
    
});

$app->get('/user/login', function() use ($app) {
echo('login page');
});
$app->get('/user/:id', function($id) use ($app) {
    User::get($id);    
});

class User {
    public static function get() {
    }
}
