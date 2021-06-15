<?php

/**
 * Configuration for database connection
 *
 */

$host       = "us-cdbr-east-04.cleardb.com";
$username   = "b7e40fb9de4cec"; // admin 
$password   = "b5692dc4"; // password 
$dbname     = "heroku_6c89511a6790ebd"; // dbproj 
// dsn below
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              ); 

/* 
LINK TO PHP MY ADMIN 
*/ 

$dsn = "mysql:host=$host;dbname=$dbname";

try {
   $db = new PDO($dsn, $username, $password, $options); // try to connect to the database 
} 
catch (PDOException $e) { // handle a PDO exception 
   $error_message = $e->getMessage();
   echo "<p>An error occurred while connecting to the database: $error_message </p>";
} 
catch (Exception $e) { // handle any type of exception
   $error_message = $e->getMessage();
   echo "<p>Error message: $error_message </p>";
}

?>

