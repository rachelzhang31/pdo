<?php

/**
 * Configuration for database connection using ClearDB and Heroku 
 * The host, username, password, and database name were all retrieved 
 * from ClearDB on Heroku 
 */

$host       = "us-cdbr-east-04.cleardb.com";
$username   = "b7e40fb9de4cec"; 
$password   = "b5692dc4"; 
$dbname     = "heroku_6c89511a6790ebd"; 

$dsn = "mysql:host=$host;dbname=$dbname";

try {
   $db = new PDO($dsn, $username, $password); // try to connect to the database 
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
