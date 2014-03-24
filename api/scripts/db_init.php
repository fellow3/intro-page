<?php
 
  // Set default timezone
  date_default_timezone_set('UTC');
 
  try {
    /**************************************
    * Create databases and                *
    * open connections                    *
    **************************************/
 
    // Create (connect to) SQLite database in file
    $file_db = new PDO('sqlite:fellow_alpha.sqlite3');
    // Set errormode to exceptions
    $file_db->setAttribute(PDO::ATTR_ERRMODE, 
                            PDO::ERRMODE_EXCEPTION);
 
    /**************************************
    * Create tables                       *
    **************************************/
 
    // Create table messages
    $file_db->exec("CREATE TABLE IF NOT EXISTS user_survey (
                    id INTEGER PRIMARY KEY NOT NULL, 
                    email VARCHAR(255), 
                    degree VARCHAR(255), 
                    phone VARCHAR(36), 
                    age INTEGER,
                    nationality VARCHAR(255), 
                    regions VARCHAR(255), 
                    interests TEXT, 
                    created TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");
    } catch (PDOException $e) {
        print $e->getMessage();
    }
