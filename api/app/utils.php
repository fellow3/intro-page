<?php

function getDB() {
    // Create (connect to) SQLite database in file
     $db = new PDO('sqlite:fellow_alpha.sqlite3');
     //mysql
     //new PDO("mysql:dbname=$dbname;host=$servername",$username,$password);
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
