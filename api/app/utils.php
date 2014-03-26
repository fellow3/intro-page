<?php

function getDB() {
    // Create (connect to) SQLite database in file
    $settings = getSettings();
    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    ); 
    $dsn = 'mysql:host='.$settings['db_host'].';dbname='.$settings['db_database'];
    $db = new PDO($dsn, $settings['db_user'], $settings['db_password'], $options);
    //mysql
    // Set errormode to exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);

    return $db;
}

function geNorORM() {
    $db = getDB();
    $norm = 'TODO';
    return $norm;
}

function sqlInsertArray($keys) {
    $sql = array();
    foreach ($keys as $key) {
        array_push($sql, "$key=:$key");
    }
    return implode(', ', $sql);
}
