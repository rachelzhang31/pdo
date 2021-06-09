<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "root"; // admin 
$password   = ""; // password 
$dbname     = "dbproj"; // dbproj 
// dsn below
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              ); 

/* 
LINK TO PHP MY ADMIN 
*/ 

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

<?php
// to close a connection 
// $db = null;
?>