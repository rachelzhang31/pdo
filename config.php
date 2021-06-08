<?php

/**
 * Configuration for database connection
 *
 */

$host       = "localhost";
$username   = "root"; // admin 
$password   = "root"; // password 
$dbname     = "test"; // dbproj 
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );