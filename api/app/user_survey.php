<?php

require_once 'utils.php';

$app = \Slim\Slim::getInstance();

$app->post('/user_survey', function() use($app) {
    $db=getDB();
    $content = $app->request->getBody();
    if ( $content == '' ) {
        return $app->render(400, array('message'=>'Invalid JSON'));
    }
    $content = json_decode($content, true);

    if ( isset($content['email']) ) {
        $sql = $db->prepare('INSERT INTO user_survey (email) VALUES (:email)');
        $sql->execute(array(':email'=>$content['email']));
        $lastID = $db->lastInsertId();
        return $app->render(200, array('id'=>$lastID));
    }

    return $app->render(400, array("message"=>"email"));

});


$app->put('/user_survey/:id', function($id) use($app) {
    $db = getDB();
    $content = $app->request->getBody();
    $content = json_decode($content, true);
    if ( empty($content)) {
        return $app->render(400, array("message"=> 'Invalid JSON'));
    }

    $keys = array('degree', 'phone', 'age', 'nationality', 'regions', 'interests');
    $insertParams = array();
    foreach ($keys as $key) {
        if ( isset($content[$key]) ) {
            $insertParams[":$key"] = $content[$key];
        } else {
            $insertParams[":$key"] = null;
        }
    }

    $sql_col = sqlInsertArray($keys);
    $sql = $db->prepare('UPDATE user_survey SET '. $sql_col.' WHERE id=:id');
    $sql->bindValue(':id', $id);
    $sql->execute($insertParams);

    return $app->render(200, array('id'=>$id));
});

$app->get('/user_survey/all', function() use ($app) {
    $db = getDB();
    $sql = $db->prepare("SELECT * from user_survey");
    $sql->execute();
    $ret = $sql->fetchAll(PDO::FETCH_ASSOC);
    $app->contentType('application/json');
    echo(json_encode($ret));

});

//TODO:
//move application out of route
//use standard init routing
//try catch all pdo statement
//separate php return with router return
//
